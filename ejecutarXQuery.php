  <?php 
  $url = $_GET['url'];
  
  include("connection.php");

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
echo $xml;
?>