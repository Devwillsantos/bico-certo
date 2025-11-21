<?php
include('../conexao.php');

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    die("Método inválido.");
}

$idlog     = $_POST['idlog'];
$login     = $_POST['login'];
$nome      = $_POST['nome'];
$cpf       = $_POST['cpf'];
$acao      = $_POST['acao'];
$descricao = $_POST['descricao'];
$status    = $_POST['status'];

$stmt = $pdo->prepare("
    UPDATE log
    SET login = ?, nome = ?, cpf = ?, acao = ?, descricao = ?, status = ?
    WHERE idlog = ?
");

$ok = $stmt->execute([$login, $nome, $cpf, $acao, $descricao, $status, $idlog]);

if ($ok) {
    // redireciona de volta para a lista de logs
 header("Location: ../../paginas/log.php");
exit;

} else {
    echo "Erro ao atualizar o log.";
}
?>
