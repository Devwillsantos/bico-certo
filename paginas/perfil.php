<!DOCTYPE html> 
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perfil</title>
    <link rel="icon" href="../imagens/icones-aba/icone16.ico" sizes="16x16">
    <link rel="icon" href="../imagens/icones-aba/icone24.ico" sizes="24x24">
    <link rel="icon" href="../imagens/icones-aba/icone32.ico" sizes="32x32">
    <link rel="icon" href="../imagens/icones-aba/icone48.ico" sizes="48x48">
    <link rel="stylesheet" href="../css/perfil.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>
    <div class="container">
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
        <div class="profile-menu" id="profileMenu">
            <ul>
                <li><a href="./perfil.html">Meu Perfil</a></li>
                <li><a href="./profile-edit.html">Editar Perfil</a></li>
                <li><a href="./login.html" id="logout">Sair</a></li>
            </ul>
        </div>

        <!-- Profile Section -->
        <div class="profile"> <!-- Seção que contém as informações do perfil do usuário -->
            <!-- Banner Section -->
            <div class="banner"> <!-- Seção do banner de perfil -->
                <img src="../imagens/perfil/fundo.jpg"> <!-- Imagem do banner, representando o perfil -->
            </div>
        
            <!-- Profile Info Section -->
            <div class="profile-info-container"> <!-- Contêiner para as informações do perfil -->
                <div class="profile-pic"> <!-- Seção para a foto de perfil do usuário -->
                    <img src="../imagens/servicos/perfil_6.jpg"> <!-- Imagem da foto de perfil -->
                </div>
                <div class="user-info"> <!-- Seção que contém as informações do usuário -->
                    <h2>Hudson Alves</h2> <!-- Nome do usuário -->
                   
                    <select id="status" name="status" onchange="updateStatusColor()"> <!-- Dropdown para selecionar o status do usuário -->
                        <option value="Disponível">Disponível</option> <!-- Opção para status disponível -->
                        <option value="Trabalhando">Trabalhando</option> <!-- Opção para status de trabalho -->
                        <option value="Descansando">Descansando</option> <!-- Opção para status de descanso -->
                        <option value="Férias">Férias</option> <!-- Opção para status de férias -->''
                    </select>
                    <span id="status-indicator" class="status-indicator"></span> <!-- Indicador visual do status selecionado -->
                    <p>⭐⭐⭐⭐⭐</p>
                    <p><strong>Registro em</strong>: Janeiro 24, 2024</p> <!-- Data em que o usuário se registrou -->
                    <p><strong>Última visita</strong>: <span id="ultima-visita"></span></p> <!-- Última visita do usuário (preenchido dinamicamente) -->
                </div>
            </div>
        </div>

        <!-- Main Content -->
        <div class="main-content"> <!-- Seção principal do conteúdo, onde as informações detalhadas do usuário são exibidas -->
            <!-- Left Column - User Info -->
            <div class="user-details"> <!-- Coluna esquerda contendo informações do usuário -->
                <h3>Informações</h3> <!-- Título para a seção de informações -->
                <p><strong>Nome</strong>: Hudson Alves Souza Ribanreli</p> <!-- Nome completo do usuário -->
                
                <p><strong>N.º do Celular</strong>: +55 (21) 91234-5678</p> <!-- Nome completo do usuário -->

                <p><strong>Gênero</strong>: Masculino</p> <!-- Gênero do usuário -->
                
                <p><strong>Data de nascimento</strong>: 11/09/1970</p> <!-- Data de nascimento do usuário -->
                
                <p><strong>Profissão</strong>: Montador de Imóveis</p> <!-- Profissão do usuário -->
                
                <p><strong>Localidade</strong>: Rio De Janeiro</p> <!-- Localização do usuário -->

                <h4>Resumo De Contratações</h4>
                <p><strong>Contratos Concluídos:</strong> <span id="contratosConcluidos">0</span></p>
                <p><strong>Contratos em Andamento:</strong> <span id="contratosAndamento">0</span></p>
                <p><strong>Última Contratação:</strong> <span id="ultimaContratacao">Nenhuma ainda</span></p>
                
                <p><strong>Descrição</strong>:</p> <!-- Título para a seção de descrição do usuário -->
                <div class="descricao-box"> <!-- Caixa que contém a descrição do usuário -->
                    <p>Olá, muito prazer! Meu nome é Hudson Alves Souza Ribanreli, tenho 54 anos e sou montador de móveis, com mais de três décadas de experiência dedicada a essa arte. Nascido e criado na vibrante cidade do Rio de Janeiro, cresci rodeado pela energia criativa que me inspirou desde cedo. Sempre tive uma verdadeira paixão por transformar peças soltas em algo que não apenas seja funcional, mas que também carregue beleza e personalidade. Ao longo dos anos, aperfeiçoei minhas habilidades, buscando entregar sempre o melhor em cada projeto que realizo, com atenção aos detalhes e compromisso com a satisfação dos meus clientes.</p> <!-- Descrição pessoal do usuário -->
                </div>
            </div>

            <!-- Right Column - Activities -->
            <div class="activities"> <!-- Coluna direita que lista as atividades relacionadas ao usuário -->
                <h3>Reclamações ou Opiniões</h3> <!-- Título para a seção de atividades -->

                <!-- Activity 1 -->
                <div class="activity"> <!-- Seção para a primeira atividade -->
                    <img src="../imagens/servicos/perfil_5.jpeg" class="perfil"> <!-- Imagem do usuário que interagiu -->
                    <div class="activity-content"> <!-- Contêiner para o conteúdo da atividade -->
                        <p><strong>Ricardo Alves curtiu seu Perfil.</strong></p> <!-- Mensagem indicando que o usuário "Gordinho_com_fome" curtiu o perfil -->
                        <div class="activity-interactions"> <!-- Seção para interações da atividade -->
                            <span><img src="../imagens/perfil/clock-blue.svg">Setembro 29, 2024</span> <!-- Data da interação -->
                        </div>
                    </div>
                </div>
                    
                <!-- Activity 2 -->
                <div class="activity"> <!-- Seção para a segunda atividade -->
                    <img src="../imagens/servicos/perfil_14.jpg" class="perfil"> <!-- Imagem do usuário que interagiu -->
                    <div class="activity-content"> <!-- Contêiner para o conteúdo da atividade -->
                        <p><strong>Roberto da Silva curtiu seu Perfil.</strong></p> <!-- Mensagem indicando que o "Canal do Ronaldinho" curtiu o perfil -->
                        <div class="activity-interactions"><!-- Seção para interações da atividade -->
                            <span><img src="../imagens/perfil/clock-blue.svg">Setembro 26, 2024</span><!-- Data da interação -->
                        </div>
                    </div>
                </div>

                <!-- Activity 3 - Comentário -->
                <div class="activity"> <!-- Seção para a terceira atividade -->
                    <img src="../imagens/servicos/perfil_8.jpg" class="perfil"> <!-- Imagem do usuário que interagiu -->
                    <div class="activity-content"> <!-- Contêiner para o conteúdo da atividade -->
                        <p><strong>Roberta Amarantos comentou no seu Perfil.</strong></p> <!-- Mensagem indicando que o "Canal do Ronaldinho" comentou no perfil -->
                        <p><i>Cara, você manda muito bem! O jeito que você deixa tudo no capricho é de tirar o chapéu. Trabalho incrível!</i></p> <!-- Comentário feito pelo "Canal do Ronaldinho" -->
                        <div class="activity-interactions"> <!-- Seção para interações da atividade -->
                            <span><img src="../imagens/perfil/clock-blue.svg">Setembro 26, 2024</span> <!-- Data da interação -->
                        </div>
                    </div>
                </div>

                <!-- Activity 4 -->
                <div class="activity"> <!-- Seção para a quarta atividade -->
                    <img src="../imagens/servicos/perfil_9.jpg" class="perfil"> <!-- Imagem do usuário que interagiu -->
                    <div class="activity-content"> <!-- Contêiner para o conteúdo da atividade -->
                        <p><strong>Élio Alves comentou no seu Perfil.</strong></p> <!-- Mensagem indicando que o "Pastor" comentou no perfil -->
                        <p><i>Parabéns, viu? Dá pra ver que você entende do que faz! Cada detalhe ficou show de bola.</i></p> <!-- Comentário feito pelo "Pastor" -->
                        <div class="activity-interactions"> <!-- Seção para interações da atividade -->
                            <span><img src="../imagens/perfil/clock-blue.svg">Setembro 25, 2024</span> <!-- Data da interação -->
                        </div>
                    </div>
                </div>

                <!-- Activity 5 -->
                <div class="activity"> <!-- Seção para a quinta atividade -->
                    <img src="../imagens/servicos/perfil_20.jpg" class="perfil"> <!-- Imagem do usuário que interagiu -->
                    <div class="activity-content"> <!-- Contêiner para o conteúdo da atividade -->
                        <p><strong>Rodrigo Almeida comentou no seu Perfil.</strong></p> <!-- Mensagem indicando que o usuário "bora_bil" comentou no perfil -->
                        <p><i>Você é fera demais! Não é qualquer um que consegue deixar tudo tão bem feito e ainda com esse acabamento top.</i></p> <!-- Comentário feito pelo "bora_bil" -->
                        <div class="activity-interactions"> <!-- Seção para interações da atividade -->
                            <span><img src="../imagens/perfil/clock-blue.svg">Setembro 15, 2024</span> <!-- Data da interação -->
                        </div>
                    </div>
                </div>

                <!-- Activity 6 -->
                <div class="activity"> <!-- Seção para a sexta atividade -->
                    <img src="../imagens/servicos/perfil_1.jpeg" class="perfil"> <!-- Imagem do usuário que interagiu -->
                    <div class="activity-content"> <!-- Contêiner para o conteúdo da atividade -->
                        <p><strong>Rafaela Andrade comentou no seu Perfil</strong></p> <!-- Mensagem indicando que "Julio Santos" comentou no perfil -->
                        <p><i>Seu trabalho é sensacional! Dá pra ver que você coloca coração e muito esforço no que faz. Ficou perfeito!</i></p> <!-- Comentário feito por "Julio Santos" -->
                        <div class="activity-interactions"> <!-- Seção para interações da atividade -->
                            <span><img src="../imagens/perfil/clock-blue.svg">Setembro 10, 2024</span> <!-- Data da interação -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
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
                    <li class="footer-list-option"><a href="./cadastro.html" target="_blank">Cadastro</a></li>
                    <li class="footer-list-option"><a href="./login.html" target="_blank">Login</a></li>
                </ul>
            </div>
        </footer>
    <script src="../script/perfil/status do perfil.js"></script> <!-- Link para o script que gerencia o status do perfil -->
    <script src="../script/perfil/ultima visista.js"></script><!-- Link para o script que atualiza a última visita -->
    <script src="../script/perfil/perfil.js"></script>
    <script src="../script/perfil/contado.js"></script>
    <script src="../script/user-login.js"></script>
    <script src="../script/user-logout.js"></script>
</body>
</html>
