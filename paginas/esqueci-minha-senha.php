<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Esqueci minha senha</title>
    <link rel="icon" href="../imagens/icones-aba/icone16.ico" sizes="16x16">
    <link rel="icon" href="../imagens/icones-aba/icone24.ico" sizes="24x24">
    <link rel="icon" href="../imagens/icones-aba/icone32.ico" sizes="32x32">
    <link rel="icon" href="../imagens/icones-aba/icone48.ico" sizes="48x48">
    <link rel="stylesheet" href="../css/esqueci-minha-senha.css">
</head>
<body>
    <div class="container">
        <div class="container-esquerdo">
            <img src="../imagens/imagem-esqueci-minha-senha.jpg" class="imagem">
        </div>
        <div class="container-direito" id="container-direito">
            <img src="../imagens/logomarca.png" class="logomarca" id="logomarca">
            <img src="../imagens/logomarca-dark-mode.png" class="logomarca-dark-mode" id="logomarca-dark-mode">
            <form method="post" id="form" action="#">
                <input id="email" type="email" name="email" placeholder="E-mail" class="email required" oninput="emailValidate()">
                <span class="span-required">Digite um e-mail válido.</span>
                <span class="span-required">Digite um e-mail.</span>
                <button type="submit" class="botao-enviar-link">Enviar link de Redefinição</button>
                <a href="../paginas/login.php" class="lembrou-sua-senha">Lembrou sua senha? Clique aqui!</a>
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
    <script src="../script/esqueci-minha-senha/validacao-campos-esqueci-minha-senha.js"></script>
    <script src="../script/esqueci-minha-senha/acessibilidade.js"></script>
    <script src="../script/esqueci-minha-senha/light-and-dark-mode.js"></script>
</body>
</html>