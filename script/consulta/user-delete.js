document.addEventListener("DOMContentLoaded", () => {
    document.querySelectorAll(".delete-btn").forEach(btn => {
        btn.addEventListener("click", () => {
            const userId = btn.getAttribute("data-id");

            if (!confirm(`Excluir usuário ${userId}?`)) return;

            fetch("../server/delete-user.php", {
                method: "POST",
                headers: {"Content-Type": "application/x-www-form-urlencoded"},
                body: `id=${userId}`
            })
            .then(res => res.text())
            .then(msg => {
                // Sem alert
                const row = document.querySelector(`tr[data-id="${userId}"]`);
                if (row) row.remove();
            })
            .catch(err => console.error("Erro:", err));
        });
    });
});
