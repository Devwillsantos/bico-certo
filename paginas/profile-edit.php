<?php
require_once __DIR__ . "/../server/logged-in-user.php";
require_once __DIR__ . "/../server/config.php";
require_once __DIR__ . "/../server/perfil/editaperfil.php";
require_once __DIR__ . "/../server/data/estados.php";
$id = $_SESSION['usuario_id'] ?? null;
if ($id) {
    $stmt = $pdo->prepare('SELECT * FROM usuarios WHERE id = ?');
    $stmt->execute([$id]);
    require_once __DIR__ . "/../server/logged-in-user.php";
    require_once __DIR__ . "/../server/config.php";
    require_once __DIR__ . "/../server/perfil/editaperfil.php";

    // Carrega dados do usuário logado para preencher o formulário
    $id = $_SESSION['usuario_id'] ?? null;
    if ($id) {
        $stmt = $pdo->prepare('SELECT * FROM usuarios WHERE id = ?');
        $stmt->execute([$id]);
        $usuario = $stmt->fetch();
    } else {
        $usuario = [];
    }
    ?>    
    <!DOCTYPE html>
    <html lang="pt-BR">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Editar Perfil</title>
        <link rel="stylesheet" href="/bico-certo/css/profile-edit.css">
    </head>
    <body>
    <header class="top-bar">
        <div class="icone"><a href="./homepage.php"><img src="../imagens/logomarca.png" class="logomarca"></a></div>
        <div class="menu">
            <div class="logo"><a href="./servicos.php"><img src="../imagens/perfil/servicos.svg"></a></div>
            <div class="user-name logo"><p id="username"><?php echo $_SESSION['usuario_login']; ?></p></div>
            <div class="logo" onclick="toggleProfileMenu()"><img src="<?php echo '../' . ($_SESSION['usuario_foto'] ?? 'imagens/perfil/default.png'); ?>"></div>
        </div>
    </header>

    <div class="profile-menu" id="profileMenu">
        <ul>
            <li><a href="<?php if ($_SESSION['tipoUsuario'] === 'prestador') { echo './perfil.php?id=' . $_SESSION['usuario_id']; } else { echo './perfil contratante.php?id=' . $_SESSION['usuario_id']; } ?>">Meu Perfil</a></li>
            <li><a href="./profile-edit.php">Editar Perfil</a></li>
            <li><a href="../index.php" id="logout">Sair</a></li>
        </ul>
    </div>

    <div class="caixa-master">
        <div class="caixa">
            <div class="title"><img src="../imagens/perfil/title-pen.svg" class="title-pen"><h1>Editar Perfil</h1></div>

            <form id="formPerfil" enctype="multipart/form-data">
                <div class="grupo-formulario">
                    <label for="fotoPerfil">Foto de perfil</label>
                    <input type="file" id="fotoPerfil" accept="image/*" onchange="carregarFotoPerfil(event)">
                    <img id="imagemPerfil" src="<?= (!empty($usuario['fotoPerfil'])) ? '../' . htmlspecialchars($usuario['fotoPerfil']) : '../imagens/perfil/default.png' ?>" alt="Imagem de perfil" class="foto-perfil">
                </div>

                <div class="grupo-formulario">
                    <label for="fotoCapa">Foto de capa</label>
                    <input type="file" id="fotoCapa" accept="image/*" onchange="carregarFotoCapa(event)">
                    <img src="<?= (!empty($usuario['foto_capa'])) ? '../' . htmlspecialchars($usuario['foto_capa']) : '../imagens/perfil/fundo.jpg' ?>" alt="Foto de capa" class="foto-perfil">
                </div>

                <div class="grupo-formulario"><input type="text" placeholder="Nome" required id="nome" value="<?= htmlspecialchars($usuario['nome'] ?? '') ?>"></div>

                <?php if (isset($_SESSION['tipoUsuario']) && $_SESSION['tipoUsuario'] === 'prestador'): ?>
                <div class="grupo-formulario">
                    <select name="servico" id="prestador-opcoes">
                        <?php if (!empty($usuario['servico'])): ?>
                            <option value="<?= htmlspecialchars($usuario['servico']) ?>" selected><?= htmlspecialchars($usuario['servico']) ?></option>
                        <?php else: ?>
                            <option value="" disabled selected>Por favor, selecione uma espécie de serviço...</option>
                        <?php endif; ?>

                            <optgroup label="Beleza e Bem-estar">
                                <option value="Manicure e pedicure">Manicure e pedicure</option>
                                <option value="Cabeleireiro(a) ou barbeiro(a)">Cabeleireiro(a) ou barbeiro(a)</option>
                                <option value="Design de sobrancelhas">Design de sobrancelhas</option>
                                <option value="Maquiador(a)">Maquiador(a)</option>
                                <option value="Massoterapeuta(a)">Massoterapeuta(a)</option>
                                <option value="Esteticista (limpeza de pele, depilação, etc.)">Esteticista (limpeza de pele, depilação, etc.)</option>
                                <option value="Personal trainer">Personal trainer</option>
                                <option value="Instrutor(a) de yoga ou pilates">Instrutor(a) de yoga ou pilates</option>
                            </optgroup>

                            <optgroup label="Cuidados Domésticos">
                                <option value="Jardinagem">Jardinagem</option>
                                <option value="Paisagismo">Paisagismo</option>
                                <option value="Limpeza residencial ou comercial">Limpeza residencial ou comercial</option>
                                <option value="Organização de ambientes">Organização de ambientes</option>
                                <option value="Serviços de mudança (empacotamento e transporte leve)">Serviços de mudança (empacotamento e transporte leve)</option>
                                <option value="Reparos domésticos (marido/mulher de aluguel)">Reparos domésticos (marido/mulher de aluguel)</option>
                            </optgroup>

                            <optgroup label="Culinária e Gastronomia">
                                <option value="Personal chef">Personal chef</option>
                                <option value="Confeiteiro(a)">Confeiteiro(a)</option>
                                <option value="Produção de marmitas e comidas congeladas">Produção de marmitas e comidas congeladas</option>
                                <option value="Food truck ou barraquinha de comida em eventos">Food truck ou barraquinha de comida em eventos</option>
                                <option value="Aulas de culinária">Aulas de culinária</option>
                            </optgroup>

                            <optgroup label="Educação e Treinamento">
                                <option value="Aulas particulares (reforço escolar, línguas, música, etc.)">Aulas particulares (reforço escolar, línguas, música, etc.)</option>
                                <option value="Consultoria profissional (marketing, finanças, tecnologia, etc.)">Consultoria profissional (marketing, finanças, tecnologia, etc.)</option>
                                <option value="Coach de carreira ou vida">Coach de carreira ou vida</option>
                                <option value="Workshops ou treinamentos em áreas específicas">Workshops ou treinamentos em áreas específicas</option>
                            </optgroup>

                            <optgroup label="Cuidados com Animais">
                                <option value="Passeador(a) de cães">Passeador(a) de cães</option>
                                <option value="Pet sitter (babá de animais)">Pet sitter (babá de animais)</option>
                                <option value="Banho e tosa de animais">Banho e tosa de animais</option>
                                <option value="Adestramento de cães">Adestramento de cães</option>
                            </optgroup>

                            <optgroup label="Arte e Criação">
                                <option value="Fotógrafo(a) (casamentos, eventos, retratos)">Fotógrafo(a) (casamentos, eventos, retratos)</option>
                                <option value="Artista plástico ou artesão (pintura, escultura, bordado, etc.)">Artista plástico ou artesão (pintura, escultura, bordado, etc.)</option>
                                <option value="Design gráfico">Design gráfico</option>
                                <option value="Escritor(a) freelancer (artigos, blogs, roteiros, etc.)">Escritor(a) freelancer (artigos, blogs, roteiros, etc.)</option>
                                <option value="Edição de fotos ou vídeos">Edição de fotos ou vídeos</option>
                                <option value="Músico(a) (shows, eventos, gravações)">Músico(a) (shows, eventos, gravações)</option>
                            </optgroup>

                            <optgroup label="Transporte e Logística">
                                <option value="Motorista de aplicativo ou transporte privado">Motorista de aplicativo ou transporte privado</option>
                                <option value="Entregador(a) autônomo">Entregador(a) autônomo</option>
                                <option value="Motoboy">Motoboy</option>
                                <option value="Transporte escolar">Transporte escolar</option>
                            </optgroup>

                            <optgroup label="Tecnologia e Serviços Digitais">
                                <option value="Desenvolvimento de sites">Desenvolvimento de sites</option>
                                <option value="Suporte técnico de informática">Suporte técnico de informática</option>
                                <option value="Consultoria em redes sociais e marketing digital">Consultoria em redes sociais e marketing digital</option>
                                <option value="Produção de conteúdo (YouTube, podcasts, blogs)">Produção de conteúdo (YouTube, podcasts, blogs)</option>
                                <option value="Edição de vídeos e podcasts">Edição de vídeos e podcasts</option>
                            </optgroup>

                            <optgroup label="Eventos e Festas">
                                <option value="Decoração de festas">Decoração de festas</option>
                                <option value="Organização de eventos">Organização de eventos</option>
                                <option value="Buffet">Buffet</option>
                                <option value="Locação de materiais para eventos">Locação de materiais para eventos</option>
                                <option value="Recreação infantil">Recreação infantil</option>
                            </optgroup>

                            <optgroup label="Outros Serviços">
                                <option value="Assistência pessoal ou virtual">Assistência pessoal ou virtual</option>
                                <option value="Costura e ajustes de roupas">Costura e ajustes de roupas</option>
                                <option value="Serviços de tradução ou intérprete">Serviços de tradução ou intérprete</option>
                                <option value="Consultoria financeira ou contábil">Consultoria financeira ou contábil</option>
                                <option value="Reparos em eletrônicos">Reparos em eletrônicos</option>
                                <option value="Outros">Outros</option>
                            </optgroup>
                    </select>
                </div>
                <?php endif; ?>

                <div class="grupo-formulario"><input type="email" placeholder="E-Mail" required id="email" value="<?= htmlspecialchars($usuario['email'] ?? '') ?>"></div>
                <div class="grupo-formulario"><input type="tel" class="caixa-de-texto-celular required" placeholder="(DD) XX XXXXX-XXXX" maxlength="13" id="celular" oninput="celValidate()" value="<?= htmlspecialchars($usuario['numeroCelular'] ?? '') ?>"></div>

                <div class="grupo-formulario"><select id="endereco" name="estado">
                    <option value="">Estado</option>
                    <?= renderEstadoOptions($usuario['estado'] ?? '') ?>
                </select></div>

                <div class="grupo-formulario"><input placeholder="Senha" type="password" class="caixa-de-texto-senha required" maxlength="10" id="senha" oninput="senhaValidate()"></div>
                <div class="grupo-formulario"><input type="url" class="caixa-de-texto-celular required" placeholder="WhatsApp Link" maxlength="13" id="whatsapp" oninput="celValidate()" value="<?= htmlspecialchars($usuario['whatsAppLink'] ?? '') ?>"></div>
                <div class="grupo-formulario"><textarea class="bio" name="bio" placeholder="Descrição" maxlength="500" required><?= htmlspecialchars($usuario['descricao'] ?? '') ?></textarea></div>

                <div class="botoes"><button type="button" class="botao botao-salvar" onclick="saveInformations()">Salvar</button><button type="button" class="botao botao-excluir" onclick="confirmDeleteAccount()">Excluir Conta</button></div>
                <div class="confirm-deleting-account" style="display:none;"><p>Deseja realmente excluir sua conta?</p><button class="botao botao-salvar botao-nao-excluir" onclick="doNotDeleteAccount()">Não!</button><button class="botao botao-excluir botao-sim-excluir" onclick="deleteAccount()">Sim!</button><p class="deleting-message">Conta sendo excluída...</p></div>
                <div class="information-saved" style="display:none;"><p>Informações salvas com sucesso.</p></div>
            </form>
        </div>
    </div>

    <footer>
        <div class="footer-image"><img src="../imagens/logomarca-dark-mode.png"></div>
        <div class="vertical-row"></div>
        <div class="footer-list"><ul><li class="footer-list-option"><a href="./contato.php" target="_blank">Contato</a></li><li class="footer-list-option"><a href="./sobrenos.php" target="_blank">Sobre</a></li></ul></div>
    </footer>

    <script src="../script/perfil/perfil.js"></script>
    <script src="../script/profile-edit/delete-account.js"></script>
    <script src="../script/profile-edit/save-informations.js"></script>
    <script src="../script/profile-edit/prestador.js"></script>
    <script src="../script/user-login.js"></script>
    <script src="../script/user-logout.js"></script>
    </body>
    </html>
<?php
}
?>