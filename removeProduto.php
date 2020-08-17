<?php
include 'includes/db.php';

$id = $_POST['id'];

$query = $db-> prepare("DELETE FROM produtos WHERE id = :id;");
$query -> execute([':id'=>$id]);

header('Location: http://localhost/desafio_PHP/indexProdutos.php');
 ?>
