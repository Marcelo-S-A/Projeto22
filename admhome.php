<?php
    session_start();
    $nomeusuario = $_SESSION['nomeusuario'];
    echo("AQUI É O NOME DO MELIANTE ");
?>
<!DOCTYPE html>
<html lang="pt br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/estiloadm.css"> 
    <title>MENU ADMINISTRATIVO</title>
</head>
<body>
    <div>
            <ul class="menu">
                <li><a href="cadastrausuario.php">CADASTRA USUARIO</a></li>
                <li><a href="cadastrausuario.php">LISTA USUARIO</a></li>
                <li><a href="cadastrausuario.php">CADASTRA PRODUTO</a></li>
                <li><a href="cadastrausuario.php">LISTA PRODUTO</a></li>
                <li><a href="cadastrausuario.php">LISTA CLIENTE</a></li>
                <li class="menuloja"><a href="logout.php">SAIR</a></li>
                <?php
                #ABERTO O PHP PARA VALIDAR SE A SESSÂO DO USUARIO ESTÁ ABERTA
                #SE SESSÃO ABERTA, FECHA O PHP PARA USAR ELEMENTOS HTML
                if($nomeusuario != null){
                    ?>
                    <!-- USO DO ELEMENTO HTML COM O PHP INTERNO -->
                    <li class="profile">OLÁ <?=strtoupper($nomeusuario)?></li>
                    <?php
                    #ABERTURA DE OUTRO PHP CASO FALSE
                }
                else{
                    echo"<script>window.alert('USUARIO NÃO AUTENTICADO');window.location.href='login.php';</script>";
                }
                #FIM DO PHP PARA CONTINUAR MEU HTML
                ?>
            </ul>
    </div>
</body>
</html>