<?php

    class Pruebas extends Controlador{

        public function __construct(){
            Sesion::iniciarSesion($this->datos);
            $this->datos['rolesPermitidos'] = [5];


            $this->pruebaModelo = $this->modelo('Prueba');
        }

        public function index(){

            $this->datos['tests'] = $this->pruebaModelo->TESTZONE();

            $this->vista('pruebas/inicio_prueba',$this->datos);
                
        }

        public function obtener_socios_test($id_test){
            $datos = $this->pruebaModelo->TESTZONE1($id_test);
            $this->vistaApi($datos);
        }

    }