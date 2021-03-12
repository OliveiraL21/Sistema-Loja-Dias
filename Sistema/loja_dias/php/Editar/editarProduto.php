<?php
include("../conecta.php");

$id = $_POST['id'];
$codBarra = $_POST['codigoBarra'];
$nome = $_POST['nome'];
$quantidade = $_POST['quantidade'];
$valor = $_POST['valor'];


$sql = "update produto  set  codigoDeBarra= ?, nome= ?, quantidade= ?, valor= ? where id_produto = ? ";
$editar=$pdo->prepare($sql);
$editar->execute(array($codBarra,$nome,$quantidade,$valor,$id));
if($editar)
{
    echo "Edição feita com sucesso!";
    header("location: ../../cadastrarProduto.html");
}

else
{
    echo "Erro ao Editar! "; 
}


?>