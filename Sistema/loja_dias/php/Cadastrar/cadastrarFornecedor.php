<?php 

include("../conecta.php");


$nome = $_POST['nome'];
$cnpj = $_POST['cnpj'];
$telefone = $_POST['telefone'];

$gravar = $pdo->prepare("insert into fornecedor (nome, cnpj, telefone) values(?,?,?)");
if($gravar->execute(array($nome,$cnpj,$telefone)))
{
    echo "Registro Gravado com Suceso";
    header("location:../../cadastrarFornecedor.html");

}
else
{
    echo "Erro ao cadastrar o Registro";
}




?>