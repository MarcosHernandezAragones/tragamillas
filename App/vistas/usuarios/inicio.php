<?php require_once RUTA_APP.'/vistas/inc/header.php';
 ?>

<table class="table" id="tabla_usuarios">
    <thead>
                <tr>
                    <th>Id</th>
                    <th>Nombre</th>
                    <th>Apellidos</th>
                    <th>Email</th>
                    <th>DNI</th>
                    <th>Cuenta Corriente</th>                    
                    <th>Fecha Nacimiento</th>
                    <th>Telefono</th>
                    <th>Rol</th>

    
                    <th>Acciones</th>
    <?php    //if (tienePrivilegios($sesion->rol,[0])){ ?>                    
    <?php   // }?>
                </tr>
    </thead>
    <tbody id='tbodyTablaUsuarios'>

<?php
include_once RUTA_APP.'/helpers/funciones.php';
mostrarUruarios($datos['usuarioSesion'],$datos['usuarios']);
?>

    </tbody>
</table>

<?php if (tienePrivilegios($datos['usuarioSesion']->rol,[0])):?>
    <div class="col text-center">
        <button type="button" class="btn btn-outline-success btn-lg" data-bs-toggle="modal" data-bs-target="#Modal_Agregar">
        <i class="bi bi-person-plus-fill"></i>
        </button>
    </div>

    <!-- <div class="container" id="listadoSesiones" style="display:none">
        <br><br>
        <h2>Sesiones de: <span id="usuarioSesion"></span></h2>
        <table class="table text-center">
            <thead>
                <tr>
                <th scope="col">id_sesion</th>
                <th scope="col">id_usuario</th>
                <th scope="col">fecha_inicio</th>
                <th scope="col">fecha_fin</th>
                <th scope="col">estado</th>
                </tr>
            </thead>
            <tbody id="tbodyTablaSesiones">

                
            </tbody>
        </table>
    </div>
<?php endif ?> -->

<!-- Modal editar -->  
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="ModalTitler" aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                
                            <div class="modal-header">
                                <h5 class="modal-title" id="ModalTitler">Editar Usuario</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body" id="contenidoModalUsuario">

                                <form method="post" class="card-body" id="form-editar" >
                                    
                                        <input  type="hidden" name="id_user" id="id_user" class="form-control form-control-lg">
                                        

                                    <div class="mt-3 mb-3">
                                        <label for="nombre">Nombre: <sup>*</sup></label>
                                        <input type="text" name="nombre" id="nombre" class="form-control form-control-lg">
                                    </div>
                                    <div class="mb-3">
                                        <label for="apellido">Apellido: <sup>*</sup></label>
                                        <input type="text" name="apellido" id="apellido" class="form-control form-control-lg">
                                    </div>
                                    <div class="mb-3">
                                        <label for="email">Email: <sup>*</sup></label>
                                        <input type="email" name="email" id="email" class="form-control form-control-lg">
                                    </div>
                                    <div class="mb-3">
                                        <label for="dni">DNI/NIE/CIF: <sup>*</sup></label>
                                        <input type="text" name="dni" id="dni" class="form-control form-control-lg">
                                    </div>
                                    <div class="mb-3">
                                        <label for="dni">Cuenta Corriente: <sup>*</sup></label>
                                        <input type="text" name="cc" id="cc" class="form-control form-control-lg">
                                    </div>
                                    <div class="mb-3">
                                        <label for="fecha_nac">Fecha Nacimiento: <sup>*</sup></label>
                                        <input type="date" name="fecha_nac" id="fecha_nac" class="form-control form-control-lg">
                                    </div>
                                    <div class="mb-3">
                                        <label for="telefono">Telefono: <sup>*</sup></label>
                                        <input type="text" name="telefono" id="telefono" class="form-control form-control-lg">
                                    </div>
                                    
                                </form>

                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cerrar</button>
                                <button type="submit" class="btn btn-success" onclick="editar_usuario()" data-bs-dismiss="modal">Editar </button>
                            </div>
                            </div>
                        </div>
                        </div>


                        
<!-- modal agraga -->
<div class="modal fade" id="Modal_Agregar" tabindex="-1" aria-labelledby="ModalTitler1" aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                
                            <div class="modal-header">
                                <h5 class="modal-title" id="ModalTitler1">Agregame PVTO</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body" id="contenidoModalUsuario">

                                <form method="post" class="card-body" name="form_agraga" id="form_agraga" onsubmit="return comprobar_formulario()">
                                    <div class="mt-3 mb-3">
                                        <label for="nombre_Agregar">Nombre: <sup>*</sup></label>
                                        <input type="text" name="nombre_Agregar" id="nombre_Agregar" class="form-control form-control-lg" onkeyup="comprobar_nombres(this)">
                                    </div>
                                    <div class="mb-3">
                                        <label for="apellidos_Agregar">Apellidos: <sup>*</sup></label>
                                        <input type="text" name="apellido_Agregar" id="apellido_Agregar" class="form-control form-control-lg" onkeyup="comprobar_nombres(this)"  >
                                    </div>
                                    <div class="mb-3">
                                        <label for="dni_Agregar">DNI/NIE/CIF: <sup>*</sup></label>
                                        <input type="text" name="dni_Agregar" id="dni_Agregar" class="form-control form-control-lg" onkeyup="comprobar_dni(this)" >
                                    </div>
                                    <div class="mb-3">
                                        <label for="email_Agregar">Email: <sup>*</sup></label>
                                        <input type="email" name="email_Agregar" id="email_Agregar" class="form-control form-control-lg" onkeyup="comprobar_correo(this)">
                                    </div>
                                    
                                    <div class="mb-3">
                                        <label for="telefono_Agregar">telefono: <sup>*</sup></label>
                                        <input type="text" name="telefono_Agregar" id="telefono_Agregar" class="form-control form-control-lg" onkeyup="comprobar_telefono(this)">
                                    </div>
                                    <div class="mb-3">
                                        <label for="fnac_Agregar">fecha nacimiento: <sup>*</sup></label>
                                        <input type="date" name="fnac_Agregar" id="fnac_Agregar" class="form-control form-control-lg is-invalid" onchange="comprobar_fecha(this)" onkeyup="comprobar_fecha(this)" >
                                    </div>
                                    <div class="mb-3">
                                        <label for="cc_Agregar">CC: <sup>*</sup></label>
                                        <input type="text" name="cc_Agregar" id="cc_Agregar" class="form-control form-control-lg" onkeyup="validarIBAN(this)">
                                    </div>
                                    <div class="mb-3">
                                        <label for="rol_Agregar">Rol: <sup>*</sup></label>
                                        <select name="rol_Agregar" id="rol_Agregar" class="form-control form-control-lg is-invalid" onchange="comprobar_select(this)">
                                            <option value="nil" disabled selected>selecione una opcion</option>
                                            <option value="5">entrenador</option>
                                            <option value="200">tienda</option>
                                        </select>
                                    </div>
                                    



                                    
                                </form>

                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cerrar</button>
                                <button type="submit" id="btn_agraga" class="btn btn-success" form="form_agraga" >Agraga</button>
                            </div>
                            </div>
                        </div>
                        </div>


<!-- modal borrascosas -->
<div class="modal fade" id="Modal_Borrar" tabindex="-1" aria-labelledby="ModalTitler2" aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                
                            <div class="modal-header">
                                <h5 class="modal-title" id="ModalTitler2">Baja de Usuario</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body" id="contenidoModalUsuario">

                                <form method="post" class="card-body" action="/borrar.php">

                                    <input  type="hidden" name="id_user_Borrar" id="id_user_Borrar" class="form-control form-control-lg">

                                    <div class="mt-3 mb-3">
                                        <label for="nombre_Borrar">Nombre: <sup>*</sup></label>
                                        <input type="text" name="nombre_Borrar" id="nombre_Borrar" class="form-control form-control-lg" readonly>
                                    </div>
                                    <div class="mb-3">
                                        <label for="apellido_Borrar">Apellido: <sup>*</sup></label>
                                        <input type="text" name="apellido_Borrar" id="apellido_Borrar" class="form-control form-control-lg" readonly>
                                    </div>
                                    <div class="mb-3">
                                        <label for="email_Borrar">Email: <sup>*</sup></label>
                                        <input type="email" name="email_Borrar" id="email_Borrar" class="form-control form-control-lg" readonly>
                                    </div>
                                    <div class="mb-3">
                                        <label for="dni_Borrar">DNI/NIE/CIF: <sup>*</sup></label>
                                        <input type="text" name="dni_Borrar" id="dni_Borrar" class="form-control form-control-lg" readonly>
                                    </div>
                                    <div class="mb-3">
                                        <label for="cc_Borrar">Cuenta Corriente: <sup>*</sup></label>
                                        <input type="text" name="cc_Borrar" id="cc_Borrar" class="form-control form-control-lg" readonly>
                                    </div>
                                    <div class="mb-3">
                                        <label for="fecha_nac_Borrar">Fecha Nacimiento: <sup>*</sup></label>
                                        <input type="date" name="fecha_nac_Borrar" id="fecha_nac_Borrar" class="form-control form-control-lg" readonly>
                                    </div>
                                    <div class="mb-3">
                                        <label for="telefono_Borrar">Telefono: <sup>*</sup></label>
                                        <input type="text" name="telefono_Borrar" id="telefono_Borrar" class="form-control form-control-lg" readonly>
                                    </div>

                                </form>

                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                                <button type="submit" class="btn btn-danger" data-bs-dismiss="modal" onclick="baja_usuario()" >Eliminar</button>
                            </div>
                            </div>
                        </div>
</div>


<script>

    async function usuarioActual($id,$act){// crea un fetch, recibe los datos procesados(en la pagina llamada por fetch) y luego cambia los datos del modal
        var modtitle

        var term="";
        if ($act==1) {
            term="_Borrar"
            modtitle= document.getElementById("ModalTitler2")
            modtitle.innerHTML="Borrar Usuario";
        }else{
            modtitle= document.getElementById("ModalTitler")
            modtitle.innerHTML="Editar Usuario";
        }
        var enlace="<?php echo RUTA_URL?>/usuarios/obtener_usu_actual/"+$id;
        var nomP="users";
        
        
        

            await fetch(enlace)
            .then(response => response.json())
            .then(data => nomP = data)
            .catch( err => console.error(err));
        //console.log(nomP.datos_usu);
        
        //obtenemos los elementos cuyo valor vamos a cambiar
        var modCont_id_user= document.getElementById("id_user"+term)
        var modCont_nombre= document.getElementById("nombre"+term)
        var modCont_apellido= document.getElementById("apellido"+term)
        var modCont_email= document.getElementById("email"+term)
        var modCont_dni= document.getElementById("dni"+term)
        var modCont_CC= document.getElementById("cc"+term)      
        var modCont_fnac= document.getElementById("fecha_nac"+term)
        var modCont_telef= document.getElementById("telefono"+term)
        
        //--------------------------------------cambiamos los datos de los elementos
        datos_usu=nomP.datos_usu;
        modCont_nombre.value = datos_usu.nombre;
        modCont_apellido.value = datos_usu.apellido;
        modCont_email.value = datos_usu.email;
        modCont_dni.value = datos_usu.Dni;
        modCont_CC.value = datos_usu.CC;
        modCont_id_user.value = $id;
        modCont_fnac.value=datos_usu.fecha_nac;
        modCont_telef.value=datos_usu.telefono;
          
        
    }
    


    function getSesiones(id_usuario){
        fetch('<?php echo RUTA_URL?>/usuarios/sesiones/'+id_user, {
            headers: {
                "Content-Type": "application/json"
            },
            credentials: 'include'
        })
            .then((resp) => resp.json())
            .then(function(data) {
                let sesiones = data.sesiones
                let usuario = data.usuario

                document.getElementById("tbodyTablaSesiones").innerHTML = ""
                document.getElementById("usuarioSesion").innerHTML = usuario.nombre

                document.getElementById("listadoSesiones").style.display="block";

                for (i = 0; i < sesiones.length; i++){
                    let fechaInicio = new Date(sesiones[i].fecha_inicio)
                    let fechaFin = new Date(sesiones[i].fecha_fin)
                    let fechaFinOut = "-"
                    let estado
                    if (sesiones[i].fecha_fin) {
                        fechaFinOut = fechaFin.toLocaleString()
                        estado = "cerrada"
                    } else {
                        estado = '<div class="col text-center"> \
                                    <a class="btn btn-success" href="javascript:cerrarSesion(\''+id_user+'\',\''+sesiones[i].id_sesion+'\')"> \
                                        Cerrar \
                                    </a> \
                                </div>' 
                    }
                    
                    document.getElementById("tbodyTablaSesiones").insertRow(-1).innerHTML = 
                                '<td>' + sesiones[i].id_sesion + '</td>' + 
                                '<td>' + sesiones[i].id_user + '</td>' + 
                                '<td>' + fechaInicio.toLocaleString() + '</td>' + 
                                '<td>' + fechaFinOut + '</td>' +
                                '<td>' + estado + '</td>'
                }
            })
    }


    async function cerrarSesion(id_usuario,id_sesion){
        const data = new FormData();
        data.append('id_sesion', id_sesion);
        
        await fetch('<?php echo RUTA_URL?>/usuarios/cerrarSesion/', {
            method: "POST",
            body: data,
        })
            .then((resp) => resp.json())
            .then(function(data) {
    
                if (Boolean(data)){
                    getSesiones(id_user)
                } else {
                    alert('Error al Cerrar la sesión')
                }
                
            })
    }


    async function editar_usuario(){

        let nombre= document.getElementById("nombre").value
        let id_user= document.getElementById("id_user").value
        let apel= document.getElementById("apellido").value
        let email= document.getElementById("email").value
        let dni= document.getElementById("dni").value
        let cc= document.getElementById("cc").value
        let fnac= document.getElementById("fecha_nac").value
        let telef= document.getElementById("telefono").value
    
        const data = new FormData()
        data.append("id_user", id_user)
        data.append("nombre", nombre)
        data.append("apellido", apel)
        data.append("Dni", dni)
        data.append("email", email)
        data.append("CC", cc)
        data.append("fecha_nac", fnac)
        data.append("telefono", telef)

        
        await fetch('<?php echo RUTA_URL?>/usuarios/editar_usuario/', {
            method: "POST",
            body: data,
        })
            .then((resp) => resp.json())
            .then(function(data) {
                //console.log(data)
                document.getElementById("tbodyTablaUsuarios").innerHTML = ""
                rellenarTabla(data)
                
            })
            .catch( err => {
               // alert("Error al actualizar el usuario")
                console.error(err)
            
            });
    } 
    
    
    async function agregar_usuario(){

        
        let nombre= document.getElementById("nombre_Agregar").value;
        let apel= document.getElementById("apellido_Agregar").value;
        let email= document.getElementById("email_Agregar").value;
        let dni= document.getElementById("dni_Agregar").value;
        let cc= document.getElementById("cc_Agregar").value;
        let fnac= document.getElementById("fnac_Agregar").value;
        let telef= document.getElementById("telefono_Agregar").value;
        let rol= document.getElementById("rol_Agregar").value;///////////////////////////////////////////////////////////////////////////////////haccer select para obtener rol

        
        

        const data_env = new FormData()
        
        data_env.append("nombre", nombre)
        data_env.append("apellido", apel)
        data_env.append("Dni", dni)
        data_env.append("email", email)
        data_env.append("CC", cc)
        data_env.append("fecha_nac", fnac)
        data_env.append("telefono", telef)
        data_env.append("rol", rol)

            //console.log(data_env)

            await fetch('<?php echo RUTA_URL?>/usuarios/agregar_usuario/',{
                method: "POST",
                body:data_env,

            })
            .then(response => response.json())
            .then(function(data) {
                //console.log(data)
                document.getElementById("tbodyTablaUsuarios").innerHTML = ""
                rellenarTabla(data)

                
                
            })
            .catch( err => { 
                
                console.error(err)
                
                alert("Error al actualizar el usuario")

            });


}


    async function baja_usuario(){
        
        let id_user= document.getElementById("id_user_Borrar").value;
        let email= document.getElementById("email_Borrar").value;


        //alert("¿Esta seguro de que quiere eliminar al usuario con el correo: "+email+"?")

        const data = new FormData()
        
        data.append("id", id_user)

        await fetch('<?php echo RUTA_URL?>/usuarios/baja_usuario/',{
                method: "POST",
                body:data,

            })
            .then(response => response.json())
            .then(function(data) {
                //console.log(data)
                document.getElementById("tbodyTablaUsuarios").innerHTML = ""
                rellenarTabla(data)
                
            })
            .catch( err => { 
                console.error(err)
                alert("Error al actualizar el usuario")
            });
        
    }


    
    function rellenarTabla(usuarios){

        tbody = document.getElementById("tbodyTablaUsuarios")

        for (let i = 0; i < usuarios.length; i++) {
            tr = document.createElement("tr")

            td_id_user=document.createElement("td") //creamos td
            td_id_user.appendChild(document.createTextNode(usuarios[i].id_user)) //rellenamos el td con el id del usuario

            td_nombre=document.createElement("td")
            td_nombre.appendChild(document.createTextNode(usuarios[i].nombre))

            td_apellido=document.createElement("td")
            td_apellido.appendChild(document.createTextNode(usuarios[i].apellido))


            td_email=document.createElement("td")
            td_email.appendChild(document.createTextNode(usuarios[i].email))

            td_Dni=document.createElement("td")
            td_Dni.appendChild(document.createTextNode(usuarios[i].Dni))

            td_CC=document.createElement("td")
            td_CC.appendChild(document.createTextNode(usuarios[i].CC))

            td_fecha_nac=document.createElement("td")
            td_fecha_nac.appendChild(document.createTextNode(usuarios[i].fecha_nac))

            td_telefono=document.createElement("td")
            td_telefono.appendChild(document.createTextNode(usuarios[i].telefono))

            
            td_rol=document.createElement("td")
            td_rol.appendChild(document.createTextNode(usuarios[i].rol))

            
            td_acciones=document.createElement("td")
            if (usuarios[i].rol != 0) {
                td_acciones.innerHTML ="<button type=\"button\" class=\"btn  btn-block editUruario\"  data-bs-toggle=\"modal\" data-bs-target=\"#exampleModal\" onclick=\"usuarioActual( "+usuarios[i].id_user+",0)\"><i class=\"bi bi-pencil-square\"></i></button>&nbsp;&nbsp;&nbsp;<button type=\"button\" class=\"btn btn-outline-danger btn-block\" data-bs-toggle=\"modal\" data-bs-target=\"#Modal_Borrar\" onclick=\"usuarioActual( "+usuarios[i].id_user+",1)\"><i class=\"bi bi-person-x-fill\"></i></button>"
            } else {
                td_acciones.innerHTML ="No Actions Avaliable";
            }

            tr.appendChild(td_id_user)
            tr.appendChild(td_nombre)
            tr.appendChild(td_apellido)
            tr.appendChild(td_email)
            tr.appendChild(td_Dni)
            tr.appendChild(td_CC)
            tr.appendChild(td_fecha_nac)
            tr.appendChild(td_telefono)
            tr.appendChild(td_rol)
            tr.appendChild(td_acciones)
            
            
            tbody.appendChild(tr)

        }


    }

    function comprobar_formulario() {
        var valid_nombre= comprobar_nombres(document.getElementById("nombre_Agregar"));
        var valid_apel= comprobar_nombres(document.getElementById("apellido_Agregar"));
        var valid_email= comprobar_correo(document.getElementById("email_Agregar"));
        var valid_dni= comprobar_dni(document.getElementById("dni_Agregar"));
        var valid_cc= validarIBAN(document.getElementById("cc_Agregar")) ;
        var valid_fnac= comprobar_fecha(document.getElementById("fnac_Agregar"));
        var valid_telef= comprobar_telefono(document.getElementById("telefono_Agregar"));
        var valid_rol= comprobar_select(document.getElementById("rol_Agregar"));

        var is_all_valid=false;


        if (valid_rol && valid_telef && valid_fnac && valid_cc && valid_dni && valid_email && valid_apel && valid_nombre) {
            is_all_valid=true
        }

        if (is_all_valid) {
            agregar_usuario()

            var modall = document.getElementById("Modal_Agregar")
        var modal = bootstrap.Modal.getInstance(modall)
        modal.hide();
           // close_modal_manually(elementor)

        }
        return false
    }

    
</script>


<?php require_once RUTA_APP.'/vistas/inc/footer.php' ;?>









