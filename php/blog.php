<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Blog</title>
<link type="text/css" rel="stylesheet" href="../css/font-awesome.css" />

<link href='https://fonts.googleapis.com/css?family=Pathway+Gothic+One'
	rel='stylesheet' type='text/css' />
<link href="https://fonts.googleapis.com/css?family=Gloria+Hallelujah"
	rel="stylesheet">

<link href="../apple-touch-icon.png" rel="apple-touch-icon" />
<link href="../apple-touch-icon-152x152.png" rel="apple-touch-icon"
	sizes="152x152" />
<link href="../apple-touch-icon-167x167.png" rel="apple-touch-icon"
	sizes="167x167" />
<link href="../apple-touch-icon-180x180.png" rel="apple-touch-icon"
	sizes="180x180" />
<link href="../icon-hires.png" rel="icon" sizes="192x192" />
<link href="../icon-normal.png" rel="icon" sizes="128x128" />

<script src="../jquery/jquery-3.1.1.min.js"></script>
<script src="https://code.jquery.com/jquery-1.11.1.min.js"></script>
<script src="https://code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
<script src="../jquery/zoom_fancybox.js"></script>

<!-- Add jQuery library -->
<script type="text/javascript"
	src="https://code.jquery.com/jquery-latest.min.js"></script>

<!-- Add fancyBox -->
<script>
    var rutacss2 = "../fancybox/source/jquery.fancybox.css?v=2.1.7?" + Math.random();
    document.write('<link rel="stylesheet" href="' + rutacss2 + '" type="text/css" media="screen" />'); 
</script>

<script type="text/javascript"
	src="../fancybox/source/jquery.fancybox.pack.js?v=2.1.7"></script>

<!-- Optionally add helpers - button, thumbnail and/or media -->
<link rel="stylesheet"
	href="../fancybox/source/helpers/jquery.fancybox-buttons.css?v=1.0.5"
	type="text/css" media="screen" />
<script type="text/javascript"
	src="../fancybox/source/helpers/jquery.fancybox-buttons.js?v=1.0.5"></script>
<script type="text/javascript"
	src="../fancybox/source/helpers/jquery.fancybox-media.js?v=1.0.6"></script>

<link rel="stylesheet"
	href="../fancybox/source/helpers/jquery.fancybox-thumbs.css?v=1.0.7"
	type="text/css" media="screen" />
<script type="text/javascript"
	src="../fancybox/source/helpers/jquery.fancybox-thumbs.js?v=1.0.7"></script>
	
<!-- Metemos un aleatorio para la recarga autom�tica del css y el js -->
<script>

    var rutacss1 = "../css/main.css?" + Math.random();
    var rutacss2 = "../jquery/jquery_menuMoviles_desplegable.js?" + Math.random();
    var rutacss3 = "../jquery/jquery_leerMas.js?" + Math.random();
    var script = "script";
    
    document.write('<link rel="stylesheet" href="' + rutacss1 + '" type="text/css" media="screen" />');
    document.write('<script src="' + rutacss2 + '"></' + script + '>');
    document.write('<script src="' + rutacss3 + '"></' + script + '>');
	
</script>

</head>
<body>
	<header>

		<nav>
          <?php include_once("menuNav.php");?>		
      	</nav>
	</header>

	<div class="explicacion_blog">

		<h3>BLOG THE FANTASTIC L</h3>

		</br>

	</div>

	<!-- ART͍CULO -->
	<div class="articulo">

		<!-- PARTE PRINCIPAL DEL ART͍CULO CON IMAGEN GRANDE Y TEXTO -->

		<h3 class="titulo_articulo">NOMBRE DEL ART�CULO</h3>

		<div class="fechaArticulo">
			<p>19 de enero de 2019</p>
		</div>

		<img src=''
			title=''
			alt=''
			class='' />

		<div class="explicacion_articulo">

			<p></p>

			<span class="leerMas"><strong>leer más...</strong></span>


			<!-- Esta parte del texto estar� oculta hasta hacer click en 'leer m�s...' -->

			<div class="texto_leerMas">
			
				</br>
				<p>!</p>

				<div class="contenedor_articulo_secundario">

					<div class="articulo_secundario">

						<!-- img con zoom -->
						<a class="fancybox" rel="group"
							href=""><img
							src=""
							class="a"
							title=''
							alt="" /></a>

					</div>

				</div>

				<div class="explicacion_final">

					<p></p>
					</br>
					<p>
						<i>Pie de foto</i>
					</p>

				</div>

			</div>

			<!-- enlace de 'leer menos...' para ocultar el texto y las im�genes -->
			<span class="leerMenos"><strong>leer menos...</strong></span>

		</div>

	</div>

	<footer>
        <?php include_once("footer.php");?>        
    </footer>

</body>
</html>