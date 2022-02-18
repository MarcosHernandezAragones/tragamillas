<?php

    class Publicos extends Controlador{

        public function __construct(){
            $this->solicitudSocioModelo = $this->modelo('Publico');

        }


        public function index(){
            $this->vista('inicio_no_logueado');

        }

        public function Solicitud_Socio(){
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                
                

                $datos['Dni']=$_POST["Dni"];
                $datos['nombre']=$_POST["nombre"];
                $datos['apellido']=$_POST["apellido"];
                $datos['CC']=$_POST["CC"];
                $datos['fecha_nac']=$_POST["fecha_nac"];
                $datos['email']=$_POST["email"];
                $datos['telefono']=$_POST["telefono"];
                
                if ($this->solicitudSocioModelo->Solicitud_Socio($datos)){
                    redireccionar('/');
                } else {
                    die('Algo ha fallado!!!');
                }
            }else{
                $this->vista('publicos/Solicitud_Socio');
            }
        }

    }