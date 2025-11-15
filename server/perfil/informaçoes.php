<?php 
session_start();

$id_usuario = $_SESSION['usuario_id'] ?? null;

// Perfil padrão (caso id inválido)
$usuario = [
  'data_registro' => null,
  'ultima_visita' => null,
  'contratos_concluidos' => 0,
  'ultima_contratacao' => null,
  'profissao' => 'Não Informada',
  'descricao' => 'Nenhuma descrição disponível.'
];


$avaliacoes = [];

// Se recebeu id, busca dados reais
if ($id_usuario) {
 $sql = "SELECT id, nome, numeroCelular AS telefone, sexo AS genero, dataNascimento AS data_nascimento,
               servico AS profissao, cidade, fotoPerfil AS foto,
               data_registro, ultima_visita, contratos_concluidos,
               ultima_contratacao, descricao
        FROM usuarios WHERE id = ?";

  $stmt = $pdo->prepare($sql);
  $stmt->execute([$id_usuario]);
  $dados = $stmt->fetch(PDO::FETCH_ASSOC);

  if ($dados) {
    foreach ($dados as $campo => $valor) {
      if (!empty($valor)) $usuario[$campo] = $valor;
    }
  }
}
ob_clean();
?>