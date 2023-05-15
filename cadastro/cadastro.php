<?php
include("connection.php");

if(isset($_FILES['imagemNov'])){
  $arquivo = $_FILES['imagemNov'];
  $senha = $_POST['senha'];
  $email = $_POST['email'];

  if($arquivo['error'])
      die("Falha ao enviar arquivo");


  if($arquivo['size'] > 2097152)
      die("Arquivo muito grande! Max: 2mb");

  $pasta = "./arquivos/";
  $nomeDoArquivo = $arquivo['name'];
  $novoNomeDoArquivo = uniqid();
  $extensao = strtolower(pathinfo($nomeDoArquivo, PATHINFO_EXTENSION));
  $path = $pasta . $novoNomeDoArquivo . "." . $extensao;

  if($extensao != "jpg" && $extensao != "png")
      die("Tipo de arquivo não aceito!");

  $deu_certo = move_uploaded_file($arquivo["tmp_name"], $pasta . $novoNomeDoArquivo . "." . $extensao) or die($mysqli->error);

  if($deu_certo) 
      $conexao -> query("INSERT INTO usuarios (email,senha, caminho) VALUES ('$email', '$senha', '$nomeDoArquivo')");
  // echo "<p>Arquivo enviado com sucesso! Para acessá-lo, <a target=\"_blank\" href=\"./arquivos/$novoNomeDoArquivo.$extensao\">Clique aqui</a></p>";
  else
      echo "<p>Falha ao enviar arquivo</p>";
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="style.css"/>
    <title>Cadastro</title>
</head>
<body>
    <div class="container" >
    <div class="content">           
      <!--FORMULÁRIO DE CADASTRO-->
      <div id="cadastro">
        <form method="POST" action="cadastro.php" enctype="multipart/form-data"> 
          <h1>Cadastro de Usuário</h1> 
      
          <p> 
            <label for="">Email</label>
            <input type="email" name="email"/> 
          </p>
          <p> 
            <label for="">Senha</label>
            <input type="password" name="senha"/>
          </p>
          <p> 
          <label for="imagemNov">Upload de imagem:</label>
		      <input type="file" id="imagemNov" name="imagemNov"><br><br>
          </p>
          <p>
            <input type="submit" value="Cadastrar"/> 
          </p>
        </form>
      </div>
</body>
</html>