<?php

include("conectadb.php");




session_start();
$nomeusuario = $_SESSION["nomeusuario"];



if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $id = $_GET['id'];

    $cpf = $_POST['cpf'];

    $nome = $_POST['nome'];

    $senha = $_POST['senha'];

    $datanasc = $_POST['datanasc'];  

    $telefone = $_POST['telefone'];

    $logradouro = $_POST['logradouro'];

    $numero = $_POST['numero'];

    $cidade = $_POST['cidade'];

    $ativo = $_POST['ativo'];




    $sql = "UPDATE clientes SET cli_cpf = ?, cli_nome = ?, cli_senha = ?, cli_datanasc = ?, cli_telefone = ?, cli_logradouro = ?, cli_numero = ?, cli_cidade = ?, cli_ativo = ? WHERE cli_id = ?";

   

    $stmt = mysqli_prepare($link, $sql);

    mysqli_stmt_bind_param($stmt, "sssssssssi", $cpf, $nome, $senha, $datanasc, $telefone, $logradouro, $numero, $cidade, $ativo, $id);

    mysqli_stmt_execute($stmt);




    echo "<script>window.alert('USUARIO ALTERADO COM SUCESSO');</script>";

    echo "<script>window.location.href='admhome.php';</script>";

}




$id = $_GET['id'];

$sql = "SELECT * FROM clientes WHERE cli_id = ?";

$stmt = mysqli_prepare($link, $sql);

mysqli_stmt_bind_param($stmt, "i", $id);

mysqli_stmt_execute($stmt);

$result = mysqli_stmt_get_result($stmt);




if ($row = mysqli_fetch_assoc($result)) {

    $cpf = $row['cli_cpf'];

    $nome = $row['cli_nome'];

    $senha = $row['cli_senha'];

    $datanasc = $row['cli_datanasc'];  

    $telefone = $row['cli_telefone'];

    $logradouro = $row['cli_logradouro'];

    $numero = $row['cli_numero'];

    $cidade = $row['cli_cidade'];

    $ativo = $row['cli_ativo'];

}

?>




<!DOCTYPE html>

<html lang="pt br">




<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="./css/estiloadm.css">




    <title>ALTERA CLIENTE</title>

</head>




<body>

    <div>

        <ul class="menu">

            <li><a href="cadastrausuario.php">CADASTRA USUARIO</a></li>

            <li><a href="cadastracliente.php">CADASTRA CLIENTE</a></li>

            <li><a href="listausuario.php">LISTA USUARIO</a></li>

            <li><a href="cadastraproduto.php">CADASTRA PRODUTO</a></li>

            <li><a href="listaproduto.php">LISTA PRODUTO</a></li>

            <li><a href="listacliente.php">LISTA CLIENTE</a></li>

            <li class="menuloja"><a href="logout.php">SAIR</a></li>

            <li class="menuloja"><a href="./areacliente/loja.php">LOJA</a></li>

        </ul>

    </div>




    <div>

        <form action="alteraclientes.php?id=<?= $id ?>" method="post">

           

            <br>

            <input type="number" name="cpf" value="<?= $cpf ?>" required placeholder="cpf">

            <br>

            <input type="text" name="nome" value="<?= $nome ?>" required placeholder="nome">

            <br>

            <input type="password" name="senha" value="<?= $senha ?>" required placeholder="senha">

            <br>

            <input type="date" name="datanasc" value="<?= $datanasc ?>" required placeholder="datanasc">

            <br>

            <input type="number" name="telefone" value="<?= $telefone ?>" required placeholder="telefone">

            <br>

            <input type="text" name="logradouro" value="<?= $logradouro ?>" required placeholder="logradouro">

            <br>

            <input type="number" name="numero" value="<?= $numero ?>" required placeholder="numero">

            <br>

            <input type="text" name="cidade" value="<?= $cidade ?>" required placeholder="cidade">

            <br>

            <input type="radio" name="ativo" value="s" <?= $ativo == "s" ? "checked" : "" ?>>ATIVO>

            <br>

            <input type="radio" name="ativo" value="n" <?= $ativo == "n" ? "checked" : "" ?>>INATIVO>

            <br>

            <input type="submit" name="salvar" value="SALVAR">

        </form>




    </div>




</body>




</html>