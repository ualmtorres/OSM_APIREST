<?php
echo '	<!DOCTYPE html>';
echo '<html lang="en">';
echo '  <head>';
echo '    <meta charset="utf-8">';
echo '    <meta http-equiv="X-UA-Compatible" content="IE=edge">';
echo '    <meta name="viewport" content="width=device-width, initial-scale=1">';
    // The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags
echo '    <meta name="description" content="">';
echo '    <meta name="author" content="">';

echo '    <title>Sample Blog using PHP driver for MongoDB</title>';

    //<!-- Bootstrap core CSS -->
echo '    <link href="../css/bootstrap.min.css" rel="stylesheet">';

    //<!-- Custom styles for this template -->
echo '    <link href="../blog.css" rel="stylesheet">';

   // <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
echo '    <!--[if lt IE 9]>';
echo '      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>';
echo '      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>';
echo '    <![endif]-->';
echo '  </head>';

echo '  <body>';

    //<!-- Navigation bar at the top -->
echo '    <div class="blog-masthead">';
echo '      <div class="container">';
echo '        <nav class="blog-nav">';
echo '          <a class="blog-nav-item" href="../index.php">Home</a>';
echo '          <a class="blog-nav-item active" href="#">API</a>';
echo '        </nav>';
echo '      </div>';
echo '    </div>';

echo '    <div class="container">';

      //<!-- Blog header -->
echo '      <div class="blog-header">';
echo '        <h1 class="blog-title">El Blog de GGVD</h1>';
echo '        <p class="lead blog-description">Ejemplo usando el driver de PHP sobre MongoDB</p>';
?>