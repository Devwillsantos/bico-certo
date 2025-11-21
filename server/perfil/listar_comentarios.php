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
                c.id,
                c.id_usuario,
                c.comentario,
                c.nota,
                DATE_FORMAT(c.data_comentario, '%d/%m/%Y %H:%i') AS data_comentario,
                COALESCE(u.nome, c.nome) AS nome,
                u.fotoPerfil AS foto_usuario,
                u.tipoUsuario AS tipo_usuario
            FROM comentarios c
            LEFT JOIN usuarios u ON u.id = c.id_usuario
            WHERE c.perfil_id = ?
            ORDER BY c.id DESC";

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
