<?php require_once RUTA_APP.'/vistas/inc/header.php';?>

<table class="table">
        <thead>
            <tr>
                <th>Tipo</th>
                <th>Fecha</th>
                <th>Ingreso</th>
                <th>Nombre</th>
                <th>Apellidos</th>
                <th>talla</th>
            </tr>
        </thead>
        <tbody>
                
            <?php foreach($datos['usuarios'] as $uruario): ?>
                <tr>
                    <?php if ($datos['listarEquipacion']->id_user==$uruario->id_user) {?>
                        <td><?php echo $datos['listarEquipacion']->tipo?></td>
                        <td><?php echo $datos['listarEquipacion']->fecha_peticion?></td>
                        <td><?php echo $datos['listarEquipacion']->id_ingreso_cuota?></td>
                        <td><?php echo $uruario->nombre ?></td>
                        <td><?php echo $uruario->apellido ?></td>
                        <td><?php echo $datos['listarEquipacion']->talla?></td>
                    <?php }else {?>
                        <td>Usuario sin equipacion</td>
                        <td>---</td>
                        <td>---</td>
                        <td><?php echo $uruario->nombre ?></td>
                        <td><?php echo $uruario->apellido ?></td>
                        <td>---</td>
                    <?php }?>
                </tr>
            <?php endforeach ?>
                    
        </tbody>
    </table>

<?php require_once RUTA_APP.'/vistas/inc/footer.php';?>