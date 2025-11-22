<?php
require_once __DIR__ . "/../server/logged-in-user.php";
require_once __DIR__ . "/../server/config.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Servicos</title>
    <link rel="icon" href="../imagens/icones-aba/icone16.ico" sizes="16x16">
    <link rel="icon" href="../imagens/icones-aba/icone24.ico" sizes="24x24">
    <link rel="icon" href="../imagens/icones-aba/icone32.ico" sizes="32x32">
    <link rel="icon" href="../imagens/icones-aba/icone48.ico" sizes="48x48">
    <link rel="stylesheet" href="../css/servicos.css">
</head>
<body>
    <!-- Top Bar -->
    <header class="top-bar">
        <div class="icone">
            <a href="./homepage.php">
                <img src="../imagens/logomarca.png" class="logomarca">
            </a>
        </div>
        <div class="menu">
            <div class="logo">
                <span>
                    <a href="./consulta.php">
                        <img src="../imagens/perfil/master-search.svg">
                    </a>
                </span>
                <span>
                    <a href="./log.php">
                        <img src="../imagens/perfil/master-log.svg">
                    </a>
                </span>
                <span>
                    <a href="./db-model.php">
                        <img src="../imagens/perfil/master-db.svg">
                    </a>
                </span>
                <span>
                    <a href="./servicos.php">
                        <img src="../imagens/perfil/servicos.svg">
                    </a>
                </span>
            </div>
            <div class="user-name logo">
                <p id="username">
                    <?php echo $_SESSION['usuario_login']; ?>
                </p>
            </div>
            <!-- Ícone de perfil com menu de opções -->
            <div class="logo" onclick="toggleProfileMenu()">
                <img src="<?php echo '../' . $_SESSION['usuario_foto']; ?>">
            </div>
        </div>
    </header>
    <!-- Profile Menu -->
    <div class="profile-menu" id="profileMenu">
        <ul>
            <li>
                <a href="
                    <?php
                        if ($_SESSION['tipoUsuario'] === 'prestador') {
                            echo './perfil.php?id=' . $_SESSION['usuario_id'];
                        } else {
                            echo './perfil contratante.php?id=' . $_SESSION['usuario_id'];
                        }
                    ?>"
                >
                    Meu Perfil
                </a>
            </li>
            <li><a href="./profile-edit.php">Editar Perfil</a></li>
            <li><a href="../index.php" id="logout">Sair</a></li>
        </ul>
    </div>
    <!-- Main Content -->
    <main>
        <div class="main-container">
            <div class="container1">
                <form method="GET" action="" class="search-container">
                    <input type="text" name="busca" class="search-bar" 
                           placeholder="Pesquise um serviço..." 
                           value="<?php echo htmlspecialchars($_GET['busca'] ?? ''); ?>"> 
                    <button type="submit" class="search-button">Buscar</button>
                </form>
            </div>
            
            <div class="container2">
                <?php
                    // 2. CAPTURA O TERMO DE BUSCA
                    $termo_busca = $_GET['busca'] ?? ''; // Pega o valor do input 'busca' ou uma string vazia
                    
                    try {
                        // 3. CONSTRÓI A CONSULTA SQL DINAMICAMENTE
                        $sql = "SELECT id, nome, estado, servico, fotoPerfil, whatsAppLink 
                                FROM usuarios ";
                        
                        $parametros = []; // Array para armazenar os parâmetros de segurança do PDO

                        // Adiciona a cláusula WHERE se houver um termo de busca
                        if (!empty($termo_busca)) {
                            // Pesquisa pelo termo no campo 'servico' usando LIKE para correspondência parcial
                            // O **CONCAT('%', :busca, '%')** é a forma segura de usar LIKE com PDO
                            $sql .= "WHERE servico LIKE :busca ";
                            
                            // Adiciona o parâmetro. Usamos '%' no valor (não no SQL) para usar a busca por LIKE
                            $parametros[':busca'] = '%' . $termo_busca . '%';
                        }

                        $sql .= "ORDER BY nome ASC";
                        
                        $stmt = $pdo->prepare($sql);
                        
                        // Executa a consulta, passando os parâmetros
                        $stmt->execute($parametros);

                        // 4. Recupera todos os usuários
                        $usuarios = $stmt->fetchAll(PDO::FETCH_ASSOC);

                        // 5. Verifica se há usuários para exibir
                        if ($usuarios) {
                            $cards_exibidos = 0; // Contador para saber se algum card foi exibido
                            
                            // Itera sobre cada usuário e gera o HTML do card
                            foreach ($usuarios as $usuario) {
                                // Limpa e valida os dados antes de inseri-los no HTML (Segurança!)
                                $id = htmlspecialchars($usuario['id'] ?? '');
                                $nome = htmlspecialchars($usuario['nome'] ?? 'Nome Desconhecido');
                                $estado = htmlspecialchars($usuario['estado'] ?? 'Estado Não Informado');
                                $servico = htmlspecialchars($usuario['servico'] ?? ''); // Pega o serviço
                                $foto_perfil = $usuario['fotoPerfil'];
                                $whatsapp_link = htmlspecialchars($usuario['whatsAppLink'] ?? 'https://wa.me/');

                                // Converte o caminho da imagem de perfil:
                                $caminho_img = $foto_perfil;

                                // VERIFICAÇÃO PRINCIPAL: SÓ EXIBE O CARD SE O SERVIÇO TIVER VALOR
                                if (!empty($servico)) {
                                    $cards_exibidos++;
                ?>
                <div class="card">
                    <img src="<?php echo '../' . $caminho_img; ?>" class="services-photo" alt="Foto de perfil de <?php echo $nome; ?>">
                    <p class="service-title"><?php echo $servico; ?></p>
                    <p class="name"><?php echo $nome; ?></p>
                    <p class="estado"><?php echo $estado; ?></p>
                    <form action="./perfil.php" method="get">
                        <button class="contact-button" name="id" value="<?php echo $id ?>">
                            Visualizar perfil
                        </button>
                    </form>
                    <img src="../imagens/servicos/whatsapp-blue-icon.svg" class="whatsapp-icon-blue">
                    <a href="<?php echo $whatsapp_link; ?>" target="_blank">
                        <img src="../imagens/servicos/whatsapp-white-icon.svg" class="whatsapp-icon-white" alt="Entrar em contato via WhatsApp">
                    </a>
                </div>
                <?php
                                }
                            } // Fim do foreach
                            
                            // 6. Mensagem caso não haja serviços válidos
                            if ($cards_exibidos === 0) {
                                $mensagem = !empty($termo_busca) ? "Nenhum serviço encontrado para a busca \"{$termo_busca}\"." : "Nenhum serviço disponível para exibição.";
                                echo "<p>{$mensagem}</p>";
                            }

                        } else {
                            // Se a consulta não retornar resultados (o que inclui zero resultados da busca)
                            $mensagem = !empty($termo_busca) ? "Nenhum resultado encontrado para a busca \"{$termo_busca}\"." : "Nenhum usuário encontrado na base de dados.";
                            echo "<p>{$mensagem}</p>";
                        }
                    } catch (PDOException $e) {
                        // Em caso de erro na consulta
                        die('Erro ao carregar os serviços: ' . $e->getMessage());
                    }
                ?>
            </div>
        </div>
    </main>
    <!-- Footer-->
    <footer>
        <div class="footer-image">
            <img src="../imagens/logomarca-dark-mode.png">
        </div>
        <div class="vertical-row"></div>
        <div class="footer-list">
            <ul>
                <li class="footer-list-option"><a href="./contato.php" target="_blank">Contato</a></li>
                <li class="footer-list-option"><a href="./sobrenos.php" target="_blank">Sobre</a></li>
            </ul>
        </div>
    </footer>
    <script src="../script/perfil/perfil.js"></script>
    <script src="../script/user-login.js"></script>
    <script src="../script/user-logout.js"></script>
</body>
</html>