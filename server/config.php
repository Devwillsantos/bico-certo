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

    // Cria a tabela de usuários se não existir
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
            `servico` VARCHAR(255) NOT NULL,
            `fotoPerfil` varchar(255) DEFAULT NULL,
            `data_registro` datetime DEFAULT CURRENT_TIMESTAMP,
            `ultima_visita` datetime DEFAULT NULL,
            `contratos_concluidos` int(11) DEFAULT 0,
            `ultima_contratacao` datetime DEFAULT NULL,
            `descricao` text DEFAULT NULL,
            `profissao` varchar(255) DEFAULT NULL,
            `foto_capa` varchar(255) DEFAULT NULL
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
    ");

    // Cria a tabela de comentários se não existir
    $pdo->exec("
        CREATE TABLE IF NOT EXISTS `comentarios` (
            `id` int(11) NOT NULL,
            `id_usuario` int(11) NOT NULL,
            `nome` varchar(100) NOT NULL,
            `comentario` text NOT NULL,
            `nota` int(1) NOT NULL,
            `data_comentario` timestamp NOT NULL DEFAULT current_timestamp(),
            `perfil_id` int(11) NOT NULL
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
    ");
// Cria a tabela de LOG se não existir
    $pdo->exec("
    CREATE TABLE IF NOT EXISTS `log` (
        `idlog` INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
        `id_usuario` INT(11) DEFAULT NULL,
        `login` VARCHAR(50) NOT NULL,
        `nome` VARCHAR(100) NOT NULL,
        `cpf` CHAR(14) DEFAULT NULL,
        `acao` VARCHAR(50) NOT NULL,
        `descricao` TEXT DEFAULT NULL,
        `data_log` DATE NOT NULL,
        `hora_log` TIME NOT NULL,
        `ip` VARCHAR(45) DEFAULT NULL,
        `status` VARCHAR(20) DEFAULT 'Ativo',

        FOREIGN KEY (`id_usuario`) REFERENCES usuarios(`id`)
            ON DELETE SET NULL
            ON UPDATE CASCADE
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
");

} catch (PDOException $e) {
    die('Erro ao conectar com o banco: ' . $e->getMessage());
}