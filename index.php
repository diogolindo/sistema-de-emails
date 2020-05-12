<?php
//inicia session
session_start();
?>

<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./styles/styles.css">
    <title>Imposto de Renda Fácil</title>
</head>

<body>

<p id="titulo" class="row">
Adquira Gratuitamente o guia definitivo e simplificado sobre o imposto de renda 2020!
</p><br>

<p id="introducao" class="row">
De forma simples e rápida para a compreensão, chegou o novo guia definitivo explicando exatamente como calcular o Imposto de renda 2020!
E é grátis! Somente repasse seu nome e e-mail abaixo para que assim possamos enviar um e-mail contendo um link para o download gratuito
e seguro.
</p>

<form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST">
    <input type="text" class="form" name="nomeForm" value=""
    class="row" required placeholder="Digite seu nome"
    pattern="^(?![ ])(?!.*[ ]{2})((?:e|da|do|das|dos|de|d'|D'|la|las|el|los)\s*?|(?:[A-Z][^\s]*\s*?)(?!.*[ ]$))+$">
    <input type="email" class="form" name="emailForm" value=""
    class="row" required placeholder="Digite seu e-mail">
    <button type="submit" id="enviar" class="row" name="enviarForm">Resgate o documento grátis</button>
</form>

<?php

//se botão for acionado
if(isset($_POST['enviarForm'])){
    
    //pega dados do formulário
    $nomeForm = $_POST['nomeForm'];
    $emailForm = $_POST['emailForm'];

    //salva no arquivo
    $arquivo = 'usuarios.txt';
    $conteudo = $nomeForm."|".$emailForm."\r\n";
    $arquivoAberto = fopen($arquivo, 'a');
    fwrite($arquivoAberto, $conteudo);
    fclose($arquivoAberto);

    //dados do e-mail que será enviado
    //assunto
    $assunto = "Documento sobre Imposto de renda";
    //conteudo
    $conteudo = "Olá, ".$nomeForm."!\r\n";
    $conteudo .= "Você entrou em contato para receber o guia do Imposto de Renda 2020.\r\n";
    $conteudo .= "Acesse o link a seguir para realizar o download: https://guiaimpostocimol.000webhostapp.com/download.php";
    //adicional
    $headers = "Content-Type: text/plain;charset=utf-8\r\n";

    //envia email
    $status = mail($emailForm, mb_encode_mimeheader($assunto, "utf-8"), $conteudo, $headers);

    if($status){
        $_SESSION['nomeForm'] = $nomeForm;
    ?><p id="status" class="row">Enviado com sucesso!</p>
<?php
    } //fecha if
    else{?><p id="status" class="row">Falha ao enviar!</p>

<?php
    } //fecha else
} //fecha isset
?>

</body>

</html>