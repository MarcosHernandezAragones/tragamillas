<?php

    class Usuarios extends Controlador{

        public function __construct(){
            Sesion::iniciarSesion($this->datos);
            $this->datos['rolesPermitidos'] = [0,5,200];          // Definimos los roles que tendran acceso

            if (!tienePrivilegios($this->datos['usuarioSesion']->rol,$this->datos['rolesPermitidos'])) {
                redireccionar('/');
            }

            $this->usuarioModelo = $this->modelo('Usuario');
            $this->equipacionModelo = $this->modelo('Equipacion');
            

            $this->datos['menuActivo'] = 1;         // Definimos el menu que sera destacado en la vista
            
        }


        public function index(){
            //Obtenemos los usuarios
            $usuarios = $this->usuarioModelo->obtenerUsuariosActivos();

            $this->datos['usuarios'] = $usuarios;
            $this->datos['listaRoles'] = $this->usuarioModelo->obtenerRoles();//solusion  copipastear esta linea aki
            $this->vista('usuarios/inicio',$this->datos);
            // $this->vista('usuarios/inicioVue',$this->datos);
        }

        public function inicio_usu_tienda(){
            //Obtenemos los usuarios
            $usuarios = $this->usuarioModelo->obtenerUsuariosActivos();

            $this->datos['usuarios'] = $usuarios;
            $this->datos['listaRoles'] = $this->usuarioModelo->obtenerRoles();//solusion  copipastear esta linea aki
            $this->datos['listarEquipacion']=$this->equipacionModelo->obtenerEquipacion();// Informacion de la equipacion de un usuario
            $this->vista('usuarios/inicio_usu_tienda',$this->datos);
            // $this->vista('usuarios/inicioVue',$this->datos);
        }


        // public function agregar(){
        //     $this->datos['rolesPermitidos'] = [0];          // Definimos los roles que tendran acceso

        //     if (!tienePrivilegios($this->datos['usuarioSesion']->rol,$this->datos['rolesPermitidos'])) {
        //         redireccionar('/usuarios');
        //     }

        //     if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                
        //         $usuarioNuevo = [
        //             'nombre' => trim($_POST['nombre']),
        //             'email' => trim($_POST['email']),
        //             'telefono' => trim($_POST['telefono']),
        //             'rol' => trim($_POST['rol']),
        //         ];

        //         if ($this->usuarioModelo->agregarUsuario($usuarioNuevo)){
        //             redireccionar('/usuarios');
        //         } else {
        //             die('Algo ha fallado!!!');
        //         }
        //     } else {
        //         $this->datos['usuario'] = (object) [
        //             'nombre' => '',
        //             'email' => '',
        //             'telefono' => '',
        //             'rol' => 10
        //         ];

        //         $this->datos['listaRoles'] = $this->usuarioModelo->obtenerRoles();

        //         $this->vista('usuarios/agregar_editar',$this->datos);
        //     }
        // }


        // public function editar($id){
        //     $this->datos['rolesPermitidos'] = [0];          // Definimos los roles que tendran acceso

        //     if (!tienePrivilegios($this->datos['usuarioSesion']->rol,$this->datos['rolesPermitidos'])) {
        //         redireccionar('/usuarios');
        //     }

        //     if ($_SERVER['REQUEST_METHOD'] == 'POST') {

        //         $usuarioModificado = [
        //             'id_user' => $id,
        //             'nombre' => trim($_POST['nombre']),
        //             'email' => trim($_POST['email']),
        //             'telefono' => trim($_POST['telefono']),
        //             'rol' => trim($_POST['rol']),
        //         ];

        //         if ($this->usuarioModelo->actualizarUsuario($usuarioModificado)){
        //             redireccionar('/usuarios');
        //         } else {
        //             die('Algo ha fallado!!!');
        //         }
        //     } else {
        //         //obtenemos información del usuario y el listado de roles desde del modelo
        //         $this->datos['usuario'] = $this->usuarioModelo->obtenerUsuarioId($id);
        //         $this->datos['listaRoles'] = $this->usuarioModelo->obtenerRoles();
        //         $this->vista('usuarios/agregar_editar',$this->datos);
        //     }
        // }


        // public function borrar($id){
            
        //     if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        //         if ($this->usuarioModelo->borrarUsuario($id)){
        //             redireccionar('/usuarios');
        //         } else {
        //             die('Algo ha fallado!!!');
        //         }
        //     } else {
        //         //obtenemos información del usuario desde del modelo
        //         $this->datos['usuario'] = $this->usuarioModelo->obtenerUsuarioId($id);

        //         $this->vista('usuarios/borrar',$this->datos);
        //     }
        // }

        public function obtener_usu_actual($id_usuario){
            
            $datosUsuario = $this->usuarioModelo->obtenerUsuarioId($id_usuario);
            //$datosAlumnos = $this->usuarioModelo->obtenerAlumnosGrupo($id_usuario);
            $datos['datos_usu'] = $datosUsuario;
            //$this->datos['grupo_alumn'] = $datosAlumnos;
            //$this->vista('usuarios/obtener_usu_actual',$this->datos);
            $this->vistaApi($datos);
        }

        //Funcion para ver los alumnos de un grupo: lo llama ENTRENADOR
        public function verAlumnos($id_entrenador, $id_grupo){
            
        }

        public function editar_usuario(){//$id_user,$nombre,$apel,$emai,$dni,$cc,$tall
            
            // $nombre
            // $apel
            // $emai
            // $dni
            // $cc
            // $tall
            $datos['id_user']=$_POST["id_user"];
            $datos['nombre']=$_POST["nombre"];
            $datos['apellido']=$_POST["apellido"];
            $datos['Dni']=$_POST["Dni"];
            $datos['email']=$_POST["email"];
            $datos['CC']=$_POST["CC"];
            $datos['fecha_nac']=$_POST["fecha_nac"];
            $datos['telefono']=$_POST["telefono"];
            $actualizarUsuario=$this->usuarioModelo->actualizarUsuario($datos);
            
            //$this->vista('usuarios/editar_usuario',$actualizarUsuario);

    
     
            if ($actualizarUsuario) {
                $usuarios=$this->usuarioModelo->obtenerUsuariosActivos();
                $this->vistaApi($usuarios);
            } else {
                $this->vistaApi(false);
            } 
        }


        public function agregar_usuario(){
            
            $datos['nombre']=$_POST["nombre"];
            $datos['apellido']=$_POST["apellido"];
            $datos['Dni']=$_POST["Dni"];
            $datos['email']=$_POST["email"];
            $datos['CC']=$_POST["CC"];
            $datos['fecha_nac']=$_POST["fecha_nac"];
            $datos['telefono']=$_POST["telefono"];
            $datos['rol']=$_POST["rol"];

            
            $ultimo_usuario=$this->usuarioModelo->obtenerUltimoId();
            $datos['id_user']=$ultimo_usuario->id_user+1;


            
            //$this->vistaApi($datos['id_user']);
            $agregarUsuario=$this->usuarioModelo->agregarUsuario($datos);
            
            //$this->vista('usuarios/editar_usuario',$actualizarUsuario);(nombre, apellido, Dni, email, CC, fecha_nac, telefono, rol)
     
            if ($agregarUsuario) {
                $usuarios=$this->usuarioModelo->obtenerUsuariosActivos();
                $this->vistaApi($usuarios);
            } else {
                $this->vistaApi(false);
            } 
        }


        public function baja_usuario(){
            
            
            $id=$_POST["id"];

            
            //$this->vistaApi($datos['id_user']);
            $bajaUsuario=$this->usuarioModelo->bajaUsuario($id);
            
            //$this->vista('usuarios/editar_usuario',$actualizarUsuario);(nombre, apellido, Dni, email, CC, fecha_nac, telefono, rol)
     
            if ($bajaUsuario) {
                $usuarios=$this->usuarioModelo->obtenerUsuariosActivos();
                $this->vistaApi($usuarios);
            } else {
                $this->vistaApi(false);
            } 
        }

        public function solicitudes_socio(){
            $this->datos['rolesPermitidos'] = [0]; 

            if (!tienePrivilegios($this->datos['usuarioSesion']->rol,$this->datos['rolesPermitidos'])) {
                redireccionar('/');
            }

            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                
                $id_solicitud_soc=$_POST["id_solicitud_soc"];
                $action=$_POST["action"];
                

                if ($action=="Aceptar") {
                    $ultimo_usuario=$this->usuarioModelo->obtenerUltimoId();
                    
                    $id_user = $ultimo_usuario->id_user; //pasamos el ultimo Id de objeto a una variable
                    $id_user +=1;

                    $solicitud = $this->usuarioModelo->obtener_datos_solicitud($id_solicitud_soc); //obtenemos datos de la solicitud
                    
                    
                    $datos['id_user']=$id_user;
                    $datos['nombre']=$solicitud->nombre;
                    $datos['apellido']=$solicitud->apellido;
                    $datos['Dni']=$solicitud->Dni;
                    $datos['email']=$solicitud->email;                  //rellenamos un array con los datos para introducirlos en usuario
                    $datos['CC']=$solicitud->CC;
                    $datos['fecha_nac']=$solicitud->fecha_nac;
                    $datos['telefono']=$solicitud->telefono;
                    $datos['rol']=10;                    
                    
                    //print_r($datos);exit;

                    if($this->usuarioModelo->agregarUsuario($datos)){//Agregamos el socio a la tabla usuarios
                        $this->usuarioModelo->aceptar_solicitud_socio($id_solicitud_soc);//marcamos la solicitud como aceptada

                        $solicitudes = $this->usuarioModelo->obtener_solicitudes_socios();
                        $this->vistaApi($solicitudes);
                    }else {
                        $this->vistaApi(false);
                    }

                }elseif ($action=="Denegar"){

                    if($this->usuarioModelo->eliminar_solicitud_socio($id_solicitud_soc)){
                        $solicitudes = $this->usuarioModelo->obtener_solicitudes_socios();
                        $this->vistaApi($solicitudes);
                    }else {
                        $this->vistaApi(false);
                    }
                }
                
            }else{
                $this->datos['solicitudes'] = $this->usuarioModelo->obtener_solicitudes_socios();
                $this->vista('usuarios/solicitudes_socio', $this->datos);
            }

        }






















        ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
        public function sesiones($id_usuario){
            $this->datos['rolesPermitidos'] = [0];          // Definimos los roles que tendran acceso

            if (!tienePrivilegios($this->datos['usuarioSesion']->rol,$this->datos['rolesPermitidos'])) {
                exit();
            }

            // En __construct() verificamos que se haya iniciado la sesion
            $sesiones = $this->usuarioModelo->obtenerSesionesUsuario($id_usuario);
            $usuario = $this->usuarioModelo->obtenerUsuarioId($id_usuario);

            // utilizamos $datos en lugar de $this->datos ya que no necesitamos los datos del usuario de sesion
            $datos['sesiones'] = $sesiones;
            $datos['usuario'] = $usuario;

            $this->vistaApi($datos);
        }


        public function cerrarSesion(){
            $this->datos['rolesPermitidos'] = [0];          // Definimos los roles que tendran acceso

            if (!tienePrivilegios($this->datos['usuarioSesion']->rol,$this->datos['rolesPermitidos'])) {
                exit();
            }
            
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                $id_sesion = $_POST['id_sesion'];
                
                $resultado = $this->usuarioModelo->cerrarSesion($id_sesion);

                unlink(session_save_path().'\\sess_'.$id_sesion);
                $this->vistaApi($resultado);
            }
        }


        
    }
