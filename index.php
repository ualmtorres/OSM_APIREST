<?php
  include('header.php');
?>

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
        <h1>Búsqueda de Bares por nombre</h1>
        <p class="lead">
        <form method = 'post' action = ''>
            <label for = 'bar'>Bar: </label>
            <input type = 'text' name = 'bar' id = 'bar' placeholder= 'p.e. Campanilla, Cuore'>
            <input type = 'submit'>
        </form>
        </p>
      </div>

      <div class="row marketing">
        <div class="col-lg-12">
        	<?php 
            if (isset($_POST['bar'])) {
              $bar = $_POST['bar'];
              $url = 'http://localhost/OSM_REST/api/api/bar/' . $bar;

              $obj = json_decode(file_get_contents($url));

              $location['lat'] = $obj->{'Bars'}->{'bar'}->{'node'}->{'@attributes'}->{'lat'};
              $location['lon'] = $obj->{'Bars'}->{'bar'}->{'node'}->{'@attributes'}->{'lon'};
              $location['barName'] = $obj->{'Bars'}->{'bar'}->{'node'}->{'tag'}[1]->{'@attributes'}->{'v'};

              echo "<h2>" . $location['barName'] .'</h2>'; 
              echo "<h3>GPS: (" . $location['lat'] . ", " . $location['lon'] .')</h3>';
            }
    		?>

        </div>
      </div>

<?php
  include("tail.php");
?>
 



