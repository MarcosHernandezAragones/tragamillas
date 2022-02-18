<?php

    class Grupos extends Controlador{

        public function __construct(){
            Sesion::iniciarSesion($this->datos);
            $this->datos['rolesPermitidos'] = [0,5];

            $this->grupoModelo = $this->modelo('Grupo');
        }

        public function index(){

            $this->datos['grupos'] = $this->grupoModelo->obtenerGrupos();
            $this->vista('grupos/inicio_grupos',$this->datos);
                
        }

        

        public function obtener_datos_grupo($id_grupo){
            
            $datosGrupo = $this->grupoModelo->obtenerGrupos($id_grupo);
            $datosAlumnos = $this->grupoModelo->obtenerAlumnosGrupo($id_grupo);
            $datos['grupo_inf'] = $datosGrupo;
            $datos['grupo_alumn'] = $datosAlumnos;

            $this->vistaApi($datos);
            
        }

        //Funcion para ver los alumnos de un grupo: lo llama ENTRENADOR
        public function verAlumnos($id_entrenador, $id_grupo){
            
        }
    }