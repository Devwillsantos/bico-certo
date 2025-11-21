<?php
include('../server/conexao.php');

if (!isset($_GET['id'])) {
    die("ID não informado.");
}

$id = $_GET['id'];

$stmt = $pdo->prepare("SELECT * FROM log WHERE idlog = ?");
$stmt->execute([$id]);
$log = $stmt->fetch();

if (!$log) {
    die("Log não encontrado.");
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Editar Log</title>
</head>

<body>

<h1>Editar Log #<?= $log['idlog'] ?></h1>

<form action="update_log.php" method="POST">

    <input type="hidden" name="idlog" value="<?= $log['idlog'] ?>">

    Login: <br>
    <input type="text" name="login" value="<?= $log['login'] ?>" required><br><br>

    Nome: <br>
    <input type="text" name="nome" value="<?= $log['nome'] ?>" required><br><br>

    CPF: <br>
    <input type="text" name="cpf" value="<?= $log['cpf'] ?>"><br><br>

    Ação: <br>
    <input type="text" name="acao" value="<?= $log['acao'] ?>" required><br><br>

    Descrição: <br>
    <textarea name="descricao" rows="4"><?= $log['descricao'] ?></textarea><br><br>

    Status: <br>
    <select name="status">
        <option value="Ativo" <?= $log['status'] === 'Ativo' ? 'selected' : '' ?>>Ativo</option>
        <option value="Inativo" <?= $log['status'] === 'Inativo' ? 'selected' : '' ?>>Inativo</option>
    </select><br><br>

    <button type="submit">Salvar</button>

</form>

<br>
<a href="log.php">Voltar</a>

</body>
</html>
