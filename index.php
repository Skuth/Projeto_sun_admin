<?php require_once('vendor/config.php') ?>
<?php $pagina = 1; ?>
<?php require_once('include/header.php'); ?>
<?php require_once('include/nav.php'); ?>
<?php
$pag = new Usuario();
$pag->verificaOn();
?>

<div class="content">
<div class="width">
<div class="content_title">
<h1>Dashboard</h1>
</div>
<div class="box_home">

<div class="box" style="background: url('lib/img/users-image.jpg'); background-size: cover;">
<div class="icon">
<div class="icon_box">
<i class="fa fa-users"></i>
</div>
</div>
<div class="info">
<?php
$user = new Usuario();
$query = $user->list();
$count = count($query);
?>
<p><?=$count?> Usuario</p>
<a href="usuarios.php">Ver todos os usuarios</a>
</div>
</div>

<div class="box" style="background: url('lib/img/pictures-image.jpg'); background-size: cover;">
<div class="icon">
<div class="icon_box">
<i class="fa fa-picture-o"></i>
</div>
</div>
<div class="info">
<?php
$picture = new Galeria();
$count = count($picture->list());
?>
<p><?=$count?> Fotos</p>
<a href="galeria.php">Ver todas as fotos</a>
</div>
</div>
</div>
</div>
</div>

<?php require_once('include/footer.php'); ?>