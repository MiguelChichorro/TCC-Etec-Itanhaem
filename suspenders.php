<?php
	session_start();
	/*<--------------- ANTI-CHEAT --------------->*/
	if (!(isset($_SESSION['adm']))) {
		header("location:login.php");
	}
	/*--------------------------------------------*/
	include ("inc/conectar.php");


    date_default_timezone_set('America/Sao_Paulo');

	$dthj = date('Y-m-d');
	$dt15 = date('Y-m-d', strtotime($dthj. ' + 15 days'));
	$dt30 = date('Y-m-d', strtotime($dthj. ' + 30 days'));
	$dtall = date('Y-m-d', strtotime($dthj. ' + 3650 days'));

	
	$banido = $_GET['cdban'];
	$rep = $_GET['codig'];

	$cont = "SELECT COUNT(cd_suspenso) as num FROM usuario_suspenso WHERE id_usuariosuspenso = '".$banido."'";
		if ($rslt = $mysqli->query($cont)){
			while($obj = $rslt ->fetch_object()){		
				$susps = $obj->num;
			}
		}

		
	if($susps < 1){	
		$sql = "INSERT INTO usuario_suspenso VALUES (NULL, '".$banido."', '".$dthj."', '".$dt15."')";

		if ($rslt = $mysqli->query($sql)){		
			echo "Banido.";

		}
	}

	if($susps == 1){
		$sqla = "INSERT INTO usuario_suspenso VALUES (NULL, '".$banido."', '".$dthj."', '".$dt30."')";

		if ($rslt = $mysqli->query($sqla)){		
			echo "Banido.";
		}
	}

	if($susps == 2){
		$sqlb = "INSERT INTO usuario_suspenso VALUES (NULL, '".$banido."', '".$dthj."', '".$dtall."')";

		if ($rslt = $mysqli->query($sqlb)){		
			echo "Banido.";
		}
	}

	$upd = "UPDATE report_servico SET st_reports = 0 WHERE cd_reportservico = '".$rep."'";

	if ($resultado = $mysqli->query($upd)) {
		echo 'oi';
		header('location: visualizarreport.php');
	}
?>