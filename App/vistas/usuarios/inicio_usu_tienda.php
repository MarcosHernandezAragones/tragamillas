<?php require_once RUTA_APP.'/vistas/inc/header.php';?>
<div class="table-responsive">
    <table class="table">
        <thead>
            <tr>  
                <th>Fecha</th>
                <th>Nombre</th>
                <th>Apellidos</th>
                <th>DNI</th>
                <th>Tipo</th>
                <th>Talla</th>
                <th>Entregar</th>
            </tr>
        </thead>
        <tbody id="tbodyy">
                
            
        </tbody>
    </table>
</div>

 <!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="ModalTitler" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            
        <div class="modal-header">
            <h5 class="modal-title" id="ModalTitler">Tienda</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body" id="contenidoModalUsuario">

            <form method="post" class="card-body" id="form">

                <input  type="hidden" name="id_equipacion" id="id_equipacion">

                <div class="mt-3 mb-2">
                    <label for="nombre">Nombre: <sup>*</sup></label>
                    <input type="text" name="nombre" id="nombre" class="form-control form-control-lg" readonly>
                </div>
                <div class="mb-2">
                    <label for="apellido">Apellido: <sup>*</sup></label>
                    <input type="text" name="apellido" id="apellido" class="form-control form-control-lg" readonly>
                </div>
                <div class="mb-2">
                    <label for="dni">DNI: <sup>*</sup></label>
                    <input type="text" name="dni" id="dni" class="form-control form-control-lg" readonly>
                </div>
                <div class="mb-2">
                    <label for="tipo">Tipo: <sup>*</sup></label>
                    <input type="text" name="tipo" id="tipo" class="form-control form-control-lg">
                </div>
                <div class="mb-2">
                    <label for="talla">Talla: <sup>*</sup></label>
                    <select class="form-select" name="talla" id="talla">
                        <option value="unica">unica</option>
                        <option value="XXXS">XXXS</option>
                        <option value="XXS">XXS</option>
                        <option value="XS">XS</option>
                        <option value="S">S</option>
                        <option value="M">M</option>
                        <option value="L">L</option>
                        <option value="XL">XL</option>
                        <option value="XXL">XXL</option>
                        <option value="XXXL">XXXL</option>
                    </select>
                </div>
            </form>

        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cerrar</button>
            <button type="submit" class="btn btn-success" data-bs-dismiss="modal" onclick="equipacion_entregada()">Confirmar Entrega</button>
        </div>
        </div>
    </div>
</div> 




  <script>
    let listarEquipacion = [];

    async function obtener_peticiones_equipacion(){
        await fetch('/usuarios/equipacion/')
        .then((resp) => resp.json())
        .then(function(data) {
            listarEquipacion = data;  
            //usu = data.usu;     
        })
        .catch( err => {
            console.error(err)            
        });
        console.log(listarEquipacion)
    }

    async function rellenarTabla(){
        await obtener_peticiones_equipacion();
        tbody = document.getElementById("tbodyy");

        console.log(listarEquipacion)
        for (let i = 0; i < listarEquipacion.length; i++) {
            tr = document.createElement("tr")

            id_equipacion = document.createElement("td")
            td_tipo = document.createElement("td")
            td_fecha = document.createElement("td")
            td_nombre = document.createElement("td")
            td_apellido = document.createElement("td")
            td_dni = document.createElement("td")
            td_talla = document.createElement("td")
            td_entregar = document.createElement("td")

            id_equipacion.appendChild(document.createTextNode(listarEquipacion[i].id_equipacion))
            id_equipacion.setAttribute("hidden",true)

            tipo = document.createElement("input")
            tipo.setAttribute('type', 'text')
            tipo.classList.add("form-text", "text-dark")
            tipo.id = "tipo_"+listarEquipacion[i].id_equipacion
            if (listarEquipacion[i].tipo=="") {
                tipo.setAttribute('placeholder',"seleccionar tipo")
            }else{
                tipo.value = listarEquipacion[i].tipo
            }
            

            td_tipo.appendChild(tipo)


            selectList = document.createElement("select")
            selectList.id = "lista-equipacion-"+listarEquipacion[i].id_equipacion;

            tallas = ["Seleccionar talla", "unica", "XXXS", "XXS", "XS","S","M","L", "XL", "XXL", "XXXL"];

            for (let j = 0; j < tallas.length; j++) {
                var option = document.createElement("option");
                    if (tallas[j]=="Seleccionar talla"){
                        option.value = null;
                    }else{
                        option.value = tallas[j];
                    }
                    option.text = tallas[j];
                    if (option.text==listarEquipacion[i].talla) {
                        option.selected = true
                    }
                    
                    
                    selectList.appendChild(option);
            }

            td_fecha.appendChild(document.createTextNode(listarEquipacion[i].fecha_peticion))
            td_nombre.appendChild(document.createTextNode(listarEquipacion[i].nombre))
            td_apellido.appendChild(document.createTextNode(listarEquipacion[i].apellido))
            td_dni.appendChild(document.createTextNode(listarEquipacion[i].dni))


            td_talla.appendChild(selectList)
            td_entregar.innerHTML = "<button type='button' id='boton_"+listarEquipacion[i].id_equipacion+"' disabled class='btn me-2 btn-outline-success btn-block' data-bs-toggle=\"modal\" data-bs-target=\"#exampleModal\" onclick=\"equipacionActual("+i+", '"+selectList.id+"', '"+tipo.id+"')\">Entregar</button>";

            selectList.setAttribute("onchange", "habilitarBoton(boton_"+listarEquipacion[i].id_equipacion+".id,'"+selectList.id+"','"+tipo.id+"')")
            tipo.setAttribute("onkeyup", "habilitarBoton(boton_"+listarEquipacion[i].id_equipacion+".id,'"+selectList.id+"','"+tipo.id+"')")
            selectList.classList.add("form-select", "col")

            tr.appendChild(id_equipacion)
            tr.appendChild(td_fecha)
            tr.appendChild(td_nombre)
            tr.appendChild(td_apellido)
            tr.appendChild(td_dni)
            tr.appendChild(td_tipo)
            tr.appendChild(td_talla)            
            tr.appendChild(td_entregar)

            tbody.appendChild(tr)  
            habilitarBoton("boton_"+listarEquipacion[i].id_equipacion,selectList.id,tipo.id)
        }        
    }

    function equipacionActual(i, lista, tipo){
        
        document.getElementById("id_equipacion").value= listarEquipacion[i].id_equipacion
        document.getElementById("nombre").value= listarEquipacion[i].nombre
        document.getElementById("apellido").value= listarEquipacion[i].apellido
        document.getElementById("dni").value= listarEquipacion[i].dni
        document.getElementById("talla").value= document.getElementById(lista).value

        for (let i = 0; i < document.getElementById("talla").length; i++) {
            if (document.getElementById(lista).value==document.getElementById("talla")[i].value) {
                document.getElementById("talla")[i].selected
            }    
        }

        document.getElementById("tipo").value= document.getElementById(tipo).value

    }

    async function equipacion_entregada(){
           
        data = new FormData(document.getElementById("form"))
            
        //console.log(Object.fromEntries(data)) 
            
        await fetch('/usuarios/equipacion_entregada/', {
        method: "POST",
        body: data,
        })
        .then((resp) => resp.json())
        .then(function(data) {
            listarEquipacion = data
            document.getElementById("tbodyy").innerHTML = ""
            rellenarTabla();
        })
        .catch( err => {
            // alert("Error al actualizar el usuario")
            console.error(err)
        
        }); 
    }

    function habilitarBoton(id, tallas, tipo){
        
        //console.log(id)
        //console.log(tallas)
        //console.log(tipo)
        if(document.getElementById(tallas).value=="null" || document.getElementById(tipo).value==""){
           document.getElementById(id).setAttribute("disabled", true)
        }else{
           document.getElementById(id).removeAttribute("disabled")
        }        
    }

    rellenarTabla();

</script>
<?php require_once RUTA_APP.'/vistas/inc/footer.php';?> 