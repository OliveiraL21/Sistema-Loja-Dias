<?php 

include("../conecta.php");


$cpf = $_POST['cpf'];
$nome = $_POST['nome'];
$idade = $_POST['idade'];
$rg = $_POST['rg'];
$endereco = $_POST['endereco'];
$telefone = $_POST['telefone'];

$gravar = $pdo->prepare("insert into cliente (cpf, nome, idade, rg, endereco, telefone) values(?,?,?,?,?,?)");
if($gravar->execute(array($cpf,$nome,$idade,$rg,$endereco,$telefone)))
{
    echo "Registro Gravado com Suceso";
    header("location:../../cadastrarCliente.html");

}
else
{
    echo "Erro ao cadastrar o Registro";
}




?>