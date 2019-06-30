<!--
- Archivo index principal.
- @author Miguel Costa.
-->

<?php
    header('Content-Type: text/html; charset=UTF-8');
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html lang="es-Es" xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html"; charset=utf-8"/>
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="description" content="" />
<meta name="robots" content="NOODP">
<title>The Fantastic L</title>
<link type="text/css" rel="stylesheet" href="css/font-awesome.css" />

<script>
     var rutacss1 = "css/main.css?" + Math.random();
     document.write('<link rel="stylesheet" href="' + rutacss1 + '" type="text/css" media="screen" />'); 
</script>

<!-- Global site tag (gtag.js) - Google Analytics -->
<script async
	src="https://www.googletagmanager.com/gtag/js?id=UA-122491095-1"></script>
<script>
  	window.dataLayer = window.dataLayer || [];
    function gtag(){dataLayer.push(arguments);}
    gtag('js', new Date());
    
    gtag('config', 'UA-122491095-1');
</script>

<link href='https://fonts.googleapis.com/css?family=Pathway+Gothic+One'
	rel='stylesheet' type='text/css' />
<link href="https://fonts.googleapis.com/css?family=Gloria+Hallelujah"
	rel="stylesheet">
<link href="apple-touch-icon.png" rel="apple-touch-icon" />
<link href="apple-touch-icon-152x152.png" rel="apple-touch-icon"
	sizes="152x152" />
<link href="apple-touch-icon-167x167.png" rel="apple-touch-icon"
	sizes="167x167" />
<link href="apple-touch-icon-180x180.png" rel="apple-touch-icon"
	sizes="180x180" />
<link href="icon-hires.png" rel="icon" sizes="192x192" />
<link href="icon-normal.png" rel="icon" sizes="128x128" />
<script src="jquery/jquery-3.1.1.min.js"></script>
<script src="https://code.jquery.com/jquery-latest.min.js"
	type="text/javascript"></script>
<script src="jquery/cookies.js" type="text/javascript"></script>
<script src="jquery/jquery_menuMoviles_desplegable.js"></script>

</head>
<body>
	<header>

		<nav>
          <?php include_once("php/menuNavIndex.php");?>		
      	</nav>

	</header>
	
	<?php include_once("php/contenido.php");?>	

	<!--//BLOQUE COOKIES-->
	<div id="overbox3">
		<div id="infobox3">
			<p>
				Esta web utiliza cookies para obtener datos estadísticos de la
				navegación de sus usuarios. Si continúas navegando consideramos
				que aceptas su uso. <a href="php/cookies.php"
					class="mas_informacion">Más información </a> <a
					onclick="aceptar_cookies();" style="cursor: pointer;"
					class="aceptar"> Aceptar</a> <a href="#" class="rechazar">Rechazar</a>
			</p>
		</div>
	</div>
	<!--//FIN BLOQUE COOKIES-->

	<footer>
        <?php include_once("php/footer.php");?>        
    </footer>

</body>
</html>