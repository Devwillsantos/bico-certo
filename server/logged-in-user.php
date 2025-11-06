<?php

// Inicia a sessão
session_start();

// Verifica se o usuário está logado
if ($_SESSION['usuario_id'] === null) {
    header('Location: ../paginas/erro.php');
    exit;
}