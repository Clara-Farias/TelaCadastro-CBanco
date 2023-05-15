<?php
#variaveis
$servidor = "localhost";
$usuario = "root";
$senha = "";
$banco = "form";

$conexao = mysqli_connect($servidor, $usuario,$senha,$banco);

if(!$conexao){
    die("Houve um erro: " . mysqli_connect_error()); # mymysqli_connect_error vai declarar o erro e mysqli_connect_errno o número do erro
}
?>