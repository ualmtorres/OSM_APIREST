<?php
  include('connection.php');
  include('header.php');
?>
<script language="JavaScript" type="text/javascript">
  function procesar(){
      var url = <?php echo "'" . $urlAPIREST . "'"; ?> +  'OSM_REST/api/api/bar/' + $('#bar').val();
      $.ajax({
        url: url,
        type: 'GET',
        success: actualizar
      })
      function actualizar(datos){

        $(datos).find("node").each(function(){
          var lat = $(this).attr('lat');
          var lon = $(this).attr('lon');
          var bar = $(this).find("tag[k='name']").attr('v');
          drawMap(bar, lat, lon);

      })
    }
  }

  function drawMap(bar, lat, lon) {
        var map = L.map('map').setView([lat, lon], 17);

    L.tileLayer('https://{s}.tiles.mapbox.com/v3/{id}/{z}/{x}/{y}.png', {
      maxZoom: 18,
      attribution: 'Map data &copy; <a href="http://openstreetmap.org">OpenStreetMap</a> contributors, ' +
        '<a href="http://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, ' +
        'Imagery © <a href="http://mapbox.com">Mapbox</a>',
      id: 'examples.map-i875mjb7'
    }).addTo(map);


    L.marker([lat, lon]).addTo(map)
      .bindPopup(bar + '<br/>(' + lat + ', ' + lon + ')').openPopup();
  }
</script>

    <div class="container">
      <div class="header clearfix">
        <nav>
          <ul class="nav nav-pills pull-right">
            <li role="presentation" class="active"><a href="index.php">Home</a></li>
            <li role="presentation"><a href="buscar.php">Dónde puedo ir?</a></li>
            <li role="presentation"><a href="api/index.php">API</a></li>
          </ul>
        </nav>
        <h3 class="text-muted">Amenity Helper</h3>
      </div>

      <div class="jumbotron">
        <h1>Búsqueda de Bares</h1>
        <div class = "form-group">
          <div class="input-group">
              <span class="input-group-addon">Bar</span>
              <input type = 'text' name = 'bar' id = 'bar' placeholder= 'p.e. Campanilla, Cuore' class="form-control" >            
          </div>
        </div>
        
        <button  id = "btnAjax" onclick = "procesar();" class="btn btn-lg btn-success"/>Buscar</button>
      </div>

      <div class="row marketing">
        <div class="col-lg-12">
          <div id = 'datos'></div>
          <div id="map" style="width: 600px; height: 400px"></div>
        </div>
      </div>

<?php
  include("tail.php");
?>
 



