<?php
require_once "conexao.php";

$id = $_POST['id'] ?? $_GET['id'] ?? null;

if ($id) {
    $id = intval($id);
    $stmt = $pdo->prepare("DELETE FROM usuarios WHERE id = ?");
    if ($stmt->execute([$id])) {
        echo "Usuário excluído com sucesso";
    } else {
        echo "Erro ao excluir usuário";
    }
} else {
    echo "Nenhum ID recebido";
}
