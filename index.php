<?php
session_start();
session_destroy();
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Página Inicial</title>
    <link rel="stylesheet" href="../bico-certo/css/index.css">
    <link rel="icon" href="../bico-certo/imagens/icones-aba/icone16.ico" sizes="16x16">
    <link rel="icon" href="../bico-certo/imagens/icones-aba/icone24.ico" sizes="24x24">
    <link rel="icon" href="../bico-certo/imagens/icones-aba/icone32.ico" sizes="32x32">
    <link rel="icon" href="../bico-certo/imagens/icones-aba/icone48.ico" sizes="48x48">
</head>
<body>
    <!-- Top Bar -->
    <header class="top-bar">
        <div class="icone">
            <a href="#">
                <img src="../bico-certo/imagens/logomarca.png" class="logomarca">
            </a>
        </div>
        <div class="menu">
            <!-- Criamos sobre nos no nav bar inicio-->
            <div class="sobrenos">
                <a href="../bico-certo/paginas/sobrenos.php">Sobre</a>
            </div>
            <div class="sobrenos">
                <a href="../bico-certo/paginas/contato.php">Contato</a>
            </div>
            <div class="sobrenos">
                <a href="../bico-certo/paginas/cadastro.php">Cadastro</a>
            </div>
            <div class="sobrenos">
                <a href="../bico-certo/paginas/login.php">Login</a>
            </div>
            
            <!-- Criamos sobre nos no nav bar FIM-->
            <!-- Mudamos o icone de perfil -->
            <div class="menu2" onclick="toggleProfileMenu()">
                <img src="../imagens/menulogo.png">
            </div>
        </div>
    </header>

    <!-- Profile Menu -->
    <div class="profile-menu" id="profileMenu">
        <ul>
            <li><a href="../bico-certo/paginas/login.php">Entrar</a></li>
            <li><a href="../bico-certo/paginas/cadastro.php">Cadastrar</a></li>
            <li><a href="../bico-certo/paginas/sobrenos.php">Sobre</a></li>
            <li><a href="../bico-certo/paginas/contato.php">Contato</a></li>
        </ul>
    </div>

    <!-- Banner -->
    <div class="banner">
        <img src="./imagens/slides-homepage/1.jpg" class="slide active" alt="">
        <img src="./imagens/slides-homepage/2.jpg" class="slide" alt="">
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
                            <img src="/bico-certo/imagens/carpenter-homepage.jpg">
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
                            <img src="../bico-certo/imagens/servicos/perfil_6.jpg">
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
                            <img src="../bico-certo/imagens/servicos/perfil_9.jpg">
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
                            <img src="../bico-certo/imagens/perfil/marcelo-fatudo.jpg">
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
                            <img src="../bico-certo/imagens/servicos/pefil_11.jpg">
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
                            <img src="../bico-certo/imagens/servicos/perfil_12.jpg">
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
                            <img src="../bico-certo/imagens/servicos/perfil_18.jpg">
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
                            <img src="../bico-certo/imagens/servicos/perfil_4.jpeg">
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
            <img src="../bico-certo/imagens/logomarca-dark-mode.png">
        </div>
        <div class="vertical-row"></div>
        <div class="footer-list">
            <ul>
                <li class="footer-list-option">
                    <a href="../bico-certo/paginas/contato.php">
                        Contato
                    </a>
                </li>
                <li class="footer-list-option">
                    <a href="../bico-certo/paginas/sobrenos.php">
                        Sobre
                    </a>
                </li>
                <li class="footer-list-option">
                    <a href="../bico-certo/paginas/cadastro.php">
                        Cadastro
                    </a>
                </li>
                <li class="footer-list-option">
                    <a href="../bico-certo/paginas/login.php">
                        Login
                    </a>
                </li>
            </ul>
        </div>
    </footer>

    <script src="./script/index/carousel.js"></script>
</body>
</html>
