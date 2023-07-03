<!DOCTYPE html>
<html lang="pt br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/estiloadm.css"
    <title>CADASTRA PRODUTOS</title>
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

    <!-- ESTRUTURA DA PÁGINA -->
    <form action="cadastraproduto.php" method="post" enctype="multipart/form-data">
        <label>NOME DO PRODUTO</label>
        <input type="text" name="nome" id="nome">
        <br>

        <label>DESCRIÇÃO</label>
        <textarea name="descricao" id="descricao" rows="4" resize="none"></textarea>
        <br>

        <label>QUANTIDADE</label>
        <input type="number" name="quantidade" id="quantidade">
        <br>

        <label>CUSTO</label>
        <input type="number" name="quantidade" id="quantidade">
        <br>

        <label>PREÇO</label>
        <input type="" name="" id="">
        <br>

        <label>IMAGEM</label>
        <input type="" name="" id="">
        <br>

    </form>


</body>
</html>