<?php

    class Pruebas extends Controlador{

        public function __construct(){
            Sesion::iniciarSesion($this->datos);
            $this->datos['rolesPermitidos'] = [5];


            $this->pruebaModelo = $this->modelo('Prueba');
            $this->marcaModelo = $this->modelo('Marca');
            $this->usuaioModelo = $this->modelo('Usuario');

        }

        public function index($id_grupo){

            $this->datos['tests'] = $this->pruebaModelo->TESTZONE($id_grupo);///////cambiar 1 por $id_grupo
            $this->datos['grupo']=$id_grupo;
            $this->vista('pruebas/inicio_prueba',$this->datos);
                
        }

        public function obtener_socios_test($id_user){
            $last_test_raw= $this->pruebaModelo->TESTZONE_and_half($id_user);
            
            $datos[0] = $this->pruebaModelo->obtenerUsuarioPrueba($id_user);

           
            if (count($last_test_raw) !=0) {
                $last_test_dig=$last_test_raw[0]->id_test;
                $datos[1] = $this->pruebaModelo->TESTZONE1($id_user,$last_test_dig);
            }else{
                $datos[1]=[];
            }
            
            $this->vistaApi($datos);
        }

        public function prueba_nueva($id_user,$id_grupo){
            

            $this->datos['usuarioTest'] = $this->pruebaModelo->obtenerUsuarioPrueba($id_user);
            $this->datos['prueba_to_grupo']=$id_grupo;
            $this->vista('pruebas/prueba_nueva',$this->datos);
        }

        public function mostrar_prueba($id_user){
            

            $this->datos['usuarioTest'] = $this->marcaModelo->obtenerMarcasId($id_user);
            $this->datos['Usuario'] =$this->usuaioModelo->obtenerUsuarioId($id_user);
            $this->datos['pruebas'] = $this->pruebaModelo->obtenerPruebas();
            $this->vista('pruebas/mostrar_prueba',$this->datos);
        }

        public function obtener_pruebas(){
            $pruebas = $this->pruebaModelo->obtenerPruebas();
            

            $this->vistaApi($pruebas);
        }

        public function obtener_tests(){
            $tests = $this->pruebaModelo->obtenerTestss();
            
            $this->vistaApi($tests);
        }

        public function guardar_pruebas(){
            $datos_pruebas=json_decode($_POST["datos"]);
            $user=$_POST["user"];
            $test_raw=$_POST["test"];
            $test_arr=explode("_",$test_raw);
            
            

            foreach ($datos_pruebas as $prueba) {
                if (isset($prueba)) {
                    if ($test_arr[0] == "nil") {
                        //echo $test_arr[0]."++".$prueba[0]."--".$prueba[1];
                         $this->pruebaModelo->insert_prueba($test_arr[1],$prueba[0],$prueba[1],$user);
                    }else{
                         $this->pruebaModelo->insert_prueba_test($test_arr[1],$prueba[0],$prueba[1],$user);
                    }
                     

                }
            }
            
            //$this->vistaApi($datos_response);
        }













    }