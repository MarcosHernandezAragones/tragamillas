<?php require_once RUTA_APP.'/vistas/inc/header.php' ?>


<div class="row justify-content-evenly">
    <div class="col-4">
        <button class="btn btn-primary" onclick="generateCSVjs()">Generar Cuotas Socios</button>
    </div>
    <div class="col-4">
        <button class="btn btn-primary" onclick="download()">Descargar CSV</button>
        
    </div>
</div>


      


<script>
    async function generateCSVjs() {
        var enlace="<?php echo RUTA_URL?>/facturas/genereateCSV";
        
        var nomP="epic failure"
        await fetch(enlace)
            .then(response => response.text())
            .then(data => nomP = data)
            .catch( err => console.error(err));

        console.log(nomP);
    }
   // generateCSVjs()
   function download() {
       fileUrl="export_cuota_socio.csv"
       fileName="Cuota_Socios.csv"
        var a = document.createElement("a");
        a.href = fileUrl;
        a.setAttribute("download", fileName);
        a.click();
    }




</script>
<?php require_once RUTA_APP.'/vistas/inc/footer.php' ?>