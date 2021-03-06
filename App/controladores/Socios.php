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
             $this->publicoModelo = $this->modelo('Publico');
             $this->equipacionModelo = $this->modelo('Equipacion');


             $this->datos['menuActivo'] = 1; 

        }

        public function index(){

             $this->datos['marcasSocio'] = $this->marcaModelo->obtenerMarcasId($this->datos['usuarioSesion']->id_user);// Informacion de la equipacion de un usuario
             $this->datos['pruebasSocio']= $this->pruebaModelo->obtenerPruebas();// Informacion de la equipacion de un usuario
             $this->datos['horarioSocio']= $this->socioModelo->obtenerHorarioId($this->datos['usuarioSesion']->id_user);
             $this->vista('socios/inicio',$this->datos);
        }

        public function Inscripcion_eventos(){
            $this->datos["entrenador"] = $this->socioModelo->obtenerEntrenadores();
            $this->vista('publicos/Inscripcion_eventos', $this->datos);
        }



        public function inicioEquipacion() {
            $this->datos["equipacionUsu"] = $this->equipacionModelo->obtenerEquipacion();
            $this->vista('equipacion/inicio',$this->datos);
        }

        public function inicioLicencias() {
            $this->vista('licencias/inicio',$this->datos);
        }
        

        //Funcion para subir la nueva licencia
        public function subirLicencia(){
            if (move_uploaded_file($_FILES['subir_archivo']['tmp_name'], "imagenes/".$_FILES['subir_archivo']['name'])) {
             //$ruta1=$directorio."bbb";
             //echo $ruta1;
               // if (copy($directorio."bbb",$directorio."aaa")) {
                //echo "El archivo es v??lido y se carg?? correctamente.<br><br>";
                } else {
                //echo "La subida ha fallado";
                }
                echo "</div>";

            
            

            $this->vista('licencias/subir');
        }

        





        //-------------------------------------------------------------------------------Eventos

        public function obtener_eventos(){
            $datos["carreras"] =$this->socioModelo->obtenerCarreras();
            $datos["cursos"] = $this->socioModelo->obtenerCursos();
            $datos["grupos"] = $this->socioModelo->obtenerGrupos();
            $datos["entrenador"] = $this->socioModelo->obtenerEntrenadores();

        

            $this->vistaApi($datos);
        }

        public function aDDadirPeticionGrupo(){
            $datos['id_grupo'] = $_POST['id_evento'];
            $datos['id_socio'] = $_POST['id_socio'];
            print_r($datos);
            //$img = $_FILES['imagen']['name'];   
            
            


            //print_r($img);

            $comprobacion = $this->socioModelo->comprobarSolicitudExistente($datos);
            
            //$anadirLinea=false;

            if (!isset($comprobacion->id_socio)) {
                move_uploaded_file($_FILES['imagen']['tmp_name'], "imagenes/fotos_usu/".$_FILES['imagen']['name']);
                $anadirLinea = $this->socioModelo->anadirLinea($datos);
            }
            
            if ($anadirLinea) {
                $this->vistaApi(true);
            } else {
                $this->vistaApi(false);
            } 
        }

        public function addPeticionEvento(){
            $datos['id_evento'] = $_POST['id_evento'];
            $datos['id_socio'] = $_POST['id_socio'];
            $info = $this->socioModelo->infoEvento();
 
            foreach ($info as $carrera){
                if ($datos['id_evento'] == $carrera->id_solicitud_evento) {
                    $datos['id_solicitud_evento'] = $carrera->id_solicitud_evento;
                }
            }
            //print_r ($datos);
            $actualizarCarrera=$this->socioModelo->anadirLineaCarrera($datos);
            
            if ($actualizarCarrera) {
                $this->vistaApi(true);
            } else {
                $this->vistaApi(false);
            } 
        }        

    }