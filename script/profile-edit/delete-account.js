const deletingMsg = document.querySelector('.deleting-message');
const confirmDeletingAccount = document.querySelector('.confirm-deleting-account');

async function deleteAccount() {
    if (deletingMsg) deletingMsg.style.display = 'block';

    try {
        const resp = await fetch('../server/perfil/deletar_conta.php', { method: 'POST', credentials: 'same-origin' });
        const data = await resp.json();
        if (data.sucesso) {
            // limpar localStorage e redirecionar para página inicial ou login
            localStorage.removeItem('userEmail');
            localStorage.removeItem('userPassword');
            localStorage.removeItem('userRole');
            // pequena pausa para o usuário ver a mensagem, depois redireciona ao login
            setTimeout(() => {
                // redireciona para a página de login (mesma pasta 'paginas')
                window.location.href = 'login.php';
            }, 800);
        } else {
            // se não autenticado, redireciona para login sem alert
            const msg = (data && data.mensagem) ? data.mensagem.toLowerCase() : '';
            if (msg.includes('autentic') || msg.includes('não autenticado') || msg.includes('nao autenticado')) {
                window.location.href = 'login.php';
                return;
            }
            // outros erros: mostrar mensagem simples (não-blocking)
            if (deletingMsg) deletingMsg.style.display = 'none';
            // opcional: mostrar um pequeno toast em vez de alert — por enquanto usamos alert
            alert(data.mensagem || 'Erro ao excluir a conta.');
        }
    } catch (err) {
        console.error(err);
        alert('Erro de comunicação com o servidor ao excluir a conta.');
        if (deletingMsg) deletingMsg.style.display = 'none';
    }
}

function confirmDeleteAccount() {
    if (confirmDeletingAccount) confirmDeletingAccount.style.display = 'flex';
}

function doNotDeleteAccount() {
    if (confirmDeletingAccount) confirmDeletingAccount.style.display = 'none';
}