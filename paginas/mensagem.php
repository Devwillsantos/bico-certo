<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chat</title>
    <link rel="icon" href="../imagens/icones-aba/icone16.ico" sizes="16x16">
    <link rel="icon" href="../imagens/icones-aba/icone24.ico" sizes="24x24">
    <link rel="icon" href="../imagens/icones-aba/icone32.ico" sizes="32x32">
    <link rel="icon" href="../imagens/icones-aba/icone48.ico" sizes="48x48">
    <link rel="stylesheet" href="../css/mensagem.css">
</head>
<body>
    <div class="container">
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
        <div class="profile-menu" id="profileMenu">
            <ul>
                <li><a href="./perfil.php">Meu Perfil</a></li>
                <li><a href="./profile-edit.php">Editar Perfil</a></li>
                <li><a href="./login.php" id="logout">Sair</a></li>
            </ul>
        </div>
        <div class="chat-container">
            <div class="sidebar">
                <div class="contact active" data-contact="Ricardo Alves">
                    <img src="../imagens/servicos/perfil_5.jpeg">
                    <div class="contact-info">
                        <span class="contact-name">Ricardo Alves</span>
                    </div>
                </div>
                <div class="contact" data-contact="Fernanda da Silva">
                    <img src="../imagens/servicos/perfil_13.jpg">
                    <div class="contact-info">
                        <span class="contact-name">Fernanda da Silva</span>
                    </div>
                </div>
                <div class="contact" data-contact="Roberta Amarantos">
                    <img src="../imagens/servicos/perfil_8.jpg">
                    <div class="contact-info">
                        <span class="contact-name">Roberta Amarantos</span>
                    </div>
                </div>
            </div>

            <!-- Área de mensagens -->
            <div class="chat-box">
                <div class="chat-header">
                    <img src="../imagens/servicos/perfil_5.jpeg">
                    <div class="header-info">
                        <span class="contact-name">Ricardo Alves</span>
                        <span class="status"></span>
                    </div>
                </div>
                <div class="messages"></div>
                <div class="chat-input">
                    <input type="text" placeholder="Escreva sua mensagem...">
                    <button>
                        <img src="../imagens/perfil/message-solid.svg">
                    </button>
                </div>
            </div>
        </div>
    </div>
    <script src="../script/perfil/perfil.js"></script>
    <script src="../script/perfil/status do perfil.js"></script>
    <script src="../script/mensagem/mens.js"></script>
    <script src="../script/mensagem/mensagem.js"></script>
    <script src="../script/user-login.js"></script>
    <script src="../script/user-logout.js"></script>
</body>
</html>
