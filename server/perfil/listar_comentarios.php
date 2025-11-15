<?php
require_once __DIR__ . "/../config.php";
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

header('Content-Type: application/json; charset=utf-8');

$id_usuario = $_POST['id_usuario'] ?? null;

if (!$id_usuario) {
    echo json_encode(['comentarios' => []]);
    exit;
}

try {
    $sql = "SELECT 
                id,
                id_usuario,
                nome,
                comentario,
                nota,
                DATE_FORMAT(data_comentario, '%d/%m/%Y %H:%i') AS data_comentario
            FROM comentarios
            WHERE id_usuario = ?
            ORDER BY id DESC";

    $stmt = $pdo->prepare($sql);
    $stmt->execute([$id_usuario]);

    $comentarios = $stmt->fetchAll(PDO::FETCH_ASSOC);

    echo json_encode([
        'sucesso' => true,
        'comentarios' => $comentarios
    ]);

} catch (PDOException $e) {
    echo json_encode(['comentarios' => []]);
}
