<?php
require_once '../server/logged-in-user.php';
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Notificações</title>
    <link rel="stylesheet" href="../css/notifications.css">
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
                <span><a href="./servicos.php">
                <img src="../imagens/perfil/servicos.svg"></a></span>
            </div>
            <div class="logo">
                <span><a href="./mensagem.php">
                <img src="../imagens/perfil/envelope.svg"></a></span>
            </div>
            <div class="logo">
                <span><a href="./notifications.php">
                <img src="../imagens/perfil/notificação.svg"></a></span>
            </div>
            <div class="user-name logo">
                <p id="username"></p>
            </div>
            <!-- Ícone de perfil com menu de opções -->
            <div class="logo" onclick="toggleProfileMenu()">
                <img src="../imagens/servicos/perfil_6.jpg">
            </div>
        </div>
    </header>
    <!-- Profile Menu -->
    <div class="profile-menu" id="profileMenu">
        <ul>
            <li><a href="./perfil.php">Meu Perfil</a></li>
            <li><a href="./profile-edit.php">Editar Perfil</a></li>
            <li><a href="../index.php" id="logout">Sair</a></li>
        </ul>
    </div>
    <!-- Main Content -->
    <main id="main">
        <div class="notifications">
            <div class="title">
                <img src="../imagens/perfil/notificação.svg" class="title-bell">
                <h1>Notificações</h1>
            </div>
            <div class="notification">
                <div class="profile-photo">
                    <img src="../imagens/servicos/perfil_5.jpeg">
                </div>
                <div class="informations">
                    <p class="name">Ricardo Alves</p>
                    <p class="action">Curtiu seu Perfil.</p>
                    <p class="date">
                        <img src="../imagens/perfil/clock-blue.svg" class="date-clock-blue">
                        <img src="../imagens/perfil/clock-white.svg" class="date-clock-white">
                        Setembro 29, 2024
                    </p>
                </div>
            </div>
            <div class="notification">
                <div class="profile-photo">
                    <img src="../imagens/servicos/perfil_14.jpg">
                </div>
                <div class="informations">
                    <p class="name">Roberto da Silva</p>
                    <p class="action">Curtiu seu Perfil.</p>
                    <p class="date">
                        <img src="../imagens/perfil/clock-blue.svg" class="date-clock-blue">
                        <img src="../imagens/perfil/clock-white.svg" class="date-clock-white">
                        Setembro 26, 2024
                    </p>
                </div>
            </div>
            <div class="notification">
                <div class="profile-photo">
                    <img src="../imagens/servicos/perfil_8.jpg">
                </div>
                <div class="informations">
                    <p class="name">Roberta Amarantos</p>
                    <p class="action">Comentou no seu Perfil.</p>
                    <p class="date">
                        <img src="../imagens/perfil/clock-blue.svg" class="date-clock-blue">
                        <img src="../imagens/perfil/clock-white.svg" class="date-clock-white">
                        Setembro 26, 2024
                    </p>
                </div>
            </div>
            <div class="notification">
                <div class="profile-photo">
                    <img src="../imagens/servicos/perfil_9.jpg">
                </div>
                <div class="informations">
                    <p class="name">Élio Alves</p>
                    <p class="action">Comentou no seu Perfil.</p>
                    <p class="date">
                        <img src="../imagens/perfil/clock-blue.svg" class="date-clock-blue">
                        <img src="../imagens/perfil/clock-white.svg" class="date-clock-white">
                        Setembro 25, 2024
                    </p>
                </div>
            </div>
            <p class="load-all-notifications" onclick="loadAllNotifications()">Clique aqui para carregar todas as notificações.</p>
            <div class="more-notifications">
                <div class="notification">
                    <div class="profile-photo">
                        <img src="../imagens/servicos/perfil_20.jpg">
                    </div>
                    <div class="informations">
                        <p class="name">Rafaela Andrade</p>
                        <p class="action">Comentou no seu Perfil.</p>
                        <p class="date">
                            <img src="../imagens/perfil/clock-blue.svg" class="date-clock-blue">
                            <img src="../imagens/perfil/clock-white.svg" class="date-clock-white">
                            Setembro 10, 2024
                        </p>
                    </div>
                </div>
                <div class="notification">
                    <div class="profile-photo">
                        <img src="../imagens/servicos/perfil_14.jpg">
                    </div>
                    <div class="informations">
                        <p class="name">Roberto da Silva</p>
                        <p class="action">Curtiu seu Perfil.</p>
                        <p class="date">
                            <img src="../imagens/perfil/clock-blue.svg" class="date-clock-blue">
                            <img src="../imagens/perfil/clock-white.svg" class="date-clock-white">
                            Setembro 26, 2024
                        </p>
                    </div>
                </div>
            </div>
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
                <li class="footer-list-option"><a href="./cadastro.php" target="_blank">Cadastro</a></li>
                <li class="footer-list-option"><a href="./login.php" target="_blank">Login</a></li>
            </ul>
        </div>
    </footer>
    <script src="../script/perfil/perfil.js"></script>
    <script src="../script/notifications/more-notification.js"></script>
    <script src="../script/user-login.js"></script>
    <script src="../script/user-logout.js"></script>
</body>
</html>