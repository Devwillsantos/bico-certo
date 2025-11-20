<?php
$id = $_SESSION['usuario_id'] ?? 0;

 $capa = !empty($usuario['foto_capa']) 
        ? "../uploads/capas/" . $usuario['foto_capa'] 
        : "../imagens/perfil/fundo.jpg";

function selected($valor, $atual) {
    return (trim($atual) === trim($valor)) ? 'selected' : '';
}