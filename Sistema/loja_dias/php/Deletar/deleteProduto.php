<?php 
    include('../conecta.php');

    $id = $_POST['id'];

    $sql = "delete from produto where id_produto = ?";

    $delete=$pdo->prepare($sql);
    $delete->bindValue(":id_produto",$id,PDO::PARAM_INT);
    $delete->execute(array($id));

    header('location: ../../cadastrarProduto.html');


?>