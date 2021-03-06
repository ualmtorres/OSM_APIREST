<?php
  include('connection.php');
  include('header.php');
?>

    <div class="container">
      <?php
        include("navbar.php"); 
      ?>
      <script language="JavaScript" type="text/javascript">
        $('#whereToGobtn').addClass("active");
      </script>

      <div class="jumbotron">
        <h1>Ocio cercano</h1>
        <div class = "form-group">
          <div class="input-group">
            <span class="input-group-addon">Amenity</span>
            <input type = 'text' name = 'amenity' id = 'amenity' placeholder= 'p.e. bar' class="form-control" >
          </div>

          <div class="input-group">
            <span class="input-group-addon">Latitud</span>
            <input type = 'text' name = 'lat' id = 'lat' value ='36.8388993' class="form-control" >
          </div>

          <div class="input-group">
            <span class="input-group-addon">Longitud</span>
            <input type = 'text' name = 'lon' id = 'lon' value = '-2.464748' class="form-control" >
          </div>

          <div class="input-group">
            <span class="input-group-addon">Radio (m)</span>
            <input type = 'text' name = 'radius' id = 'radius' value = '100' class="form-control" >
          </div>
        </div>

        <button type = "button" value = "Buscar" id = "btnAjax" onclick = "procesar();" class="btn btn-lg btn-success"/>Buscar</button>
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

var map = L.map('map').setView([$('#lat').val(), $('#lon').val()], 16);
$('#map').hide();

  function procesar(){
      var url = <?php echo "'" . $urlAPIREST . "'"; ?> + 'OSM_REST/api/api/amenity/' + $('#amenity').val() + 
                '/lat/' + $('#lat').val() + '/lon/' + $('#lon').val() + '/radius/' + $('#radius').val();

      $.ajax({
        url: url,
        type: 'GET',
        success: actualizar
      })
      function actualizar(datos){
        var amenities = [];
        var i = 0;

        $(datos).find("node").each(function(){
          var amenity = [];

          amenity['lat'] = $(this).attr('lat');
          amenity['lon'] = $(this).attr('lon');
          amenity['bar'] = $(this).find("tag[k='name']").attr('v');

          amenities[i] = amenity;

          i++;
        })

        drawMap(amenities);

      }
  }

  function drawMap(amenities) {

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

    for (i = 0; i < amenities.length; i++) {
      var control = L.marker([amenities[i]['lat'], amenities[i]['lon']]);
      control.addTo(map)
      .bindPopup(amenities[i]['bar'] + '<br/>(' + amenities[i]['lat'] + ', ' + amenities[i]['lon'] + ')').openPopup();      
      controls.push(control);
    }

    var control = L.circle([$('#lat').val(), $('#lon').val()], $('#radius').val(), {
      color: 'red',
      fillColor: '#f03',
      fillOpacity: 0.5
    });
    control.addTo(map);
    controls.push(control);
  }
</script>


