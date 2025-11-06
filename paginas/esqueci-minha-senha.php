<?php
// Exibição do modal de cadastrado com sucesso e de erro
session_start();
if (!isset($_SESSION['showModal'])) {
    $_SESSION['showModal'] = null;
} else if ($_SESSION['showModal'] === 'senha-atualizada') {
    echo '<div class="modal" onclick="closeModal(event)">' ;
    echo    '<div class="modal-box">';
    echo        '<span class="modal-title">';
    echo            'Senha atualizada com sucesso!';
    echo        '</span>';
    echo        '<button class="modal-button" onclick="goToLoginPage()">';
    echo            'Fazer login';
    echo        '</button>';
    echo    '</div>';
    echo '</div>';
    
    // Para a sessão de exibição do modal
    unset($_SESSION['showModal']);
} else if ($_SESSION['showModal'] === 'erro') {
    echo '<div class="modal" onclick="closeModal(event)">' ;
    echo    '<div class="modal-box">';
    echo        '<span class="modal-title">';
    echo            'Desculpe, não conseguimos realizar o reset da senha.';
    echo        '</span>';
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
            <form method="post" id="form" action="../server/forgotten-password/validation.php">
                <div class="form-container">
                    <div class="email-container">
                        <input id="email" type="email" name="email" placeholder="E-mail" class="campo email required" oninput="emailValidate()">
                        <span class="span-required">
                            Digite um e-mail válido.
                        </span>
                    </div>
                    <div class="cpf-container">
                        <input id="cpf" type="text" name="cpf" placeholder="CPF" class="campo cpf required" maxlength="14" oninput="cpfValidate()">
                        <span class="span-required">
                            Digite um CPF válido.
                        </span>
                    </div>
                    <div class="senha-nova-container">
                        <input id="senhaNova" type="password" name="senhaNova" placeholder="Senha nova" class="campo senha-nova required" maxlength="8" oninput="senhaNovaValidate()">
                        <span class="span-required">
                            Digite uma senha válida (8 caracteres alfabéticos).
                        </span>
                    </div>
                    <div class="buttons-container">
                        <button type="submit" class="botao-resetar-senha">
                            Resetar senha
                        </button>
                        <a href="../paginas/login.php" class="lembrou-sua-senha">
                            Lembrou sua senha? Clique aqui!
                        </a>
                    </div>
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
    <script src="../script/esqueci-minha-senha/validacao-campos-esqueci-minha-senha.js"></script>
    <script src="../script/esqueci-minha-senha/acessibilidade.js"></script>
    <script src="../script/esqueci-minha-senha/light-and-dark-mode.js"></script>
    <script src="../script/registro/formatacao-cpf.js"></script>
</body>
</html>