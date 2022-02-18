<?php

    class Grupo {
        private $db;

        public function __construct(){
            $this->db = new Base;
        }

        public function obtenerGrupos(){
            $this->db->query("SELECT * FROM Grupo");

            return $this->db->registros();
        }
        



        public function obtenerAlumnosGrupo($id_gru){
           
            $this->db->query("SELECT * from Grupo,socio_pertenece_grupo,Socio, User 
                                WHERE Grupo.id_grupo=socio_pertenece_grupo.id_grupo 
                                AND socio_pertenece_grupo.id_socio=Socio.id_socio 
                                and Socio.id_socio=User.id_user and Grupo.id_grupo=:id_gru");//alumnos del grupo
            $this->db->bind(':id_gru',$id_gru);

            return $this->db->registros();
        }















///////////////////////////////////////////////// Sesion //////////////////////////////////////////////

        // public function obtenerSesionesUsuario($id){
        //     $this->db->query("SELECT * FROM sesiones 
        //                                 WHERE id_usuario = :id
        //                                 ORDER BY fecha_inicio");
        //     $this->db->bind(':id',$id);

        //     return $this->db->registros();
        // }


        // public function cerrarSesion($id_sesion){
        //     $this->db->query("UPDATE sesiones SET fecha_fin = NOW()  
        //                             WHERE id_sesion = :id_sesion");

        //     $this->db->bind(':id_sesion',$id_sesion);

        //     if($this->db->execute()){
        //         return true;
        //     } else {
        //         return false;
        //     }
        // }
    }
