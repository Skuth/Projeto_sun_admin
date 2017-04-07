<?php require_once('vendor/config.php') ?>
<?php $pagina = 2; ?>
<?php $pager = array("usuarios", "users"); ?>
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
<h1>Usuarios</h1>
<?php if ($logado["nivel"] == 2): ?>
<a href="javascript:abrirJanela('window.php?c=usuario')" class="btnNew"><i class="fa fa-plus"></i> Novo usuario</a>
<?php endif ?>
</div>
<div class="table">
<?php
$user = new Usuario();
$query = $user->list();
if (count($query) > 0) {
?>
<table cellpadding="0" cellspacing="0">
<tr>
<th>Foto</th>
<th>Nome</th>
<th>Email</th>
<th>Senha</th>
<th>Nivel</th>
<th>Ação</th>
</tr>
<?php
foreach ($query as $key => $value) {
?>
<tr>
<td><img src="lib/img/<?=$value['foto']?>"></td>
<td><?=ucfirst($value['nome'])?></td>
<td><?=ucfirst($value['email'])?></td>
<td>********</td>
<td>
<?php if ($value['nivel'] == 1) {
echo "Editor";
}else {
echo "Administrador";
} ?>
</td>
<td>
<a href="javascript:abrirJanela('window.php?c=eusuario&id=<?php echo $value['id']; ?>')" class="btn blue"><i class="fa fa-pencil"></i></a>
<?php if ($logado["nivel"] == 2) : ?>
<a href="delete.php?c=usuario&id=<?php echo $value['id']; ?>" onclick="return confirm('Concluir acão ?')" class="btn red"><i class="fa fa-trash"></i></a>
<?php endif ?>
</td>
</tr>
<?php
}
?>
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