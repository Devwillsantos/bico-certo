<?php
include('../server/log/conexao.php');

try {
    $stmt = $pdo->prepare("SELECT * FROM log ORDER BY idlog DESC");
    $stmt->execute();
    $logs = $stmt->fetchAll();
} catch (PDOException $e) {
    die("Erro ao carregar logs: " . $e->getMessage());
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Log do Sistema</title>
    <link rel="stylesheet" href="../css/log.css">
</head>

<body>
<h1>Registros de Log</h1>

<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>Login</th>
            <th>Nome</th>
            <th>CPF</th>
            <th>Ação</th>
            <th>Data</th>
            <th>Hora</th>
            <th>Status</th>
            <th>Ações</th>
        </tr>
    </thead>

    <tbody>
        <?php foreach ($logs as $row): ?>
            <tr>
                <td><?= $row['idlog'] ?></td>
                <td><?= $row['login'] ?></td>
                <td><?= $row['nome'] ?></td>
                <td><?= $row['cpf'] ?></td>
                <td><?= $row['acao'] ?></td>
                <td><?= $row['data_log'] ?></td>
                <td><?= $row['hora_log'] ?></td>
                <td><?= $row['status'] ?></td>

                <td>
                    <a href="editar.php?id=<?= $row['idlog'] ?>">Editar</a>
                    |
                    <a href="excluir.php?id=<?= $row['idlog'] ?>" 
                       onclick="return confirm('Tem certeza que deseja excluir este registro?');">
                       Excluir
                    </a>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>

</table>

</body>
</html>
