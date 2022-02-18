<?php

    class Entrenadores extends Usuarios{

        public function __construct(){
            Sesion::iniciarSesion($this->datos);
            $this->datos['rolesPermitidos'] = [0,5,200];//edit dis sheeeet          // Definimos los roles que tendran acceso

            if (!tienePrivilegios($this->datos['usuarioSesion']->rol,$this->datos['rolesPermitidos'])) {
                redireccionar('/');
            }

            //$this->usuarioModelo = $this->modelo('Usuario');
            //$this->equipacionModelo = $this->modelo('Equipacion');
            

            //$this->datos['menuActivo'] = 1;         // Definimos el menu que sera destacado en la vista
            
        }

        public function index(){
        
            //$this->datos['usuarios'] = $usuarios;
            
            $this->vista('entrenadores/inicio',$this->datos);
            
        }



        //Funcion para ver los grupos en los que trabajo
        public function verGrupos($idEntrenador){
            
        }



    }