<?php
// Exibição do modal de senha incorreta e e-mail não encontrado
session_start();
if (!isset($_SESSION['showModal'])) {
    $_SESSION['showModal'] = null;
} else if ($_SESSION['showModal'] === 'senha-errada') { // Exibe o modal de senha errada
    echo '<div class="modal" onclick="closeModal(event)">' ;
    echo    '<div class="modal-box">';
    echo        '<span class="modal-title">';
    echo            'Senha incorreta!';
    echo        '</span>';
    echo        '<button class="modal-button" onclick="refresh()">';
    echo            'Tentar novamente';
    echo        '</button>';
    echo    '</div>';
    echo '</div>';
    
    // Para a sessão de exibição do modal
    unset($_SESSION['showModal']);
} else if ($_SESSION['showModal'] === 'e-mail-nao-encontrado') { // Exibe o modal de e-mail não encontrado
    echo '<div class="modal" onclick="closeModal(event)">' ;
    echo    '<div class="modal-box">';
    echo        '<span class="modal-title">';
    echo            'E-mail não encontrado!';
    echo        '</span>';
    echo        '<button class="modal-button" onclick="refresh()">';
    echo            'Tentar novamente';
    echo        '</button>';
    echo    '</div>';
    echo '</div>';

    // Para a sessão de exibição do modal
    unset($_SESSION['showModal']);
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="icon" href="../imagens/icones-aba/icone16.ico" sizes="16x16">
    <link rel="icon" href="../imagens/icones-aba/icone24.ico" sizes="24x24">
    <link rel="icon" href="../imagens/icones-aba/icone32.ico" sizes="32x32">
    <link rel="icon" href="../imagens/icones-aba/icone48.ico" sizes="48x48">
    <link rel="stylesheet" href="../css/login.css">
</head>
<body>
    <div class="container">
        <div class="container-esquerdo">
            <img src="../imagens/imagem-login.jpg" class="imagem">
        </div>
        <div class="container-direito" id="container-direito">
            <img src="../imagens/logomarca.png" class="logomarca" id="logomarca">
            <img src="../imagens/logomarca-dark-mode.png" class="logomarca-dark-mode" id="logomarca-dark-mode">
            <form action="../server/login/validation.php" method="post" id="form">
                <div class="campo">
                    <input id="email" type="email" class="email required" placeholder="E-mail" oninput="emailValidate()" name="email">
                    <span class="span-required">Digite um e-mail válido.</span>
                    <span class="span-required">Digite um e-mail.</span>
                </div>
                <div class="campo">
                    <input id="password" type="password" class="senha required" placeholder="Senha" oninput="senhaValidate()" name="senha">
                    <span class="span-required">Digite uma senha válida.</span>
                    <span class="span-required">E-mail ou senha estão incorretos.</span>
                </div>
                <div class="lembrar-esqueci">
                    <div class="checkbox">
                        <input type="checkbox" id="lembrar-de-mim">
                        <label for="lembrar-de-mim">Lembrar de mim</label>
                    </div>
                    <div class="link-esqueci-senha">
                        <a class="esqueci-senha" href="./esqueci-minha-senha.php">Esqueci minha senha</a>
                    </div>
                </div>
                <div class="botoes">
                    <button type="submit" class="botao-de-entrar">
                        Entrar
                    </button>
                    <button type="reset" class="botao-de-limpar-campos">
                        Limpar Campos
                    </button>
                    <a href="./cadastro.php" class="botao-de-me-cadastrar">
                        <span>
                            Me Cadastrar
                        </span>
                    </a>
                    <a href="../index.html" class="homepage">
                        <span>
                            Voltar à Página Inicial
                        </span>
                    </a>
                </div>
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
    <script src="../script/login/validacao-login.js"></script>
    <script src="../script/login/acessibilidade.js"></script>
    <script src="../script/login/light-and-dark-mode.js"></script>
</body>
</html>