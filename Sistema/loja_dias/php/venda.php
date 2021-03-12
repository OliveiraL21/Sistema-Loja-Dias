<?php 


    include('conecta.php');

    //TODA REQUISIÇÃO AJAX DEVE VIR NO COMEÇO, POIS O RETORNO DO AJAX DEVE SER EXCLUSIVAMENTE DO QUE VC ESTA BUSCANDO, CASO VOCÊ COLOCAR NO FINAL DO ARQUIVO, TODO O HTML DA PAGINA SERÁ PROCESSADO E IRÁ SE MISTURAR COM O RESULTADO DO BANCO, NADA DEVE SER ESCRITO OU IMPRIMIDO ANTES DO AJAX.

    if(isset($_POST['codigoBarra'])){

    	//USOU O POST, PQ NO SEU AJAX FOI DEFINIDO COMO POST
        $codigoBarra = $_POST['codigoBarra'];;

        //FAZ A CONSULTA NO BANCO
        $statement = $pdo->prepare("select codigoDeBarra, nome, valor from produto where codigoDeBarra = :codBarras");
        // O simbolo => significa que faz referencia á variavel $codigoBarra
		$statement->execute(array(':codBarras' => $codigoBarra));
		$row = $statement->fetchall();

		//FAZ O PRINT NA TELA POSITIVO OU NEGATIVO
        if( $row)

        	echo  json_encode($row);
        else
        	echo "Nenhum resultado encontrado!";


        exit(); //É NECESSARIO USAR O EXIT, PARA FINALIZAR A EXECUÇÃO DO AJAX AQUI, SENÃO TODA A PAGINA ABAIXO SERÁ PROCESSADA NO AJAX E IRÁ VIR COMO RETORNO
    }
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0,maximum-scale=1.0">
    <link href="../Css/venda.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto+Slab&display=swap" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <title>Vendas</title>
</head>
<body>
    
<nav class="nav-bar">
    </nav>
    <header class="menu-principal">
        <aside class="menu-lateral">
            <nav class="menu">
                <div class="logo"><a href="../index.html"><img id="perfil" src= "../images/LogoBranco.png"></a></div>
                <ul>
                    <li> <img src="../images/carrinho-de-compras.png"> <a href="../cadastrarProduto.html">Produto</a></li>
                    <li> <img src="../images/produtos.png"><a href="Consultar/consultarProdutos.php">Consultar Produtos</a></li>
                    <li> <img src="../images/fornecedor.png"><a href="../cadastrarFornecedor.html">Fornecedor</a></li>
                    <li> <img src="../images/fornecedor2.png"><a href="Consultar/consultarFornecedor.php">Consultar Fornecedores</a></li>
                    <li> <img src="../images/cliente2.png"><a href="../cadastrarCliente.html">Cliente</a></li>
                    <li> <img src="../images/cliente.png"><a href="Consultar/consultarCliente.php">Consultar Clientes</a></li>
                    <li> <img src="../images/vendas-baixas.png"><a href="venda.php">Venda</a></li>
                </ul>
            </nav>
        </aside><!--menu-lateral-->
    </header>
    <section class="venda">
        <form class="form-venda">
            <fieldset class="fieldset-venda">
                <h1>Venda</h1>
                <label>Codigo De Barra:</label><br>
                <input type="text" id="codigoBarra" name="codigoBarra" ><br>

                <button id="codigoBarraBtn" type="button" name="enviar" onclick="recuperarProduto();"> Enviar </button> <!-- QUANDO VOCÊ USA O EVENTO ONCLICK EM UM BOTÃO, O TYPE="" DELE DEVE SER DO TIPO BUTTON, SE FOR DO TIPO SUBMIT, ENVIARÁ O FORMULARIO E NÃO VAI RESPEITAR A CHAMADA DA FUNCAO -->
                
            </fieldset>
        </form>
    </section><!--venda-->

    <section class="venda">
        <form class="form-venda" method="POST">
            <fieldset class="fieldset-venda">
                <h1>Venda</h1>
                <label>Nome do Produto:</label><br>
                <input type="text" id="nome" name="nome" ><br>
                <label> Quantidade:</label><br>
                <input type="text" id="quantidade" name="quantidade"><br>
                <label>Valor:</label><br>
                <input type="text" id="valor" name="valor"><br>
                <div class="botoes">
                    <button class="botao" type="button" name="editar" onclick="mudarQuantidade();">Editar </button> <br>
                    <button class="botao"  type="button" name="adicionar" onclick="adicionar_produto();">Adicionar </button> <br>
                </div>    
            </fieldset>
            <button id="calcular" type="button" name="calcular" onclick="calcular_produto()"> Calcular </button>
        </form>
    </section><!--venda-->

    <?php 

   
    if(isset($_POST['codigoBarra'])){
        $codigoBarra = $_POST['codigoBarra'];
        $nome = $_POST['nome'];
        $quantidade = $_POST['quantidade'];
        
        $sql = "update produto set nome= ?, quantidade= quantidade - ? where codigoDeBarra= ?";
        $update=$pdo->prepare($sql);
        $update->execute(array($nome,$quanitdade,$codigoBarra));
        if($update){
             echo "Edição feita com sucesso!";
        }
        else{
            echo "Erro ao Editar! "; 
        }


    }
    ?>

    <section class="venda">
         <form class="form-venda">
             <fieldset class="fieldset-venda">
                <h1>Produtos Selecionados</h1>

                <table border="1" width="100%">
                    <thead>
                        <tr>
                            <th>Produto</th>
                            <th>Quantidade</th>
                            <th>Valor</th>
                        </tr>
                    </thead>

                    <tbody id="corpo_produtos">
                       
                    </tbody>
                </table>

                <h3 id="span_valor_total">Valor total: R$ 0</h3>
            </fieldset>
        </form>
    </section>
<section class="tabela-Venda">
    <table class="tabela">
        <tr>
            <th> Id </th>
            <th> Código de Barra </th>
            <th> Produto </th>
            <th> Quantidade </th>
            <th> Valor </th>
        </tr>

        <?php 

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
    </section>
    <script type="text/javascript">

    function adicionar_produto (){

        var quantidade = document.getElementById("quantidade").value;
        var valor = document.getElementById("valor").value;
        var produto = document.getElementById("nome").value;

        var corpo_produtos = document.getElementById("corpo_produtos");

        var valor_total_produto = parseInt(quantidade) * parseFloat(valor);
        
        var newLinha = ' <tr>';
        newLinha += '<td>' + produto + '</td>';
        newLinha += '<td>' + quantidade + '</td>';
        newLinha += '<td> <input type="text" class="valor_produto" value="' + valor_total_produto + '"> </td>';
        newLinha += '</tr> ';

        var newRow = corpo_produtos.insertRow(corpo_produtos.rows.length);
        newRow.innerHTML = newLinha;

    }

    function calcular_produto (){

        var produtos_lista = document.getElementsByClassName('valor_produto');
        var text_total = document.getElementById('span_valor_total');

        var total_produtos = produtos_lista.length;
        var total_valor = 0;


        for(i = 0; i < total_produtos; i++){
            total_valor = total_valor + parseFloat(produtos_lista[i].value);
        }

        text_total.innerHTML = 'Valor total: R$ '+total_valor;

        

    }



    mudarQuantidade = () =>{
        // INSTANCIA DA REQUISIÇÃO AJAX
        var Produto = XMLHttpRequest();

        //ITENS PARA ALTERAÇÃO
        var codigoBarra = document.getElementById("codigoBarra").value;
        var nome = document.getElementById("nome");
        var quantidade = document.getElementById("quantidade");

        
        var url = 'venda.php';

        //PARAMETROS QUE SERÁ ENVIADO PARA A REQUISICACAO AJAX
        var params = 'codigoBarra='+codigoBarra;

        produto.open('POST', url, true);
        //HEADER DA REQUISICAO AJAX
        produto.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
        
        produto.onreadystatechange = () =>{
            alert("Produto Alterado !");
        }
    }
    recuperarProduto = () =>{

    	//CRIA A INSTANCIA DA REQUISIÇÃO AJAX
        var produto = new XMLHttpRequest();

        var codigoBarra = document.getElementById("codigoBarra").value;
        var nome = document.getElementById("nome");
        var valor = document.getElementById("valor");

        var url = 'venda.php';

        //PARAMETROS QUE SERÁ ENVIADO PARA A REQUISICACAO AJAX, NO PHP TUDO Q VC COLOCAR AQUI, VC VAI RECEBER COMO POST OU GET.
		var params = 'codigoBarra='+codigoBarra;

		//SE VOCE FOSSE ADICIONAR MAIS UM PARAMETRO, FICARIA ASSIM var params = 'codigoBarra='+codigoBarra'+'&outroparametro=xxx'

		produto.open('POST', url, true);

		//HEADER DA REQUISICAO AJAX, NÃO MUITO IMPORTANTE
		produto.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');


		//QUANDO MUTAR O STATUS DA REQUISIÇÃO AJAX, OU SEJA, EMITIU ALGUM RETORNO, ENTRA NESSA FUNÇÃO
		produto.onreadystatechange = function() {

		    if(produto.readyState == 4 && produto.status == 200) {

		    	//QUANDO VC DA UM ECHO JSON NO PHP, ELE RETORNA UM TEXTO JSON, ENTÃO VC TEM Q CONVERTER PARA O FORMATO JSON DO JS
		        var jsonProduto = JSON.parse(produto.responseText);

                //VC USA O ATRIBUTO VALUE PARA INSERIR DENTRO DO INPUT, O INNERHTML SERIA PARA VC ADICIONAR O RESULTADO AO LADO DO INPUT
		        nome.value = jsonProduto[0].nome;
		        valor.value = jsonProduto[0].valor;
		    }
		}

		//AQUI VC FAZ O ENVIO DOS PARAMETROS INFORMADOS ACIMA. 
		produto.send(params);

	}

		

</script>
</body>

</html>