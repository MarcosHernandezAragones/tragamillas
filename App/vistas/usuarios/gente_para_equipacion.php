<?php require_once RUTA_APP.'/vistas/inc/header.php';?>

<div class="table-responsive">
    <table class="table">
        <thead>
            <tr>  
                <th>DNI</th>
                <th>Nombre</th>
                <th>Apellidos</th>  
                <th>Entrenador/Socio</th>                        
                <th>Tipo</th>
                <th>Talla</th>
                <th>Entregar</th>
            </tr>
        </thead>
        <tbody id="tbodyy">
                
            
        </tbody>
    </table>
</div>

<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="ModalTitler" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            
        <div class="modal-header">
            <h5 class="modal-title" id="ModalTitler">Tienda</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body" id="contenidoModalUsuario">

            <form method="post" class="card-body" id="form">

                <input  type="hidden" name="id_user" id="id_user">

                <div class="mb-2">
                    <label for="dni">DNI: <sup>*</sup></label>
                    <input type="text" name="dni" id="dni" class="form-control form-control-lg" readonly>
                </div>
                <div class="mt-3 mb-2">
                    <label for="nombre">Nombre: <sup>*</sup></label>
                    <input type="text" name="nombre" id="nombre" class="form-control form-control-lg" readonly>
                </div>
                <div class="mb-2">
                    <label for="apellido">Apellido: <sup>*</sup></label>
                    <input type="text" name="apellido" id="apellido" class="form-control form-control-lg" readonly>
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
            <button type="submit" class="btn btn-success" data-bs-dismiss="modal" onclick="pedirEquipacion()">Confirmar Pedido</button>
        </div>
        </div>
    </div>
</div> 




<div class="text-center">
    <a onclick="action_decider(this)" id="gotofirst" class="btn btn-outline-secondary"><<</a>
    <a   id="dot_prev" class="btn">...</a>
    <a  onclick="action_decider(this)" id="num_prev" class="btn btn-outline-secondary">1</a>
    <a   id="num_this" class="btn btn-outline-success">2</a>
    <a  onclick="action_decider(this)" id="num_next" class="btn btn-outline-secondary">3</a>
    <a   id="dot_next" class="btn">...</a>
    <a  onclick="action_decider(this)" id="gotolast" class="btn btn-outline-secondary">>></a>
</div>



<script>
    let usuarios = [];

    async function obtener_peticiones_equipacion(){
        await fetch('/usuarios/obtener_usuarios_equipacion/')
        .then((resp) => resp.json())
        .then(function(data) {
            usuarios = data;
            console.log(usuarios)       
        })
        .catch( err => {
            console.error(err)            
        });

    }

    async function pedirEquipacion(){
        data = new FormData(document.getElementById("form"))
        //console.log(Object.fromEntries(data))

        await fetch('/usuarios/add_pedido/',{
            method: "POST",
            body:data,      
        })
        .then((resp) => resp.json())
        .then(function(data) {
            //console.log(data)
            usuarios = data;
            tbody.innerHTML = ""
            rellenarTabla()     //VOY POR AQUI  
        })
        .catch( err => {
            console.error(err)            
        });
    }
    

    async function rellenarTabla(){
        await obtener_peticiones_equipacion();
        tbody = document.getElementById("tbodyy");

        for (let i = 0; i < usuarios.length; i++) {
            tr = document.createElement("tr");
            
            id_user = document.createElement("td");
            td_dni = document.createElement("td");
            td_nombre = document.createElement("td");
            td_apellido = document.createElement("td");
            td_rol = document.createElement("td");
            td_talla = document.createElement("td");
            td_tipo = document.createElement("td");
            td_entregar = document.createElement("td");

            id_user.appendChild(document.createTextNode(usuarios[i].id_user));
            id_user.setAttribute("hidden",true);

            td_dni.appendChild(document.createTextNode(usuarios[i].dni));

            td_nombre.appendChild(document.createTextNode(usuarios[i].nombre));
            td_apellido.appendChild(document.createTextNode(usuarios[i].apellido));

            if (usuarios[i].rol==5){
                td_rol.appendChild(document.createTextNode("Entrenador"))
                td_rol.classList.add("text-danger")
            }else{
                td_rol.appendChild(document.createTextNode("Socio"))
                td_rol.classList.add("text-primary")
            }

            selectList = document.createElement("select")
            selectList.id = "lista-equipacion-"+usuarios[i].id_user;

            tallas = ["Seleccionar talla", "unica", "XXXS", "XXS", "XS","S","M","L", "XL", "XXL", "XXXL"];

            for (let i = 0; i < tallas.length; i++) {
                var option = document.createElement("option");
                    if (tallas[i]=="Seleccionar talla"){
                        option.value = null;
                    }else{
                        option.value = tallas[i];
                    }
                    option.text = tallas[i];
                    selectList.appendChild(option);
            }

            td_talla.appendChild(selectList)

            tipo = document.createElement("input")
            tipo.setAttribute('type', 'text')
            tipo.classList.add("form-text", "text-dark")
            tipo.id = "tipo_"+usuarios[i].id_user
            tipo.setAttribute('placeholder',"seleccionar tipo")
            td_tipo.appendChild(tipo)

            td_entregar.innerHTML = "<button type='button' id='boton_"+usuarios[i].id_user+"' disabled class='btn me-2 btn-outline-success btn-block' data-bs-toggle=\"modal\" data-bs-target=\"#exampleModal\" onclick=\"usuarioActual("+i+", '"+selectList.id+"', '"+tipo.id+"')\">Pedir</button>";


            selectList.setAttribute("onchange", "habilitarBoton(boton_"+usuarios[i].id_user+".id,'"+selectList.id+"','"+tipo.id+"')")
            tipo.setAttribute("onkeyup", "habilitarBoton(boton_"+usuarios[i].id_user+".id,'"+selectList.id+"','"+tipo.id+"')")
            selectList.classList.add("form-select", "col")
            

            tr.appendChild(id_user)
            tr.appendChild(td_dni)
            tr.appendChild(td_nombre)
            tr.appendChild(td_apellido)
            tr.appendChild(td_rol)
            tr.appendChild(td_tipo)
            tr.appendChild(td_talla)            
            tr.appendChild(td_entregar)
            tbody.appendChild(tr);
        }
    }

    function usuarioActual(i, lista, tipo){
        document.getElementById("id_user").value= usuarios[i].id_user
        document.getElementById("nombre").value= usuarios[i].nombre
        document.getElementById("apellido").value= usuarios[i].apellido
        document.getElementById("dni").value= usuarios[i].dni

        document.getElementById("talla").value= document.getElementById(lista).value

        for (let i = 0; i < document.getElementById("talla").length; i++) {
            if (document.getElementById(lista).value==document.getElementById("talla")[i].value) {
                document.getElementById("talla")[i].selected
            }    
        }

        document.getElementById("tipo").value= document.getElementById(tipo).value
    }

    function habilitarBoton(id, tallas, tipo){
        
        //console.log(tipo)
        //console.log(id)
        //console.log(tallas)
        if(document.getElementById(tallas).value=="null" || document.getElementById(tipo).value==""){
           document.getElementById(id).setAttribute("disabled", true)
        }else{
           document.getElementById(id).removeAttribute("disabled")
        }

    }

    rellenarTabla()























































    //////////////////////////////////////////////////////////////////////////PARTE-PAGINACION-SOLO-JS/////////////////////////////////////////////////////////////





    var element_per_paige=2//ffs: or any other number  //ffs: futuras versiones poder cambiar el num elementos
    var p_actual //ffs: comprobaciones / reload pag btns
    var pmax //ffs: se establece al cargar pagina, ya nos ocuparemos de eso luego
    var p_next //ffs: num nxt
    var p_prev //ffs: num prev
    var p_jump //ffs: mejora para futura version

    //var pmax //ffs: obtenido del aguait

    function get_pmax() {
        //code here
    }
    get_pmax()


async function get_paige(gotop) {
    var first_page=document.getElementById("gotofirst")
    var prev_dot=document.getElementById("dot_prev")


    var dis_page=document.getElementById("num_this")
    var nxt_page=document.getElementById("num_next")
    var prv_page=document.getElementById("num_prev")


    var next_dot=document.getElementById("dot_next")
    var last_page=document.getElementById("gotolast")
 
    
    p_actual=gotop //ffs: watch this out

    
    if (p_actual <= 1) {
        p_prev="nil" //ffs: controlar esto mejor
        prv_page.innerHTML="nil"


        prev_dot.setAttribute("hidden",true)
        first_page.setAttribute("hidden",true)
        prv_page.setAttribute("hidden",true)
    }else{
        p_prev=parseInt(p_actual)-1
        prv_page.innerHTML=p_prev

        prev_dot.removeAttribute("hidden")
        first_page.removeAttribute("hidden")
        prv_page.removeAttribute("hidden")
    }
    
    if (p_actual >= pmax) {
        p_next="nil" //ffs: controlar esto mejor
        nxt_page.innerHTML="nil"


        next_dot.setAttribute("hidden",true)
        last_page.setAttribute("hidden",true)
        nxt_page.setAttribute("hidden",true)
    }else{
        p_next=parseInt(p_actual)+1
        nxt_page.innerHTML=p_next

        next_dot.removeAttribute("hidden")
        last_page.removeAttribute("hidden")
        nxt_page.removeAttribute("hidden")
    }
    
    dis_page.innerHTML=p_actual

    



    for (let i = 0; i < array.length; i++) {
        const element = array[index];
        
    }
    
           // document.getElementById("tbodyTablaUsuarios").innerHTML = ""
           // rellenarTabla(data)
     
    
}
//get_paige(1)

function action_decider(dis) {
    


    switch (dis.id) {
        case "gotofirst":
            get_paige(1)
            break;
        case "gotolast":
            get_paige(pmax)
        break;
        case "num_prev":
            
            get_paige(p_prev)
        break;
        case "num_next":
            get_paige(p_next)
        break;
        

        default:
            break;
    }


}







</script>

<?php require_once RUTA_APP.'/vistas/inc/footer.php';?> 