document.addEventListener('DOMContentLoaded', () => {
    // The page's save button already calls saveInformations() inline.
});

async function saveInformations() {
    const message = document.querySelector('.information-saved');
    const btn = document.querySelector('.botoes .botao-salvar');
    if (btn) btn.disabled = true;

    const container = document.getElementById('formPerfil');
    if (!container) return;

    const fd = new FormData();
    // files
    const fotoPerfil = document.getElementById('fotoPerfil');
    const fotoCapa = document.getElementById('fotoCapa');
    if (fotoPerfil && fotoPerfil.files.length) fd.append('fotoPerfil', fotoPerfil.files[0]);
    if (fotoCapa && fotoCapa.files.length) fd.append('fotoCapa', fotoCapa.files[0]);

    // fields (match IDs/names in the page)
    const nome = document.getElementById('nome');
    if (nome) fd.append('nome', nome.value);
    const email = document.getElementById('email');
    if (email) fd.append('email', email.value);
    const senha = document.getElementById('senha');
    if (senha) fd.append('senha', senha.value);
    const celular = document.getElementById('celular');
    if (celular) fd.append('celular', celular.value);
    const endereco = document.getElementById('endereco');
    if (endereco) fd.append('estado', endereco.value);
    const prestador = document.getElementById('prestador-opcoes');
    if (prestador) fd.append('servico', prestador.value);
    const whatsapp = document.getElementById('whatsapp');
    if (whatsapp) fd.append('whatsapp', whatsapp.value);
    const descricao = document.querySelector('textarea[name="bio"]');
    if (descricao) fd.append('descricao', descricao.value);

    try {
        const resp = await fetch('../server/perfil/atualizar_perfil.php', {
            method: 'POST',
            body: fd,
            credentials: 'same-origin'
        });
        const data = await resp.json();
        if (data.sucesso) {
            if (message) {
                message.style.display = 'block';
            }

            // Atualiza banner (capa) se o servidor retornou o novo caminho
            if (data.usuario && data.usuario.foto_capa) {
                const bannerImg = document.querySelector('.banner img') || document.querySelector('.caixa .foto-perfil');
                if (bannerImg) {
                    // caminho salvo no DB é algo como 'uploads/capas/...' - tornar relativo para a página
                    const path = (data.usuario.foto_capa.indexOf('uploads/') === 0) ? ('../' + data.usuario.foto_capa) : ('../uploads/capas/' + data.usuario.foto_capa);
                    bannerImg.src = path + '?t=' + Date.now();
                }
            }

            // Atualiza foto de perfil se retornada
            if (data.usuario && data.usuario.fotoPerfil) {
                const profileImgs = document.querySelectorAll('img');
                const newPath = (data.usuario.fotoPerfil.indexOf('uploads/') === 0) ? ('../' + data.usuario.fotoPerfil) : ('../uploads/perfis/' + data.usuario.fotoPerfil);
                // atualiza o avatar no topo e a img do formulário, se existirem
                const topo = document.querySelector('.top-bar .logo:last-child img');
                if (topo) topo.src = newPath + '?t=' + Date.now();
                const formImg = document.getElementById('imagemPerfil');
                if (formImg) formImg.src = newPath + '?t=' + Date.now();
            }

            // Atualiza o nome exibido no próprio perfil (se o elemento existir na página)
            if (data.usuario && data.usuario.nome) {
                const profileName = document.getElementById('profile-name');
                if (profileName) profileName.textContent = data.usuario.nome;
            }

            // Garantir que o cabeçalho mostre o login da conta (não o nome editável)
            if (data.usuario && data.usuario.login) {
                const headerLogin = document.getElementById('username');
                if (headerLogin) headerLogin.textContent = data.usuario.login;
            }

            // esconder mensagem depois de 2s
            setTimeout(() => {
                if (message) message.style.display = 'none';
            }, 2000);

        } else {
            const err = data.erro || 'Erro ao salvar.';
            alert(err);
        }
    } catch (err) {
        console.error(err);
        alert('Erro de comunicação com o servidor.');
    } finally {
        if (btn) btn.disabled = false;
    }
}