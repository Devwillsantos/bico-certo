<?php
session_start();
require_once __DIR__ . "/../config.php";

header('Content-Type: application/json; charset=utf-8');

$userId = $_SESSION['usuario_id'] ?? null;
if (!$userId) {
    echo json_encode(['sucesso' => false, 'mensagem' => 'Usuário não autenticado.']);
    exit;
}

try {
    // Buscar caminhos de arquivos para remover do disco
    $stmt = $pdo->prepare('SELECT fotoPerfil, foto_capa FROM usuarios WHERE id = ?');
    $stmt->execute([$userId]);
    $u = $stmt->fetch(PDO::FETCH_ASSOC);

    // Começar transação para garantir integridade
    $pdo->beginTransaction();

    // Remover comentários feitos pelo usuário
    $stmt = $pdo->prepare('DELETE FROM comentarios WHERE id_usuario = ?');
    $stmt->execute([$userId]);

    // Opcional: remover comentários recebidos neste perfil (perfil_id)
    $stmt = $pdo->prepare('DELETE FROM comentarios WHERE perfil_id = ?');
    $stmt->execute([$userId]);

    // Remover outros dados dependentes conforme necessário (logs, contratações, etc.)
    // Ex.: DELETE FROM contratos WHERE contratante_id = ? OR prestador_id = ?

    // Deletar o usuário
    $stmt = $pdo->prepare('DELETE FROM usuarios WHERE id = ?');
    $stmt->execute([$userId]);

    $pdo->commit();

    // Apagar arquivos físicos, se existirem
    if (!empty($u['fotoPerfil'])) {
        $path = __DIR__ . '/../../' . ltrim($u['fotoPerfil'], '/');
        if (file_exists($path)) @unlink($path);
    }
    if (!empty($u['foto_capa'])) {
        $path = __DIR__ . '/../../' . ltrim($u['foto_capa'], '/');
        if (file_exists($path)) @unlink($path);
    }

    // Destruir sessão e cookies
    $_SESSION = [];
    if (ini_get('session.use_cookies')) {
        $params = session_get_cookie_params();
        setcookie(session_name(), '', time() - 42000,
            $params['path'], $params['domain'], $params['secure'], $params['httponly']
        );
    }
    session_destroy();

    echo json_encode(['sucesso' => true, 'mensagem' => 'Conta excluída com sucesso.']);
    exit;

} catch (Exception $e) {
    if ($pdo->inTransaction()) $pdo->rollBack();
    http_response_code(500);
    echo json_encode(['sucesso' => false, 'mensagem' => 'Erro ao excluir a conta: ' . $e->getMessage()]);
    exit;
}

?>
