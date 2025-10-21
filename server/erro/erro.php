<?php
// página de produto
$id = $_GET['id'] ?? null;

// se não achou o produto no banco
if (!$id) {
    http_response_code(404);
    include 'erro404.php';
    exit; // interrompe o resto da execução
}
?>