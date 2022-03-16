<?php require_once RUTA_APP.'/vistas/inc/header.php';
 ?>


<h1>Alumnos Grupo</h1>
  
    <div class="row">
      <?php
      //print_r ($datos["tests"]);
          foreach ($datos["tests"] as $uruario) { ?>
          
              <div class="col-3 col-lg-2 border primary rounded-1 m-1"><?php echo $uruario->nombre." ".$uruario->apellido ?>

                <button type="button" class="btn  btn-block editUruario"  data-bs-toggle="modal" data-bs-target="#exampleModal" onclick="usuarios_tests(<?php echo $uruario->id_user?>,<?php echo $datos['grupo'] ?> )" >
                  <i class="bi bi-eye-fill"></i>
                </button> 
              </div>


      <?php } ?>
    </div>
 





<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="ModalTitler" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="ModalTitler">404 Harran Not Found</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body row" id="contenidoModalGrupo">



      </div>
      <div class="modal-footer" id="modal_footer">
        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>


<script>
    async function usuarios_tests(id_user,id_gru){
        var titler=document.getElementById("ModalTitler")
        var content=document.getElementById("contenidoModalGrupo")
        var footer=document.getElementById("modal_footer")
        titler.innerHTML="Pruebas "
        console.log(id_user)

        content.innerHTML="";


        
        var enlace="<?php echo RUTA_URL?>/pruebas/obtener_socios_test/"+id_user;
        var nomP="users";
        
        
        

            await fetch(enlace)
            .then(response => response.json())
            .then(data => nomP = data)
            .catch( err => console.error(err));

            //console.log(nomP)
      
      titler.innerHTML+=nomP[0].nombre+" "+nomP[0].apellido

      if (nomP[1].length != 0) {
        nomP[1].forEach(objekt => {
          var unidades
          console.log(nomP);
          if (objekt.unidades == "tiempo") {
            unidades=" s"
          } else {
            unidades=" m"
          }
          
          content.innerHTML+="<div class='col-6'><label for='nombre_Borrar'>Prueba:</label><input type='text' name='nombre_Borrar' id='nombre_Borrar' class='form-control form-control-lg' value='"+objekt.nombr_prueba+"' readonly></div>"
          content.innerHTML+="<div class='col-6'><label for='nombre_Borrar'>Marca:</label><input type='text' name='nombre_Borrar' id='nombre_Borrar' class='form-control form-control-lg' value='"+objekt.marca+unidades+"' readonly></div>"
        });
      } else {
        content.innerHTML="No se han encontrado pruebas recientes"
      }
      footer.innerHTML="<a href=\"<?php echo RUTA_URL?>/pruebas/prueba_nueva/"+id_user+"/"+id_gru+"\" class=\"btn btn-primary\"  >Test Nuevo</a>      <button type=\"button\" class=\"btn btn-danger\" data-bs-dismiss=\"modal\">Cerrar</button> <a href=\"/pruebas/mostrar_prueba/"+id_user+"\" class=\"btn btn-success\"   >Mostrar Todos Los Tests  </a> "




    }
</script>

<?php require_once RUTA_APP.'/vistas/inc/footer.php' ;?>