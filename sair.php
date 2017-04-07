<?php
session_start();
session_destroy();
session_unset($_SESSION["logado"]);
header("Location: login.php");
?>