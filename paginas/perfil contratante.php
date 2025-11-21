<?php
session_start();
require_once __DIR__ . "/../server/config.php";
require_once "../server/perfil/informaçoes.php";

// Variáveis padrão / sessão (mesma lógica do outro HTML)
$id_usuario_logado = $_SESSION['usuario_id'] ?? null;           // id do usuário logado
$login_usuario     = $_SESSION['login_usuario'] ?? 'Usuário';   // login do logado
$foto_usuario      = $_SESSION['foto_usuario'] ?? 'imagens/servicos/perfil_6.jpg'; // foto do logado

// $id_usuario vem do informaçoes.php (id do perfil que está sendo visto)
// $usuario e $avaliacoes também são carregados em informaçoes.php
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <title>Perfil Contratante - <?= htmlspecialchars($usuario['nome'] ?? 'Perfil') ?></title>

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
        
        <!-- FOTO DO USUÁRIO LOGADO -->
        <div class="user-display">
          <span><?php echo $_SESSION['usuario_login']; ?></span>
          <div class="logo" onclick="toggleProfileMenu()">
            <img src="<?php echo '../' . $_SESSION['usuario_foto']; ?>">
          </div>
        </div>
      </div>
    </header>

    <!-- MENU PERFIL -->
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
        <li><a href="./profile-edit.php?id=<?= htmlspecialchars($id_usuario_logado) ?>">Editar Perfil</a></li>
        <li><a href="./login.php" id="logout">Sair</a></li>
      </ul>
    </div>

    <!-- PERFIL -->
    <div class="profile">
      <div class="banner">
          <?php
            $capa = !empty($usuario['foto_capa'])
                ? (strpos($usuario['foto_capa'], 'uploads/') === 0 ? "../" . $usuario['foto_capa'] : "../uploads/capas/" . $usuario['foto_capa'])
                : "../imagens/perfil/fundo.jpg";
          ?>
          <img src="<?= $capa ?>" alt="Capa do perfil">
        </div>

      <div class="profile-info-container">
        <!-- FOTO DO DONO DO PERFIL -->
        <div class="profile-pic">
          <img src="../<?= htmlspecialchars($usuario['foto'] ?? 'imagens/servicos/perfil_6.jpg') ?>"
               alt="Foto do perfil"
               onerror="this.onerror=null;this.src='../imagens/servicos/perfil_6.jpg'">
        </div>

        <div class="user-info">
          <div class="user-title">
            <h2><?= htmlspecialchars($usuario['nome'] ?? 'Usuário') ?></h2>

            <?php if (($id_usuario ?? null) != $id_usuario_logado): ?>
              <button id="abrirModal" class="btn-avaliar">⭐ Avaliar</button>
            <?php endif; ?>
          </div>

          <p><strong>Registro em:</strong>
            <?= !empty($usuario['data_registro']) ? date('d/m/Y', strtotime($usuario['data_registro'])) : '---' ?>
          </p>
          <p><strong>Última visita:</strong>
            <?= !empty($usuario['ultima_visita']) ? date('d/m/Y', strtotime($usuario['ultima_visita'])) : 'Primeiro acesso' ?>
          </p>
        </div>
      </div>
    </div>

    <!-- CONTEÚDO -->
    <div class="main-content">
      <div class="user-details">
        <h3>Informações</h3>
        <p><strong>Nome:</strong> <?= htmlspecialchars($usuario['nome'] ?? '-') ?></p>
        <p><strong>Gênero:</strong> <?= htmlspecialchars($usuario['genero'] ?? '-') ?></p>
        <p><strong>Data de nascimento:</strong> <?= !empty($usuario['data_nascimento']) ? date('d/m/Y', strtotime($usuario['data_nascimento'])) : '-' ?></p>
        <p><strong>Localidade:</strong> <?= htmlspecialchars($usuario['estado'] ?? '-') ?></p>

        <!-- Mostrar 'Serviço' apenas se o dono do perfil for prestador e houver serviço definido -->
        <?php if (!empty($usuario['tipoUsuario']) && $usuario['tipoUsuario'] === 'prestador' && !empty($usuario['servico'])): ?>
          <p><strong>Serviço:</strong> <?= htmlspecialchars($usuario['servico']) ?></p>
        <?php endif; ?>

        <h4>Resumo de Contratações</h4>
        <p><strong>Contratos Concluídos:</strong> <span><?= htmlspecialchars($usuario['contratos_concluidos'] ?? 0) ?></span></p>
        <p><strong>Última Contratação:</strong>
          <?= !empty($usuario['ultima_contratacao']) ? date('d/m/Y', strtotime($usuario['ultima_contratacao'])) : 'Nenhuma ainda' ?>
        </p>

        <p><strong>Descrição:</strong></p>
        <div class="descricao-box">
          <p><?= nl2br(htmlspecialchars($usuario['descricao'] ?? 'Nenhuma descrição disponível.')) ?></p>
        </div>
      </div>

      <!-- AVALIAÇÕES -->
      <div class="activities" id="atividades">
        <h3>Reclamações ou Opiniões</h3>

        <!-- ESSENCIAL PARA O JS FUNCIONAR -->
        <input type="hidden" id="id_usuario" value="<?= htmlspecialchars($id_usuario ?? '') ?>">

        <div id="reclamacoesContainer" class="activity-list" data-avatar="<?= htmlspecialchars($usuario['foto'] ?? '') ?>">
          <?php if (empty($avaliacoes)): ?>
            <p id="semAvaliacoes">Sem avaliações ainda.</p>
          <?php else: ?>
            <?php foreach ($avaliacoes as $a): 
              // garantir chaves que usamos: foto_usuario, nome_avaliador, comentario, data (ou data_comentario)
              $avatar = !empty($a['foto_usuario']) ? "../" . $a['foto_usuario'] : '../imagens/servicos/perfil_6.jpg';
              $nomeAval = !empty($a['nome_avaliador']) ? $a['nome_avaliador'] : 'Usuário';
              $texto = htmlspecialchars($a['comentario'] ?? '');
              // data pode vir em 'data' ou 'data_comentario' conforme sua query — tenta ambos
              $dataRaw = $a['data'] ?? $a['data_comentario'] ?? null;
              $dataFmt = !empty($dataRaw) ? date('d/m/Y H:i', strtotime($dataRaw)) : '';
            ?>
              <div class="activity">
                <a href="./perfil.php?id=<?= htmlspecialchars($a['id_usuario']) ?>">
                  <img class="perfil" src="<?= htmlspecialchars($avatar) ?>" alt="Avatar"
                       onerror="this.onerror=null;this.src='../imagens/servicos/perfil_6.jpg'">
                </a>

                <div class="activity-content">
                  <p><strong>
                    <?php
                      $link = (isset($a['tipo_usuario']) && $a['tipo_usuario'] === 'prestador')
                        ? './perfil.php?id=' . htmlspecialchars($a['id_usuario'])
                        : './perfil%20contratante.php?id=' . htmlspecialchars($a['id_usuario']);
                    ?>
                    <a href="<?= $link ?>"><?= htmlspecialchars($nomeAval) ?></a>
                  </strong> comentou no perfil.</p>
                  <p><?= $texto ?></p>

                  <div class="activity-interactions">
                    <i class="fas fa-clock icon-relogio" aria-hidden="true"></i>
                    <span><?= htmlspecialchars($dataFmt) ?></span>
                  </div>
                </div>
              </div>
              <hr>
            <?php endforeach; ?>
          <?php endif; ?>
        </div>
      </div>
    </div>
  </div>

  <!-- MODAL DE AVALIAÇÃO -->
  <div id="modalAvaliacao" class="modal" aria-hidden="true" style="display:none;">
    <div class="modal-content" role="dialog" aria-labelledby="tituloModal">
      <span id="fecharModal" class="fechar" aria-label="Fechar">&times;</span>

      <h2 id="tituloModal">Avaliar <?= htmlspecialchars($usuario['nome'] ?? '') ?></h2>

      <form id="formAvaliacao" method="POST" action="../server/comments/salvar_comentario.php">
        <textarea name="comentario" placeholder="Escreva sua avaliação..." required></textarea>

        <!-- ID do perfil que está sendo avaliado (dono do perfil) -->
        <input type="hidden" name="id_perfil" value="<?= htmlspecialchars($id_usuario ?? '') ?>">

        <!-- Dados do avaliador (vem da sessão / mesmo padrão do outro HTML) -->
        <input type="hidden" name="id_avaliador" value="<?= htmlspecialchars($id_usuario_logado ?? '') ?>">
        <input type="hidden" name="nome_avaliador" value="<?= htmlspecialchars($login_usuario ?? '') ?>">
        <input type="hidden" name="foto_avaliador" value="<?= htmlspecialchars($foto_usuario ?? '') ?>">

        <button type="submit" class="btn-enviar">Enviar Avaliação</button>
      </form>
    </div>
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

  <script src="../script/perfil/avaliacao.js"></script>
  <script src="../script/perfil/perfil.js"></script>
</body>
</html>
