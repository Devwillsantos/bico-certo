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
    $stmtFoto = $pdo->prepare("SELECT nome, fotoPerfil FROM usuarios WHERE id = ?");
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
<!-- Top Bar -->
<header class="top-bar">
    <div class="icone">
        <a href="./homepage.php">
            <img src="../imagens/logomarca.png" class="logomarca">
        </a>
    </div>
    <div class="menu">
        <div class="logo">
            <?php
                if ($_SESSION['tipoUsuario'] === 'master') {
                    require_once __DIR__ . "/../server/master-navbar.php";
                } 
            ?>
            <span>
                <a href="./servicos.php">
                    <img src="../imagens/perfil/servicos.svg">
                </a>
            </span>
        </div>
        <div class="user-name logo">
            <p id="username">
                <?php echo $_SESSION['usuario_login']; ?>
            </p>
        </div>
        <!-- Ícone de perfil com menu de opções -->
        <div class="logo" onclick="toggleProfileMenu()">
            <img src="<?php echo '../' . $_SESSION['usuario_foto']; ?>">
        </div>
    </div>
</header>

<!-- Profile Menu -->
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
        <li><a href="./profile-edit.php">Editar Perfil</a></li>
        <li><a href="../index.php" id="logout">Sair</a></li>
    </ul>
</div>

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

<!-- Footer -->
<footer>
    <div class="footer-image">
        <img src="../imagens/logomarca-dark-mode.png">
    </div>
    <div class="vertical-row"></div>
    <div class="footer-list">
        <ul>
            <li class="footer-list-option"><a href="./contato.php" target="_blank">Contato</a></li>
            <li class="footer-list-option"><a href="./sobrenos.php" target="_blank">Sobre</a></li>
        </ul>
    </div>
</footer>

<script src="../script/perfil/perfil.js"></script>
<script src="../script/user-login.js"></script>
<script src="../script/user-logout.js"></script>
</body>
</html>