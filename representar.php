<?php
  include('connection.php');
  include('header.php');
?>
<script language="JavaScript" type="text/javascript">
  function procesar(){
      /*var url = <?php echo "'" . $urlAPIREST . "'"; ?> + 'OSM_REST/api/api/amenity/' + $('#amenity').val() + 
                '/lat/' + $('#lat').val() + /lon/ + $('#lon').val();*/
      //var url = encodeURI('http://' + <?php echo "'" . $host . "'"; ?> + '/rest?run=' + $('#filename').val());
      //alert (url);

      var url = 'http://localhost:8012/OSM_REST/osmprueba.xml';
        var map = L.map('map').setView([36.8395487, -2.45245], 17);

    L.tileLayer('https://{s}.tiles.mapbox.com/v3/{id}/{z}/{x}/{y}.png', {
      maxZoom: 18,
      attribution: 'Map data &copy; <a href="http://openstreetmap.org">OpenStreetMap</a> contributors, ' +
        '<a href="http://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, ' +
        'Imagery © <a href="http://mapbox.com">Mapbox</a>',
      id: 'examples.map-i875mjb7'
    }).addTo(map);


      $.ajax({
        url: url,
        type: 'GET',
        success: actualizar
      })
      function actualizar(datos){

        var pointList = [];

        $(datos).find("way").each(function(){
          pointList = [];

          $(this).find("nd").each(function(){

            var ref = $(this).attr('ref');
            var elementToFind = 'node[id=' + ref + ']';

            var lat = $(datos).find(elementToFind).attr('lat');
            var lon = $(datos).find(elementToFind).attr('lon');

            var point = new L.LatLng(lat, lon);
            pointList.push(point);
          })

          var firstpolyline = new L.Polyline(pointList, {
            color: 'red',
            weight: 3,
            opacity: 0.5,
            smoothFactor: 1

          });

          firstpolyline.addTo(map);
      })
     }
  }
</script>

    <div class="container">
      <div class="header clearfix">
        <nav>
          <ul class="nav nav-pills pull-right">
            <li role="presentation"><a href="index.php">Home</a></li>
            <li role="presentation" class="active"><a href="buscar.php">Dónde puedo ir?</a></li>
            <li role="presentation"><a href="consultar.php">Consultar</a></li>
            <li role="presentation"><a href="api/index.php">API</a></li>
          </ul>
        </nav>
        <h3 class="text-muted">Amenity Helper</h3>
      </div>

      <div class="jumbotron">
        <h1>Buscar regiones</h1>
        <div class = "form-group">
          <div class="input-group">
            <span class="input-group-addon">Archivo</span>
            <input type = 'text' name = 'filename' id = 'filename' placeholder= 'p.e. osmprueba.xq' class="form-control" >
          </div>
        </div>

        <button type = "button" value = "Mostrar" id = "btnAjax" onclick = "procesar();" class="btn btn-lg btn-success"/>Mostrar</button>
      </div>

      <div class="row marketing">
        <div class="col-lg-6">
          <div id = 'datos'></div>
          <div id="map" style="width: 600px; height: 400px"></div>

        </div>
      </div>

<?php
  include("tail.php");
?>
 



