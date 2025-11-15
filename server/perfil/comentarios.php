<?php
require_once __DIR__ . "/../config.php";
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

header('Content-Type: application/json; charset=utf-8');

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode(['erro'=>'Método inválido. Use POST.']);
    exit;
}

$id_usuario = $_POST['id_usuario'] ?? null;
$nome = $_POST['nome'] ?? null;
$comentario = $_POST['comentario'] ?? null;
$nota = isset($_POST['nota']) ? (int)$_POST['nota'] : 0;

if (!$id_usuario || !$nome || !$comentario) {
    echo json_encode(['erro'=>'Campos obrigatórios não enviados.']);
    exit;
}

try {
    $pdo->beginTransaction();

    // 1) inserir comentário
    $sql = "INSERT INTO comentarios (id_usuario, nome, comentario, nota, data_comentario)
            VALUES (?, ?, ?, ?, NOW())";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$id_usuario, $nome, $comentario, $nota]);
    $insertId = $pdo->lastInsertId();

    // 2) atualizar contadores do usuário
    $sqlUp = "UPDATE usuarios
              SET contratos_concluidos = COALESCE(contratos_concluidos,0) + 1,
                  ultima_contratacao = NOW()
              WHERE id = ?";
    $stmt2 = $pdo->prepare($sqlUp);
    $stmt2->execute([$id_usuario]);

    // 3) buscar dados atualizados para retorno
    $stmt3 = $pdo->prepare("SELECT contratos_concluidos, ultima_contratacao FROM usuarios WHERE id = ?");
    $stmt3->execute([$id_usuario]);
    $user = $stmt3->fetch(PDO::FETCH_ASSOC);

    // 4) buscar o comentário inserido para retornar (com data formatada)
    $stmt4 = $pdo->prepare("SELECT id, id_usuario, nome, comentario, nota, DATE_FORMAT(data_comentario, '%d/%m/%Y %H:%i:%s') AS data_comentario
                            FROM comentarios WHERE id = ?");
    $stmt4->execute([$insertId]);
    $coment = $stmt4->fetch(PDO::FETCH_ASSOC);

    $pdo->commit();

    echo json_encode([
        'sucesso' => true,
        'mensagem' => 'Comentário salvo com sucesso!',
        'comentario' => $coment,
        'contratos_concluidos' => $user['contratos_concluidos'] ?? null,
        'ultima_contratacao' => isset($user['ultima_contratacao']) ? date('d/m/Y', strtotime($user['ultima_contratacao'])) : null
    ], JSON_UNESCAPED_UNICODE);

} catch (PDOException $e) {
    $pdo->rollBack();
    echo json_encode(['erro' => 'Erro no banco: ' . $e->getMessage()]);
}
