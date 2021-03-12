<?php 
    include('../conecta.php');

    $id = $_POST['id'];

    $sql = "delete from cliente where id_cliente = ?";

    $delete=$pdo->prepare($sql);
    $delete->bindValue(":id_cliente",$id,PDO::PARAM_INT);
    $delete->execute(array($id));

    header('location: ../../cadastrarProduto.html');


?>