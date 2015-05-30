<?php
// Instantiate the class responsible for implementing a micro application
$app = new \Phalcon\Mvc\Micro();

// Routes
$app->get('/', 'home');
$app->get('/api', 'home');	
$app->get('/api/amenity/{amenity}', 'findAmenities'); // curl -i -X GET http://localhost/MongoDBBlog/api/api/id/50ab0f8bbcf1bfe2536dc3f8
$app->get('/api/bar/{bar}', 'findBar'); // curl -i -X GET http://localhost/MongoDBBlog/api/api/tag/trade
$app->get('cc', 'findAmenities100MetersNear'); // curl -i -X POST -d '{"body":"Lore ipsum", "permalink": "TqoHkbHyUgLyCKWgPLqm", "author": "machine", "title": "Lore ipsum", "tags": ["Lore", "ipsum"], "comments":[{"body": "Lore ipsum", "email": "john@doe.com", "author": "John Doe"}]}' http://localhost/MongoDBBlog/api/api
$app->notFound('notFound');

// Handlers

// Show the use of the API
function home() {

	// Describe the use of this API

	echo "<h1>Use of the API</h1>";

	echo '<table class="table table-striped">';
	echo '<tr><td>Method</td><td>URL</td><td>Description</td><td>Use</td></tr>';
	echo '<tr><td>GET</td><td>/api/amenity/{amenity}</td><td>Devuelve los nodos del tipo de <i>amenity</i> proporcionada</td><td>curl -i -X GET http://localhost/OSM_REST/api/api/amenity/bar</td></tr>';
	echo '<tr><td>GET</td><td>/api/bar/{bar}</td><td>Devuelve el nodo correspondiente al bar proporcionado</td><td>curl -i -X GET http://localhost/OSM_REST/api/api/bar/Cuore</td></tr>';
	echo '<tr><td>GET</td><td>/api/amenity/{amenity}/lat/{lat}/lon/{lon}</td><td>Devuelve los nodos del tipo de <i>amenity</i> proporcionado que están a menos de 100 metros de la latitud y longitud proporcionadas</td><td>curl -i -X GET http://localhost/OSM_REST/api/api/amenity/bar/lat/36.8388993/lon/-2.464748</td></tr>';
	echo '</table>';

}

//Searches for amenities (i.e. bar, restaurant)
function findAmenities ($amenity) {


include ('../XMLToJSON.php');

$fullurl = 'http://localhost:8080/exist/rest/db/osm?_query=%3CBars%3E%20{%20for%20$node%20in%20collection(%22/db/osm%22)/osm/node%20where%20$node/tag[@k=%22amenity%22]%20and%20$node/tag[@v=%22' . $amenity . '%22]%20return%20%3Cbar%3E%20{$node}%20%3C/bar%3E%20}%20%3C/Bars%3E';

print XMLToJSON::Parse($fullurl);

}

//Searches for a bar (i.e. Cuore, Campanilla)
function findBar ($bar) {

include ('../XMLToJSON.php');

$fullurl = 'http://localhost:8080/exist/rest/db/test?_query=%3CBars%3E%20{%20for%20$node%20in%20collection(%22/db/osm%22)/osm/node%20where%20$node/tag[@k=%22amenity%22]%20and%20$node/tag[@v=%22bar%22]%20and%20$node/tag[@k=%22name%22]%20and%20$node/tag[@v=%22' . $bar . '%22]%20return%20%3Cbar%3E%20{$node[@lat]}%20%3C/bar%3E%20}%20%3C/Bars%3E';

print XMLToJSON::Parse($fullurl);

}

//Adds a new post
function findAmenities100MetersNear($amenity, $lat, $lon) {

include ('../XMLToJSON.php');

$fullurl = 'http://localhost:8080/exist/rest/db/test?_query=%3CBars%3E%20{%20for%20$node%20in%20collection(%22/db/osm%22)/osm/node%20where%20$node/tag/@k=%22amenity%22%20and%20$node/tag/@v=%22' . $amenity . '%22%20and%20$node/@lat%20%3E%20' . $lat . '%20-%200.00000898%20*%20100%20and%20$node/@lat%20%3C%20' . $lat . '%20-%20-0.00000898%20*%20100%20and%20$node/@lon%20%3E%20' . $lon . '%20-%200.00000898%20*%20100%20and%20$node/@lon%20%3C%20' . $lon . '%20-%20-0.00000898%20*%20100%20return%20%3Cbar%3E%20{$node}%20%3C/bar%3E%20}%20%3C/Bars%3E';

print XMLToJSON::Parse($fullurl);
}

//Updates values from its key
function addComment($id) {

	// Access to the global var $app
	global $app;

	// Get the id of the post and convert it to an ObjectId 
	// Queries using _id need it converted to a MongoId object
	$objectId = new MongoId($id);

	// Connect to the database 
	include_once("../connection.php");

	// Obtain the data of the request
	$requestData = json_decode($app->request->getRawBody());

	// Update the post adding the new comment passed on the request
	$collection->update(array('_id' => $objectId), array('$push' => array('comments' => $requestData)));
}

function notFound() {
	home();
}

// Handle the request
$app->handle();
?>

