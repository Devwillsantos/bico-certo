<?php
session_start();
require_once __DIR__ . "/../server/config.php"; 
require_once "../server/perfil/informaçoes.php";
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <title>Perfil Contratante - <?= htmlspecialchars($usuario['nome']) ?></title>
  
  <link rel="icon" href="../imagens/icones-aba/icone16.ico" sizes="16x16">
  <link rel="icon" href="../imagens/icones-aba/icone24.ico" sizes="24x24">
  <link rel="icon" href="../imagens/icones-aba/icone32.ico" sizes="32x32">
  <link rel="icon" href="../imagens/icones-aba/icone48.ico" sizes="48x48">

  <link rel="stylesheet" href="../css/perfil.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>

<body>

<div class="container">

  <!-- TOPO -->
  <header class="top-bar">
    <div class="icone">
      <a href="./homepage.php"><img src="../imagens/logomarca.png" class="logomarca" alt="Bico Certo"></a>
    </div>

    <div class="menu">
      <div class="logo"><a href="./servicos.php"><img src="../imagens/perfil/servicos.svg" alt="Serviços"></a></div>
      <div class="logo"><a href="./mensagem.php"><img src="../imagens/perfil/envelope.svg" alt="Mensagens"></a></div>
      <div class="logo"><a href="./notifications.php"><img src="../imagens/perfil/notificação.svg" alt="Notificações"></a></div>

      <div class="user-display">
        <span>
          <?php
            $sql = "SELECT login FROM usuarios WHERE id = :id";
            $stmt = $pdo->prepare($sql);
            $stmt->execute(['id' => $_SESSION['usuario_id']]);
            $usuario = $stmt->fetch(PDO::FETCH_ASSOC);
            $login = $usuario['login'];
          ?>
          <p id="username">
            <?php echo $login; ?>
          </p>
        </span>
        <div class="logo" onclick="toggleProfileMenu()">
          <?php
            $sql = "SELECT fotoPerfil FROM usuarios WHERE id = :id";
            $stmt = $pdo->prepare($sql);
            $stmt->execute(['id' => $_SESSION['usuario_id']]);
            $usuario = $stmt->fetch(PDO::FETCH_ASSOC);
            $foto_perfil = $usuario['fotoPerfil'];
          ?>
          <img src="<?php echo '../' . $foto_perfil; ?>">
        </div>
      </div>
    </div>
  </header>

  <!-- MENU PERFIL -->
  <div class="profile-menu" id="profileMenu">
    <ul>
      <li><a href="./perfil.php?id=<?= $id_usuario ?>">Meu Perfil</a></li>
      <li><a href="./profile-edit.php?id=<?= $id_usuario ?>">Editar Perfil</a></li>
      <li><a href="./login.php" id="logout">Sair</a></li>
    </ul>
  </div>

  <!-- PERFIL -->
  <div class="profile">
    <div class="banner">
      <img src="../imagens/perfil/fundo.jpg" alt="Capa do perfil">
    </div>

    <div class="profile-info-container">
      <div class="profile-pic">
        <img src="<?= htmlspecialchars($usuario['foto']) ?>" alt="Foto de perfil">
      </div>

      <div class="user-info">
        <h2><?= htmlspecialchars($usuario['nome']) ?></h2>
        <p><strong>Registro em:</strong> <?= date('d/m/Y', strtotime($usuario['data_registro'])) ?></p>
        <p><strong>Última visita:</strong> 
          <?= !empty($usuario['ultima_visita']) ? date('d/m/Y H:i', strtotime($usuario['ultima_visita'])) : 'Primeiro acesso' ?>
        </p>
      </div>

      <!-- BOTÃO ABRIR MODAL -->
      <button id="abrirModal" class="btn-avaliar">Avaliar</button>
    </div>
  </div>

  <!-- CONTEÚDO -->
  <div class="main-content">
    <div class="user-details">
      <h3>Informações</h3>
      <p><strong>Nome:</strong> <?= htmlspecialchars($usuario['nome']) ?></p>
      <p><strong>Gênero:</strong> <?= htmlspecialchars($usuario['genero']) ?></p>
      <p><strong>Data de nascimento:</strong> <?= htmlspecialchars($usuario['data_nascimento']) ?></p>
      <p><strong>Localidade:</strong> <?= htmlspecialchars($usuario['cidade']) ?></p>

      <h4>Resumo de Contratações</h4>
      <p><strong>Contratos Concluídos:</strong> 
        <span><?= htmlspecialchars($usuario['contratos_concluidos']) ?></span>
      </p>
      <p><strong>Última Contratação:</strong>
        <?= $usuario['ultima_contratacao'] ? date('d/m/Y', strtotime($usuario['ultima_contratacao'])) : 'Nenhuma ainda' ?>
      </p>
    </div>

    <!-- ATIVIDADES -->
    <div class="activities" id="atividades">
      <h3>Reclamações ou Opiniões</h3>

      <!-- ESSENCIAL PARA O JS FUNCIONAR -->
      <input type="hidden" id="id_usuario" value="<?= htmlspecialchars($id_usuario) ?>">

      <div id="reclamacoesContainer" class="activity-list"
           data-avatar="<?= htmlspecialchars($usuario['foto']) ?>">

        <?php if (empty($avaliacoes)): ?>
          <p id="semAvaliacoes">Sem avaliações ainda.</p>

        <?php else: foreach ($avaliacoes as $a): ?>
          <?php
          $avatar = $a['foto_avaliador'] ?: '../imagens/servicos/perfil_6.jpg';
          $nomeAval = $a['nome_avaliador'] ?: 'Usuário';
          $texto = htmlspecialchars($a['comentario']);
          $dataFmt = !empty($a['data']) ? date('d/m/Y H:i', strtotime($a['data'])) : '';
          ?>

          <div class="activity">
            <img class="perfil" src="<?= htmlspecialchars($avatar) ?>"
             onerror="this.onerror=null;this.src='../imagens/servicos/perfil_6.jpg'">

            <div class="activity-content">
              <p><strong><?= htmlspecialchars($nomeAval) ?></strong> comentou no seu Perfil.</p>
              <p><?= $texto ?></p>

              <div class="activity-interactions">
                <img src="../imagens/icones/relogio.png" alt="Hora">
                <span><?= $dataFmt ?></span>
              </div>
            </div>
          </div>
          <hr>

        <?php endforeach; endif; ?>

      </div>
    </div>
  </div>

  <div id="lista-comentarios"></div>
</div>

<!-- FOOTER -->
<footer>
  <div class="footer-image"><img src="../imagens/logomarca-dark-mode.png" alt="Bico Certo"></div>
  <div class="vertical-row"></div>
  <div class="footer-list">
    <ul>
      <li><a href="./contato.php">Contato</a></li>
      <li><a href="./sobrenos.php">Sobre</a></li>
      <li><a href="./cadastro.php">Cadastro</a></li>
      <li><a href="./login.php">Login</a></li>
    </ul>
  </div>
</footer>

<!-- MODAL -->
<div id="modalAvaliacao" class="modal" aria-hidden="true">
  <div class="modal-content" role="dialog">
    <span id="fecharModal" class="fechar">&times;</span>

    <h2>Avaliar <?= htmlspecialchars($usuario['nome']) ?></h2>

    <form id="formAvaliacao">

      <textarea name="comentario" 
                placeholder="Escreva sua avaliação..." 
                required></textarea>

      <!-- ID correto para salvar -->
      <input type="hidden" name="id_usuario" value="<?= htmlspecialchars($id_usuario) ?>">

      <!-- Nome do avaliador -->
      <input type="hidden" name="nome" value="<?= htmlspecialchars($usuario['nome']) ?>">

      <button type="submit" class="btn-enviar">Enviar Avaliação</button>
    </form>
  </div>
</div>

<script src="../script/perfil/avaliacao.js"></script>
<script src="../script/perfil/ultima_visita.js"></script>
<script src="../script/perfil/perfil.js"></script>

</body>
</html>