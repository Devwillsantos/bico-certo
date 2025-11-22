<?php

// Apenas usuários registrados podem entrar nesta página
require_once __DIR__ . "/../server/logged-in-user.php";

// Apenas usuários do tipo "master" podem entrar nesta página
if ($_SESSION['tipoUsuario'] != 'master') {
    header('Location: ../paginas/erro.php');
    exit;
}

// Inclui o arquivo de conexão, que garante que o banco e as tabelas existam
include('../server/config.php');

try {
    // Prepara a consulta SQL para buscar todos os registros da tabela de logs
    // ORDER BY idlog DESC → mostra o log mais recente primeiro
    $stmt = $pdo->prepare("SELECT * FROM log ORDER BY idlog DESC");
    $stmt->execute();

    // Armazena todos os resultados retornados pela consulta
    $logs = $stmt->fetchAll();

} catch (PDOException $e) {
    // Caso ocorra algum erro na consulta, o sistema interrompe e mostra a mensagem
    die("Erro ao carregar logs: " . $e->getMessage());
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Log do Sistema</title>
    <link rel="icon" href="../imagens/icones-aba/icone16.ico" sizes="16x16">
    <link rel="icon" href="../imagens/icones-aba/icone24.ico" sizes="24x24">
    <link rel="icon" href="../imagens/icones-aba/icone32.ico" sizes="32x32">
    <link rel="icon" href="../imagens/icones-aba/icone48.ico" sizes="48x48">
    <!-- CSS que estiliza a tabela de logs -->
    <link rel="stylesheet" href="../css/log.css">
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

<h1>Registros de Log</h1>

<!-- Tabela que exibirá os registros -->
<div class="tabela-container">

<!-- Campo de busca -->
    <div style="margin-top: 20px; text-align:center;">
        <input 
            type="text" 
            id="searchNome" 
            placeholder="Buscar por nome..."
            class="search-bar"
        >
    </div>

    <table>
        <thead>
            <tr>
                <!-- Cabeçalho das colunas -->
                <th>ID</th>
                <th>Login</th>
                <th>Nome</th>
                <th>CPF</th>
                <th>Ação</th>
                <th>Data</th>
                <th>Hora</th>
            </tr>
        </thead>
        <tbody>
            <!-- Percorre cada linha retornada do banco e exibe na tabela -->
            <?php foreach ($logs as $row): ?>
                <tr>
                    <td><?= $row['idlog'] ?></td>
                    <td><?= $row['login'] ?></td>
                    <td><?= $row['nome'] ?></td>
                    <td><?= $row['cpf'] ?></td>
                    <td><?= $row['acao'] ?></td>
                    <td><?= $row['data_log'] ?></td>
                    <td><?= $row['hora_log'] ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
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
        </ul>
    </div>
</footer>

<script>
    document.getElementById("searchNome").addEventListener("keyup", function () {
        let filtro = this.value.toLowerCase();
        let linhas = document.querySelectorAll("table tbody tr");

        linhas.forEach(function (linha) {
            let nome = linha.children[2].textContent.toLowerCase(); // Coluna "Nome"

            if (nome.includes(filtro)) {
                linha.style.display = "";
            } else {
                linha.style.display = "none";
            }
        });
    });
</script>

</body>
<script src="../script/perfil/perfil.js"></script>
<script src="../script/user-login.js"></script>
<script src="../script/user-logout.js"></script>
</html>

