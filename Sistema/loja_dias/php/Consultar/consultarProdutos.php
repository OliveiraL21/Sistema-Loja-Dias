<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="../../Css/consultarProdutos.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto+Slab&display=swap" rel="stylesheet">
    <title>Consultar Produtos</title>
</head>
<body>

<nav class="nav-bar">

    </nav>
    <header class="menu-principal">
        <aside class="menu-lateral">
            <nav class="menu">
                <div class="logo"><a href="../../index.html"><img id="perfil" src= "../../images/LogoBranco.png" style="width: 60px; height: 60px;"></a></div>
                <ul>
                    <li> <img src="../../images/carrinho-de-compras.png"> <a href="../../cadastrarProduto.html">Produto</a></li>
                    <li> <img src="../../images/produtos.png"><a href="consultarProdutos.php">Consultar Produtos</a></li>
                    <li> <img src="../../images/fornecedor.png"><a href="../../cadastrarFornecedor.html">Fornecedor</a></li>
                    <li> <img src="../../images/fornecedor2.png"><a href="consultarFornecedor.php">Consultar Fornecedores</a></li>
                    <li> <img src="../../images/cliente2.png"><a href="../../cadastrarCliente.html">Cliente</a></li>
                    <li> <img src="../../images/cliente.png"><a href="consultarCliente.php">Consultar Clientes</a></li>
                    <li> <img src="../../images/vendas-baixas.png"><a href="../venda.php">Venda</a></li>
                </ul>
            </nav>
        </aside><!--menu-lateral-->
    </header>


    <table class="tabela">
        <tr>
            <th> Id </th>
            <th> Código de Barra </th>
            <th> Produto </th>
            <th> Quantidade </th>
            <th> Valor </th>
        </tr>

        <?php 
            include('../conecta.php');
           
            $sql = "SELECT * FROM produto";
            $consulta=$pdo->prepare($sql);
            $consulta->execute();
            $linha=$consulta->fetchall(PDO::FETCH_OBJ);
            foreach($linha as $lista){
                echo "<tr><td>".$lista->id_produto."</td><td>".$lista->codigoDeBarra."</td><td>".$lista->nome."</td><td>".$lista->quantidade."</td><td>".$lista->valor."</td></tr>";
            }
            echo "</table>";
        ?>
    </table>
</body>
</html>