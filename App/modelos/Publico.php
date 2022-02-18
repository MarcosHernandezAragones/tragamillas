<?php

    class Publico {
        private $db;

        public function __construct(){
            $this->db = new Base;
        }


        public function Solicitud_Socio($datos){
            $this->db->query("INSERT INTO solicitud_socio ( Dni, nombre, apellido, CC, fecha_nac, email,  telefono) VALUES (  :Dni, :nombre, :apellido, :CC, :fecha_nac, :email, :telefono)");

            //vinculamos los valores
            $this->db->bind(':Dni',$datos['Dni']);
            $this->db->bind(':nombre',$datos['nombre']);
            $this->db->bind(':apellido',$datos['apellido']);
            $this->db->bind(':CC',$datos['CC']);
            $this->db->bind(':fecha_nac',$datos['fecha_nac']);
            $this->db->bind(':email',$datos['email']);
            $this->db->bind(':telefono',$datos['telefono']);

            //ejecutamos
            if($this->db->execute()){
                return true;
            } else {
                return false;
            }
        }

    }