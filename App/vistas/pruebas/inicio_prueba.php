<?php require_once RUTA_APP.'/vistas/inc/header.php';
 ?>


<h1>Tests</h1>
  <div class="container">
    <div class="row">
      <?php
      print_r ($datos["tests"]);
          foreach ($datos["tests"] as $test) { ?>
          
              <div class="col-3 border primary rounded-1 m-1"><?php echo $test->Nombre?>
              &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                <button type="button" class="btn  btn-block editUruario"  data-bs-toggle="modal" data-bs-target="#exampleModal" onclick="usuarios_tests(<?php echo $test->id_test; ?>)" >
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
        <h5 class="modal-title" id="ModalTitler">404 Harran Not Found</h5>
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
    async function usuarios_tests(id_test){
        var titler=document.getElementById("ModalTitler")
        var content=document.getElementById("contenidoModalGrupo")
        titler.innerHTML=id_test
        console.log(id_test)

        var enlace="<?php echo RUTA_URL?>/pruebas/obtener_socios_test/"+id_test;
        var nomP="users";
        
        
        

            await fetch(enlace)
            .then(response => response.json())
            .then(data => nomP = data)
            .catch( err => console.error(err));

            console.log(nomP)

      nomP.forEach(objekt => {
        titler.innerHTML=objekt.nom_test
        content.innerHTML=objekt.nombre+" "+objekt.apellido+"->"+objekt.nombr_prueba+"--"+objekt.marca+"boton"
      });



    }
</script>

<?php require_once RUTA_APP.'/vistas/inc/footer.php' ;?>