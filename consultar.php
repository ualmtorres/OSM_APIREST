<?php
  include('connection.php');
  include('header.php');
?>
<script language="JavaScript" type="text/javascript">
  function procesar(){
      var query = $('#query').val();
      var database = $('#database').val();

      var url = 'http://' + <?php echo "'" . $host . "'"; ?> +  '/rest/' + database + '?query=' + encodeURIComponent(query);

      //alert (url);

      $.ajax({
        url: 'ejecutarXQuery.php',
        type: 'GET',
        data: {url:url},
        dataType: 'text',
        beforeSend: cargando,
        error: respuestaerror,
        success: actualizar
      })
      function actualizar(datos){
        $('#resultado').val(datos);
      }
      function cargando(){
        $('#resultado').val('Recuperando datos');
      }
      function respuestaerror(){
        $('#resultado').val("Error al recuperar datos");
      }
      
    }
</script>

    <div class="container">
      <div class="header clearfix">
        <nav>
          <ul class="nav nav-pills pull-right">
            <li role="presentation"><a href="index.php">Home</a></li>
            <li role="presentation"><a href="buscar.php">Dónde puedo ir?</a></li>
            <li role="presentation" class="active"><a href="consultar.php">Consultar</a></li>
            <li role="presentation"><a href="representar.php">Pintar regiones</a></li>            
            <li role="presentation"><a href="api/index.php">API</a></li>
          </ul>
        </nav>
        <h3 class="text-muted">Amenity Helper</h3>
      </div>

      <div class="jumbotron">
        <h1>Shell XQuery</h1>
        <div class = "form-group">
          <div class="input-group">
            <span class="input-group-addon">Base de datos</span>
            <input type = 'text' name = 'database' id = 'database' placeholder= 'p.e. osm' class="form-control" >
          </div>
        </div>
          <textarea id = 'query' name = 'query' rows = '10' cols = '80' placeholder = 'Consulta XQuery p.e. //tags'></textarea>
  
        <button  id = "btnAjax" onclick = "procesar();" class="btn btn-lg btn-success"/>Ejecutar</button>
          <div class="input-group">
        <textarea disabled id = 'resultado' name = 'query' rows = '10' cols = '80' placeholder = 'Resultado'></textarea>
      </div>
      </div>

      <div class="row marketing">
        <div class="col-lg-12">         
        </div>
      </div>

<?php
  include("tail.php");
?>
 



