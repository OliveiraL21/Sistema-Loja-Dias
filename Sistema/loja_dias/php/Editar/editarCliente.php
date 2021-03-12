<?php
include("../conecta.php");

$id = $_POST['id'];
$cpf = $_POST['cpf'];
$nome = $_POST['nome'];
$idade = $_POST['idade'];
$rg = $_POST['rg'];
$endereco = $_POST['endereco'];
$telefone = $_POST['telefone'];


$sql = "update cliente  set cpf= ?, nome= ?, idade= ?,  rg= ?, endereco= ?, telefone= ? where id_cliente = ? ";
$editar=$pdo->prepare($sql);
$editar->execute(array($cpf,$nome,$idade,$rg,$endereco,$telefone,$id));
if($editar)
{
    echo "Edição feita com sucesso!";
    header("location: ../../cadastrarCliente.html");
}

else
{
    echo "Erro ao Editar! "; 
}


?>