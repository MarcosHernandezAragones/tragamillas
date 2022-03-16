<?php

    //Para redireccionar la pagina
    function redireccionar($pagina){
        header('location: '.RUTA_URL.$pagina);
    }

    function tienePrivilegios($rol_usuario,$rolesPermitidos){
        // si $rolesPermitidos es vacio, se tendran privilegios
        if (empty($rolesPermitidos) || in_array($rol_usuario, $rolesPermitidos)) {
            return true;
        }
    }




    function mostrarUruarios($sesion, $usuarios){//$datos['usuarioSesion']   $datos['usuarios']
        

                    foreach($usuarios as $uruario){
                        echo "<tr>
                            <td>$uruario->id_user </td>
                            <td>$uruario->nombre </td>
                            <td>$uruario->apellido </td>
                            <td>$uruario->email </td>
                            <td>$uruario->Dni </td>
                            <td>$uruario->CC </td>
                            <td>$uruario->fecha_nac </td>
                            <td>$uruario->telefono </td>
                            <td>$uruario->rol </td>";


                                    if (tienePrivilegios($sesion->rol,[0]) && $uruario->rol!=0){
                                        echo '<td>
                                                <button type="button" class="btn  btn-block editUruario"  data-bs-toggle="modal" data-bs-target="#exampleModal" onclick="usuarioActual( '.$uruario->id_user.',0)">
                                                    <i class="bi bi-pencil-square"></i>
                                                </button> 
                                                &nbsp;
                                                <button type="button" class="btn btn-outline-danger btn-block" data-bs-toggle="modal" data-bs-target="#Modal_Borrar" onclick="usuarioActual( '.$uruario->id_user.',1)">
                                                    <i class="bi bi-person-x-fill"></i>
                                                </button> 
                                            </td>';
                                    }else{ 
                                        echo '<td>No Actions Avaliable</td>';
                                    } 

                                    echo ' </tr>';
                    }

    }