<?php

    class Prueba {
        private $db;

        public function __construct(){
            $this->db = new Base;
        }

        public function obtenerTestss(){
            $this->db->query("SELECT * FROM Test");

            return $this->db->registros();
        }

        public function obtenerPruebas(){
            $this->db->query("SELECT * FROM Prueba");

            return $this->db->registros();
        }

        public function obtenerPruebasTest(){
            $this->db->query("SELECT * FROM test_prueba");

            return $this->db->registros();
        }

        public function obtenerPruebasSocio(){
            $this->db->query("SELECT * FROM prueba_socio");

            return $this->db->registros();
        }
        

        public function TESTZONE(){//devuelve los test en X fecha   !!modificacion pendiente!!
            $this->db->query("SELECT Test.*, prueba_socio.id_socio, Prueba.Id_prueba FROM Test ,test_prueba, prueba_socio , Prueba WHERE Test.fecha='2022-02-28' and prueba_socio.fecha='2022-02-28' and Test.id_test=test_prueba.id_test and test_prueba.id_prueba=Prueba.id_prueba and Prueba.id_prueba = prueba_socio.id_prueba;");

            return $this->db->registros();
        }

        public function TESTZONE1($id_test){//devuelvelve las pruebas y marcas de un socio y un test //modificar porque no hace lo que deberia hacer
            $this->db->query("SELECT User.nombre, User.apellido, Socio.id_socio,Prueba.tipo as unidades, Prueba.nombre as nombr_prueba, Test.nombre as nom_test, prueba_socio.marca as marca 
                                FROM Test , User, Socio, test_prueba, prueba_socio, Prueba 
                                WHERE Test.id_test=:id_test and Test.fecha=:fecha and prueba_socio.fecha=:fecha2
                                 and Test.id_test=test_prueba.id_test and test_prueba.id_prueba=Prueba.id_prueba 
                                 and Prueba.id_prueba = prueba_socio.id_prueba and prueba_socio.id_socio=Socio.id_socio 
                                 and Socio.id_socio=User.id_user;");
            $this->db->bind(':id_test',$id_test);
            $this->db->bind(':fecha','2022-02-28');
            $this->db->bind(':fecha2','2022-02-28');
            $this->db->bind(':id_user','21');
            return $this->db->registros();
        }


//random shet: si una funeraria entierra a los clientes que le hacen mala publicidad, estan solucionando el problema?

///////////////////////////////////////////////// Sesion //////////////////////////////////////////////

        public function obtenerSesionesUsuario($id){
            $this->db->query("SELECT * FROM sesiones 
                                        WHERE id_usuario = :id
                                        ORDER BY fecha_inicio");
            $this->db->bind(':id',$id);

            return $this->db->registros();
        }


        public function cerrarSesion($id_sesion){
            $this->db->query("UPDATE sesiones SET fecha_fin = NOW()  
                                    WHERE id_sesion = :id_sesion");

            $this->db->bind(':id_sesion',$id_sesion);

            if($this->db->execute()){
                return true;
            } else {
                return false;
            }
        }
    }