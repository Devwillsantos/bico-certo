<?php
session_start();
require_once __DIR__ . "/../config.php";

header('Content-Type: application/json; charset=utf-8');

$userId = $_SESSION['usuario_id'] ?? null;
if (!$userId) {
    echo json_encode(['erro' => 'Usuário não autenticado.']);
    exit;
}

try {
    $fields = [];
    $params = [];

    // Nome
    if (!empty($_POST['nome'])) {
        $fields[] = 'nome = ?';
        $params[] = trim($_POST['nome']);
    }

    // Email
    if (!empty($_POST['email'])) {
        $fields[] = 'email = ?';
        $params[] = trim($_POST['email']);
    }

    // Senha (opcional) - hash
    if (!empty($_POST['senha'])) {
        $fields[] = 'senha = ?';
        $params[] = password_hash($_POST['senha'], PASSWORD_DEFAULT);
    }

    // Telefone / celular
    if (!empty($_POST['celular'])) {
        $fields[] = 'numeroCelular = ?';
        $params[] = trim($_POST['celular']);
    }

    // Estado
    if (!empty($_POST['estado'])) {
        $fields[] = 'estado = ?';
        $params[] = trim($_POST['estado']);
    }

    // Servico (apenas prestadores podem atualizar)
    if (isset($_POST['servico']) && (isset($_SESSION['tipoUsuario']) && $_SESSION['tipoUsuario'] === 'prestador')) {
        if (trim($_POST['servico']) !== '') {
            $fields[] = 'servico = ?';
            $params[] = trim($_POST['servico']);
        }
    }

    // WhatsApp link
    if (!empty($_POST['whatsapp'])) {
        $fields[] = 'whatsAppLink = ?';
        $params[] = trim($_POST['whatsapp']);
    }

    // Descrição
    if (!empty($_POST['descricao'])) {
        $fields[] = 'descricao = ?';
        $params[] = trim($_POST['descricao']);
    }

    // Processar upload de fotoPerfil
    if (!empty($_FILES['fotoPerfil']) && $_FILES['fotoPerfil']['error'] === UPLOAD_ERR_OK) {
        $tmp = $_FILES['fotoPerfil']['tmp_name'];
        $name = basename($_FILES['fotoPerfil']['name']);
        $ext = pathinfo($name, PATHINFO_EXTENSION);
        $newName = 'perfil_' . $userId . '_' . time() . '.' . $ext;
        $destDir = __DIR__ . '/../../uploads/perfis';
        if (!is_dir($destDir)) mkdir($destDir, 0755, true);
        $dest = $destDir . '/' . $newName;
        if (move_uploaded_file($tmp, $dest)) {
            $fields[] = 'fotoPerfil = ?';
            $params[] = 'uploads/perfis/' . $newName;
            // update session photo path too
            $_SESSION['usuario_foto'] = 'uploads/perfis/' . $newName;
        }
    }

    // Processar upload de capa (foto_capa)
    if (!empty($_FILES['fotoCapa']) && $_FILES['fotoCapa']['error'] === UPLOAD_ERR_OK) {
        $tmp = $_FILES['fotoCapa']['tmp_name'];
        $name = basename($_FILES['fotoCapa']['name']);
        $ext = pathinfo($name, PATHINFO_EXTENSION);
        $newName = 'capa_' . $userId . '_' . time() . '.' . $ext;
        $destDir = __DIR__ . '/../../uploads/capas';
        if (!is_dir($destDir)) mkdir($destDir, 0755, true);
        $dest = $destDir . '/' . $newName;
        if (move_uploaded_file($tmp, $dest)) {
            $fields[] = 'foto_capa = ?';
            $params[] = 'uploads/capas/' . $newName;
            // update session capa path so top-level templates can use it if needed
            $_SESSION['usuario_foto_capa'] = 'uploads/capas/' . $newName;
        }
    }

    // If nome was provided, update session login/name so header reflects changes
    if (!empty($_POST['nome'])) {
        $_SESSION['usuario_login'] = trim($_POST['nome']);
    }

    if (!empty($fields)) {
        $sql = 'UPDATE usuarios SET ' . implode(', ', $fields) . ' WHERE id = ?';
        $params[] = $userId;
        $stmt = $pdo->prepare($sql);
        $stmt->execute($params);
    }

    // Buscar os dados atualizados para retornar ao cliente (caminhos das imagens e nome)
    $stmt2 = $pdo->prepare('SELECT nome, fotoPerfil, foto_capa FROM usuarios WHERE id = ?');
    $stmt2->execute([$userId]);
    $usuarioAtualizado = $stmt2->fetch();

    $resp = ['sucesso' => true, 'mensagem' => 'Perfil atualizado com sucesso.'];
    if (!empty($usuarioAtualizado)) {
        $resp['usuario'] = [
            'nome' => $usuarioAtualizado['nome'] ?? null,
            'fotoPerfil' => $usuarioAtualizado['fotoPerfil'] ?? null,
            'foto_capa' => $usuarioAtualizado['foto_capa'] ?? null,
        ];
    }

    echo json_encode($resp);

} catch (PDOException $e) {
    http_response_code(500);
    echo json_encode(['erro' => 'Erro no banco: ' . $e->getMessage()]);
}

?>
