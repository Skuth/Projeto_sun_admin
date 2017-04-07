<div class="nav_top">
<div class="logo">
<img src="lib/img/logo.png">
</div>
<div class="width">
<div class="pager">
<a href="index.php"><div class="page_box">
<i class="fa fa-tachometer"></i>
<p>Dashboard</p>
</div></a>
<?php
if (isset($pager)) {
echo '<a href="'.$pager[0].'.php"><div class="page_box">
<i class="fa fa-'.$pager[1].'"></i>
<p>'.$pager[0].'</p>
</div></a>';
}
?>
</div>
<div class="user">
<div class="user_box">
<ul>
<img src="lib/img/user_unknown.png">
<ul class="submenu">
<?php
$logado = json_decode($_SESSION["logado"], true);
?>
<li><a href="javascript:abrirJanela('window.php?c=eusuario&id=<?=$logado["id"]?>')"><i class="fa fa-user"></i>Profile</a></li>
<li><a href="sair.php" onclick="return confirm('Concluir acão ?')"><i class="fa fa-sign-out"></i>Sair</a></li>
</ul>
</ul>
</div>
</div>
</div>
</div>
<div class="nav_left">
<ul>
<?php
if (!isset($pagina)) {
$pagina = "";
}
switch ($pagina) {
case '1':
?>
<li><a href="index.php" class="active"><i class="fa fa-tachometer"></i></a></li>
<li><a href="usuarios.php"><i class="fa fa-user"></i></a></li>
<li><a href="galeria.php"><i class="fa fa-picture-o"></i></a></li>
<li><a href="mensagens.php"><i class="fa fa-envelope"></i></a></li>
<?php
break;

case '2':
?>
<li><a href="index.php"><i class="fa fa-tachometer"></i></a></li>
<li><a href="usuarios.php" class="active"><i class="fa fa-user"></i></a></li>
<li><a href="galeria.php"><i class="fa fa-picture-o"></i></a></li>
<li><a href="mensagens.php"><i class="fa fa-envelope"></i></a></li>
<?php
break;

case '3':
?>
<li><a href="index.php"><i class="fa fa-tachometer"></i></a></li>
<li><a href="usuarios.php"><i class="fa fa-user"></i></a></li>
<li><a href="galeria.php" class="active"><i class="fa fa-picture-o"></i></a></li>
<li><a href="mensagens.php"><i class="fa fa-envelope"></i></a></li>
<?php
break;

case '4':
?>
<li><a href="index.php"><i class="fa fa-tachometer"></i></a></li>
<li><a href="usuarios.php"><i class="fa fa-user"></i></a></li>
<li><a href="galeria.php"><i class="fa fa-picture-o"></i></a></li>
<li><a href="mensagens.php" class="active"><i class="fa fa-envelope"></i></a></li>
<?php
break;

default:
?>
<li><a href="index.php"><i class="fa fa-tachometer"></i></a></li>
<li><a href="usuarios.php"><i class="fa fa-user"></i></a></li>
<li><a href="galeria.php"><i class="fa fa-picture-o"></i></a></li>
<li><a href="mensagens.php"><i class="fa fa-envelope"></i></a></li>
<?php
break;
}
?>
</ul>
</div>
<div class="nav_mobile">
<p id="mobile"><i class="fa fa-bars"></i></p>
</div>
<?php require_once('preloader.php'); ?>