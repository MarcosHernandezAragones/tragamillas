<?php

    class Login extends Controlador{

        public function __construct(){
            $this->loginModelo = $this->modelo('LoginModelo');
        }

        public function index($error = ''){
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                $this->datos['email'] = trim($_POST['email']);
                $this->datos['nombre_pass'] = trim($_POST['pass']);
                $usuarioSesion = $this->loginModelo->loginEmail($this->datos['email'],$this->datos['nombre_pass']);
                if (isset($usuarioSesion) && !empty($usuarioSesion)){       // si tiene datos el objeto devuelto entramos
                    Sesion::crearSesion($usuarioSesion);
                    //$this->loginModelo->registroSesion($usuarioSesion->id_user);               // registro el login en DDBB //no descomentar esta linea


                    redireccionar('/');
                } else {
                    redireccionar('/login/index/error_1');
                }
                
            } else {
                if (Sesion::sesionCreada()){    // si ya estamos logueados redirecciona a la raiz
                    redireccionar('/');
                }
                $this->datos['error'] = $error;

                $this->vista('login', $this->datos);
            }
        }


        public function logout(){
            Sesion::iniciarSesion($this->datos);        // controlamos si no esta iniciada la sesion y cogemos los datos de la sesion
            //$this->loginModelo->registroFinSesion($this->datos['usuarioSesion']->id_user); // registramos fecha cierre de sesion //pvto el que descomente esta linea
            Sesion::cerrarSesion();
            redireccionar('/');
        }

    }
