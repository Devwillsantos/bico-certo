<?php
$host = 'localhost';
$db   = 'bico_certo_db';
$db_user = 'root';
$db_pass = ''; // Padrão XAMPP

$options = [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, // exceções em erros
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES => false, // prepared statements reais
];

try {
    // Estabele conexão com o MySQL
    $pdo = new PDO("mysql:host=$host;charset=utf8mb4", $db_user, $db_pass, $options);

    // Cria o banco de dados se não existir
    $pdo->exec("CREATE DATABASE IF NOT EXISTS `$db` CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci");

    // Seleciona o banco de dados
    $pdo->exec("USE `$db`");

    // Cria a tabela se não existir
    $pdo->exec("
        CREATE TABLE IF NOT EXISTS `usuarios` (
            `id` INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
            `nome` VARCHAR(60) NOT NULL,
            `email` VARCHAR(30) NOT NULL,
            `dataNascimento` DATE NOT NULL,
            `sexo` VARCHAR(9) NOT NULL,
            `cpf` CHAR(14) NOT NULL,
            `numeroCelular` CHAR(17) NOT NULL,
            `cep` CHAR(9) NOT NULL,
            `estado` VARCHAR(19) NOT NULL,
            `cidade` VARCHAR(30) NOT NULL,
            `bairro` VARCHAR(30) NOT NULL,
            `rua` VARCHAR(30) NOT NULL,
            `numeroCasa` INT(5) DEFAULT NULL,
            `referenciaCasa` VARCHAR(30) DEFAULT NULL,
            `login` CHAR(6) NOT NULL,
            `senha` VARCHAR(255) NOT NULL,
            `whatsAppLink` VARCHAR(27) NOT NULL,
            `tipoUsuario` VARCHAR(11) NOT NULL,
            `servico` VARCHAR(30) NOT NULL,
            `fotoPerfil` varchar(255) DEFAULT NULL
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
    ");

} catch (PDOException $e) {
    die('Erro ao conectar com o banco: ' . $e->getMessage());
}