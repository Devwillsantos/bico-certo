document.addEventListener("DOMContentLoaded", () => {

    const modal = document.getElementById("modalAvaliacao");
    const abrirModal = document.getElementById("abrirModal");
    const fecharModal = document.getElementById("fecharModal");
    const form = document.getElementById("formAvaliacao");
    const container = document.getElementById("reclamacoesContainer");
    const semAvaliacoes = document.getElementById("semAvaliacoes");

    // 🔹 Abrir modal
    abrirModal.addEventListener("click", () => {
        modal.style.display = "flex";
    });

    // 🔹 Fechar modal
    fecharModal.addEventListener("click", () => {
        modal.style.display = "none";
    });

    modal.addEventListener("click", (e) => {
        if (e.target === modal) modal.style.display = "none";
    });

    //  **ENVIO DO FORMULÁRIO**
    form.addEventListener("submit", async (e) => {
        e.preventDefault();

        const comentario = form.comentario.value.trim();
        if (!comentario) return alert("Por favor, escreva algo antes de enviar.");

        const fd = new FormData(form);
        const url = "../server/perfil/comentarios.php";

        try {
            const res = await fetch(url, {
                method: "POST",
                body: fd
            });

            const json = await res.json();

            if (!json.sucesso) {
                alert(json.erro || "Erro ao enviar comentário.");
                return;
            }

            // 🔥 Adiciona o comentário retornado PELO PHP
            addComentarioNaLista(json.comentario);

            form.reset();
            modal.style.display = "none";

        } catch (err) {
            console.error(err);
            alert("Erro de rede.");
        }
    });

    carregarComentarios();
});


// 🔧 **Adicionar comentário na página**
function addComentarioNaLista(c) {
    const container = document.getElementById("reclamacoesContainer");

    const div = document.createElement("div");
    div.className = "activity";

    div.innerHTML = `
            ${/* build profile link depending on tipo_usuario */''}
            ${(() => {
                const tipo = c.tipo_usuario || '';
                const link = tipo === 'prestador' ? `./perfil.php?id=${c.id_usuario}` : `./perfil%20contratante.php?id=${c.id_usuario}`;
                return `<a href="${link}"><img class="perfil" src="${c.foto_usuario ? '../' + c.foto_usuario : '../imagens/servicos/perfil_6.jpg'}" onerror="this.onerror=null;this.src='../imagens/servicos/perfil_6.jpg'"></a>`;
            })()}
            <div class="activity-content">
                <p><strong>${(() => {
                    const tipo = c.tipo_usuario || '';
                    const link = tipo === 'prestador' ? `./perfil.php?id=${c.id_usuario}` : `./perfil%20contratante.php?id=${c.id_usuario}`;
                    return `<a href="${link}">${escapeHtml(c.nome)}</a>`;
                })()}</strong> comentou no seu Perfil.</p>
                <p>${escapeHtml(c.comentario)}</p>
                <div class="activity-interactions">
                    <i class="fas fa-clock icon-relogio" aria-hidden="true"></i>
                    <span>${c.data_comentario}</span>
                </div>
            </div>
    `;

    container.prepend(div);
}


//  HTML safe
function escapeHtml(s) {
    return String(s)
        .replaceAll("&", "&amp;")
        .replaceAll("<", "&lt;")
        .replaceAll(">", "&gt;")
        .replaceAll('"', "&quot;")
        .replaceAll("'", "&#39;");
}


//  **CARREGAR COMENTÁRIOS DO BANCO**
function carregarComentarios() {

    const id_usuario = document.getElementById("id_usuario").value;
    const url = "../server/perfil/listar_comentarios.php";

    const fd = new FormData();
    fd.append("id_usuario", id_usuario);

    fetch(url, {
        method: "POST",
        body: fd
    })
        .then(res => res.json())
        .then(dados => {

            const area = document.getElementById("reclamacoesContainer");
            area.innerHTML = "";

            if (!dados.sucesso || dados.comentarios.length === 0) {
                area.innerHTML = "<p id='semAvaliacoes'>Nenhum comentário ainda.</p>";
                return;
            }

            dados.comentarios.forEach(c => addComentarioNaLista(c));
        });
}
