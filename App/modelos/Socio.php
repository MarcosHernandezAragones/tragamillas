<?php

    class Socio {
        private $db;

        public function __construct(){
            $this->db = new Base;
        }

        public function obtenerUsuarios(){
            $this->db->query("SELECT * FROM User");

            return $this->db->registros();
        }
        
        public function obtenerEquipacionId($id){
            $this->db->query("SELECT * FROM equipacion WHERE id_user = :id");
            $this->db->bind(':id',$id);

            
        }
        public function obtenerHorarioId($id){
            $this->db->query("SELECT horario.* 
                                FROM horario,horario_grupo,Grupo,socio_pertenece_grupo,Socio,User 
                                WHERE horario.id_horario=horario_grupo.id_horario 
                                    and horario_grupo.id_grupo=Grupo.id_grupo 
                                    and Grupo.id_grupo=socio_pertenece_grupo.id_grupo 
                                    and socio_pertenece_grupo.id_socio=Socio.id_socio 
                                    and Socio.id_socio=User.id_user 
                                    and User.id_user= :id");

            $this->db->bind(':id',$id);

            return $this->db->registros();
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