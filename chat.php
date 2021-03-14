<?php 
	include('inc/conectar.php');
	session_start();
	/*<--------------- ANTI-CHEAT --------------->*/
	if (!(isset($_SESSION["usuario"]))) {
		header("location:login.php");
	}

 ?>

<div class="col-sm-12" style="width: 100%;" >
	
	<?php 
	$consulta = "SELECT * FROM chat WHERE id_servicochat = '".$_SESSION['codigoservico']."' ORDER BY cd_chat ASC; ";
	$query = $mysqli->query($consulta);
	echo "<div id='divContent'>";
	while($chatquery = $query->fetch_array()){
		$user = "SELECT nm_usuario FROM usuario WHERE cd_usuario = '".$chatquery['id_usuariochat']."';";
		$userquery = $mysqli->query($user);
		while($userq = $userquery->fetch_object()){
			$cdchat=$chatquery['id_usuariochat'];
		?>
		<div id="dados-chat">
			<span>
				<?php $_SESSION['namechat'] = $userq->nm_usuario; ?>
				<?php echo '<a href="perfil.php?cdus='.$cdchat.'" id="text-trampo_certo">'. $userq->nm_usuario. '</a> '; ?>
			</span>
			<span>
				<?php $_SESSION['mensagemchat'] = $chatquery['ds_mensagem']; ?>
				<?php 
					echo "<div class='balao'>";
					echo $chatquery['ds_mensagem'];
					echo "</div>";
		  		?>
			</span>
			<span>
				<?php $_SESSION['datamensagem'] = $chatquery['dt_data']; ?>
				<?php 
					echo "<div class='balaodt'> Enviado em: ";
					echo $chatquery['dt_data']; 
					echo "</div>";
				?>
			</span>
		</div>
		
<?php  
		}
	}
?>

</div>
<br><br>
<div id="ult-msg">
<br>
