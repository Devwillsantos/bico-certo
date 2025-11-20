<?php
session_start();
require_once __DIR__ . "/../config.php";

$id_usuario = $_GET['id'];

// Valores padrão
$usuario = [
    'nome' => 'Usuário',
    'telefone' => 'Não informado',
    'genero' => 'Não informado',
    'data_nascimento' => 'Não informado',
    'servico' => 'Não Informado',
    'cidade' => 'Não informado',
    'data_registro' => null,
    'ultima_visita' => null,
    'contratos_concluidos' => 0,
    'ultima_contratacao' => null,
    'descricao' => 'Nenhuma descrição disponível.',
    'foto' => 'imagens/padrao.jpg'
];

$avaliacoes = [];
$login_usuario = "Usuário";
$foto_usuario = "imagens/padrao.jpg";

if ($id_usuario) {

    // 🔥 ATUALIZAR ULTIMA VISITA
    $sql = "UPDATE usuarios SET ultima_visita = NOW() WHERE id = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$id_usuario]);

    // 🔍 1. Buscar dados do usuário logado
    $sql = "SELECT 
                id,
                nome,
                numeroCelular AS telefone,
                sexo AS genero,
                dataNascimento AS data_nascimento,
                servico,
                cidade,
                fotoPerfil AS foto,
                data_registro,
                ultima_visita,
                contratos_concluidos,
                ultima_contratacao,
                descricao
            FROM usuarios
            WHERE id = ?";

    $stmt = $pdo->prepare($sql);
    $stmt->execute([$id_usuario]);
    $dados = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($dados) {
        foreach ($dados as $campo => $valor) {
            if (!empty($valor)) $usuario[$campo] = $valor;
        }
    }

    // 🔍 2. Buscar login do usuário
    $sql = "SELECT login FROM usuarios WHERE id = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['id' => $id_usuario]);
    $login_usuario = $stmt->fetchColumn() ?: 'Usuário';

    // 🔍 3. Buscar foto do usuário logado
    $sql = "SELECT fotoPerfil FROM usuarios WHERE id = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['id' => $id_usuario]);
    $foto_usuario = $stmt->fetchColumn() ?: 'imagens/padrao.jpg';

    // 🔍 4. Buscar comentários recebidos neste perfil
    $sql = "SELECT 
                c.id,
                c.id_usuario,
                c.nome AS nome_avaliador,
                c.comentario,
                c.nota,
                c.data_comentario AS data,
                u.fotoPerfil AS foto_usuario
            FROM comentarios c
            JOIN usuarios u ON u.id = c.id_usuario
            WHERE c.perfil_id = ?
            ORDER BY c.data_comentario DESC";

    $stmt = $pdo->prepare($sql);
    $stmt->execute([$id_usuario]);
    $avaliacoes = $stmt->fetchAll(PDO::FETCH_ASSOC);
}

ob_clean();
?>
