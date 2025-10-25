<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Obrigado!</title>
    <link rel="icon" href="../imagens/icones-aba/icone16.ico" sizes="16x16">
    <link rel="icon" href="../imagens/icones-aba/icone24.ico" sizes="24x24">
    <link rel="icon" href="../imagens/icones-aba/icone32.ico" sizes="32x32">
    <link rel="icon" href="../imagens/icones-aba/icone48.ico" sizes="48x48">
    <link rel="stylesheet" href="../css/obrigado.css">
</head>
<body>
    <div class="container">
        <div class="container-esquerdo">
            <img src="../imagens/imagem-obrigado.jpg" class="imagem">
        </div>
        <div class="container-direito" id="container-direito">
            <img src="../imagens/logomarca.png" class="logomarca" id="logomarca">
            <img src="../imagens/logomarca-dark-mode.png" class="logomarca-dark-mode" id="logomarca-dark-mode">
            <h1 class="muito-obrigado">
                Muito Obrigado!
            </h1>
            <p class="obrigado" id="obrigado">
                Gostariamos de agradecer pelo seu tempo e dizer que acabamos de receber sua mensagem! Em breve retornaremos com uma resposta no E-Mail que você forneceu. 😊
            </p>
            <form>
                <button formaction="../index.html" class="botao-de-voltar-a-pagina-inicial">
                    Voltar à Página Inicial
                </button>
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
    <script src="../script/obrigado/acessibilidade.js"></script>
    <script src="../script/obrigado/light-and-dark-mode.js"></script>
</body>
</html>