<?php
include("model/User.php");
include("model/Security.php");
include("view/header.php");

class Controller {
    
    public $user;
    public $security;

    public function __construct() {
        //Models
        $this->user = new User();
        $this->security = new Security();
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
        include("view/LoginMenu.php");
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
                echo ("<script>location.href='index.php?do=LoginMenu&bflc=user'</script>");
                exit();
            }

            //Comprobamos si la contraseña es correcta
            if ($usuario->passwd != $_REQUEST["password"]) {
                //bflc -> back from logincheck // pass
                echo ("<script>location.href='index.php?do=LoginMenu&bflc=pass'</script>");
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
            echo ("<script>location.href='index.php?do=UserMenu'</script>");
        } else {
            echo ("<script>location.href='index.php?do=NoPermissionError'</script>");
        }
    }

    // REGISTER MENU //////////////////////////////////////////////////////////////////////////
    public function RegisterMenu(){
        $data = Array();
        if(isset($_REQUEST['uyc']) ? $data['uyc'] = $_REQUEST['uyc'] : null);
        if(isset($_REQUEST['cda']) ? $data['cda'] = true : null);
        include("view/RegisterMenu.php");
    }

    // REGISTER CHECH //////////////////////////////////////////////////////////////////////////
    public function RegisterCheck(){
        //Si está declara la variable que se crea al hacer un registro
        //Al volver despues de registrar comprobamos si existe con ese nick
        if (isset($_REQUEST['rName'])) {
            if($this->user->getEverything($_REQUEST['rNick'])){
                $rNick = $_REQUEST['rNick'];
                echo ("<script>location.href='index.php?do=RegisterMenu&uyc=$rNick'</script>");
                exit();
            }

            if (!isset($_REQUEST['rAdmin'])) 
                $admin = 1;
            else
                $admin = 0;

            $arr = array($_REQUEST['rName'], 
                        $_REQUEST['rSurname'], 
                        $_REQUEST['rEmail'], 
                        $_REQUEST['rNick'], 
                        $_REQUEST['rPassword'], 
                        $admin);
            
            echo($this->user->insert($arr));

            $nick = $arr[3];
            $password = $arr[4];
            // Para que al crear un nuevo usuario si esamos creandolo
            // desde una cuenta admin no nos cambie a la otra
            if(isset($_REQUEST['cda'])){
                echo ("<script>location.href='index.php?do=UserMenu'</script>");
            } else {
                echo ("<script>location.href='index.php?do=LoginCheck&nick=$nick&password=$password'</script>");
            }
        } else {
            echo ("<script>location.href='index.php?do=NoPermissionError'</script>");
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
            include("view/UserMenuAdmin.php");
        } else {
            include("view/UserMenuUser.php");
        }
        
    }

    // DISCONNECTION CHECK //////////////////////////////////////////////////////////////////////////
    public function DisconnectCheck(){
        $this->security->closeSession();
        echo ("<script>location.href='index.php?do=LoginMenu&dc=true'</script>");
    }

    // MODIFY MENU //////////////////////////////////////////////////////////////////////////
    public function ModifyMenu() {
        $data['security'] = $this->security;
        $data['nqm'] = $_REQUEST['nqm'];
        if(isset($_REQUEST['nyo']) ? $data['nyo'] = $_REQUEST['nyo'] : null);
        include("view/ModifyMenu.php");
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
                    if ($registro->nick != $_SESSION['nick']) {
                        // nyo = Nick ya ocupado
                        echo("<script>location.href='index.php?do=ModifyMenu&nqm=".$_REQUEST['nqm']."&nyo=".$_REQUEST['mNick']."'</script>");
                        exit();
                    }
                }
            }

            //Si no encuetra el usuario 
            $result = $this->user->getEverything($_REQUEST['nqm']);
            //Cogemos la id para cambiar desde aqui en el select
            $id = $result->idusuario;

            //Preparaciones para asignar el valor de admin
            if (isset($_REQUEST['mAdmin'])) {
                $admin = 0;
                $adminAux = true;
            } else {
                $admin = 1;
                $adminAux = false;
            }

            //Mandamos la actualizacion
            $arr = array($_REQUEST['mName'], 
                        $_REQUEST['mSurname'], 
                        $_REQUEST['mEmail'], 
                        $_REQUEST['mNick'], 
                        $_REQUEST['mPassword'], 
                        $admin);
            $this->user->update($arr, $id);
            //$conn->query("UPDATE usuarios SET nombre = \"" . $_REQUEST['mName'] . "\", apellido = \"" . $_REQUEST['mSurname'] . "\", email = \"" . $_REQUEST['mEmail'] . "\", nick = \"" . $_REQUEST['mNick'] . "\", passwd = \"" . $_REQUEST['mPassword'] . "\", tipo = \"" . $admin . "\" WHERE `usuarios`.`idusuario` = $id;");

            //Si modificamos los datos del que estamos rehacemos la sesion
            console.log($_REQUEST['nqm']);
            console.log($_REQUEST['nick']);

            if ($_REQUEST['nqm'] == $_SESSION['nick']) {
                $_SESSION['nick'] = $_REQUEST['mNick'];
                $_SESSION['admin'] = $adminAux;
            }

            $aux = $_REQUEST['nqm'];
            //Nos dirigimos al menu de usuario
            echo ("<script>location.href='index.php?do=UserMenu&umc=$aux'</script>");            
        } else {
            echo ("<script>location.href='index.php?do=NoPermissionError'</script>");
        }
    }

    // DELETE MENU //////////////////////////////////////////////////////////////////////////
    public function DeleteMenu() {
        $data = Array();
        $data['nqb'] = $_REQUEST['nqb'];
        $data['security'] = $this->security;
        include("view/DeleteMenu.php");
    }

    // DELETE CHECK //////////////////////////////////////////////////////////////////////////
    public function DeleteCheck() {
        if ($this->security->check()) {
            
            $result = $this->user->delete("nick", $_REQUEST['nqb']);

            //Si hemos destruido un usuario propio nos manda al menú principal
            if ($_REQUEST['nqb'] == $_SESSION['nick']) {
                echo("<script>location.href='index.php?do=LoginMenu&nqb=".$_REQUEST['nqb']."'</script>");
                $this->security->closeSession();
            } else {
                echo("<script>location.href='index.php?do=UserMenu&nqb=".$_REQUEST['nqb']."'</script>");
            }
        } else {
            echo("<script>location.href='index.php?do=NoPermissionError'</script>");
        }
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