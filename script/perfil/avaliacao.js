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
    modal.setAttribute("aria-hidden", "false");
  });

  // 🔹 Fechar modal
  fecharModal.addEventListener("click", () => {
    modal.style.display = "none";
    modal.setAttribute("aria-hidden", "true");
  });

  // 🔹 Fechar ao clicar fora
  modal.addEventListener("click", (e) => {
    if (e.target === modal) {
      modal.style.display = "none";
      modal.setAttribute("aria-hidden", "true");
    }
  });

  // 🔹 Envio do formulário
  form.addEventListener("submit", (e) => {
    e.preventDefault();

    const comentario = form.comentario.value.trim();
    if (!comentario) return alert("Por favor, escreva algo antes de enviar.");

    // 🔹 Remove a mensagem "Sem avaliações ainda"
    if (semAvaliacoes) semAvaliacoes.remove();

    // 🔹 Avatar do usuário
    const avatarDefault = container.dataset.avatar || "../imagens/servicos/perfil_6.jpg";

    // 🔹 Cria elemento
    const novo = document.createElement("div");
    novo.classList.add("activity");

    // 🔹 Data formatada
    const dataAgora = new Date().toLocaleDateString("pt-BR", {
      day: "2-digit",
      month: "long",
      year: "numeric"
    });

    // 🔹 Monta o HTML do novo comentário
    novo.innerHTML = `
      <img class="perfil" src="${avatarDefault}" alt="Avatar"
           onerror="this.onerror=null;this.src='../imagens/servicos/perfil_6.jpg'">
      <div class="activity-content">
        <p><strong>Você</strong> comentou no seu Perfil.</p>
        <p>${comentario}</p>
        <div class="activity-interactions">
          <img src="../imagens/icones/relogio.png" alt="Hora">
          <span>${dataAgora}</span>
        </div>
      </div>
    `;

    // 🔹 Adiciona o novo comentário no topo
    container.prepend(novo);

    // 🔹 Limpa o formulário e fecha o modal
    form.reset();
    modal.style.display = "none";
    modal.setAttribute("aria-hidden", "true");
  });
});
