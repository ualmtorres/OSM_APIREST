<?php
  include('header.php');
?>
    <div class="container">
      <div class="header clearfix">
      <?php
        include("navbar.php"); 
      ?>
      <script language="JavaScript" type="text/javascript">
        $('#apibtn').addClass("active");
      </script>

      <div class="jumbotron">
        <h1>Use of the API</h1>
      </div>

      <div class="row marketing">
        <div class="col-lg-6">
          <div class = "table-responsive">
          <table>
            <tr><th>Method</th><th>URL</th><th>Description</th><th>Use</th></tr>
            <tr><td>GET</td><td>/api/amenity/{amenity}</td><td>Devuelve los nodos del tipo de <i>amenity</i> proporcionada</td><td>curl -i -X GET http://<i>host</i>/OSM_REST/api/api/amenity/bar</td></tr>
            <tr><td>GET</td><td>/api/bar/{bar}</td><td>Devuelve el nodo correspondiente al bar proporcionado</td><td>curl -i -X GET http://<i>host</i>/OSM_REST/api/api/bar/Cuore</td></tr>
            <tr><td>GET</td><td>/api/amenity/{amenity}/lat/{lat}/lon/{lon}/radius/{radius}</td><td>Devuelve los nodos del tipo de <i>amenity</i> proporcionado que están a menos de la distancia indicada y de la latitud y longitud proporcionadas</td><td>curl -i -X GET http://<i>host</i>/OSM_REST/api/api/amenity/bar/lat/36.8388993/lon/-2.464748/radius/100</td></tr>
            <tr><td>GET</td><td>/api/llamadaXQ</td><td>Hace una llamada a una consulta XQuery</td><td>curl -i -X GET http://<i>host</i>/OSM_REST/api/api/llamadaXQ</td></tr>
          </table>
        </div>
        </div>
      </div>

<?php
  include("tail.php");
?>
 



