<?php
    class Security {
        //Clase con las que accedemos a las variables de sesion

        public function __construct(){
            if(session_status() == PHP_SESSION_NONE){
                //session has not started
                session_start();
            }
        }

        public function openSession($nick, $admin) {
            $_SESSION['nick'] = $nick;
            $_SESSION['admin'] = $admin;
        }

        public function closeSession() {
            $_SESSION['nick'] = null;
            $_SESSION['admin'] = null;
            session_destroy();
        }

        public function getNick() {
            if(isset($_SESSION['nick']))
                return $_SESSION['nick'];
            else
                return false;
        }

        public function isAdmin() {
            if(isset($_SESSION['admin']))
                return $_SESSION['admin'];
            else
                return false;
        }

        public function check(){
            if(isset($_SESSION['nick'])){
                return true;
            } else {
                return false;
            }
        }
    }