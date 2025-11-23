<?php

// Apenas usuários registrados podem entrar nesta página
require_once __DIR__ . "/../server/logged-in-user.php";

// Apenas usuários do tipo "master" podem entrar nesta página
if ($_SESSION['tipoUsuario'] != 'master') {
    header('Location: ../paginas/erro.php');
    exit;
}

require_once __DIR__ . "/../server/config.php";

// Buscar nome e foto do usuário logado
$idUsuarioLogado = $_SESSION['usuario_id'] ?? null;
$fotoUsuario = null;
$nomeUsuario = 'Usuário'; // valor padrão

if ($idUsuarioLogado) {
    $stmtFoto = $pdo->prepare("SELECT nome, foto FROM usuarios WHERE id = ?");
    $stmtFoto->execute([$idUsuarioLogado]);
    $dadosUsuario = $stmtFoto->fetch(PDO::FETCH_ASSOC);

    if ($dadosUsuario) {
        $fotoUsuario = $dadosUsuario['foto'] ?? null;
        $nomeUsuario = $dadosUsuario['nome'] ?? 'Usuário';
    }
}

// Consulta de usuários
$termo = isset($_GET['termo']) ? trim($_GET['termo']) : '';

if ($termo !== '') {
    $stmt = $pdo->prepare("SELECT id, nome, login, email FROM usuarios WHERE LOWER(nome) LIKE ? OR id = ?");
    $stmt->execute(["%" . strtolower($termo) . "%", $termo]);
} else {
    $stmt = $pdo->query("SELECT id, nome, login, email FROM usuarios ORDER BY id ASC");
}

$usuarios = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Consulta de Usuários</title>
    <link rel="stylesheet" href="../css/consulta.css?v=3.0">
</head>
<body>
<header class="top-bar">
    <div class="logo">
        <a href="consulta.php">
            <img src="../imagens/logomarca.png" alt="Logo Bico Certo" class="logo-img">
        </a>
    </div>

    <div class="user-photo">
        <span class="user-name"><?= htmlspecialchars($nomeUsuario) ?></span>
        <?php if ($fotoUsuario): ?>
            <img src="../imagens/<?= htmlspecialchars($fotoUsuario) ?>" alt="Foto do usuário" class="user-img">
        <?php else: ?>
            <img src="../imagens/joao.jpg.jpeg" alt="Foto padrão" class="user-img">
        <?php endif; ?>
    </div>
</header>

<main>
    <h1>Consulta de Usuários</h1>
    <br>

    <form method="GET" action="consulta.php" class="search-bar">
        <input type="text" name="termo" placeholder="Pesquisar por Nome ou ID" value="<?= isset($_GET['termo']) ? htmlspecialchars($_GET['termo']) : '' ?>">
        <button type="submit">Consultar</button>
    </form>

    <table id="userTable">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nome</th>
                <th>Login</th>
                <th>Email</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($usuarios as $user): ?>
                <tr data-id="<?= $user['id'] ?>">
                    <td><?= $user['id'] ?></td>
                    <td><?= htmlspecialchars($user['nome']) ?></td>
                    <td><?= htmlspecialchars($user['login']) ?></td>
                    <td><?= htmlspecialchars($user['email']) ?></td>
                    <td>
                        <button class="delete-btn" data-id="<?= $user['id'] ?>">Excluir</button>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</main>

<footer>
    <div class="footer-image"><img src="../imagens/logomarca-dark-mode.png" alt="Bico Certo"></div>
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

<!-- Modais -->
<div id="deleteModal" class="modal hidden">
  <div class="modal-content">
    <p>Tem certeza que deseja excluir este usuário?</p>
    <button id="confirmDelete">Sim</button>
    <button id="cancelDelete">Cancelar</button>
  </div>
</div>

<div id="successDeleteModal" class="modal hidden">
  <div class="modal-content">
    <p>Usuário excluído com sucesso!</p>
    <button id="closeDeleteModal">OK</button>
  </div>
</div>

<script src="../script/consulta.js"></script>
</body>
</html>