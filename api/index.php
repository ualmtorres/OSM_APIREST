<?php
// Instantiate the class responsible for implementing a micro application
$app = new \Phalcon\Mvc\Micro();

// Routes
$app->get('/', 'home');
$app->get('/api', 'home');	
$app->get('/api/amenity/{amenity}', 'findAmenities'); // curl -i -X GET http://localhost/MongoDBBlog/api/api/id/50ab0f8bbcf1bfe2536dc3f8
$app->get('/api/bar/{bar}', 'findBar'); // curl -i -X GET http://localhost/MongoDBBlog/api/api/tag/trade
$app->get('/api/amenity/{amenity}/lat/{lat}/lon/{lon}/radius/{radius}', 'findAmenities100MetersNear'); // curl -i -X POST -d '{"body":"Lore ipsum", "permalink": "TqoHkbHyUgLyCKWgPLqm", "author": "machine", "title": "Lore ipsum", "tags": ["Lore", "ipsum"], "comments":[{"body": "Lore ipsum", "email": "john@doe.com", "author": "John Doe"}]}' http://localhost/MongoDBBlog/api/api
//$app->get('/api/amenity/{amenity}/lat/{lat}/lon/{lon}/radius{radius}', 'findAmenities100MetersNear'); // curl -i -X POST -d '{"body":"Lore ipsum", "permalink": "TqoHkbHyUgLyCKWgPLqm", "author": "machine", "title": "Lore ipsum", "tags": ["Lore", "ipsum"], "comments":[{"body": "Lore ipsum", "email": "john@doe.com", "author": "John Doe"}]}' http://localhost/MongoDBBlog/api/api
//http://localhost/OSM_REST/api/api/amenity/bar/lat/36.8388993/lon/-2.464748/r/100
$app->get('/api/llamadaXQ', 'llamadaXQ'); // 
$app->get('/api/dameREST', 'dameREST'); // 
$app->notFound('notFound');

// Handlers

// Show the use of the API
function home() {
	header('Location:../useOfTheAPI.php');
}

//Searches for amenities (i.e. bar, restaurant)
function findAmenities ($amenity) {

include("../connection.php");

$fullurl = $urlPrefix . 'query=%3CBars%3E%20{%20for%20$node%20in%20collection(%22osm%22)/osm/node%20where%20$node/tag[@k=%22amenity%22]%20and%20$node/tag[@v=%22' . $amenity . '%22]%20return%20%3Cbar%3E%20{$node}%20%3C/bar%3E%20}%20%3C/Bars%3E';

renderXML($fullurl);

}

//Searches for a bar (i.e. Cuore, Campanilla)
function findBar ($bar) {

include("../connection.php");

$fullurl = $urlPrefix . 'query=%3CBars%3E%20{%20for%20$node%20in%20collection(%22osm%22)/osm/node%20where%20$node/tag[@k=%22amenity%22]%20and%20$node/tag[@v=%22bar%22]%20and%20$node/tag[@k=%22name%22]%20and%20$node/tag[@v=%22' . $bar . '%22]%20return%20%3Cbar%3E%20{$node[@lat]}%20%3C/bar%3E%20}%20%3C/Bars%3E';

renderXML($fullurl);

}

//Searches for amenities that are 100 meters near from the (lat, lon) specified
//function findAmenities100MetersNear($amenity, $lat, $lon, $radius) {
//function findAmenities100MetersNear($amenity, $lat, $lon, $radius) {
function findAmenities100MetersNear($amenity, $lat, $lon, $radius) {

include("../connection.php");

//$fullurl = $urlPrefix . 'query=%3CBars%3E%20{%20for%20$node%20in%20collection(%22osm%22)/osm/node%20where%20$node/tag/@k=%22amenity%22%20and%20$node/tag/@v=%22' . $amenity . '%22%20and%20$node/@lat%20%3E%20' . $lat . '%20-%200.00000898%20*%20100%20and%20$node/@lat%20%3C%20' . $lat . '%20-%20-0.00000898%20*%20100%20and%20$node/@lon%20%3E%20' . $lon . '%20-%200.00000898%20*%20100%20and%20$node/@lon%20%3C%20' . $lon . '%20-%20-0.00000898%20*%20100%20return%20%3Cbar%3E%20{$node}%20%3C/bar%3E%20}%20%3C/Bars%3E';
$fullurl = $urlPrefix . 'query=%3CBars%3E%20{%20for%20$node%20in%20collection(%22osm%22)/osm/node%20where%20$node/tag/@k=%22amenity%22%20and%20$node/tag/@v=%22' . $amenity . '%22%20and%20$node/@lat%20%3E%20' . $lat . '%20-%200.00000898%20*%20' . $radius . '%20and%20$node/@lat%20%3C%20' . $lat . '%20-%20-0.00000898%20*%20' . $radius . '%20and%20$node/@lon%20%3E%20' . $lon . '%20-%200.00000898%20*%20' . $radius . '%20and%20$node/@lon%20%3C%20' . $lon . '%20-%20-0.00000898%20*%20' . $radius . '%20return%20%3Cbar%3E%20{$node}%20%3C/bar%3E%20}%20%3C/Bars%3E';
//echo "Hoooola";
renderXML($fullurl);
}

//Uses a XQ function
function llamadaXQ() {
	$fullurl = 'http://localhost:8080/exist/rest/db/apps/osm/saludar.xq';

	$ch = curl_init();

// Establecer URL y otras opciones apropiadas
curl_setopt($ch, CURLOPT_URL, $fullurl);
curl_setopt($ch, CURLOPT_HEADER, 0);

// Capturar la URL y pasarla al navegador
curl_exec($ch);

// Cerrar el recurso cURL y liberar recursos del sistema
curl_close($ch);
}

//Adds a new post
function dameREST() {


}

function notFound() {
	home();
}

function renderXML($url) {
include("../connection.php");

 // Create a stream
 $opts = array(
 'http'=>array(
 'method' => "GET",
 'header' => "Authorization: Basic " .
base64_encode("$userBaseX:$passwordBaseX")
 )
 );
 $context = stream_context_create($opts); 

	$xml = file_get_contents($url, FALSE, $context);
	$sxe = new SimpleXMLElement($xml);
	Header('Content-type: text/xml');
	print($sxe->asXML());
}
// Handle the request
$app->handle();
?>

