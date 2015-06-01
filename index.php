
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../favicon.ico">

    <title>Narrow Jumbotron Template for Bootstrap</title>

    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="jumbotron-narrow.css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->


    <script src="https://maps.googleapis.com/maps/api/js?v=3.exp&signed_in=true"></script>
    <script>
function initialize(lat, lon) {
  var myLatlng = new google.maps.LatLng(lat, lon);
  var mapOptions = {
    zoom: 4,
    center: myLatlng
  }
  var map = new google.maps.Map(document.getElementById('map-canvas'), mapOptions);

  var marker = new google.maps.Marker({
      position: myLatlng,
      map: map,
      title: 'Hello World!'
  });
}

/*google.maps.event.addDomListener(window, 'load', initialize);*/

    </script>
  </head>

  <body>

    <div class="container">
      <div class="header clearfix">
        <nav>
          <ul class="nav nav-pills pull-right">
            <li role="presentation" class="active"><a href="index.php">Home</a></li>
            <li role="presentation"><a href="buscar.php">Buscar</a></li>
            <li role="presentation"><a href="api/index.php">API</a></li>
          </ul>
        </nav>
        <h3 class="text-muted">Amenity Helper</h3>
      </div>

      <div class="jumbotron">
        <h1>Disfruta de Almeria</h1>
        <p class="lead">Usa tus coordenadas GPS y te daremos los mejores lugares en 100 metros a la redonda.</p>
        <p><a class="btn btn-lg btn-success" href="#" role="button">Find</a></p>
      </div>

      <div class="row marketing">
        <div class="col-lg-6">
			<?php
			$url = 'http://localhost/OSM_REST/api/api/amenity/bar';
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

			/*
			echo '<script type="text/javascript">
			 initialize('. $locations[0]["lat"] . ',' . $locations[0]["lon"] . ');
			</script>';
			*/

			?>
        </div>
      </div>

      <footer class="footer">
        <p>&copy; Espeshal Company 2015</p>
      </footer>

    </div> <!-- /container -->
  </body>
</html>
 



