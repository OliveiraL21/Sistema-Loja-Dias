<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="../../Css/consultarCliente.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto+Slab&display=swap" rel="stylesheet">
    <title>Consultar Cliente</title>
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
            <th> Cpf </th>
            <th> Nome </th>
            <th> Idade </th>
            <th> Rg </th>
            <th> Endereço </th>
            <th> Telefone </th>
        </tr>

        <?php 
            include('../conecta.php');
          ;

            $sql = "SELECT * FROM cliente";
            $consulta=$pdo->prepare($sql);
            $consulta->execute();
            $linha=$consulta->fetchall(PDO::FETCH_OBJ);
            foreach($linha as $lista){
                echo "<tr><td>".$lista->id_cliente."<td>".$lista->cpf."</td><td>".$lista->nome."</td><td>".$lista->idade."</td><td>".$lista->rg."</td><td>".$lista->endereco."</td><td>"
                .$lista->telefone."</td></tr>";
            }
            echo "</table>";
        ?>
    </table>
</body>
</html>