<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Servicos</title>
    <link rel="icon" href="../imagens/icones-aba/icone16.ico" sizes="16x16">
    <link rel="icon" href="../imagens/icones-aba/icone24.ico" sizes="24x24">
    <link rel="icon" href="../imagens/icones-aba/icone32.ico" sizes="32x32">
    <link rel="icon" href="../imagens/icones-aba/icone48.ico" sizes="48x48">
    <link rel="stylesheet" href="../css/servicos.css">
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
            <li><a href="./login.php" id="logout">Sair</a></li>
        </ul>
    </div>
    <!-- Main Content -->
    <main>
        <div class="main-container">
            <div class="container1">
                <select name="state-filter" id="state-filter">
                    <option value="" disabled selected>Filtre por estado</option>
                    <option value="AC">Acre</option>
                    <option value="AL">Alagoas</option>
                    <option value="AP">Amapá</option>
                    <option value="AM">Amazonas</option>
                    <option value="BA">Bahia</option>
                    <option value="CE">Ceará</option>
                    <option value="DF">Distrito Federal</option>
                    <option value="ES">Espírito Santo</option>
                    <option value="GO">Goiás</option>
                    <option value="MA">Maranhão</option>
                    <option value="MT">Mato Grosso</option>
                    <option value="MS">Mato Grosso do Sul</option>
                    <option value="MG">Minas Gerais</option>
                    <option value="PA">Pará</option>
                    <option value="PB">Paraíba</option>
                    <option value="PR">Paraná</option>
                    <option value="PE">Pernambuco</option>
                    <option value="PI">Piauí</option>
                    <option value="RJ">Rio de Janeiro</option>
                    <option value="RN">Rio Grande do Norte</option>
                    <option value="RS">Rio Grande do Sul</option>
                    <option value="RO">Rondônia</option>
                    <option value="RR">Roraima</option>
                    <option value="SC">Santa Catarina</option>
                    <option value="SP">São Paulo</option>
                    <option value="SE">Sergipe</option>
                    <option value="TO">Tocantins</option>
                </select>
                
                <input type="text" class="search-bar" placeholder="Pesquise um serviço ou usuário">

                <select name="star-filter" id="star-filter">
                    <option value="" disabled selected>Filtre por estrelas</option>
                    <option value="5">⭐⭐⭐⭐⭐</option>
                    <option value="4">⭐⭐⭐⭐</option>
                    <option value="3">⭐⭐⭐</option>
                    <option value="2">⭐⭐</option>
                    <option value="1">⭐</option>
                </select>

                
            </div>
            <div class="container2">
            <div class="card">
                <img src="../imagens/servicos/perfil_1.jpeg" class="services-photo">
                <p class="service-title">Professora de Inglês</p>
                <p>⭐⭐⭐⭐⭐</p>
                <p class="name">Ângela Ferreira</p>
                <p class="estado">Rio de Janeiro</p>
                <a href="./mensagem.html" class="contact-button">Entrar em contato</a>
                <img src="../imagens/servicos/whatsapp-blue-icon.svg" class="whatsapp-icon-blue">
                <a href="https://chat.whatsapp.com/DSv8j4QpaI9CuZtDlzOEOZ" target="_blank">
                    <img src="../imagens/servicos/whatsapp-white-icon.svg" class="whatsapp-icon-white">
                </a>
            </div>
            <div class="card">
                <img src="../imagens/servicos/perfil_2.jpeg" class="services-photo">
                <p class="service-title">Eletricista</p>
                <p>⭐⭐⭐⭐</p>
                <p class="name">Eduardo Henrique</p>
                <p class="estado">São Paulo</p>
                <a href="./mensagem.html" class="contact-button">Entrar em contato</a>
                <img src="../imagens/servicos/whatsapp-blue-icon.svg" class="whatsapp-icon-blue">
                <a href="https://chat.whatsapp.com/DSv8j4QpaI9CuZtDlzOEOZ" target="_blank">
                    <img src="../imagens/servicos/whatsapp-white-icon.svg" class="whatsapp-icon-white">
                </a>
            </div>
            <div class="card">
                <img src="../imagens/servicos/perfil_3.jpeg" class="services-photo">
                <p class="service-title">Fotógrafo</p>
                <p>⭐⭐</p>
                <p class="name">Matheus Vasconcelos</p>
                <p class="estado">Minas Gerais</p>
                <a href="./mensagem.html" class="contact-button">Entrar em contato</a>
                <img src="../imagens/servicos/whatsapp-blue-icon.svg" class="whatsapp-icon-blue">
                <a href="https://chat.whatsapp.com/DSv8j4QpaI9CuZtDlzOEOZ" target="_blank">
                    <img src="../imagens/servicos/whatsapp-white-icon.svg" class="whatsapp-icon-white">
                </a>
            </div>
            <div class="card">
                <img src="../imagens/servicos/perfil_4.jpeg" class="services-photo">
                <p class="service-title">Professora de Música</p>
                <p>⭐⭐⭐⭐</p>
                <p class="name">Sulamita Santos</p>
                <p class="estado">Goiás</p>
                <a href="./mensagem.html" class="contact-button">Entrar em contato</a>
                <img src="../imagens/servicos/whatsapp-blue-icon.svg" class="whatsapp-icon-blue">
                <a href="https://chat.whatsapp.com/DSv8j4QpaI9CuZtDlzOEOZ" target="_blank">
                    <img src="../imagens/servicos/whatsapp-white-icon.svg" class="whatsapp-icon-white">
                </a>
            </div>
            <div class="card">
                <img src="../imagens/servicos/perfil_5.jpeg" class="services-photo">
                <p class="service-title">Programador Front-End</p>
                <p>⭐⭐⭐</p>
                <p class="name">William Almeida</p>
                <p class="estado">Pernambuco</p>
                <a href="./mensagem.html" class="contact-button">Entrar em contato</a>
                <img src="../imagens/servicos/whatsapp-blue-icon.svg" class="whatsapp-icon-blue">
                <a href="https://chat.whatsapp.com/DSv8j4QpaI9CuZtDlzOEOZ" target="_blank">
                    <img src="../imagens/servicos/whatsapp-white-icon.svg" class="whatsapp-icon-white">
                </a>
            </div>
            <div class="card">
                <img src="../imagens/servicos/perfil_6.jpg" class="services-photo">
                <p class="service-title">Professor de Inglês</p>
                <p>⭐⭐⭐⭐⭐</p>
                <p class="name">Lucas Henrique da Silva Almeida</p>
                <p class="estado">Rio de Janeiro</p>
                <a href="./mensagem.html" class="contact-button">Entrar em contato</a>
                <img src="../imagens/servicos/whatsapp-blue-icon.svg" class="whatsapp-icon-blue">
                <a href="https://chat.whatsapp.com/DSv8j4QpaI9CuZtDlzOEOZ" target="_blank">
                    <img src="../imagens/servicos/whatsapp-white-icon.svg" class="whatsapp-icon-white">
                </a>
            </div>
            <div class="card">
                <img src="../imagens/servicos/perfil_7.jpg" class="services-photo">
                <p class="service-title">Eletricista</p>
                <p>⭐⭐⭐⭐</p>
                <p class="name">Ana Luiza Carvalho Menezes</p>
                <p class="estado">São Paulo</p>
                <a href="./mensagem.html" class="contact-button">Entrar em contato</a>
                <img src="../imagens/servicos/whatsapp-blue-icon.svg" class="whatsapp-icon-blue">
                <a href="https://chat.whatsapp.com/DSv8j4QpaI9CuZtDlzOEOZ" target="_blank">
                    <img src="../imagens/servicos/whatsapp-white-icon.svg" class="whatsapp-icon-white">
                </a>
            </div>
            <div class="card">
                <img src="../imagens/servicos/perfil_8.jpg" class="services-photo">
                <p class="service-title">Fotógrafa</p>
                <p>⭐⭐</p>
                <p class="name">Maria Clara Rodrigues Souza</p>
                <p class="estado">Minas Gerais</p>
                <a href="./mensagem.html" class="contact-button">Entrar em contato</a>
                <img src="../imagens/servicos/whatsapp-blue-icon.svg" class="whatsapp-icon-blue">
                <a href="https://chat.whatsapp.com/DSv8j4QpaI9CuZtDlzOEOZ" target="_blank">
                    <img src="../imagens/servicos/whatsapp-white-icon.svg" class="whatsapp-icon-white">
                </a>
            </div>
            <div class="card">
                <img src="../imagens/servicos/perfil_9.jpg" class="services-photo">
                <p class="service-title">Professor de Dança</p>
                <p>⭐⭐⭐⭐</p>
                <p class="name">Rafael Augusto Oliveira Pereira</p>
                <p class="estado">Goiás</p>
                <a href="./mensagem.html" class="contact-button">Entrar em contato</a>
                <img src="../imagens/servicos/whatsapp-blue-icon.svg" class="whatsapp-icon-blue">
                <a href="https://chat.whatsapp.com/DSv8j4QpaI9CuZtDlzOEOZ" target="_blank">
                    <img src="../imagens/servicos/whatsapp-white-icon.svg" class="whatsapp-icon-white">
                </a>
            </div>
            <div class="card">
                <img src="../imagens/servicos/perfil_10.jpg" class="services-photo">
                <p class="service-title">Programadora Back-End</p>
                <p>⭐⭐⭐</p>
                <p class="name">Gabriela Costa dos Santos</p>
                <p class="estado">Pernambuco</p>
                <a href="./mensagem.html" class="contact-button">Entrar em contato</a>
                <img src="../imagens/servicos/whatsapp-blue-icon.svg" class="whatsapp-icon-blue">
                <a href="https://chat.whatsapp.com/DSv8j4QpaI9CuZtDlzOEOZ" target="_blank">
                    <img src="../imagens/servicos/whatsapp-white-icon.svg" class="whatsapp-icon-white">
                </a>
            </div>
            <div class="card">
                <img src="../imagens/servicos/perfil_11.jpg" class="services-photo">
                <p class="service-title">Pintora</p>
                <p>⭐⭐⭐⭐⭐</p>
                <p class="name">Lara Beatriz Fonseca Duarte</p>
                <p class="estado">Rio de Janeiro</p>
                <a href="./mensagem.html" class="contact-button">Entrar em contato</a>
                <img src="../imagens/servicos/whatsapp-blue-icon.svg" class="whatsapp-icon-blue">
                <a href="https://chat.whatsapp.com/DSv8j4QpaI9CuZtDlzOEOZ" target="_blank">
                    <img src="../imagens/servicos/whatsapp-white-icon.svg" class="whatsapp-icon-white">
                </a>
            </div>
            <div class="card">
                <img src="../imagens/servicos/perfil_12.jpg" class="services-photo">
                <p class="service-title">Mecânica</p>
                <p>⭐⭐⭐⭐</p>
                <p class="name">Aura Moreira Fernandes</p>
                <p class="estado">São Paulo</p>
                <a href="./mensagem.html" class="contact-button">Entrar em contato</a>
                <img src="../imagens/servicos/whatsapp-blue-icon.svg" class="whatsapp-icon-blue">
                <a href="https://chat.whatsapp.com/DSv8j4QpaI9CuZtDlzOEOZ" target="_blank">
                    <img src="../imagens/servicos/whatsapp-white-icon.svg" class="whatsapp-icon-white">
                </a>
            </div>
            <div class="card">
                <img src="../imagens/servicos/perfil_13.jpg" class="services-photo">
                <p class="service-title">Professora de Espanhol</p>
                <p>⭐⭐</p>
                <p class="name">Sofia de Moura Pinto</p>
                <p class="estado">Minas Gerais</p>
                <a href="./mensagem.html" class="contact-button">Entrar em contato</a>
                <img src="../imagens/servicos/whatsapp-blue-icon.svg" class="whatsapp-icon-blue">
                <a href="https://chat.whatsapp.com/DSv8j4QpaI9CuZtDlzOEOZ" target="_blank">
                    <img src="../imagens/servicos/whatsapp-white-icon.svg" class="whatsapp-icon-white">
                </a>
            </div>
            <div class="card">
                <img src="../imagens/servicos/perfil_14.jpg" class="services-photo">
                <p class="service-title">Coach</p>
                <p>⭐⭐⭐⭐</p>
                <p class="name">Gustavo Henrique Almeida Farias</p>
                <p class="estado">Goiás</p>
                <a href="./mensagem.html" class="contact-button">Entrar em contato</a>
                <img src="../imagens/servicos/whatsapp-blue-icon.svg" class="whatsapp-icon-blue">
                <a href="https://chat.whatsapp.com/DSv8j4QpaI9CuZtDlzOEOZ" target="_blank">
                    <img src="../imagens/servicos/whatsapp-white-icon.svg" class="whatsapp-icon-white">
                </a>
            </div>
            <div class="card">
                <img src="../imagens/servicos/perfil_15.jpg" class="services-photo">
                <p class="service-title">Babá</p>
                <p>⭐⭐⭐</p>
                <p class="name">Beatriz dos Anjos Martins</p>
                <p class="estado">Pernambuco</p>
                <a href="./mensagem.html" class="contact-button">Entrar em contato</a>
                <img src="../imagens/servicos/whatsapp-blue-icon.svg" class="whatsapp-icon-blue">
                <a href="https://chat.whatsapp.com/DSv8j4QpaI9CuZtDlzOEOZ" target="_blank">
                    <img src="../imagens/servicos/whatsapp-white-icon.svg" class="whatsapp-icon-white">
                </a>
            </div>
            <div class="card">
                <img src="../imagens/servicos/perfil_16.jpg" class="services-photo">
                <p class="service-title">Professora de Investimentos</p>
                <p>⭐⭐⭐⭐⭐</p>
                <p class="name">Luana Ribeiro Fernandes</p>
                <p class="estado">Rio de Janeiro</p>
                <a href="./mensagem.html" class="contact-button">Entrar em contato</a>
                <img src="../imagens/servicos/whatsapp-blue-icon.svg" class="whatsapp-icon-blue">
                <a href="https://chat.whatsapp.com/DSv8j4QpaI9CuZtDlzOEOZ" target="_blank">
                    <img src="../imagens/servicos/whatsapp-white-icon.svg" class="whatsapp-icon-white">
                </a>
            </div>
            <div class="card">
                <img src="../imagens/servicos/perfil_17.jpg" class="services-photo">
                <p class="service-title">Eletricista</p>
                <p>⭐⭐⭐⭐</p>
                <p class="name">Thiago Cardoso dos Anjos</p>
                <p class="estado">São Paulo</p>
                <a href="./mensagem.html" class="contact-button">Entrar em contato</a>
                <img src="../imagens/servicos/whatsapp-blue-icon.svg" class="whatsapp-icon-blue">
                <a href="https://chat.whatsapp.com/DSv8j4QpaI9CuZtDlzOEOZ" target="_blank">
                    <img src="../imagens/servicos/whatsapp-white-icon.svg" class="whatsapp-icon-white">
                </a>
            </div>
            <div class="card">
                <img src="../imagens/servicos/perfil_18.jpg" class="services-photo">
                <p class="service-title">Personal Trainer</p>
                <p>⭐⭐</p>
                <p class="name">Bianca Ramos da Conceição</p>
                <p class="estado">Minas Gerais</p>
                <a href="./mensagem.html" class="contact-button">Entrar em contato</a>
                <img src="../imagens/servicos/whatsapp-blue-icon.svg" class="whatsapp-icon-blue">
                <a href="https://chat.whatsapp.com/DSv8j4QpaI9CuZtDlzOEOZ" target="_blank">
                    <img src="../imagens/servicos/whatsapp-white-icon.svg" class="whatsapp-icon-white">
                </a>
            </div>
            <div class="card">
                <img src="../imagens/servicos/perfil_19.jpg" class="services-photo">
                <p class="service-title">Professora de Artes Cênicas</p>
                <p>⭐⭐⭐⭐</p>
                <p class="name">Laura Mendes Guimarães</p>
                <p class="estado">Goiás</p>
                <a href="./mensagem.html" class="contact-button">Entrar em contato</a>
                <img src="../imagens/servicos/whatsapp-blue-icon.svg" class="whatsapp-icon-blue">
                <a href="https://chat.whatsapp.com/DSv8j4QpaI9CuZtDlzOEOZ" target="_blank">
                    <img src="../imagens/servicos/whatsapp-white-icon.svg" class="whatsapp-icon-white">
                </a>
            </div>
            <div class="card">
                <img src="../imagens/servicos/perfil_20.jpg" class="services-photo">
                <p class="service-title">Programador Full-Stack</p>
                <p>⭐⭐⭐</p>
                <p class="name">André Luiz Freitas Gomes</p>
                <p class="estado">Pernambuco</p>
                <a href="./mensagem.html" class="contact-button">Entrar em contato</a>
                <img src="../imagens/servicos/whatsapp-blue-icon.svg" class="whatsapp-icon-blue">
                <a href="https://chat.whatsapp.com/DSv8j4QpaI9CuZtDlzOEOZ" target="_blank">
                    <img src="../imagens/servicos/whatsapp-white-icon.svg" class="whatsapp-icon-white">
                </a>
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
    <script src="../script/user-login.js"></script>
    <script src="../script/user-logout.js"></script>
</body>
</html>