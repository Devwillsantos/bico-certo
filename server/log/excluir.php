<?php
include('../server/conexao.php');

if (!isset($_GET['id'])) {
    die("ID não informado.");
}

$id = $_GET['id'];

$stmt = $pdo->prepare("DELETE FROM log WHERE idlog = ?");
$stmt->execute([$id]);

header("Location: log.php");
exit;
