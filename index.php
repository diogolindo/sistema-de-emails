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

<div id="corpo" class="row">
    <div id="esquerda">
        <p id="titulo" class="row">
        Adquira Gratuitamente o guia definitivo e simplificado sobre o imposto de renda 2020!
        </p><br>

        <p id="introducao" class="row">
        De forma simples e rápida para a compreensão, chegou o novo guia definitivo explicando exatamente como calcular o Imposto de renda 2020!
        E é grátis! Somente repasse seu nome e e-mail para que assim possamos enviar um e-mail contendo um link para o download gratuito e seguro.<br>
        Observação: o e-mail pode levar alguns minutos para ser enviado assim como pode cair na caixa de spams.
        </p>
    </div>

    <div id="direita">
        <p class="insira">INSIRA SEU NOME E E-MAIL AQUI PARA RECEBER O DOCUMENTO TOTALMENTE GRATUITO</p>
        <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST">
            <input type="text" class="form" name="nomeForm" value=""
            class="row" required placeholder="Digite seu nome"
            pattern="^(?![ ])(?!.*[ ]{2})((?:e|da|do|das|dos|de|d'|D'|la|las|el|los)\s*?|(?:[A-Z][^\s]*\s*?)(?!.*[ ]$))+$">
            <input type="email" class="form" name="emailForm" value=""
            class="row" required placeholder="Digite seu e-mail">
            <button type="submit" class="enviar" class="row" name="enviarForm">RESGATE O DOCUMENTO</button>
        </form>
    </div>
</div>

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

    //controle de acesso
    $data = date("d/m/Y");
    $acesso = md5($data);

    //dados do e-mail que será enviado
    //assunto
    $assunto = "Documento sobre Imposto de renda";
    //conteudo
    $conteudo = "Olá, ".$nomeForm."!\r\n";
    $conteudo .= "Você entrou em contato para receber o guia do Imposto de Renda 2020.\r\n";
    $conteudo .= "Acesse o link a seguir para realizar o download: https://diogoimpostocimol.000webhostapp.com/download.php?acesso=".$acesso;
    //adicional
    $headers = 'From: Guia do Imposto <diogo-kengelmann@educar.rs.gov.br>'."\r\n" .
        'Reply-To: diogo-kengelmann@educar.rs.gov.br '. "\r\n" .
        'X-Mailer: MyFunction/' . phpversion().
        'MIME-Version: 1.0' . "\n".
        'Content-type: text/html; charset=UTF-8' . "\r\n";
    $_SESSION['nomeForm'] = $nomeForm;
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