<?php
session_start();
if (!$_SESSION['acesso']){
  header ('Location: http://localhost/desafio_PHP/login.php');
}

include 'includes/db.php';
include 'includes/header.php';

$extensoesValidas = ['image/jpeg','image/png', 'image/jpg'];
$salvo;
$msg="";

if ($_POST){
    if ($_FILES['fotoProduto'] == 1) {
      if (array_search($_FILES['fotoProduto']['type'], $extensoesValidas) == false) {
        $msg="Extensão do arquivo inválida! Insira um arquivo JPG, PNG ou JPEG";
      }
      else {
        $query = $db->prepare("INSERT INTO produtos 
          (nome,
          categoria,
          descricao,
          quantidade,
          preco,
          foto)
          VALUES (:nome,
            :categoria,
            :descricao,
            :quantidade,
            :preco,
            :foto);");

            $salvo=$query->execute([':nome'=>$_POST['nomeProduto'],
            ':categoria'=>$_POST['categoriaProduto'],
            ':descricao'=>$_POST['descricaoProduto'],
            ':quantidade'=>$_POST['quantidadeProduto'],
            ':preco'=>$_POST['precoProduto'],
            ':foto'=>$_FILES['fotoProduto'] ['name']]);

            $idInserido = $db->lastInsertId();
            echo "Produto cadastrado com sucesso";
            move_uploaded_file($_FILES['fotoProduto']['tmp_name'],'../Desafio_PHP/database/'.$idInserido.'.jpg');
          }
        }
        else {
          $msg="Erro no envio! Tente novamente.";
        }
      }

    if(isset($salvo)){
      header ('Location: http://localhost/desafio_PHP/indexProdutos.php');
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="css/estilo.css">
    <title>Cadastro de Produtos</title>
</head>
<body>
    <div class="cadastro">
        <h1>Cadastrar produto</h1>
        <form action="createProduto.html" name="cadastroProduto" method="POST">
            <label for="nomeProduto"></strong>Nome</label>
                <input type="text" name="nomeProduto" placeholder="Insira o nome do produto"></input><br>
            <label for="categoria">Categoria</label>
                <input type="text" name="categoriaProduto" placeholder="Indique a categoria"></input>
            <label for="descricao">Descrição</label>
                <input type="text" name="descricaoProduto" placeholder="Escreva da descrição"></input>
            <label for="quantidade">Quantidade</label>
                <input type="text" name="quantidadeProduto" placeholder="Insira o preço"></input>
            <label for="preco">Preço</label>
                <input type="text" name="precoProduto"></input>
            <label for="fotoProduto">Foto do produto</label>
                <input type="file"  accept="image/jpeg, image/png, image/jpg" name="fotoProduto" required>   
                <?php echo $msg;?>
            <br>
            <br>
            <input type="submit" value="Enviar">Cadastrar produto</input>
        </form>
    </div>
</body>
</html>