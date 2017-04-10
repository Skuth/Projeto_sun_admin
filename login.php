<?php require_once('vendor/config.php') ?>
<?php require_once('include/header.php'); ?>
<?php
$pag = new Usuario();
$pag->verificaOff();
?>

<div class="login">
	<div class="login_box">
		<div class="logo">
			<img src="lib/img/logo.png" alt="Logotipo do paienl administrativo">
		</div>
		<div class="box">
			<form method="POST" enctype="multipart/form">
				<input type="email" name="email" placeholder="Email" required autofocus>
				<input type="password" name="senha" placeholder="Senha" required>
				<button type="submit" name="entrar">Entrar</button>
			</form>
		</div>
		<?php
		if (isset($_POST['entrar'])) {
			$email = trim(strip_tags($_POST['email']));
			$senha = trim(strip_tags($_POST['senha']));
			$user = new Usuario();
			try {
				$user->login($email, $senha);
				echo "1";
			} catch (Exception $e) {
				echo '
				<div class="login_aviso">
					<p>'.$e->getMessage().'</p>
					<p id="close"><i class="fa fa-close"></i></p>
				</div>
				';
			}
		}
		?>
	</div>
</div>

<script type="text/javascript">
	$(document).ready(function() {
		$(".fa-close").click(function() {
			$(".login_aviso").fadeOut();
		});
	});
</script>


<?php require_once('include/footer.php'); ?>