<?php

    class Facturas extends Controlador{

        public function __construct(){
            Sesion::iniciarSesion($this->datos);
            $this->datos['rolesPermitidos'] = [0];          // Definimos los roles que tendran acceso

            if (!tienePrivilegios($this->datos['usuarioSesion']->rol,$this->datos['rolesPermitidos'])) {
                redireccionar('/');
            }

            $this->facturaModelo = $this->modelo('Factura');
        }

        public function index(){
            $facturas='$this->facturaModelo->obtenerFacturas()';

            $this->datos['facturas'] = $facturas;
            
            $this->vista('facturas/inicio_facturacion',$this->datos);
                
        }

    }