<?php require_once RUTA_APP.'/vistas/inc/header.php'; ?>

  <h1>Grupos</h1>
  <div class="container">
    <div class="row">
      <?php
      print_r ($datos);
          foreach ($datos["grupos"] as $grupos) { ?>
          
              <div class="col-3 border primary rounded-1 m-1"><?php echo $grupos->nombre?>
              &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                <button type="button" class="btn  btn-block editUruario"  data-bs-toggle="modal" data-bs-target="#exampleModal" onclick="usuariosGrupo(<?php echo $grupos->id_grupo; ?>)" >
                  <i class="bi bi-eye-fill"></i>
                </button> 
              </div>


      <?php } ?>
    </div>
  </div>





<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="ModalTitler" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="ModalTitler"></h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body" id="contenidoModalGrupo">

        
        


      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>

<script>


    async function usuariosGrupo($id){// create un fetch y luego cambias los datos del modal
        var modtitler=document.getElementById("ModalTitler")
        var modbody=document.getElementById("contenidoModalGrupo")
        modbody.innerHTML="";
        modtitler.innerHTML="Grupo "+$id;


        var enlace="<?php echo RUTA_URL?>/grupos/obtener_datos_grupo/"+$id;
        var nomP="grupo";
        

          await fetch(enlace)
          .then(response => response.json())
          .then(data => nomP = data)
          .catch( err => console.error(err));


          nomP.grupo_alumn.forEach(alumno => {
            var btn_info_alumn=document.createElement("button")
            
            var funcion_info= "mostrar_usuario("+alumno.id_socio+")"
            btn_info_alumn.setAttribute("onclick",funcion_info)
            btn_info_alumn.setAttribute("class","btn  btn-block editUruario")
            btn_info_alumn.setAttribute("data-bs-toggle","modal")
            btn_info_alumn.setAttribute("data-bs-target","#exampleModal")
            btn_info_alumn.setAttribute("type","button")
            btn_info_alumn.innerHTML=`<i class="bi bi-eye-fill"></i>`
            

            var modCont_nombre=document.createElement("div")
            modCont_nombre.setAttribute("class","col-3 border primary rounded-1 m-1")
            
            modCont_nombre.innerHTML=alumno.nombre+" "+alumno.apellido

            
            modCont_nombre.appendChild(btn_info_alumn)
            modbody.appendChild(modCont_nombre)
          
          });

    };


  
</script>


<?php require_once RUTA_APP.'/vistas/inc/footer.php'; ?>