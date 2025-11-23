<?php
// Apenas usuários registrados podem entrar nesta página
require_once __DIR__ . "/../server/logged-in-user.php";

// Apenas usuários do tipo "master" podem entrar nesta página
if ($_SESSION['tipoUsuario'] != 'master') {
    header('Location: ../paginas/erro.php');
    exit;
}

require_once __DIR__ . "/../server/config.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modelo do BD</title>
    <link rel="stylesheet" href="../css/db-model.css">
    <link rel="icon" href="../imagens/icones-aba/icone16.ico" sizes="16x16">
    <link rel="icon" href="../imagens/icones-aba/icone24.ico" sizes="24x24">
    <link rel="icon" href="../imagens/icones-aba/icone32.ico" sizes="32x32">
    <link rel="icon" href="../imagens/icones-aba/icone48.ico" sizes="48x48">
</head>
<body>
    <!-- Top Bar -->
    <header class="top-bar">
        <div class="icone">
            <a href="./homepage.php">
                <img src="../imagens/logomarca.png" class="logomarca">
            </a>
        </div>
        <div class="menu">
            <div class="logo">
                <?php
                    if ($_SESSION['tipoUsuario'] === 'master') {
                        require_once __DIR__ . "/../server/master-navbar.php";
                    } 
                ?>
                <span>
                    <a href="./servicos.php">
                        <img src="../imagens/perfil/servicos.svg">
                    </a>
                </span>
            </div>
            <div class="user-name logo">
                <p id="username">
                    <?php echo $_SESSION['usuario_login']; ?>
                </p>
            </div>
            <!-- Ícone de perfil com menu de opções -->
            <div class="logo" onclick="toggleProfileMenu()">
                <img src="<?php echo '../' . $_SESSION['usuario_foto']; ?>">
            </div>
        </div>
    </header>

    <!-- Profile Menu -->
    <div class="profile-menu" id="profileMenu">
        <ul>
            <li>
                <a href="
                    <?php
                        if ($_SESSION['tipoUsuario'] === 'prestador') {
                            echo './perfil.php?id=' . $_SESSION['usuario_id'];
                        } else {
                            echo './perfil contratante.php?id=' . $_SESSION['usuario_id'];
                        }
                    ?>"
                >
                    Meu Perfil
                </a>
            </li>
            <li><a href="./profile-edit.php">Editar Perfil</a></li>
            <li><a href="../index.php" id="logout">Sair</a></li>
        </ul>
    </div>

    <!-- Main Content -->
    <main>
        <div class="image-db-container">
            <img src="../imagens/db-model-conceptual.png" class="db-model-logic">
            <img src="../imagens/db-model-logic.png" class="db-model-conceptual">
        </div>
    </main>

    <!-- Footer-->
    <footer>
        <div class="footer-image">
            <img src="../imagens/logomarca-dark-mode.png">
        </div>
        <div class="vertical-row"></div>
        <div class="footer-list">
            <ul>
                <li class="footer-list-option"><a href="./contato.php" target="_blank">Contato</a></li>
                <li class="footer-list-option"><a href="./sobrenos.php" target="_blank">Sobre</a></li>
            </ul>
        </div>
    </footer>
    <script src="../script/perfil/perfil.js"></script>
    <script src="../script/user-login.js"></script>
    <script src="../script/user-logout.js"></script>
</body>
</html>