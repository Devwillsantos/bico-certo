<?php
require_once __DIR__ . "/conexao.php";

header("Content-Type: application/json; charset=utf-8");

$id = $_POST['id'] ?? null;

if ($id) {
    $id = intval($id);
    $stmt = $pdo->prepare("DELETE FROM usuarios WHERE id = ?");
    if ($stmt->execute([$id])) {
        echo json_encode(["ok" => true, "message" => "Usuário excluído com sucesso"]);
    } else {
        echo json_encode(["ok" => false, "message" => "Erro ao excluir usuário"]);
    }
} else {
    echo json_encode(["ok" => false, "message" => "Nenhum ID recebido"]);
}