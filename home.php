<?php require_once("models/seguridad.php");
$snomcc = isset($_SESSION["nomcc"]) ? $_SESSION["nomcc"] : NULL;
$ano = date("Y");
?>
<!DOCTYPE html>
<html class="menu">
<html lang="es">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="shortcut icon" href="img/favicon.png">
	
	<!-- Alerts Mensajes Pantalla -->
	<script src="js/sweetalert2.all.min.js"></script>
	<link rel="stylesheet" type="text/css" href="./css/sweetalert2.min.css">

	<!-- jQuery primero -->
	<script src="./js//jquery-3.5.1.js"></script>

	<!-- jQuery UI CSS -->
	<link rel="stylesheet" href="./css/jquery-ui.css">

	<!-- jQuery UI JS -->
	<script src="./js/jquery-ui.min.js"></script>

	<!-- Chart -->
	<script src="js/chart.min.js"></script>

	<!-- Chart JS Datatables -->
	<script src="js/chartjs-plugin-datalabels.min.js"></script>

	<!-- Bootstrap 5 CSS -->
	<link href="./css/bootstrap.min.css" rel="stylesheet">

	<!-- DataTables CSS (con Bootstrap 5) -->
	<link href="./css/dataTables.bootstrap5.min.css" rel="stylesheet">

	<!-- DataTables JS -->
	<script src="./js/jquery.dataTables.min.js"></script>
	<script src="./js/dataTables.bootstrap5.min.js"></script>

	<!-- Bootstrap 5 JS -->
	<script src="./js/bootstrap.bundle.min.js"></script>

	<!-- FontAwesome -->
	<link rel="stylesheet" href="./font/fontawesome/css/all.min.css">

	<!-- DataTables exportación -->
	<script src="./js/dataTables.buttons.min.js"></script>
	<script src="./js/jszip.min.js"></script>
	<script src="./js/pdfmake.min.js"></script>
	<script src="./js/vfs_fonts.js"></script>
	<script src="./js/buttons.html5.min.js"></script>

	<link rel="stylesheet" href="./css/buttons.bootstrap5.min.css">

	<script src="js/java.js"></script>
	<!-- scripts -->
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<link rel="stylesheet" type="text/css" href="css/menu.css">

	<title>SagiCDA <?= $ano; ?></title>
</head>

<body>
	<header class="header-home">
		<?php
		date_default_timezone_set('America/Bogota');
		require_once('models/conexion.php');
		require_once('controllers/optimg.php');
		require_once('controllers/ccof.php');
		$nu = 2;
		$alto = "0px";
		$pg = isset($_REQUEST["pg"]) ? $_REQUEST["pg"] : 1102;
		$pefid = isset($_SESSION["pefid"]) ? $_SESSION["pefid"] : NULL;
		$ope = isset($_GET['ope']) ? $_GET['ope'] : false;
		$opera = isset($_GET['opera']) ? $_GET['opera'] : false;
		require_once("views/header.php");
		echo '<div id="err"></div>';
		require_once("views/vmenu.php");
		if ($pg == 1405)
			$cont = 'contenido2';
		else
			$cont = 'contenido';
		?>
	</header>

	<section class="<?= $cont; ?>">
		<?php
		$mos = 0;
		$est = 0;
		$rut = validar($pg);
		if ($rut) {
			$mos = $rut[0]['mospas'];
			if ($opera == "edi" or $ope == "edi")
				$est = 1;
			echo ayuda($pg);
			echo "<script>err();</script>";
			$icono = substr($rut[0]['icopag'], 3);
			$rutaVista = trim($rut[0]['rutpag']);

			if (!empty($rutaVista) && file_exists($rutaVista)) {
				require_once($rutaVista);
			} else {
				// Fallback de compatibilidad: buscar archivo legacy si aún no tiene prefijo en disco
				$base = basename($rutaVista);
				$legacy = preg_replace('/^(usu|hor|prev|des|com|adm|mes|dat|eta|conv|con|edt|vot|es)/', '', $base);
				if (!empty($legacy) && file_exists("views/" . $legacy)) {
					require_once("views/" . $legacy);
				} elseif (!empty($legacy) && file_exists("views/v" . $legacy)) {
					require_once("views/v" . $legacy);
				} else {
					echo '<div class="alert alert-warning m-4 shadow-sm" role="alert">
							<h4 class="alert-heading"><i class="fa-solid fa-triangle-exclamation me-2"></i>Módulo en desarrollo</h4>
							<p>La vista configurada para esta interfaz (<code>' . htmlspecialchars($rutaVista) . '</code>) aún no ha sido implementada o no se encuentra disponible en el repositorio local.</p>
							<hr>
							<p class="mb-0 small text-muted">Página: ' . htmlspecialchars($rut[0]['nompag']) . ' (ID: ' . htmlspecialchars($pg) . ')</p>
						  </div>';
				}
			}
		} else {
			echo "<script>window.location='home.php?pg=1102';</script>";
		}
		?>
	</section>

	<?php require_once "views/vfooter.php"; ?>


	
</body>
</div>

<script type="text/javascript" src="js/valida.js"></script>
<script type="text/javascript">ocul(<?= $mos; ?>, <?= $est; ?>);</script>

</html>