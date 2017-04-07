<?php require_once('vendor/config.php') ?>
<?php require_once('include/header.php'); ?>
<?php
$pag = new Usuario();
$pag->verificaOn();
?>

<div class="content">
<div class="width">
<?php

if (isset($_GET['c'])) {
$case = $_GET['c'];
}else {
$case = "";
}

$logado = json_decode($_SESSION["logado"], true);
$nivel = $logado["nivel"];

switch ($case) {
case 'usuario':
if ($nivel == 2) {
?>
<div class="content_title">
<h1>Cadastrar usuario</h1>
</div>
<div class="form">
<form method="POST" enctype="multipart/form-data">
<input type="text" name="nome" placeholder="Nome" required autofocus>
<input type="email" name="email" placeholder="Email" required>
<input type="password" name="senha" placeholder="Senha" required>
<?php if ($nivel == 2): ?>
<select name="nivel">
<option value="1">Editor</option>
<option value="2">Administrador</option>
</select>
<?php endif ?>
<input type="file" name="foto" accept="image/*">
<button type="submit" name="cadastrar"><i class="fa fa-sign-up"></i>Cadastrar</button>
</form>
</div>
<?php
}else {
echo '
<div class="content_title">
<h1>Você precisa ser administrador</h1>
</div>
';
}
try {
if (isset($_POST['cadastrar'])) {
$nome = trim(strip_tags($_POST['nome']));
$email = trim(strip_tags($_POST['email']));
$senha = trim(strip_tags($_POST['senha']));
if ($nivel == 2) {
$nivel = trim(strip_tags($_POST['nivel']));
}else {
$nivel = 1;
}
if (!empty($_FILES['foto']['name'])) {
$file = $_FILES['foto'];
$fileExtension = explode(".", strtolower($file['name']));
$novoNome = date("dmYHis").".".$fileExtension[1];
$dirUploads = "lib".DIRECTORY_SEPARATOR."img";
if (move_uploaded_file($file["tmp_name"], $dirUploads . DIRECTORY_SEPARATOR . $novoNome)) {
echo "Upload realizado com sucesso!<br>";
}else {
throw new Exception("Erro ao fazer o upload");
}//verifica se fez o upload
$foto = $novoNome;
}else {
$foto = "user_unknown.png";
}

$user = new Usuario();
$user->setNome($nome);
$user->setEmail($email);
$user->setSenha($senha);
$user->setNivel($nivel);
$user->setFoto($foto);
$user->insert();
}
} catch (Exception $e) {
echo $e->getMessage();
}
break;

case 'eusuario':
if (isset($_GET['id'])) {
$id = $_GET['id'];
}else {
$id = "";
}
if ($nivel == 2 || $id = $logado["id"]) {
$user = new Usuario();
$query = $user->listById($id);
foreach ($query as $key => $value) {
?>
<div class="content_title">
<h1>Editando usuario de id <?=$id?></h1>
</div>
<div class="form">
<form method="POST" enctype="multipart/form-data">
<input type="text" name="nome" value="<?=$value['nome']?>" required>
<input type="email" name="email" value="<?=$value['email']?>" required>
<input type="password" name="senha" value="<?=$value['senha']?>" required>
<?php if ($nivel == 2): ?>
<select name="nivel">
<option value="1" <?php if($value["nivel"] == 1){echo "selected";} ?> >Editor</option>
<option value="2" <?php if($value["nivel"] == 2){echo "selected";} ?> >Administrador</option>
</select>
<?php endif ?>
<input type="hidden" name="id" value="<?=$value["id"]?>">
<input type="hidden" name="fotoAntiga" value="<?php echo $value['foto']; ?>">
<input type="file" name="foto" accept="image/*">
<button type="submit" name="editar"><i class="fa fa-sign-up"></i>Editar</button>
</form>
</div>
<?php
}
}else {
echo '
<div class="content_title">
<h1>Você precisa ser administrador</h1>
</div>
';
}
try {
if (isset($_POST['editar'])) {
$id = trim(strip_tags($_POST['id']));
$nome = trim(strip_tags($_POST['nome']));
$email = trim(strip_tags($_POST['email']));
$senha = trim(strip_tags($_POST['senha']));
if ($nivel == 2) {
$nivel = trim(strip_tags($_POST['nivel']));
}else {
$nivel = 1;
}
if (!empty($_FILES['foto']['name'])) {
$fotoOld = $_POST['fotoAntiga'];
unlink('lib'.DIRECTORY_SEPARATOR.'img'.DIRECTORY_SEPARATOR.''.$fotoOld);
$file = $_FILES['foto'];
$fileExtension = explode(".", strtolower($file['name']));
$novoNome = date("dmYHis").".".$fileExtension[1];
$dirUploads = "lib".DIRECTORY_SEPARATOR."img";
move_uploaded_file($file["tmp_name"], $dirUploads . DIRECTORY_SEPARATOR . $novoNome);
$foto = $novoNome;
}else {
$foto = trim(strip_tags($_POST["fotoAntiga"]));
}

$user = new Usuario();
$user->loadById($id);
$user->update($nome, $email, $senha, $nivel, $foto);
}
} catch (Exception $e) {
echo $e->getMessage();
}
break;

case 'foto':
?>
<div class="content_title">
<h1>Cadastrar foto</h1>
</div>
<div class="form">
<form method="POST" enctype="multipart/form-data">
<input type="text" name="descricao" placeholder="Descrição">
<input type="file" name="foto" accept="image/*" required>
<button type="submit" name="cadastrar"><i class="fa fa-sign-up"></i>Cadastrar</button>
</form>
</div>
<?php
try {
if (isset($_POST['cadastrar'])) {

$file = $_FILES['foto'];

if ($file["error"]) {
echo "Error : ".$file["error"];
}//verificar error

$fileExtension = explode(".", strtolower($file['name']));
$novoNome = date("dmYHis").".".$fileExtension[1];

$dirUploads = "lib".DIRECTORY_SEPARATOR."upload";
if (!is_dir($dirUploads)) {
mkdir($dirUploads);
}//verificar pasta e criar pasta

if (move_uploaded_file($file["tmp_name"], $dirUploads . DIRECTORY_SEPARATOR . $novoNome)) {
echo "Upload realizado com sucesso!";
}else {
throw new Exception("Erro ao fazer o upload");
}//verifica se fez o upload

$foto = $novoNome;
$descricao = trim(strip_tags($_POST['descricao']));

$galeria = new Galeria();
$galeria->setDescricao($descricao);
$galeria->setFoto($foto);
$galeria->insert();

}
} catch (Exception $e) {
echo $e->getMessage();
}
break;

case 'efoto':
if (isset($_GET['id'])) {
$id = $_GET['id'];
}else {
$id = "";
}
?>
<div class="content_title">
<h1>Editando foto de id <?=$id?></h1>
</div>
<div class="form">
<?php
$galeria = new Galeria();
$query = $galeria->listById($id);
foreach ($query as $key => $value) {
?>
<form method="POST" enctype="multipart/form-data">
<input type="text" name="descricao" placeholder="Descricao" value="<?php echo $value["descricao"]; ?>">
<input type="hidden" name="fotoAntiga" value="<?php echo $value["foto"]; ?>">
<input type="file" name="foto" accept="image/*">
<button type="submit" name="editar"><i class="fa fa-sign-up"></i>Editar</button>
</form>
</div>
<?php } ?>
<?php
try {
if (isset($_POST['editar'])) {
if (!empty($_FILES['foto']['name'])) {
$fotoOld = $_POST['fotoAntiga'];
unlink('lib'.DIRECTORY_SEPARATOR.'upload'.DIRECTORY_SEPARATOR.''.$fotoOld);
$file = $_FILES['foto'];
$fileExtension = explode(".", strtolower($file['name']));
$novoNome = date("dmYHis").".".$fileExtension[1];
$dirUploads = "lib".DIRECTORY_SEPARATOR."upload";
move_uploaded_file($file["tmp_name"], $dirUploads . DIRECTORY_SEPARATOR . $novoNome);
$foto = $novoNome;
}else {
$foto = trim(strip_tags($_POST["fotoAntiga"]));
}

$descricao = trim(strip_tags($_POST["descricao"]));
$id = $_GET['id'];

$editar = new Galeria();
$editar->listById($id);
$editar->update($descricao, $foto);
header('Refresh:2,window.php?c=efoto&id='.$id);
}
} catch (Exception $e) {
echo $e->getMessage();
}
break;

case 'read':
if (isset($_GET['id'])) {
$id = $_GET['id'];
}else {
$id = "";
}
$read = new Mensagem();
$query = $read->listById($id);
if (count($query) > 0) {
foreach ($query as $key => $value) {
?>
<div class="content_title">
<h1>Mensagem de id <?=$id?></h1>
</div>
<div class="readMore">
<p>Nome: <span><?=$value['nome']?></span></p>
<p>Email: <span><?=$value['email']?></span></p>
<p>Telefone: <span><?=$value['telefone']?></span></p>
<p>Assunto: <span><?=$value['assunto']?></span></p>
<p>Mensagem: <span><?=$value['mensagem']?></span></p>
</div>
<?php
}
}else {
echo '
<div class="content_title">
<h1>Nada encontrado <i class="fa fa-frown-o"></i></h1>
</div>
';
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