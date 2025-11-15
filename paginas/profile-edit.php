<?php
require_once __DIR__ . "/../server/logged-in-user.php";
require_once __DIR__ . "/../server/config.php";
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Perfil</title>
    <link rel="stylesheet" href="../css/profile-edit.css">
    <link rel="icon" href="../imagens/icones-aba/icone16.ico" sizes="16x16">
    <link rel="icon" href="../imagens/icones-aba/icone24.ico" sizes="24x24">
    <link rel="icon" href="../imagens/icones-aba/icone32.ico" sizes="32x32">
    <link rel="icon" href="../imagens/icones-aba/icone48.ico" sizes="48x48">
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
                <span><a href="./servicos.php">
                <img src="../imagens/perfil/servicos.svg"></a></span>
            </div>
            <div class="logo">
                <span><a href="./mensagem.php">
                <img src="../imagens/perfil/envelope.svg"></a></span>
            </div>
            <div class="logo">
                <span><a href="./notifications.php">
                <img src="../imagens/perfil/notificação.svg"></a></span>
            </div>
            <div class="user-name logo">
                <?php
                    $sql = "SELECT login FROM usuarios WHERE id = :id";
                    $stmt = $pdo->prepare($sql);
                    $stmt->execute(['id' => $_SESSION['usuario_id']]);
                    $usuario = $stmt->fetch(PDO::FETCH_ASSOC);
                    $login = $usuario['login'];
                ?>
                <p id="username">
                    <?php echo $login; ?>
                </p>
            </div>
            <!-- Ícone de perfil com menu de opções -->
            <div class="logo" onclick="toggleProfileMenu()">
                <?php
                    $sql = "SELECT fotoPerfil FROM usuarios WHERE id = :id";
                    $stmt = $pdo->prepare($sql);
                    $stmt->execute(['id' => $_SESSION['usuario_id']]);
                    $usuario = $stmt->fetch(PDO::FETCH_ASSOC);
                    $foto_perfil = $usuario['fotoPerfil'];
                ?>
                <img src="<?php echo '../' . $foto_perfil; ?>">
            </div>
        </div>
    </header>
    <div class="profile-menu" id="profileMenu">
        <ul>
            <li><a href="./perfil.php">Meu Perfil</a></li>
            <li><a href="./profile-edit.php">Editar Perfil</a></li>
            <li><a href="../index.php" id="logout">Sair</a></li>
        </ul>
    </div>

    <div class="caixa-master">
        <div class="caixa">
            <div class="title">
                <img src="../imagens/perfil/title-pen.svg" class="title-pen">
                <h1>Editar Perfil</h1>
            </div>
            <div id="formPerfil" onsubmit="return validarFormulario()">

                <div class="grupo-formulario">
                    <label for="fotoPerfil">Foto de perfil</label>
                    <input type="file" id="fotoPerfil" accept="image/*" onchange="carregarFotoPerfil(event)">
                    <img id="imagemPerfil" src="#" alt="Imagem de perfil" class="foto-perfil" style="display: none;">
                </div>
                
                <div class="grupo-formulario">
                    <label for="fotoCapa">Foto de capa</label>
                    <input type="file" id="fotoCapa" accept="image/*" onchange="carregarFotoCapa(event)">
                    <img id="imagemCapa" src="#" alt="Imagem de capa" class="foto-perfil" style="display: none;">
                </div>
                
                <div class="grupo-formulario">
                    <input type="text" placeholder="Nome" required id="nome" >
                </div>

                <div class="grupo-formulario">
                    <select name="" id="prestador-opcoes">
                        <option value="" disabled selected>Por favor, selecione uma espécie de serviço...</option>
                        <optgroup label="Beleza e Bem-estar">
                            <option value="teste">Manicure e pedicure</option>
                            <option value="teste">Cabeleireiro(a) ou barbeiro(a)</option>
                            <option value="teste">Design de sobrancelhas</option>
                            <option value="teste">Maquiador(a)</option>
                            <option value="teste">Massoterapeuta(a)</option>
                            <option value="teste">Esteticista (limpeza de pele, depilação, etc.)</option>
                            <option value="teste">Personal trainer</option>
                            <option value="teste">Instrutor(a) de yoga ou pilates</option>
                        </optgroup>
                        <optgroup label="Cuidados Domésticos">
                            <option value="teste">Jardinagem</option>
                            <option value="teste">Paisagismo</option>
                            <option value="teste">Limpeza residencial ou comercial</option>
                            <option value="teste">Organização de ambientes</option>
                            <option value="teste">Serviços de mudança (empacotamento e transporte leve)</option>
                            <option value="teste">Reparos domésticos (marido/mulher de aluguel)</option>
                        </optgroup>
                        <optgroup label="Culinária e Gastronomia">
                            <option value="teste">Personal chef</option>
                            <option value="teste">Confeiteiro(a)</option>
                            <option value="teste">Produção de marmitas e comidas congeladas</option>
                            <option value="teste">Food truck ou barraquinha de comida em eventos</option>
                            <option value="teste">Aulas de culinária</option>
                        </optgroup>
                        <optgroup label="Educação e Treinamento">
                            <option value="teste">Aulas particulares (reforço escolar, línguas, música, etc.)</option>
                            <option value="teste">Consultoria profissional (marketing, finanças, tecnologia, etc.)</option>
                            <option value="teste">Coach de carreira ou vida</option>
                            <option value="teste">Workshops ou treinamentos em áreas específicas</option>
                        </optgroup>
                        <optgroup label="Cuidados com Animais">
                            <option value="teste">Passeador(a) de cães</option>
                            <option value="teste">Pet sitter (babá de animais)</option>
                            <option value="teste">Banho e tosa de animais</option>
                            <option value="teste">Adestramento de cães</option>
                        </optgroup>
                        <optgroup label="Arte e Criação">
                            <option value="teste">Fotógrafo(a) (casamentos, eventos, retratos)</option>
                            <option value="teste">Artista plástico ou artesão (pintura, escultura, bordado, etc.)</option>
                            <option value="teste">Design gráfico</option>
                            <option value="teste">Escritor(a) freelancer (artigos, blogs, roteiros, etc.)</option>
                            <option value="teste">Edição de fotos ou vídeos</option>
                            <option value="teste">Músico(a) (shows, eventos, gravações)</option>
                        </optgroup>
                        <optgroup label="Transporte e Logística">
                            <option value="teste">Motorista de aplicativo ou transporte privado</option>
                            <option value="teste">Entregador(a) autônomo</option>
                            <option value="teste">Motoboy</option>
                            <option value="teste">Transporte escolar</option>
                        </optgroup>
                        <optgroup label="Tecnologia e Serviços Digitais">
                            <option value="teste">Desenvolvimento de sites</option>
                            <option value="teste">Suporte técnico de informática</option>
                            <option value="teste">Consultoria em redes sociais e marketing digital</option>
                            <option value="teste">Produção de conteúdo (YouTube, podcasts, blogs)</option>
                            <option value="teste">Edição de vídeos e podcasts</option>
                        </optgroup>
                        <optgroup label="Eventos e Festas">
                            <option value="teste">Decoração de festas</option>
                            <option value="teste">Organização de eventos</option>
                            <option value="teste">Buffet para festas</option>
                            <option value="teste">Locação de materiais para eventos</option>
                            <option value="teste">Recreação infantil</option>
                        </optgroup>
                        <optgroup label="Outros Serviços">
                            <option value="teste">Assistência pessoal ou virtual</option>
                            <option value="teste">Costura e ajustes de roupas</option>
                            <option value="teste">Serviços de tradução ou intérprete</option>
                            <option value="teste">Consultoria financeira ou contábil</option>
                            <option value="teste">Reparos em eletrônicos</option>
                            <option value="teste">Outros</option>
                        </optgroup>
                    </select>
                </div>

                <div class="grupo-formulario">
                    <input type="email" placeholder="E-Mail" required id="email">
                </div>

                <div class="grupo-formulario">
                    <input type="tel" class="caixa-de-texto-celular required" placeholder="(DD) XX XXXXX-XXXX" maxlength="13" id="celular" oninput="celValidate()">
                </div>

                <div class="grupo-formulario">
                    <select id="endereco">
                        <option value="">Estado</option>
                        <option value="ac">Acre</option>
                        <option value="al">Alagoas</option>
                        <option value="am">Amazonas</option>
                        <option value="ba">Bahia</option>
                        <option value="ce">Ceará</option>
                        <option value="es">Espírito Santo</option>
                        <option value="go">Goiás</option>
                        <option value="ma">Maranhão</option>
                        <option value="mt">Mato Grosso</option>
                        <option value="ms">Mato Grosso do Sul</option>
                        <option value="mg">Minas Gerais</option>
                        <option value="pa">Pará</option>
                        <option value="pb">Paraíba</option>
                        <option value="pr">Paraná</option>
                        <option value="pe">Pernambuco</option>
                        <option value="pi">Piauí</option>
                        <option value="rj">Rio de Janeiro</option>
                        <option value="rn">Rio Grande do Norte</option>
                        <option value="rs">Rio Grande do Sul</option>
                        <option value="ro">Rondônia</option>
                        <option value="rr">Roraima</option>
                        <option value="sc">Santa Catarina</option>
                        <option value="sp">São Paulo</option>
                        <option value="se">Sergipe</option>
                        <option value="to">Tocantins</option>
                        <option value="df">Distrito Federal</option>
                    </select>
                </div>

                <div class="grupo-formulario">
                    <input placeholder="Senha" type="password" class="caixa-de-texto-senha required" maxlength="10" id="senha" oninput="senhaValidate()">
                </div>

                <div class="grupo-formulario">
                    <input type="url" class="caixa-de-texto-celular required" placeholder="WhatsApp Link" maxlength="13" id="whatsapp" oninput="celValidate()">
                </div>

                <div class="grupo-formulario">
                    <textarea class="bio" name="bio" placeholder="Descrição" maxlength="500" required></textarea>
                </div>
                <div class="botoes">
                    <button class="botao botao-salvar" onclick="saveInformations()">Salvar</button>
                    <button class="botao botao-excluir" onclick="confirmDeleteAccount()">Excluir Conta</button>
                </div>
                <div class="confirm-deleting-account">
                    <p>Deseja realmente excluir sua conta?</p>
                    <button class="botao botao-salvar botao-nao-excluir" onclick="doNotDeleteAccount()">Não!</button>
                    <button class="botao botao-excluir botao-sim-excluir" onclick="deleteAccount()">Sim!</button>
                    <p class="deleting-message">Conta sendo excluída...</p>
                </div>
                <div class="information-saved">
                    <p>Informações salvas com sucesso.</p>
                </div>
            </div>
        </div>
    </div>
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
    <script src="../script/profile-edit/delete-account.js"></script>
    <script src="../script/profile-edit/save-informations.js"></script>
    <script src="../script/profile-edit/prestador.js"></script>
    <script src="../script/user-login.js"></script>
    <script src="../script/user-logout.js"></script>
</body>
</html>
