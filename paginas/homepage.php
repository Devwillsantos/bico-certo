<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Página Inicial</title>
    <link rel="stylesheet" href="../css/homepage.css">
    <link rel="icon" href="../imagens/icones-aba/icone16.ico" sizes="16x16">
    <link rel="icon" href="../imagens/icones-aba/icone24.ico" sizes="24x24">
    <link rel="icon" href="../imagens/icones-aba/icone32.ico" sizes="32x32">
    <link rel="icon" href="../imagens/icones-aba/icone48.ico" sizes="48x48">
</head>
<body>
    <!-- Top Bar -->
    <header class="top-bar">
        <div class="icone">
            <a href="./homepage.html">
                <img src="../imagens/logomarca.png" class="logomarca">
            </a>
        </div>
        <div class="menu">
            <div class="logo">
                <span><a href="./servicos.html">
                <img src="../imagens/perfil/servicos.svg"></a></span>
            </div>
            <div class="logo">
                <span><a href="./mensagem.html">
                <img src="../imagens/perfil/envelope.svg"></a></span>
            </div>
            <div class="logo">
                <span><a href="./notifications.html">
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
            <li><a href="./perfil.html">Meu Perfil</a></li>
            <li><a href="./profile-edit.html">Editar Perfil</a></li>
            <li><a href="./login.html" id="logout">Sair</a></li>
        </ul>
    </div>
    <!-- Advertisement Banner -->
     <div class="banner">
        <div class="banner-container">
            <img src="../imagens/Google-AdWords-Logo.png">
        </div>
     </div>
    <!-- Main Content -->
    <main>
        <div class="main-container">
            <div class="title-card">
                <h1 class="title">Bem-vindo ao <span>Bico Certo</span>!</h1>
                <p class="subtitle">O lugar onde as <span>oportunidades</span> acontecem!</p>
            </div>
            <div class="opinions-card">
                <h2>Confira as opiniões dos nossos queridos usuários sobre o site!</h2>
                <div class="cards">
                    <div class="opinion-card">
                        <div class="opinion-image">
                            <img src="../imagens/carpenter-homepage.jpg">
                        </div>
                        <div class="opinion-about">
                            <div class="opinion-info">
                                <p>José Marcos Oliveira</p>
                                <p class="opinion-job">Carpinteiro há 3 anos</p>
                                <p class="rating">⭐⭐⭐⭐⭐</p>
                            </div>
                            <div class="opinion-description">
                                <p>Conheci o site Bico Certo e ele transformou minha vida como carpinteiro. Consegui mais clientes, organizei meu perfil profissional e aumentei minha renda, garantindo o sustento e sonhos da minha família. Recomendo a todos os profissionais que buscam oportunidades para crescer e valorizar o seu talento!</p>
                            </div>
                        </div>
                    </div>
                    <div class="opinion-card">
                        <div class="opinion-image">
                            <img src="../imagens/servicos/perfil_6.jpg">
                        </div>
                        <div class="opinion-about">
                            <div class="opinion-info">
                                <p>Marcos Rocha da Silva</p>
                                <p class="opinion-job">Mecânico há 5 anos</p>
                                <p class="rating">⭐⭐⭐⭐</p>
                            </div>
                            <div class="opinion-description">
                                <p>Descobri o site Bico Certo e ele mudou minha trajetória como mecânico. Com mais clientes e serviços, aumentei minha renda e consegui ajudar minha família. Hoje, tenho estabilidade e posso investir no futuro. Recomendo a todos que querem crescer e mostrar seu talento!</p>
                            </div>
                        </div>
                    </div>
                    <div class="opinion-card">
                        <div class="opinion-image">
                            <img src="../imagens/servicos/perfil_9.jpg">
                        </div>
                        <div class="opinion-about">
                            <div class="opinion-info">
                                <p>Ricardo Oliveira</p>
                                <p class="opinion-job">Professor particular há 1 ano</p>
                                <p class="rating">⭐⭐⭐⭐⭐</p>
                            </div>
                            <div class="opinion-description">
                                <p>Conheci o site Bico Certo e ele foi essencial para meu crescimento como professor particular. Consegui mais alunos, organizei meu perfil profissional e aumentei minha renda, garantindo um futuro melhor para mim e minha família. Recomendo para quem busca novas oportunidades e valorização!</p>
                            </div>
                        </div>
                    </div>
                    <div class="opinion-card">
                        <div class="opinion-image">
                            <img src="../imagens/perfil/marcelo-fatudo.jpg">
                        </div>
                        <div class="opinion-about">
                            <div class="opinion-info">
                                <p>Marcelo Fatudo</p>
                                <p class="opinion-job">Professor universitário há 10 anos</p>
                                <p class="rating">⭐⭐⭐⭐⭐</p>
                            </div>
                            <div class="opinion-description">
                                <p>Conheci o site Bico Certo e ele foi uma excelente oportunidade para complementar minha renda como professor de tecnologia. Com mais alunos e projetos, consegui organizar melhor meu trabalho e contribuir ainda mais com minha família.</p>
                            </div>
                        </div>
                    </div>
                    <div class="opinion-card">
                        <div class="opinion-image">
                            <img src="../imagens/servicos/pefil_11.jpg">
                        </div>
                        <div class="opinion-about">
                            <div class="opinion-info">
                                <p>Gabriela Souza</p>
                                <p class="opinion-job">Professora de música há 2 anos</p>
                                <p class="rating">⭐⭐⭐⭐⭐</p>
                            </div>
                            <div class="opinion-description">
                                <p>Descobri o site Bico Certo e ele foi essencial para minha carreira como professora de música. Encontrei alunos, organizei minha agenda e consegui aumentar minha renda. Isso me ajudou a contribuir mais com minha família e a crescer profissionalmente.</p>
                            </div>
                        </div>
                    </div>
                    <div class="opinion-card">
                        <div class="opinion-image">
                            <img src="../imagens/servicos/perfil_12.jpg">
                        </div>
                        <div class="opinion-about">
                            <div class="opinion-info">
                                <p>Herília Drummont</p>
                                <p class="opinion-job">Cuidadora de idosos há 6 anos</p>
                                <p class="rating">⭐⭐⭐⭐</p>
                            </div>
                            <div class="opinion-description">
                                <p>Conheci o site Bico Certo e ele mudou minha rotina como cuidadora de idosos. Graças a ele, consegui mais oportunidades, melhorei minha renda e pude oferecer mais estabilidade para minha família. Recomendo a quem busca mostrar seu trabalho e crescer na profissão!</p>
                            </div>
                        </div>
                    </div>
                    <div class="opinion-card">
                        <div class="opinion-image">
                            <img src="../imagens/servicos/perfil_18.jpg">
                        </div>
                        <div class="opinion-about">
                            <div class="opinion-info">
                                <p>Amanda Sorrilheiro</p>
                                <p class="opinion-job">Personal trainer há 7 anos</p>
                                <p class="rating">⭐⭐⭐⭐</p>
                            </div>
                            <div class="opinion-description">
                                <p>Conheci o site Bico Certo e ele transformou minha vida como personal trainer. Consegui mais clientes, organizei meu perfil profissional e aumentei minha renda, garantindo o sustento e os sonhos da minha família.</p>
                            </div>
                        </div>
                    </div>
                    <div class="opinion-card">
                        <div class="opinion-image">
                            <img src="../imagens/servicos/perfil_4.jpeg">
                        </div>
                        <div class="opinion-about">
                            <div class="opinion-info">
                                <p>Zuli Almeida</p>
                                <p class="opinion-job">Desenvolvedora há 2 anos</p>
                                <p class="rating">⭐⭐⭐⭐⭐</p>
                            </div>
                            <div class="opinion-description">
                                <p>Descobri o site Bico Certo e ele abriu muitas portas na minha carreira como desenvolvedora. Com mais projetos e clientes, consegui crescer profissionalmente e ajudar minha família. É uma ferramenta incrível para quem quer mostrar suas habilidades e alcançar novas oportunidades!</p>
                            </div>
                        </div>
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
                <li class="footer-list-option"><a href="./contato.html" target="_blank">Contato</a></li>
                <li class="footer-list-option"><a href="./sobrenos.html" target="_blank">Sobre</a></li>
            </ul>
        </div>
    </footer>
    <script src="../script/perfil/perfil.js"></script>
    <script src="../script/user-login.js"></script>
    <script src="../script/user-logout.js"></script>
</body>
</html>