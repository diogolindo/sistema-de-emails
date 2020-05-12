<?php
session_start();
if(isset($_SESSION['nomeForm'])){ //se tiver repassado email/nome e clicar e recebeu e-mail
    
    if(isset($_POST['enviarForm'])){ //se clicou para fazer download
        // faz as validações
        $aquivoNome = 'scrumFinalCerto.pdf'; // nome do arquivo que será enviado p/ download

        if(file_exists($arquivoNome)){// Verifica se o arquivo não existe
            echo "existe :D<br>";
            // Definimos o novo nome do arquivo
            $novoNome = 'guia.pdf';
            // Configuramos os headers que serão enviados para o browser
            header('Content-Description: File Transfer');
            header('Content-Disposition: attachment; filename="'.$novoNome.'"');
            header('Content-Type: application/octet-stream');
            header('Content-Transfer-Encoding: binary');
            header('Content-Length: ' . filesize($aquivoNome));
            header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
            header('Pragma: public');
            header('Expires: 0');
            // Envia o arquivo para o cliente
            readfile($aquivoNome);
        }
    }
}
if(!isset($_SESSION['nomeForm'])){ //se tentar acessar essa página sem receber email, vai para página para repassar dados para receber e-mail
    header('Location: index.php');
    exit();
}

session_unset();
session_destroy();

?>

<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./styles/styles.css">
    <title>Faça o download</title>
</head>

<body>

<p id="bemvindo" class="row">Olá, <?php echo $_SESSION['nomeForm']; ?></p>
<button type="submit" id="download" class="row" name="enviarForm">Realizar download do documento</button>

</body>

</html>