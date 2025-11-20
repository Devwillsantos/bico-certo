<?php
$host = "localhost";
$banco = "usuarios_db"; // substitua pelo nome real do seu banco
$usuario = "root";        // ou outro usuário do MySQL
$senha = "";              // sua senha do MySQL

try {
    $pdo = new PDO("mysql:host=$host;dbname=$banco;charset=utf8", $usuario, $senha);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Erro na conexão: " . $e->getMessage());
}
?>