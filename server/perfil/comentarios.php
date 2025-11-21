<?php
session_start();
require_once __DIR__ . "/../config.php";
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

header('Content-Type: application/json; charset=utf-8');

// Permite apenas POST
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode(['erro' => 'Método inválido. Use POST.']);
    exit;
}

// Dados recebidos
$id_usuario  = $_POST['id_usuario'] ?? null;  // dono do perfil avaliado
$comentario  = $_POST['comentario'] ?? null;
$nota        = isset($_POST['nota']) ? (int)$_POST['nota'] : 0;

// ID de quem está comentando (contratante)
$id_autor = $_SESSION['usuario_id'] ?? null;
// nome do autor (vindo da sessão)
$nome_autor = $_SESSION['usuario_login'] ?? 'Usuário';

// Validação básica
if (!$id_usuario || !$id_autor || !$comentario) {
    echo json_encode(['erro' => 'Campos obrigatórios não enviados.']);
    exit;
}

try {
    $pdo->beginTransaction();

        // 1) Inserir comentário (compatível com a estrutura atual da tabela)
        // Observação: a tabela contém 'id_usuario' (autor), 'nome' (nome do autor) e 'perfil_id' (perfil avaliado)
        $sql = "INSERT INTO comentarios (id_usuario, nome, comentario, nota, data_comentario, perfil_id)
            VALUES (?, ?, ?, ?, NOW(), ?)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$id_autor, $nome_autor, $comentario, $nota, $id_usuario]);

    $insertId = $pdo->lastInsertId();

    // 2) Atualizar dados do usuário avaliado
    $sqlUp = "UPDATE usuarios
              SET contratos_concluidos = COALESCE(contratos_concluidos, 0) + 1,
                  ultima_contratacao = NOW()
              WHERE id = ?";
    $stmt2 = $pdo->prepare($sqlUp);
    $stmt2->execute([$id_usuario]);

    // 3) Buscar dados atualizados
    $stmt3 = $pdo->prepare("
        SELECT contratos_concluidos, ultima_contratacao 
        FROM usuarios 
        WHERE id = ?
    ");
    $stmt3->execute([$id_usuario]);
    $user = $stmt3->fetch(PDO::FETCH_ASSOC);

    // 4) Buscar o comentário criado + dados do autor
    $sqlComent = "
        SELECT 
            c.id, 
            c.id_usuario, 
            c.comentario, 
            c.nota,
            DATE_FORMAT(c.data_comentario, '%d/%m/%Y %H:%i') AS data_comentario,

            -- preferimos o nome do usuário na tabela de usuários quando existir
            COALESCE(u.nome, c.nome) AS nome,
            u.fotoPerfil AS foto_usuario,
            u.tipoUsuario AS tipo_usuario

        FROM comentarios c
        LEFT JOIN usuarios u ON u.id = c.id_usuario
        WHERE c.id = ?
    ";
    $stmt4 = $pdo->prepare($sqlComent);
    $stmt4->execute([$insertId]);
    $coment = $stmt4->fetch(PDO::FETCH_ASSOC);

    $pdo->commit();

    echo json_encode([
        'sucesso' => true,
        'mensagem' => 'Comentário salvo com sucesso!',
        'comentario' => $coment,
        'contratos_concluidos' => $user['contratos_concluidos'] ?? null,
        'ultima_contratacao' => isset($user['ultima_contratacao'])
            ? date('d/m/Y H:i', strtotime($user['ultima_contratacao']))
            : null
    ], JSON_UNESCAPED_UNICODE);

} catch (PDOException $e) {
    $pdo->rollBack();
    echo json_encode([
        'erro' => 'Erro no banco: ' . $e->getMessage()
    ]);
}
