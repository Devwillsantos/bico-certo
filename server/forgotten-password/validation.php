<?php

require_once __DIR__ . '/../config.php';

// Se o envio do formulário for pelo método "POST", começa a validação da nova senha
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // Dados do formulário
    $email     = $_POST['email'] ?? null;
    $cpf       = $_POST['cpf'] ?? null;
    $senhaNova = $_POST['senhaNova'] ?? null;

    // Funções de validação
    function validarEmail($email) {

        // Contador de erros na validação
        $qtdErrosFuncao = 0;

        // Remove espaços no começo e no fim
        $email = trim($email);

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $qtdErrosFuncao += 1;
        }

        // Retorna o total de erros encontrados
        return $qtdErrosFuncao;

    }

    function validarCPF($cpf) {
        
        // Contador de erros na validação
        $qtdErrosFuncao = 0;

        // Lista de CPFs repetidos
        $listaCpfsRepetidos = [
            '00000000000', '11111111111', '22222222222', '33333333333',
            '44444444444', '55555555555', '66666666666', '77777777777',
            '88888888888', '99999999999'
        ];

        // Remove caracteres não numéricos
        $cpf = preg_replace('/\D/', '', $cpf);

        // Verifica se o CPF não tem 11 dígitos
        if (strlen($cpf) != 11) {
            $qtdErrosFuncao += 1;
        }

        // Verifica se o CPF é não é repetido
        if (in_array($cpf, $listaCpfsRepetidos)) {
            $qtdErrosFuncao += 1;
        }

        // Converte CPF em array de dígitos
        $cpfArray = str_split($cpf);

        // Calcula o primeiro dígito verificador
        $soma1 = 0;
        for ($i = 0, $peso = 10; $i < 9; $i++, $peso--) {
            $soma1 += $cpfArray[$i] * $peso;
        }
        $d1 = ($soma1 % 11 < 2) ? 0 : 11 - ($soma1 % 11);

        // Calcula o segundo dígito verificador
        $soma2 = 0;
        for ($i = 0, $peso = 11; $i < 10; $i++, $peso--) {
            $soma2 += $cpfArray[$i] * $peso;
        }
        $d2 = ($soma2 % 11 < 2) ? 0 : 11 - ($soma2 % 11);

        // Verifica se os dígitos não conferem
        if ($d1 != $cpfArray[9] or $d2 != $cpfArray[10]) {
            $qtdErrosFuncao += 1;
        }

        // Retorna o total de erros encontrados
        return $qtdErrosFuncao;

    }

    function validarSenhaNova($senhaNova) {

        // Contador de erros na validação
        $qtdErrosFuncao = 0;

        // Remove espaços extras
        $senhaNova = trim($senhaNova);
    
        // Verifica se não há apenas letras e se não há menos ou mais de 8 caracteres
        if (!preg_match('/^[\p{L}]+$/u', $senhaNova) || strlen($senhaNova) != 8) {
            $qtdErrosFuncao += 1;
        }

        // Retorna o total de erros encontrados
        return $qtdErrosFuncao;

    }

    // Array com todas as funções de validações
    $allFunctionErrors = [
        validarEmail($email),
        validarCPF($cpf),
        validarSenhaNova($senhaNova)
    ];

    // Soma a quantidade de erros que cada uma das validações retornaram
    $qtdErros = array_sum($allFunctionErrors);

    // Se não houver erros, inicia o reset da senha
    if ($qtdErros === 0) {

        // 1. Sanitiza dos dados
        $email     = htmlspecialchars($email);
        $cpf       = htmlspecialchars($cpf);
        $senhaNova = htmlspecialchars($senhaNova);
        
        // 2. Cria o HASH da nova senha
        $senhaHash = password_hash($senhaNova, PASSWORD_DEFAULT);

        // 3. Prepara a consulta SQL (UPDATE)
        $sql = "UPDATE usuarios SET senha = ? WHERE email = ? AND cpf = ?";
        
        // 4. Prepara e executa o statement
        try {
            $stmt = $pdo->prepare($sql);
            
            // Executa a query, passando os valores como um array.
            $execucao = $stmt->execute([$senhaHash, $email, $cpf]);
            
            // 5. Verifica o resultado
            if ($execucao && $stmt->rowCount() > 0) {
                // Sucesso! A senha foi atualizada.
                // Redireciona para a página de registro e exibe o modal de cadastrado com sucesso
                session_start();
                $_SESSION['showModal'] = 'senha-atualizada';
                header("Location: ../../paginas/esqueci-minha-senha.php");
                exit;
            } else {
                // Redireciona para a página de registro e exibe o modal de erro
                session_start();
                $_SESSION['showModal'] = 'erro';
                header("Location: ../../paginas/esqueci-minha-senha.php");
                exit;
            }
            
        } catch (PDOException $e) {
            // Em caso de erro do banco de dados (ex: problema de conexão)
            echo "Erro de banco de dados: " . $e->getMessage();
        }
    } else {
        // Redireciona para a página de registro e exibe o modal de erro
        session_start();
        $_SESSION['showModal'] = 'erro';
        header("Location: ../../paginas/esqueci-minha-senha.php");
        exit;
    }

} else {
    // Se o envio do formulário for por um método diferente do "POST", envia o usuário para a página de erro
    header('Location: ../../paginas/erro.php');
    exit;
}