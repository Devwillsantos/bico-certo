console.log("JS carregado");

let userIdToDelete = null;

// Modal de exclusão
document.addEventListener("click", function (e) {
  // Abrir modal de confirmação
  if (e.target.classList.contains("delete-btn")) {
    userIdToDelete = parseInt(e.target.dataset.id);
    document.getElementById("deleteModal").classList.remove("hidden");
  }

  // Cancelar exclusão
  if (e.target.id === "cancelDelete") {
    document.getElementById("deleteModal").classList.add("hidden");
    userIdToDelete = null;
  }

  // Confirmar exclusão
  if (e.target.id === "confirmDelete") {
    fetch("excluirUsuario.php", {
      method: "POST",
      body: new URLSearchParams({ id: userIdToDelete })
    })
    
    .then(res => res.text())
    .then(response => {
      console.log(response); // debug no console

      // Fecha modal de confirmação
      document.getElementById("deleteModal").classList.add("hidden");

      // Se o PHP retornou sucesso
      if (response.includes("sucesso")) {
        // Remove a linha da tabela sem recarregar
        const row = document.querySelector(`tr[data-id="${userIdToDelete}"]`);
        if (row) {
          row.remove();
        }

        // Mostra modal de sucesso
        document.getElementById("successDeleteModal").classList.remove("hidden");
      } else {
        alert("Erro ao excluir usuário: " + response);
      }

      // Reseta variável
      userIdToDelete = null;
    })
    .catch(error => {
      console.error("Erro na requisição:", error);
      alert("Erro na exclusão. Verifique o servidor.");
    });
  }
});

// Fechar modal de sucesso
document.getElementById("closeDeleteModal").addEventListener("click", () => {
  document.getElementById("successDeleteModal").classList.add("hidden");
});