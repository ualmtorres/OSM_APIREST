<?php
  include('header.php');
?>

    <div class="container">
      <div class="header clearfix">
        <nav>
          <ul class="nav nav-pills pull-right">
            <li role="presentation"><a href="index.php">Home</a></li>
            <li role="presentation" class="active"><a href="buscar.php">Dónde puedo ir?</a></li>
            <li role="presentation"><a href="api/index.php">API</a></li>
          </ul>
        </nav>
        <h3 class="text-muted">Amenity Helper</h3>
      </div>

      <div class="jumbotron">
        <h1>Búsqueda de ocio por amenity</h1>
        <form method = 'post' action = ''>
            <label for = 'amenity'>Amenity: </label>
            <input type = 'text' name = 'amenity' id = 'amenity' placeholder= 'p.e. bar'><br/>

            <label for = 'lat'>Latitud: </label>
            <input type = 'text' name = 'lat' id = 'lat' value ='36.8388993'><br/>

            <label for = 'lon'>Longitud: </label>
            <input type = 'text' name = 'lon' id = 'lon' value = '-2.464748'><br/>

            <input type = 'submit'>
        </form>
      </div>

      <div class="row marketing">
        <div class="col-lg-6">
          <?php
            if (isset($_POST['amenity'])) {
              $amenity = $_POST['amenity'];
              $url = 'http://localhost/OSM_REST/api/api/amenity/' . $amenity;
              $obj = json_decode(file_get_contents($url));
    
              $i = 0;
              foreach ($obj->{'Bars'}->{'bar'} as $bar) {
              $location['lat'] = $obj->{'Bars'}->{'bar'}[$i]->{'node'}->{'@attributes'}->{'lat'};
              $location['lon'] = $obj->{'Bars'}->{'bar'}[$i]->{'node'}->{'@attributes'}->{'lon'};
              $location['barName'] = $obj->{'Bars'}->{'bar'}[$i]->{'node'}->{'tag'}[1]->{'@attributes'}->{'v'};

              $locations[] = $location;

              $i++;

              }

                foreach ($locations as $location) {
                echo "<h4>" . $location['barName'] .'</h4>';
                echo "<p>GPS: (" . $location['lat'] . ", " . $location['lon'] .')</p>';  
              }

            }
          ?>
        </div>
      </div>

<?php
  include("tail.php");
?>
 



