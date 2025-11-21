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

            // Login bem-sucedido — registra sessão
            $_SESSION['usuario_id']    = $usuario['id'];
            $_SESSION['usuario_login'] = $usuario['login'];
            $_SESSION['usuario_nome']  = $usuario['nome'];
            $_SESSION['usuario_foto']  = $usuario['fotoPerfil'];
            $_SESSION['tipoUsuario']   = $usuario['tipoUsuario'];

            // ===============================
            // 🔵 REGISTRA LOGIN NO LOG
            // ===============================
         // Prepara a query para inserir um novo registro na tabela de LOG
    $log = $pdo->prepare("
    INSERT INTO log (
        id_usuario,        -- ID do usuário que fez a ação
        login,             -- Login do usuário
        nome,              -- Nome do usuário
        cpf,               -- CPF do usuário (pode ser null)
        acao,              -- Ação realizada (ex: Login)
        descricao,         -- Descrição detalhada da ação
        data_log,          -- Data do registro (CURDATE pega a data atual)
        hora_log,          -- Hora exata do registro (CURTIME pega a hora atual)
        ip                 -- IP de onde o usuário acessou
    ) VALUES (
        :id_usuario,
        :login,
        :nome,
        :cpf,
        :acao,
        :descricao,
        CURDATE(),         -- Insere automaticamente a data atual
        CURTIME(),         -- Insere automaticamente a hora atual
        :ip
    )
");

// Executa a query passando os valores correspondentes às variáveis nomeadas
$log->execute([
    'id_usuario' => $usuario['id'],           // ID do usuário logado
    'login'      => $usuario['login'],        // Login do usuário
    'nome'       => $usuario['nome'],         // Nome completo
    'cpf'        => $usuario['cpf'] ?? null,  // CPF caso exista, senão envia NULL
    'acao'       => 'Login',                  // Tipo da ação registrada
    'descricao'  => 'Login realizado com sucesso', // Detalhe do evento
    'ip'         => $_SERVER['REMOTE_ADDR']   // IP do computador que acessou
]);


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

    // Se o envio do formulário for por um método diferente do "POST", envia para página de erro
    header('Location: ../../paginas/erro.php');
    exit;
}
