<?php
require_once "contado.php"; // conexão com o banco

$data = json_decode(file_get_contents("php://input"), true);

if ($data) {
    $stmt = $pdo->prepare("INSERT INTO resumo_atividades (contratos_concluidos, contratos_andamento, ultima_contratacao)
                           VALUES (:cc, :ca, :uc)");
    $stmt->execute([
        ':cc' => $data['contratosConcluidos'],
        ':ca' => $data['contratosAndamento'],
        ':uc' => $data['ultimaContratacao']
    ]);

    echo "Resumo salvo com sucesso!";
} else {
    echo "Nenhum dado recebido.";
}
?>
