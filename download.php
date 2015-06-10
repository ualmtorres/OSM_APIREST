<?php
  include('connection.php');
  include('header.php');
?>

    <div class="container">
      <?php
        include("navbar.php"); 
      ?>
      <script language="JavaScript" type="text/javascript">
        $('#downloadbtn').addClass("active");
      </script>

      <div class="jumbotron">
        <h1>Descargar mapa</h1>

        <button type = "button" value = "Descargar" id = "btnAjax" onclick = "descargar();" class="btn btn-lg btn-success"/>Descargar</button>
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
 
<script language="JavaScript" type="text/javascript">

var controls = [];

var map = L.map('map').setView([36.8395487, -2.45245], 16);

    L.tileLayer('https://{s}.tiles.mapbox.com/v3/{id}/{z}/{x}/{y}.png', {
      maxZoom: 18,
      attribution: 'Map data &copy; <a href="http://openstreetmap.org">OpenStreetMap</a> contributors, ' +
        '<a href="http://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, ' +
        'Imagery © <a href="http://mapbox.com">Mapbox</a>',
      id: 'examples.map-i875mjb7'
    }).addTo(map);

  function descargar(){
    var southWest = map.getBounds().getSouthWest();
    var northEast = map.getBounds().getNorthEast();

    var url = 'http://api.openstreetmap.org/api/0.6/map?bbox=' + southWest.lng + ',' + southWest.lat + ',' + northEast.lng + ',' + northEast.lat;

    if (map.getZoom() >= 13) {
      window.open(url,'Download');
    }
    else {
      alert ('Archivo demasiado grande. Acércate un poco más');
    }
  }
</script>


