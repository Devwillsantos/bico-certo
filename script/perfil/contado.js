// Envia os dados para o PHP (salvar no banco)
fetch("../server/error/error.php", {
  method: "POST",
  headers: { "Content-Type": "application/json" },
  body: JSON.stringify({
    contratosConcluidos,
    contratosAndamento,
    ultimaContratacao: ultimaData ? ultimaData.toISOString() : null
  })
})
.then(response => response.text())
.then(data => console.log("Resumo salvo:", data))
.catch(err => console.error("Erro ao salvar resumo:", err));
