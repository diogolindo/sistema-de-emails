<?php

if(!isset($_GET['acesso'])){
    header('Location: index.php');
    exit();
}

?>

<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./styles/styles.css">
    <title>Faça o download</title>
</head>

<body>

<div id="corpodown">
    <p class="insira" id="bemvindo" class="row">Bem vindo!</p>
    
    <a href="guia.pdf" download="Guia Imposto de Renda.pdf">
    <button type="submit" class="enviar" class="row" name="enviarForm">Realizar download do documento</button>
    </a>
</div>

</body>

</html>