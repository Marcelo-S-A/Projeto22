<?php
include("conectadb.php");

session_start();
$nomeusuario = $_SESSION["nomeusuario"];

#TRAZ DADOS DO BANCO PARA COMPLETAR OS CAMPOS
$id = $_GET['id'];
$sql = "SELECT * FROM clientes WHERE cli_id = '$id'";
$retorno = mysqli_query($link, $sql);

#PREENCHENDO O ARRAY SEMPRE
while ($tbl=mysqli_fetch_array($retorno)) {

    $cpf = $tbl[1];
    $nome = $tbl[2]; #CAMPO NOME DA TABELA DO BANCO
    $datanasc = $tbl[4];
    $telefone = $tbl[5];
    $logradouro = $tbl[6];
    $numero = $tbl[7];
    $cidade = $tbl[8];
    $ativo = $tbl[9]; #CAMPO ATIVO DA TABELA DO BANCO
    
}

#USUARIO CLICA NO BOTÃO SALVAR
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];
    $cpf = $_POST['cpf'];
    $nome = $_POST['nome'];
    $senha = $_POST['senha'];
    $datanasc = $_POST['datanasc'];
    $telefone = $_POST['telefone'];
    $logradouro = $_POST['logradouro'];
    $numero = $_POST['numero'];
    $cidade = $_POST['cidade'];
    $ativo = $_POST['ativo'];

    $sql = "UPDATE usuarios SET cli_cpf = '$cpf',cli_nome = '$nome', cli_senha = '$senha',cli_datanasc = '$datanasc'
    cli_telefone = '$telefone',cli_logradouro = '$logradouro',cli_numero = 'numero',cli_cidade = '$cidade', usu_ativo = '$ativo'
    WHERE usu_id = $id";

    mysqli_query($link, $sql);

    echo "<script>window.alert('CLIENTE ALTERADO COM SUCESSO!');</script>";
    echo "<script>window.location.href='admhome.php';</script>";
}
?>



<!DOCTYPE html>
<html lang="pt br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/estiloadm.css">
    <title>ALTERA CLIENTES</title>
</head>

<body>
    <div>
        <ul class="menu">
            <li><a href="cadastrausuario.php">CADASTRA USUARIO</a></li>
            <li><a href="cadastracliente.php">CADASTRA CLIENTE</a></li>
            <li><a href="listausuario.php">LISTA USUARIO</a></li>
            <li><a href="listacliente.php">LISTA CLIENTE</a></li>
            <li><a href="cadastraproduto.php">CADASTRA PRODUTO</a></li>
            <li><a href="listaproduto.php">LISTA PRODUTO</a></li>
            <li><a href="listacliente.php">LISTA CLIENTE</a></li>
            <li class="menuloja"><a href="./areacliente/loja.php">LOJA</a></li>
        </ul>
    </div>

    <div>
        <div>

            <form action="alterausuario.php" method="post">
                <input type="hidden" name="id" value="<?= $id ?>">
                <br>
                <input type="number" name="cpf" value="<?= $cpf ?>" required placeholder="CPF">
                <br>
                <input type="text" name="nome" id="nome" value="<?= $nome ?>" required placeholder="NOME">
                <br>
                <input type="password" name="senha" id="senha" value="<?= $senha ?>" required placeholder="SENHA">
                <br>
                <input type="data" name="datanasc" id="datanasc" value="<?= $datanasc ?>" required placeholder="DATA DE NASCIMENTO">
                <br>
                <input type="number" name="telefone" id="telefone" value="<?= $telefone ?>" required placeholder="TELEFONE">
                <br>
                <input type="text" name="logradouro" id="logradouro" value="<?= $logradouro ?>" required placeholder="LOGRADOURO">
                <br>
                <input type="number" name="numero" id="numero" value="<?= $numero ?>" required placeholder="NUMERO">
                <br>
                <input type="text" name="cidade" id="cidade" value="<?= $cidade ?>" required placeholder="CIDADE">
                <br>
                <input type="radio" name="ativo" value="s" <?= $ativo == "s" ? "checked" : "" ?>>ATIVO>
                <br>
                <input type="radio" name="ativo" value="n" <?= $ativo == "n" ? "checked" : "" ?>>INATIVO>
                <br>
                <input type="submit" name="salvar" id="salvar" value="SALVAR">
            </form>

        </div>
    </div>

</body>

</html>
