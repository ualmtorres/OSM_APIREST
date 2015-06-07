<?php
  include('connection.php');
  include('header.php');
?>
    <div class="container">
      <?php
        include("navbar.php"); 
      ?>
      <script language="JavaScript" type="text/javascript">
        $('#homebtn').addClass("active");
      </script>

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

<script language="JavaScript" type="text/javascript">

var controls = [];

//var map = L.map('map').setView([36.8386395, -2.4648017], 17);
var map = L.map('map').setView([0, 0], 16);

$('#map').hide();

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

    for (z = 0; z < controls.length; z++) {
      map.removeLayer(controls[z]);
    }

    controls = [];

    map.panTo([lat, lon]);

    $('#map').show();

    L.tileLayer('https://{s}.tiles.mapbox.com/v3/{id}/{z}/{x}/{y}.png', {
      maxZoom: 18,
      attribution: 'Map data &copy; <a href="http://openstreetmap.org">OpenStreetMap</a> contributors, ' +
        '<a href="http://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, ' +
        'Imagery © <a href="http://mapbox.com">Mapbox</a>',
      id: 'examples.map-i875mjb7'
    }).addTo(map);


    var control = L.marker([lat, lon]);

    control.addTo(map)
      .bindPopup(bar + '<br/>(' + lat + ', ' + lon + ')').openPopup();

    controls.push(control);
  }
</script>

