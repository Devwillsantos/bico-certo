<?php
require_once __DIR__ . "/../server/logged-in-user.php";
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

    <!-- CSS que estiliza a tabela de logs -->
    <link rel="stylesheet" href="../css/log.css">
</head>

<body>
<h1>Registros de Log</h1>

<!-- Tabela que exibirá os registros -->
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
            <th>Status</th>
            <th>Ações</th>
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
                <td><?= $row['status'] ?></td>

                <!-- Ações: editar ou excluir o registro -->
   <td>
    <a class="action-btn btn-edit" 
       href="../server/log/editar.php?id=<?= $row['idlog'] ?>">
       Editar
    </a>

    <a class="action-btn btn-delete" 
       href="excluir.php?id=<?= $row['idlog'] ?>"
       onclick="return confirm('Tem certeza que deseja excluir este registro?');">
       Excluir
    </a>
</td>

</td>

                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>

</table>

</body>
</html>

