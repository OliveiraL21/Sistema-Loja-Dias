<?php
include("../conecta.php");
if(isset($_POST['id'])){
    $id = $_POST['id'];
    $nome = $_POST['nome'];
    $cnpj = $_POST['cnpj'];
    $telefone = $_POST['telefone'];


    $sql = "update fornecedor  set  nome= ?,cnpj= ?, telefone= ? where id_fornecedor = ? ";
    $editar=$pdo->prepare($sql);
    $editar->execute(array($nome,$cnpj,$telefone,$id));
    if($editar)
    {
        echo "Edição feita com sucesso!";
        header("location: ../../cadastrarFornecedor.html");
    }

    else
    {
        echo "Erro ao Editar! "; 
    }

}


?>