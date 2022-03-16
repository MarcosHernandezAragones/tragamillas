<?php require_once RUTA_APP.'/vistas/inc/header.php';?>

<?php //print_r($datos)?>
    <div class="row">
        <div class="col-12 col-lg-6 adminOPT " style="font-size: 3vh;">
        <table class="table table-hover" id="tabla_usuarios">
            <?php $uruario = $datos['usuarioSesion'];?>
                <thead>  
                    <td><?php echo $uruario->nombre?></td>
                    <td><?php echo $uruario->apellido?></td>
                </thead>
                <tr class="puebasUsu">
                    <td>Prueba</td>
                    <td>Marca</td>
                    <td>Fecha</td>
                </tr>

            <?php foreach($datos['marcasSocio'] as $prueba): ?>
                <tr class="puebasUsu">

                    <?php foreach($datos['pruebasSocio'] as $prueba_nombre):?>

                        <?php if ($prueba_nombre->Id_prueba==$prueba->Id_prueba) {?>
                            <td><?php print_r($prueba_nombre->nombre) ?></td>
                        <?php } ?>

                    <?php endforeach; ?>

                    <td><?php print_r($prueba->marca) ?></td>
                    <td><?php print_r($prueba->Fecha)?></td>
                <tr style="font-size: 3vh;">
            <?php endforeach; ?>
    
                </tr>
        </table>
        </div>


        <div class="col-6 col-lg-3 adminOPT ">
            <a href="<?php echo RUTA_URL ?>/socios/inicioLicencias" ><i class="bi bi-person-video adminBTN"></i>
            <p class="enlaUsu">Licencias</p> </a>
        </div>
        <div class="col-6 col-lg-3 adminOPT ">
            <a href="<?php echo RUTA_URL ?>/socios/Inscripcion_eventos" ><i class="bi bi-pencil-fill adminBTN"></i>
            <p class="enlaUsu">Inscripción Grupo/Evento</p></a>
        </div>


        <!-- <div class="col-4 col-lg-2 adminOPT ">
            <a href="/socios/inicioEquipacion" ><i class="bi bi-bag-plus adminBTN"></i>
            <p class="enlaUsu">2ª Equipación</p></a>
        </div> -->


    </div>

    <div class="row">
        <div class="col-12 col-lg-6 adminOPT" style="font-size: 3vh;">
            <br>
            <h1>Horario</h1>
            <div class="table-responsive">

            <table class="table table-responsive-sm" id="tabla_usuarios">

                <thead class="horario">
                    <td>Lunes</td>
                    <td>Martes</td>
                    <td>Miercoles</td>
                    <td>Jueves</td>
                    <td>Viernes</td>
                    <td>Sabado</td>
                    <td>Domingo</td>
                </thead>

                <?php
                    $horarioSemana = ['---','---','---','---','---','---','---'];
                ?>

                <tr class="horario">
                    <?php foreach($datos['horarioSocio'] as $hora_socios): 

                        if ($hora_socios->dia_sem == 'Lunes'){
                            $horarioSemana[0] = $hora_socios->hora_ini+'/'+$hora_socios->hora_fin;
                        }
                        if ($hora_socios->dia_sem == 'Martes') {
                            $horarioSemana[1] = $hora_socios->hora_ini.'/'.$hora_socios->hora_fin;
                        }
                        if ($hora_socios->dia_sem == 'Miercoles') {
                            $horarioSemana[2] = $hora_socios->hora_ini.'/'.$hora_socios->hora_fin;
                        }
                        if ($hora_socios->dia_sem == 'Jueves'){
                            $horarioSemana[3] = $hora_socios->hora_ini.'/'.$hora_socios->hora_fin;
                        }
                        if ($hora_socios->dia_sem == 'Viernes') {
                            $horarioSemana[4] = $hora_socios->hora_ini.'/'.$hora_socios->hora_fin;
                        }
                        if ($hora_socios->dia_sem == 'Sabado') {
                            $horarioSemana[5] = $hora_socios->hora_ini.'/'.$hora_socios->hora_fin;
                        }
                        if ($hora_socios->dia_sem == 'Domingo') {
                            $horarioSemana[6] = $hora_socios->hora_ini.'/'.$hora_socios->hora_fin;
                        }
                    ?>


                    <?php endforeach; ?>

                    <td> <?php echo $horarioSemana[0]?></td>
                    <td> <?php echo $horarioSemana[1]?></td>
                    <td> <?php echo $horarioSemana[2]?></td>
                    <td> <?php echo $horarioSemana[3]?></td>
                    <td> <?php echo $horarioSemana[4]?></td>
                    <td> <?php echo $horarioSemana[5]?></td>
                    <td> <?php echo $horarioSemana[6]?></td>
                </tr>
            </table>

            </div>
        </div>

        
        <div class="col-12 col-lg-6 adminOPT" style="font-size: 3vh;">
            <h1>Calendario</h1>

            <?php
            # definimos los valores iniciales para nuestro calendario
            $month=date("n");
            $year=date("Y");
            $diaActual=date("j");

            # Obtenemos el dia de la semana del primer dia
            # Devuelve 0 para domingo, 6 para sabado
            $diaSemana=date("w",mktime(0,0,0,$month,1,$year))+7;
           
            # Obtenemos el ultimo dia del mes
            $ultimoDiaMes=date("d",(mktime(0,0,0,$month+1,1,$year)-1));
            
            $meses=array(1=>"Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio",
            "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre");
            ?>
            

            <table id="calendar">
            <caption><?php echo $meses[$month]." ".$year?></caption>
            <tr style="font-size: 2vh;">
                <th>Lun</th><th>Mar</th><th>Mie</th><th>Jue</th>
                <th>Vie</th><th>Sab</th><th>Dom</th>
            </tr>
            <tr style="font-size: 2vh;">
                <?php
                $last_cell=$diaSemana+$ultimoDiaMes;
                // hacemos un bucle hasta 42, que es el máximo de valores que puede
                // haber... 6 columnas de 7 dias
                for($i=1;$i<=42;$i++){
                    if($i==$diaSemana){
                        // determinamos en que dia empieza
                        $day=1;
                    }
                    if($i<$diaSemana || $i>=$last_cell){
                        // celca vacia
                        
                        echo "<td>---</td>";
                    }else{
                        if($day==$diaActual)
                                echo "<td class='hoy'>$day</td>";
                            else
                                echo "<td>$day</td>";
                        
                        
                        $day++;
                    }
                    // cuando llega al final de la semana, iniciamos una columna nueva
                    if($i%7==0)
                    {
                        echo "</tr><tr>\n";
                    }
                }
            ?>
            </tr>
        </table>
        <br>
        </div>
    </div>
      
<?php require_once RUTA_APP.'/vistas/inc/footer.php';?>