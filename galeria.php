<?php require_once('vendor/config.php') ?>
<?php $pagina = 3; ?>
<?php $pager = array("galeria", "picture-o"); ?>
<?php require_once('include/header.php'); ?>
<?php require_once('include/nav.php'); ?>
<?php
$pag = new Usuario();
$pag->verificaOn();
?>

<div class="content">
<div class="width">
<div class="content_title">
<h1>Galeria</h1>
<a href="javascript:abrirJanela('window.php?c=foto')" class="btnNew"><i class="fa fa-plus"></i> Nova foto</a>
</div>
<div class="galeria">
<?php
$user = new Galeria();
$query = $user->list();
if (count($query) > 0) {
foreach ($query as $key => $value) {
?>
<div class="box">
<div class="img" style="background: url('lib/upload/<?=$value['foto']?>') center center; background-size: cover;">
</div>
<div class="action">
<a href="javascript:abrirJanela('window.php?c=efoto&id=<?=$value['id']?>')" class="btn blue"><i class="fa fa-pencil"></i></a>
<a href="delete.php?c=foto&id=<?=$value['id']?>" onclick="return confirm('Concluir acão ?')" class="btn red"><i class="fa fa-trash"></i></a>
</div>
</div>
<?php 
}
}else {
echo "<p class='aviso'>Nada encontrado! <i class='fa fa-smile-o'></i></p>";
} 
?>
</div>
</div>
</div>

<?php require_once('include/footer.php'); ?>