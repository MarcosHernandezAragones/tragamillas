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
        
        public function obtener_last_id(){
            $this->db->query("SELECT max(id_grupo) as last_id FROM Grupo");

            return $this->db->registro();
        }

        public function insert_grupo($id_gru,$nom_gru){
            $this->db->query("INSERT INTO Grupo (id_grupo, nombre) 
                                        VALUES (:id_gru,:nom_gru)");

            $this->db->bind(':id_gru',$id_gru);
            $this->db->bind(':nom_gru',$nom_gru);


            if ($this->db->execute()) {
                return true;
            } else {
                return false;
            }
            

        }

        public function edit_grupo($id_gru,$nom_gru){
            $this->db->query("UPDATE Grupo SET nombre=:nom_gru WHERE id_grupo = :id_gru");

            $this->db->bind(':id_gru',$id_gru);
            $this->db->bind(':nom_gru',$nom_gru);


            if ($this->db->execute()) {
                return true;
            } else {
                return false;
            }
            

        }

        public function obtenerAlumnosGrupo($id_gru){
           
            $this->db->query("SELECT * from Grupo,socio_pertenece_grupo,Socio, User 
                                WHERE Grupo.id_grupo=socio_pertenece_grupo.id_grupo 
                                AND socio_pertenece_grupo.id_socio=Socio.id_socio 
                                and Socio.id_socio=User.id_user and Grupo.id_grupo=:id_gru");//alumnos del grupo
            $this->db->bind(':id_gru',$id_gru);

            return $this->db->registros();
        }

        public function obtenerAlumno($id_user){
           
            $this->db->query("SELECT * from User
                                WHERE User.id_user =:id_user");//alumno seleccionado
            $this->db->bind(':id_user',$id_user);

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
