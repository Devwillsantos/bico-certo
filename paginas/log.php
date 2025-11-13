<?php
// =====================================
// 🔹 Simulação sem banco de dados
// =====================================
// Temporariamente removemos a conexão e a query real
// include('../server/log/conexao.php');
// $query = "SELECT * FROM log";
// $result = $conn->query($query);

// 🔹 Dados fictícios para testar o layout da página
$result = [
    ['idlog' => 1, 'login' => 'gabrielr', 'nome' => 'Gabriel Roberto', 'cpf' => '123.456.789-00', 'data_log' => '2025-10-20', 'hora_log' => '14:35:00', 'status' => 'Ativo'],
    ['idlog' => 2, 'login' => 'joaos', 'nome' => 'João Silva', 'cpf' => '987.654.321-00', 'data_log' => '2025-10-19', 'hora_log' => '09:10:00', 'status' => 'Inativo'],
    ['idlog' => 3, 'login' => 'mariac', 'nome' => 'Maria Clara', 'cpf' => '111.222.333-44', 'data_log' => '2025-10-18', 'hora_log' => '17:45:00', 'status' => 'Ativo']
];
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
        <th>Data</th>
        <th>Hora</th>
        <th>Status</th>
      </tr>
    </thead>
    <tbody>

      <?php 
      // =====================================
      // 🔹 Exibe os registros simulados
      // =====================================
      foreach ($result as $row): ?>
          <tr>
              <td><?= $row['idlog'] ?></td>
              <td><?= $row['login'] ?></td>
              <td><?= $row['nome'] ?></td>
              <td><?= $row['cpf'] ?></td>
              <td><?= $row['data_log'] ?></td>
              <td><?= $row['hora_log'] ?></td>
              <td><?= $row['status'] ?></td>
          </tr>
      <?php endforeach; ?>

    </tbody>
  </table>

</body>
</html>
