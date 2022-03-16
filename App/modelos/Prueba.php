<?php

    class Prueba {
        private $db;

        public function __construct(){
            $this->db = new Base;
        }

        public function obtenerTestss(){
            $this->db->query("SELECT * FROM Test ORDER BY fecha desc limit 5");

            return $this->db->registros();
        }

        public function obtenerPruebas(){
            $this->db->query("SELECT * FROM Prueba ORDER BY Id_prueba DESC LIMIT 5");

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
        public function obtenerUsuarioPrueba($id_user){
            $this->db->query("SELECT nombre, apellido, id_user FROM User WHERE id_user = :id");
            $this->db->bind(':id',$id_user);

            return $this->db->registro();
        }

        public function TESTZONE($id_grupo){//devuelve los alumnos de un grupo   !!modificacion pendiente!!
            $this->db->query("SELECT User.id_user, User.nombre, User.apellido FROM User, Socio, socio_pertenece_grupo, Grupo WHERE Grupo.id_grupo=:id_grupo and Grupo.id_grupo=socio_pertenece_grupo.id_grupo
            and socio_pertenece_grupo.id_socio=Socio.id_socio and Socio.id_socio=User.id_user;");
            $this->db->bind(':id_grupo',$id_grupo);
            return $this->db->registros();
        }

        public function TESTZONE_and_half($id_user){
            //devuelvelve las pruebas y marcas de un socio y un test en una fecha concreta 
            //modificar porque no hace lo que deberia hacer
            $this->db->query("SELECT Test.id_test 
                                FROM Test , User, Socio, test_prueba, prueba_socio, Prueba 
                                WHERE Test.id_test=test_prueba.id_test and test_prueba.id_prueba=Prueba.id_prueba 
                                 and Prueba.id_prueba = prueba_socio.id_prueba and prueba_socio.id_socio=Socio.id_socio 
                                 and Socio.id_socio=User.id_user and User.id_user=:id_user");
            
            
            $this->db->bind(':id_user',$id_user);
            return $this->db->registros();
        }

        public function TESTZONE1($id_user,$last_test){
            //devuelvelve las pruebas y marcas de un socio y un test en una fecha concreta 
            //modificar porque no hace lo que deberia hacer
            $this->db->query("SELECT Test.fecha, Socio.id_socio,Prueba.tipo as unidades, Prueba.nombre as nombr_prueba, Test.nombre as nom_test, prueba_socio.marca as marca 
                                FROM Test , User, Socio, test_prueba, prueba_socio, Prueba 
                                WHERE Test.id_test=:last_test and Test.id_test=test_prueba.id_test 
                                 and Test.fecha=prueba_socio.Fecha and test_prueba.id_prueba=Prueba.id_prueba 
                                 and Prueba.id_prueba = prueba_socio.id_prueba and prueba_socio.id_socio=Socio.id_socio 
                                 and Socio.id_socio=User.id_user and User.id_user=:id_user ;");
            
            
            $this->db->bind(':id_user',$id_user);
            $this->db->bind(':last_test',$last_test);
            return $this->db->registros();
        }


        public function insert_prueba($datee,$id_prueba,$marka,$user){
           

            $this->db->query("INSERT INTO prueba_socio (id_prueba, id_socio, marca, Fecha) 
            VALUES (:id_prueba, :user, :marka, :datee)");

            $this->db->bind(':id_prueba',$id_prueba);
            $this->db->bind(':user',$user);
            $this->db->bind(':marka',$marka);
            $this->db->bind(':datee',$datee);

            if($this->db->execute()){
                return true;
            } else {
                return false;
            }

        }

        public function insert_prueba_test($datee,$id_prueba,$marka,$user){
            

            $this->db->query("INSERT INTO prueba_socio (id_prueba, id_socio, marca, Fecha) 
            VALUES (:id_prueba, :user, :marka, :datee)");

            $this->db->bind(':id_prueba',$id_prueba);
            $this->db->bind(':user',$user);
            $this->db->bind(':marka',$marka);
            $this->db->bind(':datee',$datee);

            if($this->db->execute()){
                return true;
            } else {
                return false;
            }
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