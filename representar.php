<?php
  include('connection.php');
  include('header.php');
?>
    <div class="container">
      <?php
        include("navbar.php"); 
      ?>
      <script language="JavaScript" type="text/javascript">
        $('#renderbtn').addClass("active");
      </script>

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
 
<script language="JavaScript" type="text/javascript">

var controls = [];

//var map = L.map('map').setView([36.8395487, -2.45245], 17);
var map = L.map('map').setView([0, 0], 16);
$('#map').hide();

  function procesar(){
      var url = encodeURI('http://' + <?php echo "'" . $host . "'"; ?> + '/rest?run=' + $('#filename').val());

      $.ajax({
        url: 'ejecutarXQuery.php',
        type: 'GET',
        data: {url:url},
        success: actualizar
      })

      function actualizar(datos){

    for (z = 0; z < controls.length; z++) {
      map.removeLayer(controls[z]);
    }

    controls = [];

    $('#map').show();

        L.tileLayer('https://{s}.tiles.mapbox.com/v3/{id}/{z}/{x}/{y}.png', {
          maxZoom: 18,
          attribution: 'Map data &copy; <a href="http://openstreetmap.org">OpenStreetMap</a> contributors, ' +
            '<a href="http://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, ' +
            'Imagery © <a href="http://mapbox.com">Mapbox</a>',
          id: 'examples.map-i875mjb7'
        }).addTo(map);

        var pointList = [];

        // Obtener la primera latitud y longitud que aparece para tomarla como centro del mapa
        var firstNode = $(datos).find("node").first();
        var firstLat = firstNode.attr("lat");
        var firstLon = firstNode.attr("lon");

        map.panTo([firstLat, firstLon]);

        $(datos).find("way").each(function(){
          pointList = [];

          var tags = [];
          var color = "";

          $(this).find("tag").each(function(){
            tags.push($(this).attr('k'));
          })
          
          if ($.inArray("amenity", tags) >= 0) {
            color = "red";
            console.log("rojo");
          }
          if ($.inArray("highway", tags) >= 0) {
            color = "blue";
            console.log("azul");
          }

          console.log("Vuelta");
          for (z=0; z<tags.length; z++) console.log(tags[z]);


          $(this).find("nd").each(function(){

            var ref = $(this).attr('ref');
            var elementToFind = 'node[id=' + ref + ']';

            var lat = $(datos).find(elementToFind).attr('lat');
            var lon = $(datos).find(elementToFind).attr('lon');

            var point = new L.LatLng(lat, lon);
            pointList.push(point);
          })

          var firstpolyline = new L.polygon(pointList, {
            color: color,
            opacity: 0.5
          });

          firstpolyline.addTo(map);

          controls.push(firstpolyline);
        })
      }
   }
</script>

