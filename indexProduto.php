<?php
  session_start();
  if (!$_SESSION['acesso']){
    header ('Location: http://localhost/desafio_PHP/login.php');
  }

  include 'includes/db.php';
  include 'includes/header.php'; //codar o header

  $query = $db->prepare("SELECT * FROM produtos;");
  $query -> execute();
  $produtos = $query->fetchAll(PDO::FETCH_ASSOC);


 ?>

<!DOCTYPE html>
<html lang="pt" dir="ltr">
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="css/estilo.css">
    <title>Lista de Produtos</title>
  </head>
  <body class="text-center">
    <br><br>
    <div class="container">
      <table> <!-- codar css da tabela -->
        <tr>
          <td><h3>ID</h3></td>
          <td><h3>PRODUTO</h3></td>
          <td><h3>CATEGORIA</h3></td>
          <td><h3>DESCRIÇÃO</h3></td>
          <td><h3>QUANTIDADE</h3></td>
          <td><h3>PREÇO</h3></td>
          <td></td>
        </tr>
        <?php foreach ($produtos as $produto) : ?>
        <tr>
          <td class="font-weight-bold"><?= $produto['ID']?> </td>
          <td class="text-uppercase"><?= $produto['NOME']?> </td>
          <td><?=$produto['CATEGORIA']?></td>
          <td><?= $produto['DESCRICAO']?> </td>
          <td><?= $produto['QUANTIDADE']?></td>
          <td>R$ <?= $produto['PRECO']?> </td>
          <td><a href="showProduto.php?id=<?= $produto['ID']?>">Ver Produto</td>
        </tr>
      <?php endforeach; ?>
    </table>
    </div>

  </body>
  </html>
