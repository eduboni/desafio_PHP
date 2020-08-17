<?php
session_start();
unset($_SESSION['acesso']);

include 'database/db.php';

$query = $db-> prepare ("SELECT *
  FROM users;");
  $query -> execute();
  $acessos = $query->fetchAll(PDO::FETCH_ASSOC);

  if ($_POST) {
    foreach ($acessos as $acesso) {
      if ($_POST['email'] == $acesso['EMAIL']){
        if (password_verify($_POST['pass'], $acesso['SENHA'])){
          $_SESSION['acesso']=$acesso['NOME'];
          header('Location: http://localhost/desafio_PHP/indexProdutos.php');
          // unset($_SESSION['acesso']);
        }
      }
    }
    $erro = 'Dados não conferem: verifique seu e-mail e/ou senha';
  }

?>

<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="css/estilo.css">
    <title>Login</title>
</head>
<body>
<div>
        <h1>Faça o login no sistema</h1>
        <form action="index.html" name="login" method="POST">
            <label for="email">E-mail</label>
                <input type="text" name="email"></input><br>
            <label for="senha">Senha</label>
                <input type="text" name="pass"></input>
            <? php if (isset(($erro)){
                echo $erro; 
            }
            ?>
            <input type="submit" value="Enviar">
        </form>
    </div>
</body>
</html>