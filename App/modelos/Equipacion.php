<?php

    class Equipacion {
        private $db;

        public function __construct(){
            $this->db = new Base;
        }

        public function obtenerEquipacion(){
            $this->db->query("SELECT * FROM equipacion");
            
            return $this->db->registro();
        }

        public function obtenerEquipacionId($id){
            $this->db->query("SELECT * FROM equipacion WHERE id_user = :id");
            $this->db->bind(':id',$id);

            return $this->db->registro();
        }
        

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
