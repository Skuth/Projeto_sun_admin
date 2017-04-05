<?php require_once('vendor/config.php') ?>
<?php $pagina = 4; ?>
<?php $pager = array("mensagens", "envelope"); ?>
<?php require_once('include/header.php'); ?>
<?php require_once('include/nav.php'); ?>
<?php
$pag = new Usuario();
$pag->verificaOn();
$logado = json_decode($_SESSION["logado"], true);
?>

<div class="content">
	<div class="width">
		<div class="content_title">
			<h1>Mensagens</h1>
		</div>
		<div class="table">
			<?php
			$user = new Mensagem();
			$query = $user->list();
			if (count($query) > 0) {
			?>
			<table cellpadding="0" cellspacing="0">
				<tr>
					<th>Nome</th>
					<th>Email</th>
					<th>Telefone</th>
					<th>Assunto</th>
					<th>Mensagem</th>
					<th>Ação</th>
				</tr>
			<?php
				foreach ($query as $key => $value) {
			?>
				<tr>
					<td><?=$value['nome']?></td>
					<td><?=$value['email']?></td>
					<td><?=$value['telefone']?></td>
					<td><?=$value['assunto']?></td>
					<td><?=substr($value['mensagem'], 0, 50)?>...</td>
					<td>
						<a href="javascript:abrirJanela('window.php?c=read&id=<?=$value['id']?>')" class="btn blue"><i class="fa fa-eye"></i></a>
						<?php if ($logado["nivel"] == 2): ?>
							<a href="delete.php?c=mensagem&id=<?php echo $value['id']; ?>" onclick="return confirm('Concluir acão ?')" class="btn red"><i class="fa fa-trash"></i></a>
						<?php endif ?>
					</td>
				</tr>
			<?php } ?>
			</table>
			<?php 
			}else {
				echo "<p class='aviso'>Nada encontrado! <i class='fa fa-smile-o'></i></p>";
			} 
			?>
		</div>
	</div>
</div>

<?php require_once('include/footer.php'); ?>