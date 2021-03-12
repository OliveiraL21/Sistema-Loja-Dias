<?php 
    include('../conecta.php');

    $id = $_POST['id'];

    $sql = "delete from fornecedor where id_fornecedor = ?";

    $delete=$pdo->prepare($sql);
    $delete->bindValue(":id_fornecedor",$id,PDO::PARAM_INT);
    $delete->execute(array($id));

    header('location: ../../cadastrarProduto.html');


?>