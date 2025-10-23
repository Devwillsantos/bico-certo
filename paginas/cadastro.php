<?php
// Display a succesfull registration modal
session_start();
if ($_SESSION['showModal']) {
    echo '<div class="modal" onclick="closeModal(event)">' ;
    echo    '<div class="modal-box">';
    echo        '<span class="modal-title">';
    echo            'Registrado com sucesso!';
    echo        '</span>';
    echo        '<button class="modal-button" onclick="goToLoginPage()">';
    echo            'Fazer login';
    echo        '</button>';
    echo    '</div>';
    echo '</div>';
    
    // Stop the modal session
    unset($_SESSION['showModal']);
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro</title>
    <link rel="icon" href="../imagens/icones-aba/icone16.ico" sizes="16x16">
    <link rel="icon" href="../imagens/icones-aba/icone24.ico" sizes="24x24">
    <link rel="icon" href="../imagens/icones-aba/icone32.ico" sizes="32x32">
    <link rel="icon" href="../imagens/icones-aba/icone48.ico" sizes="48x48">
    <link rel="stylesheet" href="../css/cadastro.css">
</head>
<body>
    <div class="container">
        <div class="container-esquerdo">
            <img src="../imagens/imagem-cadastro.jpg" class="imagem">
        </div>
        <div class="container-direito" id="container-direito">
            <img src="../imagens/logomarca.png" class="logomarca" id="logomarca">
            <img src="../imagens/logomarca-dark-mode.png" class="logomarca-dark-mode" id="logomarca-dark-mode">
            <form action="../server/registration/validation.php" method="post" id="form" enctype="multipart/form-data">
                <h1>Informações Pessoais</h1>
                <div class="coluna1">
                    <div class="campo">
                        <input type="text" class="nome required" placeholder="Nome Completo" id="nome" name="nome" oninput="nameValidate()">
                        <span class="span-required">Nome deve ter no mínimo 8 caracteres alfabéticos e no máximo 60.</span>
                    </div>
                    <div class="campo">
                        <input type="email" class="email required" placeholder="E-mail" name="email" maxlength="30" id="email" oninput="emailValidate()">
                        <span class="span-required">Digite um e-mail válido.</span>
                    </div>
                    <div class="campo">
                        <input type="date" class="data-de-nascimento required" name="dataDeNascimento" id="data-de-nascimento" value="2024-01-01" oninput="dateValidate(2)">
                        <span class="span-required">Você precisa ter mais de 18 anos.</span>
                    </div>
                    <div class="campo">
                        <select name="sexo" id="sexo" class="sexo required" onchange="sexoValidate()">
                            <option value="" disabled selected>Selecione um sexo...</option>
                            <option value="masculino">Masculino</option>
                            <option value="feminino">Feminino</option>
                        </select>
                        <span class="span-required">Selecione um sexo.</span>
                    </div>
                    <div class="campo">
                        <input type="text" class="cpf required" placeholder="CPF" name="cpf" maxlength="14" id="cpf" oninput="cpfValidate(4)">
                        <span class="span-required">Digite um CPF válido.</span>
                    </div>
                    <div class="campo">
                        <input type="tel" class="celular required" placeholder="Número do Celular" name="numeroCelular" maxlength="17" id="celular" oninput="celValidate()">
                        <span class="span-required">Digite um número de celular que siga o padrão: (+55)XX-XXXXXXXXX.</span>
                    </div>
                </div>
                <h1>Localização</h1>
                <div class="coluna2">
                    <div class="campo">
                        <input type="text" class="cep required" placeholder="CEP" name="cep" maxlength="9" id="cep" onblur="buscaCep(this.value)" oninput="cepValidate()">
                        <span class="span-required">Digite um CEP válido.</span>
                    </div>
                    <div class="campo">
                        <input type="text" class="rua required" placeholder="Rua" name="rua" maxlength="20" id="rua" oninput="ruaValidate()">
                        <span class="span-required">Digite uma rua.</span>
                    </div>
                    <div class="campo">
                        <input type="text" class="estado required" placeholder="Estado" name="estado" maxlength="19" id="estado" oninput="estadoValidate()">
                        <span class="span-required">Digite um estado.</span>
                    </div>
                    <div class="campo">
                        <input type="text" class="cidade required" placeholder="Cidade" name="cidade" maxlength="30" id="cidade" oninput="cidadeValidate()">
                        <span class="span-required">Digite uma cidade.</span>
                    </div>
                    <div class="campo">
                        <input type="number" class="numero required" placeholder="Número da Casa" name="numeroCasa" id="numero" oninput="numeroValidate()">
                        <span class="span-required">Digite um número válido.</span>
                    </div>
                    <div class="campo">
                        <input type="text" class="bairro required" placeholder="Bairro" name="bairro" maxlength="30" id="bairro" oninput="bairroValidate()">
                        <span class="span-required">Digite um bairro.</span>
                    </div>
                    <div class="campo">
                        <input type="text" class="ponto-de-referencia required" placeholder="Ponto de Referência" name="pontoReferencia" maxlength="30" id="ponto-de-referencia">
                    </div>
                </div>
                <h1>Informações da Conta</h1>
                <div class="coluna3">
                    <div class="campo">
                        <input type="text" class="login required" placeholder="Login" name="login" maxlength="6" id="login" oninput="loginValidate()">
                        <span class="span-required">Login deve ter exatamente 6 caracteres alfabéticos.</span>
                    </div>
                    <div class="campo">
                        <input type="password" class="senha required" placeholder="Senha" name="senha" maxlength="8" id="senha" oninput="senhaValidate(this.value)">
                        <span class="span-required">Senha deve ter exatamente 8 caracteres alfabéticos.</span>
                    </div>
                    <div class="campo">
                        <input type="password" class="confirmar-senha required" placeholder="Confirmar Senha" name="confirmacaoSenha" maxlength="8" id="confirmar-senha" oninput="confirmarSenhaValidate()">
                        <span class="span-required">As senhas precisam ser iguais.</span>
                    </div>
                </div>
                <h1>Contratante ou Prestador?</h1>
                <div class="coluna4">
                    <div>
                        <div class="contratante">
                            <input type="radio" name="contratante" id="contratante" class="required" onclick="userRoleValidate()">
                            <label for="contratante" class="sou-contratante">
                                Sou contratante e viso contratar serviços dentro da plataforma.
                            </label>
                        </div>
                        <div class="prestador">
                            <input type="radio" name="prestador" id="prestador" class="required" onclick="userRoleValidate()">
                            <label for="prestador" class="sou-prestador">
                                Sou prestador e viso oferecer serviços dentro da plataforma.
                            </label>
                        </div>
                    </div>
                </div>
                <span class="span-required">Selecione que tipo de usuário você será dentro da plataforma.</span>
                <div class="coluna5" id="coluna5">
                    <div class="services">
                        <h3>Que tipo de serviço você deseja oferecer na plataforma?</h3>
                        <select name="prestador-opcoes" id="prestador-opcoes" class="required">
                            <option value="" disabled selected>Por favor, selecione uma espécie de serviço...</option>

                            <optgroup label="Beleza e Bem-estar">
                                <option value="manicure-pedicure">Manicure e pedicure</option>
                                <option value="cabeleireiro-barbeiro">Cabeleireiro(a) ou barbeiro(a)</option>
                                <option value="design-sobrancelhas">Design de sobrancelhas</option>
                                <option value="maquiador">Maquiador(a)</option>
                                <option value="massoterapeuta">Massoterapeuta(a)</option>
                                <option value="esteticista">Esteticista (limpeza de pele, depilação, etc.)</option>
                                <option value="personal-trainer">Personal trainer</option>
                                <option value="instrutor-yoga-pilates">Instrutor(a) de yoga ou pilates</option>
                            </optgroup>

                            <optgroup label="Cuidados Domésticos">
                                <option value="jardinagem">Jardinagem</option>
                                <option value="paisagismo">Paisagismo</option>
                                <option value="limpeza-residencial-comercial">Limpeza residencial ou comercial</option>
                                <option value="organizacao-de-ambientes">Organização de ambientes</option>
                                <option value="servicos-de-mudanca">Serviços de mudança (empacotamento e transporte leve)</option>
                                <option value="reparos-domesticos">Reparos domésticos (marido/mulher de aluguel)</option>
                            </optgroup>

                            <optgroup label="Culinária e Gastronomia">
                                <option value="personal-chef">Personal chef</option>
                                <option value="confeiteiro">Confeiteiro(a)</option>
                                <option value="marmitas-e-congelados">Produção de marmitas e comidas congeladas</option>
                                <option value="food-truck-eventos">Food truck ou barraquinha de comida em eventos</option>
                                <option value="aulas-de-culinaria">Aulas de culinária</option>
                            </optgroup>

                            <optgroup label="Educação e Treinamento">
                                <option value="aulas-particulares">Aulas particulares (reforço escolar, línguas, música, etc.)</option>
                                <option value="consultoria-profissional">Consultoria profissional (marketing, finanças, tecnologia, etc.)</option>
                                <option value="coach-carreira-vida">Coach de carreira ou vida</option>
                                <option value="workshops-treinamentos">Workshops ou treinamentos em áreas específicas</option>
                            </optgroup>

                            <optgroup label="Cuidados com Animais">
                                <option value="passeador-de-caes">Passeador(a) de cães</option>
                                <option value="pet-sitter">Pet sitter (babá de animais)</option>
                                <option value="banho-e-tosa">Banho e tosa de animais</option>
                                <option value="adestramento-de-caes">Adestramento de cães</option>
                            </optgroup>

                            <optgroup label="Arte e Criação">
                                <option value="fotografia">Fotógrafo(a) (casamentos, eventos, retratos)</option>
                                <option value="artes-plasticas">Artista plástico ou artesão (pintura, escultura, bordado, etc.)</option>
                                <option value="design-grafico">Design gráfico</option>
                                <option value="escritor-freelancer">Escritor(a) freelancer (artigos, blogs, roteiros, etc.)</option>
                                <option value="edicao-fotos-videos">Edição de fotos ou vídeos</option>
                                <option value="musico">Músico(a) (shows, eventos, gravações)</option>
                            </optgroup>

                            <optgroup label="Transporte e Logística">
                                <option value="motorista-aplicativo">Motorista de aplicativo ou transporte privado</option>
                                <option value="entregador-autonomo">Entregador(a) autônomo</option>
                                <option value="motoboy">Motoboy</option>
                                <option value="transporte-escolar">Transporte escolar</option>
                            </optgroup>

                            <optgroup label="Tecnologia e Serviços Digitais">
                                <option value="desenvolvimento-de-sites">Desenvolvimento de sites</option>
                                <option value="suporte-informatica">Suporte técnico de informática</option>
                                <option value="consultoria-marketing-digital">Consultoria em redes sociais e marketing digital</option>
                                <option value="producao-de-conteudo">Produção de conteúdo (YouTube, podcasts, blogs)</option>
                                <option value="edicao-videos-podcasts">Edição de vídeos e podcasts</option>
                            </optgroup>

                            <optgroup label="Eventos e Festas">
                                <option value="decoracao-de-festas">Decoração de festas</option>
                                <option value="organizacao-de-eventos">Organização de eventos</option>
                                <option value="buffet">Buffet para festas</option>
                                <option value="locacao-de-materiais">Locação de materiais para eventos</option>
                                <option value="recreacao-infantil">Recreação infantil</option>
                            </optgroup>

                            <optgroup label="Outros Serviços">
                                <option value="assistencia-pessoal-virtual">Assistência pessoal ou virtual</option>
                                <option value="costura-ajustes">Costura e ajustes de roupas</option>
                                <option value="traducao-interpretacao">Serviços de tradução ou intérprete</option>
                                <option value="consultoria-financeira">Consultoria financeira ou contábil</option>
                                <option value="reparos-eletronicos">Reparos em eletrônicos</option>
                                <option value="outros">Outros</option>
                            </optgroup>
                        </select>
                        <span class="span-required">Selecione que tipo de serviço você oferecerá na plataforma.</span>
                    </div>
                </div>
                <h1>Foto de Perfil</h1>
                <div class="coluna6">
                    <input type="file" name="profile-photo" id="profilePhotoInput" class="btn-profile-photo" accept="image/*">
                    <img src="" alt="" id="profilePhotoPreview" class="profile-photo-preview">
                    <span class="span-required">Selecione uma foto de perfil.</span>
                </div>
                <div class="buttons-container">
                    <button type="submit" class="botao-de-cadastrar-usuario">Cadastrar Usuário</button>
                    <button type="reset" class="botao-de-limpar-formulario">Limpar Formulário</button>
                    <a href="../index.html" class="botao-de-voltar-a-pagina-inicial">
                        <span>Voltar à Página Inicial</span>
                    </a>
                </div>
            </form>
        </div>
        <div class="acessibility-buttons">
            <div class="acessibility-panel">
                <img onclick="LightMode()" id="btnLightMode" src="../imagens/white-and-dark-mode/sun-solid.svg" class="botao-white-mode">
                <img onclick="DarkMode()" id="btnDarkMode" src="../imagens/white-and-dark-mode/moon-solid.svg" class="botao-dark-mode">
                <img id="aumentarZoom" src="../imagens/acessibilidade/circle-plus-solid.svg" class="acessibilidade-mais">
                <img id="abaixarZoom" src="../imagens/acessibilidade/circle-minus-solid.svg" class="acessibilidade-menos">
                <img id="aumentarZoomDM" src="../imagens/white-and-dark-mode/circle-plus-solid.svg" class="acessibilidade-mais lm-dm">
                <img id="abaixarZoomDM" src="../imagens/white-and-dark-mode/circle-minus-solid.svg" class="acessibilidade-menos lm-dm">
            </div>
        </div>
    </div>
    <script src="../script/registro/profile-photo.js"></script>
    <script src="../script/registro/formatacao-cep.js"></script>
    <script src="../script/registro/formatacao-cpf.js"></script>
    <script src="../script/registro/formatacao-celular.js"></script>
    <script src="../script/registro/formatacao-telefone-fixo.js"></script>
    <script src="../script/registro/validacao-campos-cadastro.js"></script>
    <script src="../script/registro/acessibilidade.js"></script>
    <script src="../script/registro/light-and-dark-mode.js"></script>
    <script src="../script/registro/contratante-prestador.js"></script>
</body>
</html>