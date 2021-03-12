<?php 

include("../conecta.php");

$codBarra = $_POST['codigoBarra'];
$nome = $_POST['nome'];
$quantidade = $_POST['quantidade'];
$valor = $_POST['valor'];

$gravar = $pdo->prepare("insert into produto (codigoDeBarra, nome, quantidade, valor) values(?,?,?,?)");
if($gravar->execute(array($codBarra,$nome,$quantidade,$valor)))
{
    echo "Registro Gravado com Suceso";
    header("location:../../cadastrarProduto.html");

}
else
{
    echo "Erro ao cadastrar o Registro";
}




?>