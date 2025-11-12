<?php
require_once __DIR__ . "/../server/config.php"; // ✅ Conexão com o banco

$id_usuario = $_GET['id'] ?? null;

// 🔧 Perfil padrão (caso o ID seja inválido ou o usuário não exista)
$usuario = [
  'nome' => 'Usuário',
  'foto' => '../imagens/servicos/perfil_6.jpg',
  'data_registro' => date('Y-m-d'),
  'ultima_contratacao' => null,
  'contratos_concluidos' => 0,
  'genero' => 'Não informado',
  'data_nascimento' => 'Não informada',
  'cidade' => 'Não informada',
];

$avaliacoes = [];

// 🔹 Buscar informações do usuário no banco
if ($id_usuario) {
  $sql = "SELECT 
            id,
            nome,
            sexo AS genero,
            cidade,
            fotoPerfil AS foto,
            data_registro,
            ultima_visita
          FROM usuarios
          WHERE id = ?";
  $stmt = $pdo->prepare($sql);
  $stmt->execute([$id_usuario]);
  $dados = $stmt->fetch(PDO::FETCH_ASSOC);

  if ($dados) {
    foreach ($dados as $campo => $valor) {
      if (!empty($valor)) {
        $usuario[$campo] = $valor;
      }
    }
  }

  // 🔹 Atualizar última visita
  $pdo->prepare("UPDATE usuarios SET ultima_visita = NOW() WHERE id = ?")->execute([$id_usuario]);

  // 🔹 Buscar avaliações
  $sqlAval = "
    SELECT a.*, u.nome AS nome_avaliador, u.fotoPerfil AS foto_avaliador
    FROM avaliacoes a
    LEFT JOIN usuarios u ON a.id_avaliador = u.id
    WHERE a.id_avaliado = ?
    ORDER BY a.data DESC";
  $stmt = $pdo->prepare($sqlAval);
  $stmt->execute([$id_usuario]);
  $avaliacoes = $stmt->fetchAll(PDO::FETCH_ASSOC);
}
ob_clean();
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Perfil Contratante - <?= htmlspecialchars($usuario['nome']) ?></title>

  <!-- Ícones -->
  <link rel="icon" href="../imagens/icones-aba/icone16.ico" sizes="16x16">
  <link rel="icon" href="../imagens/icones-aba/icone24.ico" sizes="24x24">
  <link rel="icon" href="../imagens/icones-aba/icone32.ico" sizes="32x32">
  <link rel="icon" href="../imagens/icones-aba/icone48.ico" sizes="48x48">

  <!-- CSS -->
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

        <!-- 🔹 Nome e miniatura -->
        <div class="user-display">
          <span><?= htmlspecialchars($usuario['nome']) ?></span>
          <div class="logo" onclick="toggleProfileMenu()">
            <img src="<?= htmlspecialchars($usuario['foto']) ?>" alt="Perfil">
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
          <p><strong>Última visita:</strong> <?= !empty($usuario['ultima_visita']) ? date('d/m/Y H:i', strtotime($usuario['ultima_visita'])) : 'Primeiro acesso' ?></p>
        </div>
        <button id="abrirModal" class="btn-avaliar">⭐ Avaliar</button>
      </div>
    </div>

    <!-- CONTEÚDO -->
    <div class="main-content">
      <div class="user-details">
        <h3>Informações</h3>
        <p><strong>Nome:</strong> <?= htmlspecialchars($usuario['nome']) ?></p>
        <p><strong>Gênero:</strong> <?= htmlspecialchars($usuario['genero']) ?></p>
        <p><strong>Localidade:</strong> <?= htmlspecialchars($usuario['cidade']) ?></p>

        <h4>Resumo de Contratações</h4>
        <p><strong>Contratos Concluídos:</strong> 
          <span><?= htmlspecialchars($usuario['contratos_concluidos']) ?></span>
        </p>
        <p><strong>Última Contratação:</strong>
          <?= $usuario['ultima_contratacao'] ? date('d/m/Y', strtotime($usuario['ultima_contratacao'])) : 'Nenhuma ainda' ?>
        </p>
      </div>

      <div class="activities" id="atividades">
        <h3>Reclamações ou Opiniões</h3>

        <div id="reclamacoesContainer" class="activity-list">
          <?php if (empty($avaliacoes)): ?>
            <p id="semAvaliacoes">Sem avaliações ainda.</p>
          <?php else: ?>
            <?php foreach ($avaliacoes as $a): 
              $avatar = !empty($a['foto_avaliador']) ? $a['foto_avaliador'] : '../imagens/servicos/perfil_6.jpg';
              $nomeAval = !empty($a['nome_avaliador']) ? $a['nome_avaliador'] : 'Usuário';
              $texto = htmlspecialchars($a['comentario']);
              $dataFmt = !empty($a['data']) ? date('d/m/Y H:i', strtotime($a['data'])) : '';
            ?>
              <div class="activity">
                <img src="<?= htmlspecialchars($avatar) ?>" alt="Foto do avaliador" class="perfil">
                <div class="activity-content">
                  <p><strong><?= htmlspecialchars($nomeAval) ?></strong> comentou no seu Perfil.</p>
                  <p><?= $texto ?></p>
                  <div class="activity-interactions">
                    <img src="../imagens/icones/relogio.png" alt="Hora">
                    <span><?= $dataFmt ?></span>
                  </div>
                </div>
              </div>
            <?php endforeach; ?>
          <?php endif; ?>
        </div>
      </div>
    </div>
  </div>

  <footer>
    <div class="footer-image">
      <img src="../imagens/logomarca-dark-mode.png" alt="Bico Certo">
    </div>
    <div class="vertical-row"></div>
    <div class="footer-list">
      <ul>
        <li class="footer-list-option"><a href="./contato.php">Contato</a></li>
        <li class="footer-list-option"><a href="./sobrenos.php">Sobre</a></li>
        <li class="footer-list-option"><a href="./cadastro.php">Cadastro</a></li>
        <li class="footer-list-option"><a href="./login.php">Login</a></li>
      </ul>
    </div>
  </footer>

  <!-- MODAL -->
  <div id="modalAvaliacao" class="modal" aria-hidden="true">
    <div class="modal-content" role="dialog" aria-labelledby="tituloModal">
      <span id="fecharModal" class="fechar" aria-label="Fechar">&times;</span>
      <h2 id="tituloModal">Avaliar <?= htmlspecialchars($usuario['nome']) ?></h2>

      <form id="formAvaliacao">
        <textarea name="comentario" placeholder="Escreva sua avaliação..." required></textarea>
        <input type="hidden" name="id_avaliado" value="<?= htmlspecialchars($id_usuario) ?>">
        <button type="submit" class="btn-enviar">Enviar Avaliação</button>
      </form>
    </div>
  </div>

  <!-- JS -->
  <script src="../script/perfil/avaliacao.js"></script>
  <script src="../script/perfil/ultima visista.js"></script>
  <script src="../script/perfil/perfil.js"></script>
</body>
</html>
