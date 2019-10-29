<?php
include_once("model/User.php");

class UserController extends MainController{
    
    public $user;
    
    public function __construct() {
        parent::__construct();
        $this->user = new User();
    }

    //Header of the controler
    public function main() {
        if (isset($_REQUEST['do'])) {
            $do = $_REQUEST['do'];
        } else {
            $do = "LoginMenu";
        }
        $this->$do();
    }

    // LOGIN MENU //////////////////////////////////////////////////////////////////////////
    public function LoginMenu() {
        $data['conn'] = $this->user->getConnection();
        if(isset($_REQUEST['nqb']) ? $data['nqb'] = $_REQUEST['nqb'] : null);
        if(isset($_REQUEST['dc']) ? $data['dc'] = $_REQUEST['dc'] : null);
        //Esto nos muestra si el error al logearse fué del nick o de la contraseña
        if(isset($_REQUEST['bflc'])){
            if($_REQUEST['bflc'] == "pass"){
                $data['bflc'] = "pass";
            }
            if($_REQUEST['bflc'] == "user"){
                $data['bflc'] = "user";
            }
        }
        View::show("users/LoginMenu", $data);
    }

    // LOGIN CHECK ///////////////////////////////////////////////////////////////////////////////////
    public function LoginCheck() {
        // Aqui le llega el data ay $data con todo la información del usuario
        // que intenta entrar o null si no tiene nada
        //Requisitos el nick y la contraseña en REQUEST
        if (isset($_REQUEST['nick']) && isset($_REQUEST['password'])) {
            //Si todo está establecido buscamos el usuario
            $usuario = $this->user->getEverything($_REQUEST['nick']); 
            //Comprobamos que el usuario existe
            if(!$usuario){
                //Si llegamos aqui es que no hemos encontrado el usuario
                //bflc -> back from logincheck // user
                $redirect['mainDo'] = "UserController";
                $redirect['bflc'] = "user";
                View::redirect("LoginMenu", $redirect);
                //echo ("<script>location.href='index.php?do=LoginMenu&bflc=user'</script>");
                exit();
            }

            //Comprobamos si la contraseña es correcta
            if ($usuario->password != $_REQUEST["password"]) {
                //bflc -> back from logincheck // pass
                $redirect['mainDo'] = "UserController";
                $redirect['bflc'] = "pass";
                View::redirect("LoginMenu", $redirect);
                //echo ("<script>location.href='index.php?do=LoginMenu&bflc=pass'</script>");
                exit();
            }

            //Si ES correcta selecciona el tipo de usuario y entra
            $aux = $this->user->getTipo($_REQUEST['nick']);
            if ($aux == 0) {
                //Sistituimos la variable auxiliar porque podemos
                $aux = true;
            } else {
                $aux = false;
            }

            $this->security->openSession($_REQUEST['nick'], $aux);
            //Nos manda al panel del usuario
            $data['mainDo'] = "UserController";
            View::redirect("UserMenu", $data);
            //echo ("<script>location.href='index.php?mainDo=UserController&do=UserMenu'</script>");
        } else {
            $data['mainDo'] = "UserController";
            View::redirect("NoPermissionError", $data);
        }
    }

    // REGISTER MENU //////////////////////////////////////////////////////////////////////////
    public function RegisterMenu(){
        $data = Array();
        if(isset($_REQUEST['uyc']) ? $data['uyc'] = $_REQUEST['uyc'] : null);
        if(isset($_REQUEST['cda']) ? $data['cda'] = true : null);
        //$data['mainDo'] = "UserController";
        View::show("/users/RegisterMenu", $data);
    }

    // REGISTER CHECH //////////////////////////////////////////////////////////////////////////
    public function RegisterCheck(){
        //Si está declara la variable que se crea al hacer un registro
        //Al volver despues de registrar comprobamos si existe con ese nick
        if (isset($_REQUEST['rNick'])) {
            if($this->user->getEverything($_REQUEST['rNick'])){
                $rNick = $_REQUEST['rNick'];
                echo ("<script>location.href='index.php?mainDo=UserController&do=RegisterMenu&uyc=$rNick'</script>");
                exit();
            }
           
            do{
                $idRand = rand(99999, 1000000);
            } while($this->user->getEverything($idRand) != false);
            
            $arr = array($idRand,
                        $_REQUEST['rNick'], 
                        $_REQUEST['rEmail'], 
                        $_REQUEST['rPassword'],
                        0);
            
            echo($this->user->insert($arr));

            $nick = $arr[1];
            $password = $arr[3];

            // Para que al crear un nuevo usuario si esamos creandolo
            // desde una cuenta admin no nos cambie a la otra
            $redirect['mainDo'] = "UserController";
            View::redirect("ManageUsers", $redirect);
            /*if(isset($_REQUEST['cda'])){
                echo ("<script>location.href='index.php?mainDo=UserController&do=UserMenu'</script>");
            } else {
                echo ("<script>location.href='index.php?mainDo=UserController&do=LoginCheck&nick=$nick&password=$password'</script>");
            }*/
        } else {
            echo ("<script>location.href='index.php?mainDo=UserController&do=NoPermissionError'</script>");
        }
    }

    // USER MENU //////////////////////////////////////////////////////////////////////////
    public function UserMenu(){
        $data = Array();
        $data['rows'] = $this->user->getAll();
        $data['user'] = $this->user->getEverything($this->security->getNick());
        $data['security'] = $this->security;
        if(isset($_REQUEST['nqb']) ? $data['nqb'] = $_REQUEST['nqb'] : null);
        if(isset($_REQUEST['umc']) ? $data['umc'] = $_REQUEST['umc'] : null);
        if($this->security->isAdmin()){
            View::show("users/UserMenuAdmin", $data);
        } else {
            View::show("users/UserMenuUser", $data);
        }
        
    }

    // MANAGE USERS  //////////////////////////////////////////////////////////////////////////
    public function ManageUsers(){
        $data['rows'] = $this->user->getAll();
        View::show("users/ManageUsersMenu", $data);
    }

    // DISCONNECTION CHECK //////////////////////////////////////////////////////////////////////////
    public function DisconnectCheck(){
        $this->security->closeSession();
        echo ("<script>location.href='index.php?mainDo=UserController&do=LoginMenu&dc=true'</script>");
    }

    // MODIFY MENU //////////////////////////////////////////////////////////////////////////
    public function ModifyMenu() {
        $data['security'] = $this->security;
        $data['id'] = $_REQUEST['id'];
        if(isset($_REQUEST['nyo']) ? $data['nyo'] = $_REQUEST['nyo'] : null);
        View::show("users/ModifyMenu", $data);
        //include("view/users/ModifyMenu.php");
    }

    // MODIFY CHECK //////////////////////////////////////////////////////////////////////////
    public function ModifyCheck(){
        if ($this->security->check()) {
            //Recorremos los usuarios para ver si conciden con el nuevo nick
            //Si lo hace lo mandamos al menu de modificar otra vez
            $registros = $this->user->getAll();
            foreach($registros as $registro){
                //En el caso de que se encuentre uno
                if ($registro->nick == $_REQUEST['mNick']) {
                    //Si no es el mismo que el de la sesion es que está pillado
                    if ($registro->nick != $this->security->getNick()) {
                        // nyo = Nick ya ocupado
                        $redirect['mainDo'] = "UserController";
                        $redirect['id'] = $_REQUEST['id'];
                        $redirect['nyo'] = $_REQUEST['mNick'];
                        View::redirect("ModifyMenu", $redirect);
                        //echo("<script>location.href='index.php?mainDo=UserController&do=ModifyMenu&id=".$_REQUEST['id']."&nyo=".$_REQUEST['mNick']."'</script>");
                        exit();
                    }
                }
            }
            
            //Si no encuetra el usuario 
            $result = $this->user->getEverything($_REQUEST['id']);
            //Cogemos la id para cambiar desde aqui en el select
            $id = $result->id;

            //Mandamos la actualizacion
            $arr = array($_REQUEST['mNick'], 
                        $_REQUEST['mEmail'], 
                        $_REQUEST['mPassword'],
                        0);
            $this->user->update($arr, $id);
            //Si modificamos los datos del que estamos rehacemos la sesion
            if ($_REQUEST['id'] == $this->security->getNick()) {
                $this->security->openSession($_REQUEST['mNick'], true);
            }

            //Nos dirigimos al menu de usuario
            $redirect2['mainDo'] = "UserController";
            $redirect2['umc'] = $_REQUEST['id'];
            View::redirect("ManageUsers", $redirect2);
            //echo ("<script>location.href='index.php?do=UserMenu&umc=$aux'</script>");
        } else {
            echo ("<script>location.href='index.php?mainDo=UserController&do=NoPermissionError'</script>");
        }
    }

    // DELETE MENU //////////////////////////////////////////////////////////////////////////
    public function DeleteMenu() {
        $data = Array();
        $data['id'] = $_REQUEST['id'];
        $data['nick'] = $_REQUEST['nick'];
        $data['security'] = $this->security;
        View::show("users/DeleteMenu", $data);
        //include("view/users/DeleteMenu.php");
    }

    // DELETE CHECK //////////////////////////////////////////////////////////////////////////
    public function DeleteCheck() {
        if ($this->security->check()) {
            $this->user->delete("id", $_REQUEST['id']);
            //Si hemos destruido un usuario propio nos manda al menú principal
            if ($this->user->getNick($_REQUEST['id']) == $this->security->getNick()) {
                $this->security->closeSession();
                $redirect['mainDo'] = "UserController";
                $redirect['id'] = $_REQUEST['id'];
                View::redirect("LoginMenu", $redirect);
                //echo("<script>location.href='index.php?do=LoginMenu&id=".$_REQUEST['id']."'</script>");
            } else {
                $redirect['mainDo'] = "UserController";
                $redirect['id'] = $_REQUEST['id'];
                View::redirect("ManageUsers", $redirect);
                //echo("<script>location.href='index.php?do=UserMenu&id=".$_REQUEST['id']."'</script>");
            }
        } else {
            echo("<script>location.href='index.php?do=NoPermissionError'</script>");
        }
    }

    public function goToCine(){
        echo ("<script>location.href='http://localhost/cine/index.php'</script>");
    }

    // CONNECTION ERROR //////////////////////////////////////////////////////////////////////////
    public function ConnectionError(){
        include("view/ConnectionError.php");
    }

    // NO PERMISSION ERROR //////////////////////////////////////////////////////////////////////////
    public function NoPermissionError(){
        include("view/NoPermissionError.php");
    }

    // PAGE NOT FOUND //////////////////////////////////////////////////////////////////////////
    public function Default(){
        include("view/Default.php ");
    }

} // class controller
?>