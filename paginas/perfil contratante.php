<?php
require_once '../server/logged-in-user.php';
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Perfil</title>

  <!-- Favicon -->
  <link rel="icon" href="../imagens/icones-aba/icone16.ico" sizes="16x16">
  <link rel="icon" href="../imagens/icones-aba/icone24.ico" sizes="24x24">
  <link rel="icon" href="../imagens/icones-aba/icone32.ico" sizes="32x32">
  <link rel="icon" href="../imagens/icones-aba/icone48.ico" sizes="48x48">

  <!-- CSS -->
  <link rel="stylesheet" href="../css/perfilcontratante.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>
  <div class="container">
    <!-- Top Bar -->
    <header class="top-bar">
      <div class="icone">
        <a href="./homepage.php">
          <img src="../imagens/logomarca.png" class="logomarca" alt="Logomarca">
        </a>
      </div>
      <div class="menu">
        <div class="logo">
          <a href="./servicos.php">
            <img src="../imagens/perfil/servicos.svg" alt="Serviços">
          </a>
        </div>
        <div class="logo">
          <a href="./mensagem.php">
            <img src="../imagens/perfil/envelope.svg" alt="Mensagens">
          </a>
        </div>
        <div class="logo">
          <a href="./notifications.php">
            <img src="../imagens/perfil/notificação.svg" alt="Notificações">
          </a>
        </div>
        <!-- Ícone de perfil com menu -->
        <div class="logo" onclick="toggleProfileMenu()">
          <img src="../imagens/servicos/perfil_6.jpg" alt="Perfil">
        </div>
      </div>
    </header>

    <!-- Profile Menu -->
    <div class="profile-menu" id="profileMenu">
      <ul>
        <li><a href="../paginas/perfil contratante.php">Meu Perfil</a></li>
        <li><a href="../paginas/profile-edit.php">Editar Perfil</a></li>
        <li><a href="../index.php" id="logout">Sair</a></li>
      </ul>
    </div>

    <!-- Profile -->
    <div class="profile">
      <div class="banner">
        <img src="../imagens/perfil/fundo.jpg" alt="Banner do Perfil">
      </div>

      <div class="profile-info-container">
        <div class="profile-pic">
          <img src="../imagens/servicos/perfil_6.jpg" alt="Foto do Perfil">
        </div>
        <div class="user-info">
          <h2>Hudson Alves</h2>
          <p>⭐⭐⭐⭐⭐</p>
          <p><strong>Registro em</strong>: Abril 20, 2024</p>
          <p><strong>Última visita</strong>: <span id="ultima-visita"></span></p>
        </div>

        <button id="abrirModal" class="btn-avaliar">⭐ Avaliar</button>

      </div>
    </div>

    <!-- Main Content -->
    <div class="main-content">
      <!-- User Details -->
      <div class="user-details">
        <h3>Informações</h3>
        <p><strong>Nome</strong>: Hudson Alves Souza Ribanreli</p>
        <p><strong>N.º do Celular</strong>: +55 (21) 91234-5678</p>
        <p><strong>Gênero</strong>: Masculino</p>

        <h4>Resumo De Contratações</h4>
        <p><strong>Contratos Concluídos:</strong> <span id="contratosConcluidos">0</span></p>
        <p><strong>Última Contratação:</strong> <span id="ultimaContratacao">Nenhuma ainda</span></p>


        <p><strong>Localidade</strong>: Rio De Janeiro</p>
      </div>

      <!-- Activities -->
      <div class="activities">
        <h3>Reclamações ou Opiniões</h3>

        <!-- Activity 1 -->
        <div class="activity">
          <img src="../imagens/servicos/perfil_5.jpeg" class="perfil" alt="Ricardo Alves">
          <div class="activity-content">
            <p><strong>Ricardo Alves curtiu seu Perfil.</strong></p>
            <div class="activity-interactions">
              <span><img src="../imagens/perfil/clock-blue.svg" alt="">Setembro 29, 2024</span>
            </div>
          </div>
        </div>

        <!-- Activity 2 -->
        <div class="activity">
          <img src="../imagens/servicos/perfil_14.jpg" class="perfil" alt="Roberto da Silva">
          <div class="activity-content">
            <p><strong>Roberto da Silva curtiu seu Perfil.</strong></p>
            <div class="activity-interactions">
              <span><img src="../imagens/perfil/clock-blue.svg" alt="">Setembro 26, 2024</span>
            </div>
          </div>
        </div>

        <!-- Activity 3 -->
        <div class="activity">
          <img src="../imagens/servicos/perfil_8.jpg" class="perfil" alt="Roberta Amarantos">
          <div class="activity-content">
            <p><strong>Roberta Amarantos comentou no seu Perfil.</strong></p>
            <p><i>Você foi bem receptivo, ofereceu café e deixou tudo organizado pra eu trabalhar. Recomendo como contratante!</i></p>
            <div class="activity-interactions">
              <span><img src="../imagens/perfil/clock-blue.svg" alt="">Setembro 26, 2024</span>
            </div>
          </div>
        </div>

        <!-- Activity 4 -->
        <div class="activity">
          <img src="../imagens/servicos/perfil_9.jpg" class="perfil" alt="Élio Alves">
          <div class="activity-content">
            <p><strong>Élio Alves comentou no seu Perfil.</strong></p>
            <p><i>Foi uma boa experiência, mas senti que faltou um pouco mais de clareza nas instruções. Fora isso, tudo certo.</i></p>
            <div class="activity-interactions">
              <span><img src="../imagens/perfil/clock-blue.svg" alt="">Setembro 25, 2024</span>
            </div>
          </div>
        </div>

        <!-- Activity 5 -->
        <div class="activity">
          <img src="../imagens/servicos/perfil_20.jpg" class="perfil" alt="Rodrigo Almeida">
          <div class="activity-content">
            <p><strong>Rodrigo Almeida comentou no seu Perfil.</strong></p>
            <p><i>Infelizmente tive dificuldades, pois não recebi o pagamento no prazo combinado. Acho que isso poderia melhorar.</i></p>
            <div class="activity-interactions">
              <span><img src="../imagens/perfil/clock-blue.svg" alt="">Setembro 15, 2024</span>
            </div>
          </div>
        </div>

        <!-- Activity 6 -->
        <div class="activity">
          <img src="../imagens/servicos/perfil_1.jpeg" class="perfil" alt="Rafaela Andrade">
          <div class="activity-content">
            <p><strong>Rafaela Andrade comentou no seu Perfil.</strong></p>
            <p><i>Foi ótimo trabalhar pra você! Tudo organizado, pagamento certo e ambiente tranquilo. Espero voltar em breve.</i></p>
            <div class="activity-interactions">
              <span><img src="../imagens/perfil/clock-blue.svg" alt="">Setembro 10, 2024</span>
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
                <li class="footer-list-option"><a href="./contato.php" target="_blank">Contato</a></li>
                <li class="footer-list-option"><a href="./sobrenos.php" target="_blank">Sobre</a></li>
                <li class="footer-list-option"><a href="./cadastro.php" target="_blank">Cadastro</a></li>
                <li class="footer-list-option"><a href="./login.php" target="_blank">Login</a></li>
                </ul>
            </div>
        </footer>

        <div id="modalAvaliacao" class="modal">
          <div class="modal-content">
            <span id="fecharModal" class="fechar">&times;</span>
            <h2>Avaliar Hudson Alves</h2>

            <form action="avaliar.php" method="POST">
              <div class="estrelas"> 
                <input type="hidden" name="nota" id="nota"> 
                <i class="estrela" data-valor="1">★</i>
                <i class="estrela" data-valor="2">★</i>
                <i class="estrela" data-valor="3">★</i>
                <i class="estrela" data-valor="4">★</i>
                <i class="estrela" data-valor="5">★</i>
              </div>
              <textarea name="comentario" placeholder="Escreva sua avaliação..."  required></textarea>
              <input type="hidden" name="id_avaliado" value="<php echo $id_usuario; ?>">
              <button type="submit" class="btn-enviar">Enviar Avaliação</button> 
            </form>
          </div>
        </div>
   <!-- Scripts -->
  <script src="../script/perfil/ultima visista.js"></script>
  <script src="../script/perfil/perfil.js"></script>
  <script src="../script/perfil/contado.js"></script>
  <script src="../script/perfil/avaliacao.js"></script>
</body>
</html>