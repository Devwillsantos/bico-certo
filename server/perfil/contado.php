<?php
// ✅ Caminho seguro para o config.php
require_once __DIR__ . "/../config.php";

if (!isset($pdo)) {
  die("Erro: conexão com o banco não estabelecida.");
}

// 🔍 Buscar informações de um usuário
function buscarUsuario($id) {
  global $pdo;
  $stmt = $pdo->prepare("SELECT * FROM usuarios WHERE id = ?");
  $stmt->execute([$id]);
  return $stmt->fetch(PDO::FETCH_ASSOC);
}

// 💬 Salvar comentário (via POST)
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $id_usuario = $_POST['id_usuario'] ?? null;
  $comentario = trim($_POST['comentario'] ?? '');
  $avaliacao  = $_POST['avaliacao'] ?? null;

  if ($id_usuario && $comentario !== '') {
    try {
      $stmt = $pdo->prepare("
        INSERT INTO comentarios (id_usuario, comentario, avaliacao, data_envio)
        VALUES (?, ?, ?, NOW())
      ");
      $stmt->execute([$id_usuario, $comentario, $avaliacao]);

      echo json_encode(["status" => "success", "mensagem" => "Comentário enviado com sucesso!"]);
    } catch (PDOException $e) {
      echo json_encode(["status" => "error", "mensagem" => "Erro ao enviar comentário: " . $e->getMessage()]);
    }
  } else {
    echo json_encode(["status" => "error", "mensagem" => "Campos obrigatórios não preenchidos."]);
  }
  exit;
}

// 📦 Buscar comentários de um usuário (via GET)
if (isset($_GET['id'])) {
  $id_usuario = $_GET['id'];
  try {
    $stmt = $pdo->prepare("
      SELECT c.*, u.nome AS nome_autor
      FROM comentarios c
      LEFT JOIN usuarios u ON c.id_usuario = u.id
      WHERE c.id_usuario = ?
      ORDER BY c.data_envio DESC
    ");
    $stmt->execute([$id_usuario]);
    $comentarios = $stmt->fetchAll(PDO::FETCH_ASSOC);

    echo json_encode(["status" => "success", "comentarios" => $comentarios]);
  } catch (PDOException $e) {
    echo json_encode(["status" => "error", "mensagem" => "Erro ao buscar comentários: " . $e->getMessage()]);
  }
  exit;
}
?>

