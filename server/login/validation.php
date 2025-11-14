<?php

require_once __DIR__ . '/../config.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // Resgata e-mail e senha digitado no formulário
    $email = $_POST['email'];
    $senha = $_POST['senha'];

    // Elimina espaços extras antes e depois
    $email = trim($email);
    $senha = trim($senha);

    // Impede código SQL Injection
    $email = htmlspecialchars($email);
    $senha = htmlspecialchars($senha);

    // Busca o usuário pelo e-mail
    $stmt = $pdo->prepare("SELECT * FROM usuarios WHERE email = :email LIMIT 1");
    $stmt->execute(['email' => $email]);
    $usuario = $stmt->fetch();

    // E-mail encontrado
    if ($usuario) {
        // Verifica a senha
        if (password_verify($senha, $usuario['senha'])) {
            // Login bem-sucedido
            $_SESSION['usuario_id']   = $usuario['id'];
            $_SESSION['usuario_nome'] = $usuario['nome'];
            $_SESSION['tipoUsuario']  = $usuario['tipoUsuario'];

            // Redireciona para homepage
            header('Location: ../../paginas/homepage.php');
            exit;
        } else {
            // Redireciona para a página de login e exibe o modal de senha incorreta
            $_SESSION['showModal'] = 'senha-errada';
            header("Location: ../../paginas/login.php");
            exit;
        }
    } else {
        // Redireciona para a página de login e exibe o modal de e-mail não encontrado
        $_SESSION['showModal'] = 'e-mail-nao-encontrado';
        header("Location: ../../paginas/login.php");
        exit;
    }
} else {
    // Se o envio do formulário for por um método diferente do "POST", envia o usuário para a página de erro
    header('Location: ../../paginas/erro.php');
    exit;
}