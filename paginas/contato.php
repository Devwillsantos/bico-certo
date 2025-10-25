<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contato</title>
    <link rel="icon" href="../imagens/icones-aba/icone16.ico" sizes="16x16">
    <link rel="icon" href="../imagens/icones-aba/icone24.ico" sizes="24x24">
    <link rel="icon" href="../imagens/icones-aba/icone32.ico" sizes="32x32">
    <link rel="icon" href="../imagens/icones-aba/icone48.ico" sizes="48x48">
    <link rel="stylesheet" href="../css/contato.css">
</head>
<body>
    <div class="container">
        <div class="container-esquerdo">
            <img src="../imagens/imagem-contato.jpg" class="imagem">
        </div>
        <div class="container-direito" id="container-direito">
            <img src="../imagens/logomarca.png" class="logomarca" id="logomarca">
            <img src="../imagens/logomarca-dark-mode.png" class="logomarca-dark-mode" id="logomarca-dark-mode">
            <form action="https://api.web3forms.com/submit" method="POST" id="form">
                <div class="campo">
                    <input id="nome" type="text" class="nome required" name="nome" placeholder="Nome Completo" oninput="nameValidate()">
                    <span class="span-required">Digite um nome.</span>
                </div>
                <div class="campo">
                    <input id="email" type="email" class="email required" name="e-mail" placeholder="E-mail" oninput="emailValidate()">
                    <span class="span-required">Digite um E-mail válido.</span>
                </div>
                <div class="campo">
                    <textarea class="mensagem required" id="mensagem" name="mensagem" placeholder="Digite aqui sua mensagem." maxlength="500" oninput="mensagemValidate()"></textarea>
                    <span class="span-required">Digite uma mensagem.</span>
                </div>
                <div class="campo">
                    <button type="submit" class="botao-de-enviar">
                        Enviar
                    </button>
                    <a href="../index.html" class="botao-de-voltar-a-pagina-inicial">
                        <span>Voltar à Página Inicial</span>
                    </a>
                </div>
                <input type="hidden" name="access_key" value="950898ff-e46e-4efa-ba77-aab1a3835e0f">
                <input type="hidden" name="redirect" value="http://localhost/bico-certo/paginas/obrigado.php?">
            </form>
        </div>
        <div class="acessibility-buttons">
            <div class="acessibility-panel">
                <img onclick="LightMode()" id="btnLightMode" src="../imagens/white-and-dark-mode/sun-solid.svg" class="botao-white-mode">
                <img onclick="DarkMode()" id="btnDarkMode" src="../imagens/white-and-dark-mode/moon-solid.svg" class="botao-dark-mode">
                <img id="aumentarZoom" onclick="aumentarZoom()" src="../imagens/acessibilidade/circle-plus-solid.svg" class="acessibilidade-mais">
                <img id="abaixarZoom" onclick="abaixarZoom()" src="../imagens/acessibilidade/circle-minus-solid.svg" class="acessibilidade-menos">
                <img id="aumentarZoomDM" onclick="aumentarZoom()" src="../imagens/white-and-dark-mode/circle-plus-solid.svg" class="acessibilidade-mais lm-dm">
                <img id="abaixarZoomDM" onclick="abaixarZoom()" src="../imagens/white-and-dark-mode/circle-minus-solid.svg" class="acessibilidade-menos lm-dm">
            </div>
        </div>
    </div>
    <script src="../script/contato/validacao-campos-contato.js"></script>
    <script src="../script/contato/acessibilidade.js"></script>
    <script src="../script/contato/light-and-dark-mode.js"></script>
</body>
</html>