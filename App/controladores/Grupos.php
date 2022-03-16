<?php

    class Grupos extends Controlador{

        public function __construct(){
            Sesion::iniciarSesion($this->datos);
            $this->datos['rolesPermitidos'] = [0,5];

            $this->grupoModelo = $this->modelo('Grupo');
            
        }

        public function index(){

            //$this->datos['grupos']=$this->grupoModelo->obtenerGrupos();
            
            $this->vista('grupos/inicio_grupos',true);
                
        }

        public function add_grupo(){
            $namee=$_POST["namee"];
            
            $id_last=$this->grupoModelo->obtener_last_id();
            $id_new=$id_last->last_id +1;

            
            if ($this->grupoModelo->insert_grupo($id_new,$namee)) {
                

                $this->vistaApi(TRUE);
            } else {
                $this->vistaApi(FALSE);
            }
        }

        public function edit_grupo(){
            $namee=$_POST["namee"];
            $idd=$_POST["idd"];
            
            

            
            if ($this->grupoModelo->edit_grupo($idd,$namee)) {
                

                $this->vistaApi(TRUE);
            } else {
                $this->vistaApi(FALSE);
            }
        }

        public function obtener_gruposs(){
            
            $datosGrupo=$this->grupoModelo->obtenerGrupos();
            

            $this->vistaApi($datosGrupo);
            
        }


        
        
    }