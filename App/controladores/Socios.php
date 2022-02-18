<?php

    class Socios extends Controlador{

        public function __construct(){
            Sesion::iniciarSesion($this->datos);
            $this->datos['rolesPermitidos'] = [10];          // Definimos los roles que tendran acceso

            if (!tienePrivilegios($this->datos['usuarioSesion']->rol,$this->datos['rolesPermitidos'])) {
                redireccionar('/');
            }

            $this->marcaModelo = $this->modelo('Marca');
            $this->pruebaModelo = $this->modelo('Prueba');
            $this->socioModelo = $this->modelo('Socio');

            $this->datos['menuActivo'] = 1; 

        }

        public function index(){

            $this->datos['marcasSocio'] = $this->marcaModelo->obtenerMarcasId($this->datos['usuarioSesion']->id_user);// Informacion de la equipacion de un usuario
            $this->datos['pruebasSocio']=$this->pruebaModelo->obtenerPruebas();// Informacion de la equipacion de un usuario
            $this->datos['horarioSocio']=$this->socioModelo->obtenerHorarioId($this->datos['usuarioSesion']->id_user);
            $this->vista('socios/inicio',$this->datos);

        }

        //Funcion para inscribirse a un evento
        public function inscribirseEvento($id_socio, $id_evento){
            
        }

        //Funcion para inscribirse grupo
        public function inscribirseGrupo($id_socio, $id_evento){
            
        }

        //Funcion para subir la nueva licencia
        public function subirLicencia($id_socio){
            
        }

        //El ENTRENADOR introduce una nueva marca que habra hecho un alumno
        public function nuevaMarca($id_socio, $id_prueba){

        }

    }