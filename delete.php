<?php require_once('vendor/config.php') ?>
<?php require_once('include/header.php'); ?>
<?php
$pag = new Usuario();
$pag->verificaOn();
$logado = json_decode($_SESSION["logado"], true);
?>

<div class="content">
<div class="width">

<?php
if (isset($_GET['c'])) {
$case = $_GET['c'];
}else {
$case = "";
}
if (isset($_GET['id'])) {
$id = $_GET['id'];
}else {
$id = "";
}
$nivel = $logado["nivel"];

switch ($case) {
case 'usuario':
if ($nivel == 2) {
$user = new Usuario();
$query = $user->listById($id);
if ($query[0]['foto'] === 'user_unknown.png') {
}else {
unlink('lib'.DIRECTORY_SEPARATOR.'upload'.DIRECTORY_SEPARATOR.'perfil'.DIRECTORY_SEPARATOR.''.$query[0]['foto']);
}
$user->delete($id);
header('location:usuarios.php');
}else {
header('location:index.php');
}
break;

case 'foto':
$user = new Galeria();
$query = $user->listById($id);
unlink('lib'.DIRECTORY_SEPARATOR.'upload'.DIRECTORY_SEPARATOR.'galeria'.DIRECTORY_SEPARATOR.''.$query[0]['foto']);
$user->delete($id);
header('location:galeria.php');
break;

case 'mensagem':
if ($nivel == 2) {
$user = new Mensagem();
$user->delete($id);
header('location:mensagens.php');
}else {
header('location:index.php');
}
break;

default:
echo '
<div class="content_title">
<h1>Houve um erro <i class="fa fa-frown-o"></i></h1>
</div>
';
break;
}
?>

</div>
</div>

<?php require_once('include/footer.php'); ?>