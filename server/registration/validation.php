<?php

require_once __DIR__ . '/../config.php';
require_once __DIR__ . '/../lista-servicos.php';

// Se o envio do formulário for pelo método "POST", começa a validação dos dados
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // Dados Pessoais
    $nome             = $_POST['nome'] ?? null;
    $email            = $_POST['email'] ?? null;
    $dataNascimento   = $_POST['dataDeNascimento'] ?? null;
    $sexo             = $_POST['sexo'] ?? null;
    $cpf              = $_POST['cpf'] ?? null;
    $numeroCelular    = $_POST['numeroCelular'] ?? null;

    // Dados De Localização
    $cep               = $_POST['cep'] ?? null;
    $rua               = $_POST['rua'] ?? null;
    $estado            = $_POST['estado'] ?? null;
    $cidade            = $_POST['cidade'] ?? null;
    $numeroCasa        = $_POST['numeroCasa'] === '' ? '0' : $_POST['numeroCasa'];
    $bairro            = $_POST['bairro'] ?? null;
    $referenciaCasa    = $_POST['pontoReferencia'] ?? null;

    // Dados Da Conta
    $login              = $_POST['login'] ?? null;
    $senha              = $_POST['senha'] ?? null;
    $confirmacaoSenha   = $_POST['confirmacaoSenha'] ?? null;
    $fotoPerfil         = $_FILES['profile-photo'] ?? null;
    $whatsAppLink    = '';

    // Tipo de Usuário e Serviço
    $tipoUsuario = '';
    $servico     = $_POST['prestador-opcoes'] ?? null;

    // Verificação do Tipo do Usuário
    if ($_POST['contratante'] === 'on') {
        $tipoUsuario = 'contratante';
    } else if ($_POST['prestador'] === 'on') {
        $tipoUsuario = 'prestador';
    } else {
        $tipoUsuario = '';
    }

    // Renomeação do nome do servico
    $nomeServico = '';
    foreach ($listaServicos as $categoria => $itens) {
        if (isset($itens[$servico])) {
            $nomeServico = $itens[$servico];
            break;
        }
    }

    // Validação Do Nome
    function validarNome($nome) {

        // Contador de erros na validação
        $qtdErrosFuncao = 0;

        // Remove espaços no começo e no fim
        $nome = trim($nome);

        // Verifica se há caracteres não-alfabéticos (acentos e espaços entre o nome são permitidos)
        if (!preg_match('/^[a-zA-ZÀ-ú\s]+$/u', $nome)) {
            $qtdErrosFuncao += 1;
        }

        // Verifica se há mais de 8 e menos de 60 caracteres
        if (strlen($nome) < 8 || strlen($nome) > 60) {
            $qtdErrosFuncao += 1;
        }

        // Verifica se está vazio
        if (empty($nome)) {
            $qtdErrosFuncao += 1;
        }

        // Retorna o total de erros encontrados
        return $qtdErrosFuncao;

    }

    // Validação Do E-mail
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

    // Validação Da Data De Nascimento
    function validarDataNascimento($dataNascimento) {

        // Contador de erros na validação
        $qtdErrosFuncao = 0;

        // Verifica se a data de nascimento possui o padrão AAAA-MM-DD
        if (!preg_match('/^\d{4}-\d{2}-\d{2}$/', $dataNascimento)) {
            $qtdErrosFuncao += 1;
        }

        // Retorna o total de erros encontrados
        return $qtdErrosFuncao;

    }

    // Validação do Sexo
    function validarSexo($sexo) {

        // Contador de erros na validação
        $qtdErrosFuncao = 0;

        // Verifica se é um valor diferente de "masculino" e "feminino"
        if ($sexo != 'masculino' && $sexo != 'feminino') {
            $qtdErrosFuncao += 1;
        }

        // Retorna o total de erros encontrados
        return $qtdErrosFuncao;

    }

    // Validação Do CPF
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

    // Validação do Número De Celular
    function validarNumeroCelular($numeroCelular) {

        // Inicializa o contador de erros
        $qtdErrosFuncao = 0;

        // VALIDAÇÃO 1: Os 5 primeiros caracteres devem ser "(+55)"
        if (substr($numeroCelular, 0, 5) !== "(+55)") {
            $qtdErrosFuncao += 1;
        }

        // VALIDAÇÃO 2: O oitavo caractere deve ser "-"
        if (substr($numeroCelular, 7, 1) !== "-") {
            $qtdErrosFuncao += 1;
        }

        // VALIDAÇÃO 3: A string deve ter exatamente 17 caracteres
        if (strlen($numeroCelular) !== 17) {
            $qtdErrosFuncao += 1;
        }

        // VALIDAÇÃO 4: A string não pode conter letras e espaços
        if (preg_match('/[A-Za-zÀ-ÿ\s]/', $numeroCelular)) {
            $qtdErrosFuncao += 1;
        }

        // Retorna o total de erros encontrados
        return $qtdErrosFuncao;

    }

    // Validação do Endereço
    function validarEndereço($cep, $estado, $cidade, $bairro, $rua, $numeroCasa, $referenciaCasa) {

        // Contador de erros na validação.
        $qtdErrosFuncao = 0;

        // Remove espaços extras.
        $cep            = trim($cep);
        $estado         = trim($estado);
        $cidade         = trim($cidade);
        $bairro         = trim($bairro);
        $rua            = trim($rua);
        $numeroCasa     = trim($numeroCasa);
        $referenciaCasa = trim($referenciaCasa);

        // Consulta a API do ViaCEP
        $url = "https://viacep.com.br/ws/" . preg_replace('/[^0-9]/', '', $cep) . "/json/";

        // Armazena a consulta do ViaCEP
        $resultado = json_decode(file_get_contents($url));

        // Verifica se o CEP é válido
        if (isset($resultado->erro)) {
            $qtdErrosFuncao += 1;
        } else {
            // Se o CEP for válido e encontrado, armazena os dados da API
            $GLOBALS['dados']['api_estado'] = $resultado->estado;
            $GLOBALS['dados']['api_cidade'] = $resultado->localidade;
            $GLOBALS['dados']['api_bairro'] = $resultado->bairro;
            $GLOBALS['dados']['api_rua']    = $resultado->logradouro;

            // Compara os dados da API com os do formulário
            if (strcasecmp(trim($estado), trim($GLOBALS['dados']['api_estado'])) !== 0) {
                $qtdErrosFuncao += 1;
            }
            if (strcasecmp(trim($cidade), trim($GLOBALS['dados']['api_cidade'])) !== 0) {
                $qtdErrosFuncao += 1;
            }
            if (strcasecmp(trim($bairro), trim($GLOBALS['dados']['api_bairro'])) !== 0) {
                $qtdErrosFuncao += 1;
            }
            if (strcasecmp(trim($rua), trim($GLOBALS['dados']['api_rua'])) !== 0) {
                $qtdErrosFuncao += 1;
            }

            // Validação do Número da Casa
            if ($numeroCasa === '' || !preg_match('/^[0-9]+$/', $numeroCasa) || strlen($numeroCasa) > 5) {
                $qtdErrosFuncao += 1;
            }

            // Validação do Ponto de Referência
            if ($referenciaCasa !== '' && !preg_match('/^[\p{L}0-9 ]+$/u', $referenciaCasa)) {
                $qtdErrosFuncao += 1;
            }
        }

        // Retorna o total de erros encontrados
        return $qtdErrosFuncao;

    }

    // Validação do Login
    function validarLogin($login) {

        // Contador de erros na validação
        $qtdErrosFuncao = 0;

        // Remove espaços extras
        $login = trim($login);

        // Verifica se não há apenas letras e se não há mais de 6 caracteres
        if (!preg_match('/^[\p{L}\s]+$/u', $login) || strlen($login) != 6) {
            $qtdErrosFuncao += 1;
        }

        return $qtdErrosFuncao;

    }

    // Validação da Senha e Confirmação da Senha
    function validarSenha($senha, $confirmacaoSenha) {

        // Contador de erros na validação
        $qtdErrosFuncao = 0;

        // Remove espaços extras
        $senha            = trim($senha);
        $confirmacaoSenha = trim($confirmacaoSenha);
    
        // Verifica se não há apenas letras e se não há menos ou mais de 8 caracteres
        if (!preg_match('/^[\p{L}]+$/u', $senha) || strlen($senha) != 8) {
            $qtdErrosFuncao += 1;
        } else if (!preg_match('/^[\p{L}]+$/u', $confirmacaoSenha) || strlen($confirmacaoSenha) != 8) {
            $qtdErrosFuncao += 1;
        }

        // Verifica se a senha e a confirmação da senha não são iguais
        if ($senha != $confirmacaoSenha) {
            $qtdErrosFuncao += 1;
        }

        // Retorna o total de erros encontrados
        return $qtdErrosFuncao;

    }

    // Criação do link para contato via WhatsApp
    function criarWhatsAppLink($numeroCelular) {
        // Remove tudo que não for número
        $somenteNumeros = preg_replace('/\D/', '', $numeroCelular);
        
        // Retorna o link formatado
        return "https://wa.me/" . $somenteNumeros;
    }

    // Validação do Tipo de Usuário
    function validarTipoUsuario($tipoUsuario) {

        // Contador de erros na validação
        $qtdErrosFuncao = 0;

        if (empty($tipoUsuario)) {
            $qtdErrosFuncao += 1;
        }

        // Tipo de Usuário
        if ($tipoUsuario != 'contratante' && $tipoUsuario != 'prestador') {
            $qtdErrosFuncao += 1;
        }

        // Retorna o total de erros encontrados
        return $qtdErrosFuncao;

    }

    // Validação do Servico Selecionado
    function validarServicoSelecionado($servico) {

        // Contador de erros na validação
        $qtdErrosFuncao = 0;

        // Inclui e executa o arquivo "lista-servicos.php"
        require __DIR__ . '/../lista-servicos.php';

        // Cria outro array com apenas os serviços (sem as categorias)
        $todosServicos = [];
        foreach ($listaServicos as $categoria => $itens) {
            $todosServicos = array_merge($todosServicos, array_keys($itens));
        }

        // Verifica se o $servico é vazio (NULL)
        if (is_null($servico)) {
            $servico = '';
        } else {
            // Verifica se o serviço selecionado está no array criado acima
            if (!in_array($servico, $todosServicos)) {
                $qtdErrosFuncao += 1;
            }
        }

        return $qtdErrosFuncao;

    }

    // Array com todas as funções de validações
    $allFunctionErrors = [
        validarNome($nome),
        validarEmail($email),
        validarDataNascimento($dataNascimento),
        validarSexo($sexo),
        validarCPF($cpf),
        validarNumeroCelular($numeroCelular),
        validarEndereço($cep, $estado, $cidade, $bairro, $rua, $numeroCasa, $referenciaCasa),
        validarLogin($login),
        validarSenha($senha, $confirmacaoSenha),
        validarTipoUsuario($tipoUsuario),
        validarServicoSelecionado($servico)
    ];

    // Soma a quantidade de erros que cada uma das validações retornaram
    $qtdErros = array_sum($allFunctionErrors);

    // Verifica se há algum erro
    if ($qtdErros != 0) {
        // Redireciona para a página de erro
        header('Location: ../../paginas/erro.php');
        exit;
    } else {

        // --- INÍCIO DO CÓDIGO PARA UPLOAD DE FOTO --- //

        $caminhoFotoBD = null;

        // 1. Verifica se o arquivo foi enviado corretamente
        if (isset($fotoPerfil) && $fotoPerfil['error'] === UPLOAD_ERR_OK) {

            // 1.1. DEFINE O CAMINHO ABSOLUTO NO SERVIDOR SEM USAR realpath AINDA
            // Caminho que aponta para: .../server/profile-photos/
            $diretorioBase = __DIR__ . '/../profile-photos'; 

            // 1.2. GARANTE QUE O DIRETÓRIO EXISTA
            if (!is_dir($diretorioBase)) {
                // Tenta criar o diretório com permissões 0777 (leitura, escrita e execução para todos)
                $criado = @mkdir($diretorioBase, 0777, true); 
                
                if (!$criado) {
                    // Se falhar a criação (muitas vezes por permissão), registra o erro
                    error_log("ERRO CRÍTICO: Não foi possível criar o diretório de upload: " . $diretorioBase);
                    // Aborta o processo de upload
                    header('Location: ../../paginas/erro.php');
                    exit;
                }
            }
            
            // 1.3. AGORA, USA realpath() PARA TER O CAMINHO ABSOLUTO LIMPO (sem o '../')
            // Se a pasta existe, realpath() funcionará
            $diretorioDestino = realpath($diretorioBase) . DIRECTORY_SEPARATOR;

            // ----------------------------------------------------------------------
            // SE O var_dump ABAIXO ESTIVER CORRETO, O RESTANTE VAI FUNCIONAR:
            // var_dump($diretorioDestino); // Deve retornar o caminho completo e limpo
            // ----------------------------------------------------------------------
            
            // Gera um nome único para o arquivo
            $extensao = pathinfo($fotoPerfil['name'], PATHINFO_EXTENSION);
            $novoNomeArquivo = time() . '_' . uniqid() . '.' . $extensao;

            // Caminho completo ABSOLUTO para onde o arquivo será movido no servidor
            $caminhoCompletoDestino = $diretorioDestino . $novoNomeArquivo;

            // var_dump($caminhoCompletoDestino); // Este var_dump deve estar correto agora
            // exit; 
            
            // Tenta mover o arquivo
            if (move_uploaded_file($fotoPerfil['tmp_name'], $caminhoCompletoDestino)) {
                
                // 2. Caminho RELATIVO para exibição no navegador/Banco de Dados
                $caminhoRelativoWeb = '/server/profile-photos/' . $novoNomeArquivo;
                $caminhoFotoBD = $caminhoRelativoWeb;

            } else {
                header('Location: ../../paginas/erro.php');
                exit;
            }
        }
        
        // Se a foto não foi enviada ou houve erro (é obrigatória)
        if (is_null($caminhoFotoBD)) {
            header('Location: ../../paginas/erro.php');
            exit;
        }

        $fotoPerfil = $caminhoFotoBD;
        
        // --- FIM DO CÓDIGO PARA UPLOAD DE FOTO --- //

        // Sanitização dos dados pessoais
        $nome           = htmlspecialchars($nome);
        $email          = htmlspecialchars($email);
        $dataNascimento = htmlspecialchars($dataNascimento);
        $sexo           = htmlspecialchars($sexo);
        $cpf            = htmlspecialchars($cpf);
        $numeroCelular  = htmlspecialchars($numeroCelular);

        // Sanitização dos dados de localização
        $cep            = htmlspecialchars($cep);
        $estado         = htmlspecialchars($estado);
        $cidade         = htmlspecialchars($cidade);
        $bairro         = htmlspecialchars($bairro);
        $rua            = htmlspecialchars($rua);
        $numeroCasa     = htmlspecialchars($numeroCasa);
        $referenciaCasa = htmlspecialchars($referenciaCasa);
        
        // Sanitização dos dados da conta
        $login       = htmlspecialchars($login);
        $senha       = htmlspecialchars($senha);
        $tipoUsuario = htmlspecialchars($tipoUsuario);
        $servico     = $nomeServico;
        
        // Link do WhatsApp para contato
        $whatsAppLink = criarWhatsAppLink($numeroCelular);

        // Criptografia da senha
        $senhaEncriptada = password_hash($senha, PASSWORD_DEFAULT);

        // Valores padrão para campos obrigatórios no banco
        $descricaoPadrao = "Nenhuma descrição informada.";
        $profissaoPadrao = "Não Informado";

        // Caso venham vazios ou não existam
        $descricao = $_POST['descricao'] ?? $descricaoPadrao;
        $profissao = $_POST['profissao'] ?? $profissaoPadrao;

        // Inserção de dados
        $sql = "INSERT INTO usuarios (nome, email, dataNascimento, sexo, cpf, numeroCelular, cep, estado, cidade, bairro, rua, numeroCasa, referenciaCasa, login, senha, whatsAppLink, tipoUsuario, servico, fotoPerfil, ultima_visita, ultima_contratacao, descricao, profissao, foto_capa)
                VALUES (:nome, :email, :dataNascimento, :sexo, :cpf, :numeroCelular, :cep, :estado, :cidade, :bairro, :rua, :numeroCasa, :referenciaCasa, :login, :senha, :whatsAppLink, :tipoUsuario, :servico, :fotoPerfil, :ultima_visita, :ultima_contratacao, :descricao, :profissao, :foto_capa)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            ':nome'               => $nome,
            ':email'              => $email,
            ':dataNascimento'     => $dataNascimento,
            ':sexo'               => $sexo,
            ':cpf'                => $cpf,
            ':numeroCelular'      => $numeroCelular,
            ':cep'                => $cep,
            ':estado'             => $estado,
            ':cidade'             => $cidade,
            ':bairro'             => $bairro,
            ':rua'                => $rua,
            ':numeroCasa'         => $numeroCasa,
            ':referenciaCasa'     => $referenciaCasa,
            ':login'              => $login,
            ':senha'              => $senhaEncriptada,
            ':whatsAppLink'       => $whatsAppLink,
            ':tipoUsuario'        => $tipoUsuario,
            ':servico'            => $servico,
            ':fotoPerfil'         => $fotoPerfil,
            ':ultima_visita'      => null,
            ':ultima_contratacao' => null,
            ':descricao'          => $descricao,
            ':profissao'          => $profissao,
            ':foto_capa'          => null
        ]);

        $id = (int)$pdo->lastInsertId();

        // Redireciona para a página de registro e exibe o modal de cadastrado com sucesso
        session_start();
        $_SESSION['showModal'] = true;
        header("Location: ../../paginas/cadastro.php");
        exit;
    }
} else {
    // Se o envio do formulário for por um método diferente do "POST", envia o usuário para a página de erro
    header('Location: ../../paginas/erro.php');
    exit;
}
