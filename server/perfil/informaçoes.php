<?php
session_start();

require_once __DIR__ . "/../config.php";

$id_usuario = $_SESSION['usuario_id'] ?? null;

$usuario = [
  'data_registro' => null,
  'ultima_visita' => null,
  'contratos_concluidos' => 0,
  'ultima_contratacao' => null,
  'profissao' => 'Não Informada',
  'descricao' => 'Nenhuma descrição disponível.',
  'foto' => 'imagens/padrao.jpg'
];

$avaliacoes = [];

if ($id_usuario) {

    // 1. Buscar dados do usuário
    $sql = "SELECT 
                id, nome,
                numeroCelular AS telefone,
                sexo AS genero,
                dataNascimento AS data_nascimento,
                profissao,
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

    // 2. Buscar login
    $sql = "SELECT login FROM usuarios WHERE id = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['id' => $id_usuario]);
    $login_usuario = $stmt->fetchColumn() ?: 'Usuário';


    // 3. Buscar foto do usuário
    $sql = "SELECT fotoPerfil FROM usuarios WHERE id = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['id' => $id_usuario]);
    $foto_usuario = $stmt->fetchColumn() ?: 'imagens/padrao.jpg';

    // 4. Buscar comentários do perfil
    $sql = "SELECT 
                c.id,
                c.id_usuario,
                c.nome,
                c.comentario,
                c.nota,
                c.data_comentario,
                u.fotoPerfil AS foto_usuario,
                u.profissao
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
