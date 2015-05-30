<?php

include ('XMLToJSON.php');

print XMLToJSON::Parse('http://localhost:8080/exist/rest/db/test?_query=%3CBars%3E%20{%20for%20$node%20in%20collection(%22/db/osm%22)/osm/node%20where%20$node/tag/@k=%22amenity%22%20and%20$node/tag/@v=%22bar%22%20and%20$node/@lat%20%3E%2036.8388993%20-%200.00000898%20*%20100%20and%20$node/@lat%20%3C%2036.8388993%20-%20-0.00000898%20*%20100%20and%20$node/@lon%20%3E%20-2.464748%20-%200.00000898%20*%20100%20and%20$node/@lon%20%3C%20-2.464748%20-%20-0.00000898%20*%20100%20return%20%3Cbar%3E%20{$node}%20%3C/bar%3E%20}%20%3C/Bars%3E');

?>