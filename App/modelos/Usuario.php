<?php

    class Usuario {
        private $db;

        public function __construct(){
            $this->db = new Base;
        }


        public function obtenerUsuarios(){
            $this->db->query("SELECT * FROM User");

            return $this->db->registros();
        }

        public function obtenerUsuariosActivos(){
            $this->db->query("SELECT * FROM User WHERE activo=1");

            return $this->db->registros();
        }


        public function obtenerRoles(){
            $this->db->query("SELECT * FROM Rol");

            return $this->db->registros();
        }

        public function obtenerUltimoId(){
            $this->db->query("SELECT max(id_user) as id_user FROM User");            
            return $this->db->registro();
        }


        public function agregarUsuario($datos){
            
            $this->db->query("INSERT INTO User (id_user, nombre, apellido, Dni, pass, email, CC, fecha_nac, telefono, rol) 
                                        VALUES (:id_user, :nombre, :apellido, :Dni, :pass, :email, :CC, :fecha_nac, :telefono, :id_rol)");

            //vinculamos los valores
            $this->db->bind(':id_user',$datos['id_user']);
            $this->db->bind(':nombre',$datos['nombre']);
            $this->db->bind(':apellido',$datos['apellido']);
            $this->db->bind(':Dni',$datos['Dni']);
            $this->db->bind(':pass',$datos['Dni']);
            $this->db->bind(':email',$datos['email']);
            $this->db->bind(':CC',$datos['CC']);
            $this->db->bind(':fecha_nac',$datos['fecha_nac']);
            $this->db->bind(':telefono',$datos['telefono']);
            $this->db->bind(':id_rol',$datos['rol']);

            //echo "llegamos";exit();

            //ejecutamos
            if($this->db->execute()){
                return true;
            } else {
                return false;
            }
        }


        public function obtenerUsuarioId($id){
            $this->db->query("SELECT * FROM User WHERE id_user = :id");
            $this->db->bind(':id',$id);

            return $this->db->registro();
        }


        public function actualizarUsuario($datos){
            
            $this->db->query("UPDATE User SET nombre=:nombre, apellido=:apellido, Dni=:Dni, email=:email, CC=:CC, fecha_nac=:fecha_nac, telefono=:telefono
                                                WHERE id_user = :id");

            //vinculamos los valores
            $this->db->bind(':id',$datos['id_user']);
            $this->db->bind(':nombre',$datos['nombre']);
            $this->db->bind(':apellido',$datos['apellido']);
            $this->db->bind(':Dni',$datos['Dni']);
            $this->db->bind(':email',$datos['email']);            
            $this->db->bind(':CC',$datos['CC']);
            $this->db->bind(':fecha_nac',$datos['fecha_nac']);
            $this->db->bind(':telefono',$datos['telefono']);

            //ejecutamos
            if($this->db->execute()){
                return true;
            } else {
                return false;
            }
        }

        public function bajaUsuario($id){
            $this->db->query("UPDATE User SET activo=0 WHERE id_user = :id");
            $this->db->bind(':id',$id);

            if($this->db->execute()){
                return true;
            } else {
                return false;
            }
        }


        public function borrarUsuario($id){
            $this->db->query("DELETE FROM usuarios WHERE id_user = :id");
            $this->db->bind(':id',$id);

            if($this->db->execute()){
                return true;
            } else {
                return false;
            }
        }

        public function obtener_solicitudes_socios(){
            $this->db->query("SELECT * FROM solicitud_socio WHERE aceptada=0");

            return $this->db->registros();
        }

        
        public function obtener_datos_solicitud($id_solicitud_soc){
            $this->db->query("SELECT * FROM solicitud_socio WHERE id_solicitud_soc=:id_solicitud_soc");
            $this->db->bind(':id_solicitud_soc', $id_solicitud_soc);

            return $this->db->registro();
        }

        public function aceptar_solicitud_socio($id_solicitud_soc){
            $this->db->query("UPDATE solicitud_socio SET aceptada=1 WHERE id_solicitud_soc = :id_solicitud_soc");
            $this->db->bind(':id_solicitud_soc',$id_solicitud_soc);

            if($this->db->execute()){
                return true;
            } else {
                return false;
            }
        }

        public function eliminar_solicitud_socio($id_solicitud_soc){
            $this->db->query("DELETE FROM solicitud_socio WHERE id_solicitud_soc = :id_solicitud_soc");
            $this->db->bind(':id_solicitud_soc',$id_solicitud_soc);

            if($this->db->execute()){
                return true;
            } else {
                return false;
            }
        }

///////////////////////////////////////////////// Sesion //////////////////////////////////////////////

        public function obtenerSesionesUsuario($id){
            $this->db->query("SELECT * FROM sesiones 
                                        WHERE id_user = :id
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
