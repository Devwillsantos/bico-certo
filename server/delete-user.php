<?php
session_start();

// Apenas master pode excluir
if (!isset($_SESSION['tipoUsuario']) || $_SESSION['tipoUsuario'] !== 'master') {
    http_response_code(403);
    exit;
}

require_once __DIR__ . "/config.php";

// Verifica ID
if (!isset($_POST['id'])) {
    http_response_code(400);
    exit;
}

$id = intval($_POST['id']);

$stmt = $pdo->prepare("DELETE FROM usuarios WHERE id = ?");
$stmt->execute([$id]);

// Não enviamos texto nenhum para evitar alert automático
http_response_code(204); // No Content
exit;