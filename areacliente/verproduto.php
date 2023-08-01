<?php

include("../conectadb.php");

session_start();
// COLETA DE DADOS DE CLIENTE NA SESSÃO
$idcliente = $_SESSION['idcliente'];

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $id = $_POST['id'];
    $nomeproduto = $POST['nomeproduto'];
    $quantidade = $_POST['quantidade'];
    $preco = $_POST['preco'];
    // TOTAL ITEM É A SOMA DO PREÇO UNITARIO * QUANTIDADE
    $totalitem = ($preco * $quantidade);
    // GERAR UM HASH PARA DEFINIR UM CARRINHO ÚNICO E EXCLUSIVO
    $numerocarrinho = MD5($_SESSION['idcliente'].date('d-m-Y H:i:s'));

    // VALIDA CLIENTE
    if($idcliente <= 0){
        echo"<script>window.alert('VOCÊ PRECISA LOGAR PARA ADD ITEM AO CARRINHO');</script>";
        echo"<script>window.location.href='loja.php';</script>";
    }
    else{
        // VERIFICA SE O CLIENTE TEM CARRINHO ABERTO
        $sql = "SELECT COUNT(car_numero_carrinho) FROM itens_carrinho INNER JOIN clientes ON fk_cli_id = cli_id
        WHERE cli_id = '$idcliente' AND car_finalizado = 'n'";
        $retorno = mysqli_query($link, $sql);

        while($tbl = mysqli_fetch_array($retorno)){
            $count = $tbl[0];

            if($count == 0 ){
                // SE O CARRINHO NÃO EXISTE NO BANCO, GERA UM NOVO MD5 E INSERE OS ITENS
                // NA TABELA

                $sql = "INSERT INTO itens_carrinho (fk_pro_id, car_item_quantidade, fk_cli_id, car_total_item,
                car_numero_carrinho, car_finalizado)
                VALUES($id, '$quantidade', '$idcliente', '$totalitem' '$numerocarrinho', 'n')";
                mysqli_query($link, $sql);
                $_SESSION['carrinhoid'] = $numerocarrinho;
                echo"<script>window.alert('PRODUTO ADICIONADO AO CARRINHO');</script";
                echo"<script>window.location.href='loja.php';</script>";
            }
            else{
                // SE O CARRINHO EXISTE, CONSULTA O NUMERO DO CARRINHO PARA ADD ITENS AO CARRINHO
                $sql = "SELECT DISTINCT(car_numero_carrinho) FROM itens_carrinho
                WHERE fk_cli_id = '$idcliente' AND car_finalizado = 'n'";
                $retorno = mysqli_query($link,$sql);

                while($tbl = mysqli_fetch_array($retorno))
                {
                    $numerocarrinhocliente = $tbl[0];
                    $_SESSION['carrinhoid'] = $numerocarrinhocliente;
                    $sql = "INSERT INTO itens_carrinho (fk_pro_id, car_item_quantidade, fk_cli_id, car_total_carrinho,
                    car_numero_carrinho, car_finalizado)
                    VALUES($id, '$quantidade', '$idcliente', '$totalitem', '$numerocarrinhocliente', 'n'";

                    mysqli_query($link, $sql);
                    echo"<script>window.alert('PRODUTO ADICIONADO AO CARRINHO $numeroarrinhocliente');</script>";
                    echo"<script>window.location.href='loja.php';</script>";
                }
            }
        }
    }
}


//TRAZENDO DADOS VIA URL (GET)
$id = $_GET['id'];
$sql = "SELECT * FROM produtos WHERE pro_id = '$id'";

$retorno = mysqli_query($link, $sql);
while($tbl = mysqli_fetch_array($retorno)){
    $nomeproduto = $tbl[1];
    $descricao = $tbl[2];
    $preco = $tbl[5];
    $imagem_atual = $tbl[7];
}

?>

<!DOCTYPE html>
<html lang="pt br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/estiloadm.css">
    <title>LOJA PRODUTOS</title>
</head>

<body>

    <div>
        <ul class="menu">
            <li><a href="cadastrausuario.php">CADASTRA USUARIO</a></li>
            <li><a href="cadastracliente.php">CADASTRA CLIENTE</a></li>
            <li><a href="cadastraproduto.php">CADASTRA PRODUTO</a></li>
            <li><a href="listausuario.php">LISTA USUARIO</a></li>
            <li><a href="listacliente.php">LISTA CLIENTE</a></li>
            <li><a href="listaproduto.php">LISTA PRODUTO</a></li>
            <li class="menuloja"><a href="./areacliente/loja.php">LOJA</a></li>
            <?php
            #ABERTO O PHP PARA VALIDAR SE A SESSÂO DO USUARIO ESTÁ ABERTA
            #SE SESSÃO ABERTA, FECHA O PHP PARA USAR ELEMENTOS HTML
            if ($nomeusuario != null) {
            ?>
                <!-- USO DO ELEMENTO HTML COM O PHP INTERNO -->
                <li class="profile">OLÁ <?= strtoupper($nomeusuario) ?></li>
            <?php
                #ABERTURA DE OUTRO PHP CASO FALSE
            } else {
                echo "<script>window.alert('USUARIO NÃO AUTENTICADO');window.location.href='login.php';</script>";
            }
            #FIM DO PHP PARA CONTINUAR MEU HTML
            ?>
        </ul>
    </div>
    <!-- MENU DA LOJA -->
    <header>
        <nav>
            <ul class="menu">
                <li><a href="loja.php"></a>home</li> <!-- BOTÃO HOME -->
                <li><a href="#"></a>PRODUTOS</li>

                <!-- VALIDA SE O CLIENTE LOGOU -->
                <?php
                if (isset($_SESSION['idcliente'])) {
                ?>
                    <form class="formmenu" action="logout.php" method="post">
                        <h3 class="menu-right2">
                            olá <?= $_SESSION['nomecliente']; ?>
                        </h3>
                        <li class="menu-right"><a href="perfil.php?id=<?= $sessao_idcliente ?>">PERFIL</a></li>
                        <li class="menu-right"><a href="logout.php">LOGOUT</a></li>
                    </form>
                <?php
                } else {

                ?>
                    <form class="formmenu2">
                        <li class="menu-right"><a href="logincliente.php" style="float: right">ENTRAR</a></li>
                        <li class="menu-right"><a href="cadastracliente.php">CADASTRAR</a></li>
                    </form>

                <?php
                }
                ?>
            </ul>
        </nav>
    </header>
    <!--Fim menu-->

    <div class="formulario">
        <form class="visualizaproduto" action="alteraproduto.php" method="post" enctype="multipart/form-data">
            <input type="hidden" name="id" id="nome" value="<?= $id ?>">
            <label>NOME</label>
            <input type="text" name="nome" id="nome "value="<?= $nomeproduto ?>">

            <label>DESCRIÇÃO</label>
            <textarea name="descricao" readonly><?= $descricao ?></textarea>

            <label>QUANTIDADE</label>
            <input type="number" name="quantidade" id="quantidade">

            <label>PREÇO</label>
            <input type="decimal" name="preco" id="preço" value="<?= $preco ?>" readonly>

            <br>

            <input type="submit" value="ADICIONAR AO CARRINHO">

        </form>
    </div>
    <div>
        <!-- PEÇA ESSENCIAL PARA COLETAR A IMAGEM ATUAL -->
        <td><img name="imagem_atual" class="imagem_atual" src="data:image/jpeg;base64,<?= $imagem_atual ?>"></td>
    </div>

</body>

</html>