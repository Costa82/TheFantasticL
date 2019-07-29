<!--
- Página del administrador.
- @author Miguel Costa.
-->

<?php
require_once './config/funciones.php';
require_once './config/validaciones.php';
include_once ("./model/Textos.php");
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html lang="es-Es" xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<meta http-equiv="X-UA-Compatible" content="IE=edge" />
<meta name="viewport" content="width=device-width, initial-scale=1" />
<meta name="description" content="" />
<meta name="robots" content="NOODP" />
<title>Página del administrador</title>
<link href="https://fonts.googleapis.com/css?family=Roboto&display=swap"
	rel="stylesheet" />
<link type="text/css" rel="stylesheet" href="./views/default/css/font-awesome.css" />

<!-- Metemos un aleatorio para el css y el jss -->
<script>
    var rutacss1 = "./views/default/css/font-awesome.css?" + Math.random();
    var rutacss2 = "./views/default/css/main.css?" + Math.random();
    var rutacss3 = "./views/default/css/form-elements.css?" + Math.random();
    document.write('<link rel="stylesheet" href="' + rutacss1 + '" type="text/css" media="screen" />'); 
    document.write('<link rel="stylesheet" href="' + rutacss2 + '" type="text/css" media="screen" />'); 
    document.write('<link rel="stylesheet" href="' + rutacss3 + '" type="text/css" media="screen" />'); 
</script>

<!-- Global site tag (gtag.js) - Google Analytics -->
<script async
	src="https://www.googletagmanager.com/gtag/js?id=UA-122491095-1">
</script>

<script>
  	window.dataLayer = window.dataLayer || [];
    function gtag(){dataLayer.push(arguments);}
    gtag('js', new Date());
    
    gtag('config', 'UA-122491095-1');
</script>

<link href='https://fonts.googleapis.com/css?family=Pathway+Gothic+One'
	rel='stylesheet' type='text/css' />
<link href="https://fonts.googleapis.com/css?family=Gloria+Hallelujah"
	rel="stylesheet" />
<link href="./apple-touch-icon.png" rel="apple-touch-icon" />
<link href="./apple-touch-icon-152x152.png" rel="apple-touch-icon"
	sizes="152x152" />
<link href="./apple-touch-icon-167x167.png" rel="apple-touch-icon"
	sizes="167x167" />
<link href="./apple-touch-icon-180x180.png" rel="apple-touch-icon"
	sizes="180x180" />
<link href="./icon-hires.png" rel="icon" sizes="192x192" />
<link href="./icon-normal.png" rel="icon" sizes="128x128" />
<script src="./views/default/jquery/jquery-3.1.1.min.js"></script>
<script src="https://code.jquery.com/jquery-latest.min.js"
	type="text/javascript"></script>

</head>
<body>

    <!-- Contenido -->
    <?php echo $contenido; ?>

</body>
</html>