<?php 
	include('inc/conectar.php');
	session_start();
	/*<--------------- ANTI-CHEAT --------------->*/
	if (!(isset($_SESSION["usuario"]))) {
		header("location:login.php");
	}

 ?>

<!DOCTYPE html>
<html>
<head>
	 <!-- HEAD -->
<?php include('inc/head.php');?>

<!-- TÍTULO DA PÁGINA -->
<title>Trampo Centro - Chat</title>

<!-- NAVBAR -->
<?php include('inc/navbar.php');?>

	<?php
		$_SESSION['codigoservico'] = $_GET['chat'];
	?>

	<script type="text/javascript">
		function ajax(){
			var req = new XMLHttpRequest();
			req.onreadystatechange = function(){
				if (req.readyState == 4 && req.status == 200) {
					document.getElementById('chat').innerHTML = req.responseText;
				}
			}
			req.open('GET', 'chat.php', true);
			req.send();
		}
		setInterval(function(){ajax();},1000);
	</script>


<body onload="ajax();">
<div id="tc-index">
	<section class="parallax-chat">
		<div class="col-sm-12 text-center">
	    	<h2 id='h2-servicos' class='tracking-in-expand'>CHAT</h2>
	    	<
		</div>
		<div class="container">
			<div class="row">
				<div id="chat"></div>
					<?php
						if (isset($_POST['mensagem'])) {
							$nome = $_SESSION['namechat'];
							$mensagem = $_SESSION['mensagemchat'];
							$insertchat = "INSERT INTO chat (id_usuariochat, id_servicochat, ds_mensagem, dt_data) VALUES ('".				$_SESSION['cd']."','".$_GET['chat']."', '".$_POST['mensagem']."', NOW());";
							$exe = $mysqli->query($insertchat);

							if ($exe) {
								echo "<embed loop='false' src='soundnot.mp3' hidden='true' autoplay='true'>";
							}

						}
					?>
			</div>
		</div>
		<br>
				<div class="col-sm-12 text-center">
	    	<form method="POST">
				<input type="text" name="mensagem" class="input-msg text-center" placeholder="Digite sua mensagem aqui." maxlength="35" required>
				<input type="submit" name="enviar" class="btn btn-outline-success" value="&rang;">
			</form>
			<br>
		</div>
	</section>
</div>

<!-- SCRIPTS -->
<?php include('inc/scripts.php');?>

<!-- FOOTER -->
<?php include('inc/footer.php');?>
