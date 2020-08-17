<?php
session_start();
if (!$_SESSION['acesso']){
  header ('Location: http://localhost/desafio_PHP/login.php');
}

include 'includes/db.php';
include 'header.php';

$id = $_GET['id'];

$query = $db->prepare ("SELECT nome, categoria, descricao, quantidade, preco, foto  
  FROM produtos
  WHERE id=:id;");
  $query->execute([':id' => $id]);

  $produtos=$query->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="css/estilo.css">
    <title>Dados do Produto</title>
</head>
<body>
    <? foreach ($produtos as $produto):?>
<div id="div_produto">
    <div id="div_containerImage">
        <button>Voltar para lista de produtos</button>
        <div id="imagemProduto">
            <image src="desafio_PHP/database/<?$id;?>.jpg" alt="<?$produto['nomeProduto']?>" width="100%">
        </div>
    </div>
    <div id="div_containerInfos">
        <h1 id="nomeProduto">Nome do produto</h1>
        <p><? $produto['nomeProduto']?></p>
        <h5>Categoria</h5>
        <p><? $produto['categoriaProduto']?></p>
        <h5>Descrição</h5>
        <p><? $produto['descricaoProduto']?></p>
        <br>
        <div id="qtd_preco"> 
            <div id="qtd">
                <h5>Quantidade em estoque</h5>
                <p><? $produto['quantidadeProduto']?></p>
            </div>
            <div id="preco">
                <h5>Quantidade em estoque</h5>
                <p>R$ <? $produto['precoProduto']?></p>
            </div>
            <form action="removeProduto.php" method="post">
                <button type="submit" id="excluirProduto" name="id">Excluir produto</button>
            </form>
        </div>
    </div>
   <? endforeach;?>
</div>
</body>
</html>