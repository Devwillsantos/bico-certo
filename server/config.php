<?php

$db_host = 'localhost';
$db_name = 'bico_certo_db';
$db_user = 'root';
$db_pass = '';
$dsn = "mysql:host=$db_host;dbname=$db_name;charset=utf8mb4";

$options = [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, // exceções em erros
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES => false, // prepared statements reais
];

try {
    $pdo = new PDO($dsn, $db_user, $db_pass, $options);
} catch (PDOException $e) {
    // Em produção, não exiba detalhes sensíveis
    die('Erro ao conectar com o banco: ' . $e->getMessage());
}