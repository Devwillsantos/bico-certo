// Seleção de elementos e regex
const btnRegister = document.querySelector('.botao-de-cadastrar-usuario');
const btnLimparFormulario = document.querySelector('.botao-de-limpar-formulario');
const campos = document.querySelectorAll('.required');
const spans = document.querySelectorAll('.span-required');
const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
const cpfRegex = /(\d{3})[\.\s]?(\d{3})[\.\s]?(\d{3})[-\s]?(\d{2})/gm;
const estadosBrasil = [
    "Acre", "Alagoas", "Amapá", "Amazonas", "Bahia", "Ceará", "Distrito Federal",
    "Espírito Santo", "Goiás", "Maranhão", "Mato Grosso", "Mato Grosso do Sul",
    "Minas Gerais", "Pará", "Paraíba", "Paraná", "Pernambuco", "Piauí", "Rio de Janeiro",
    "Rio Grande do Norte", "Rio Grande do Sul", "Rondônia", "Roraima", "Santa Catarina",
    "São Paulo", "Sergipe", "Tocantins"
];
let tipoUsuario = '';
let tipoPrestador = '';

// BOTÃO DE LIMPAR FORMULÁRIO
btnLimparFormulario.addEventListener('click', (event) => {
    let profilePhotoPreview = document.getElementById('profilePhotoPreview');
    profilePhotoPreview.style.display = 'none';
})

// MODAL
const form = document.getElementById('form');
const modal = document.getElementsByClassName('modal');
const modalButton = document.getElementsByClassName('modal-button');

function closeModal(event) {
    // Verifica se o clique foi fora da .modal-box
    if (event.target === event.currentTarget) {
        document.querySelector('.modal').style.display = 'none'; // Fecha o modal
    }
}

function goToLoginPage() {
    window.location.href = "../paginas/login.php";
}

// Funções de erro
function setError(index) {
    spans[index].style.display = 'block';
    spans[index].style.color = 'rgb(171, 67, 67)';
}

function removeError(index) {
    spans[index].style.display = 'none';
}

// Validações individuais
function nameValidate() {

    // Impede qualquer caractere não alfabético.
    document.getElementById("nome").addEventListener("input", function () {
        this.value = this.value.replace(/[^A-Za-zÀ-ÿ\s]/g, ""); 
    });

    campos[0].value.length < 8 || campos[0].value.length > 60 ? setError(0) : removeError(0);
}

function emailValidate() {
    emailRegex.test(campos[1].value) ? removeError(1) : setError(1);
}

function dateValidate() {
    const birthDate = new Date(campos[2].value);
    const today = new Date();
    let age = today.getFullYear() - birthDate.getFullYear();
    if (today.getMonth() < birthDate.getMonth() || (today.getMonth() === birthDate.getMonth() && today.getDate() < birthDate.getDate())) {
        age--;
    }
    age < 18 ? setError(2) : removeError(2);
}

function sexoValidate() {
    const sexo = document.getElementById('sexo').value;
    (sexo === "masculino" || sexo === "feminino") ? removeError(3) : setError(3);
}

function cpfValidate() {
    let cpf            = campos[4].value.replace(/\D/g, ''); // REMOVE CARACTERES NÃO-NÚMERICOS

    let dv1            = Number(cpf[9]); // PRIMEIRO DIGITO VERIFICADOR DIGITADO NO FORMULÁRIO
    let d_vef1         = 0;              // PRIMEIRO DÍGITO VERIFICADOR CALCULADO USANDO A LÓGICA
    let lista_dv1      = [];             // LISTA COM OS 9 PRIMEIROS DÍGITOS MULTIPLICADOS POR SEUS PESOS
    let soma_lista_dv1 = 0;              // SOMA DA MULTIPLICAÇÃO DOS 9 PRIMEIROS DÍGITOS
    let calculo_dv1    = 0;              // REALIZA A MULTIPLICAÇÃO DO DÍGITO COM O SEU PESO
    let incremento_dv1 = 10;             // SIMPLES INCREMENTO PARA REALIZAR A MULTIPLICAÇÃO DECRESCENTE DOS DÍGITOS
    
    let dv2            = Number(cpf[10]); // SEGUNDO DIGITO VERIFICADOR DIGITADO NO FORMULÁRIO
    let d_vef2         = 0;               // SEGUNDO DÍGITO VERIFICADOR CALCULADO USANDO A LÓGICA
    let lista_dv2      = [];              // LISTA COM OS 10 PRIMEIROS DÍGITOS MULTIPLICADOS POR SEUS PESOS
    let soma_lista_dv2 = 0;               // SOMA DA MULTIPLICAÇÃO DOS 10 PRIMEIROS DÍGITOS
    let calculo_dv2    = 0;               // REALIZA A MULTIPLICAÇÃO DO DÍGITOCOM O SEU PESO
    let incremento_dv2 = 11;              // SIMPLES INCREMENTO PARA REALIZAR A MULTIPLICAÇÃO DECRESCENTE DOS DÍGITOS

    // LISTA CONTENDO CPFs REPETIDOS
    let lista_cpfs_repetidos = ['00000000000', '11111111111', '22222222222','33333333333', '44444444444',
                                   '55555555555', '66666666666', '77777777777', '88888888888', '99999999999'];

    // VERIFICA SE O CPF DIGITADO SÃO APENAS NÚMEROS REPETIDOS
    function verificar_numeros_repetidos(cpf) {
        let cpf_repetido = lista_cpfs_repetidos.indexOf(cpf) != -1;
        return cpf_repetido;
    }

    // TRANSFORMA O CPF EM UMA LISTA
    cpf = cpf.split('');

    // CÁLCULOS PARA O PRIMEIRO DÍGITO VERIFICADOR
    // ITERA SOBRE OS 9 PRIMEIROS DíGITOS E RETORNA COM UMA LISTA COM CADA DÍGITO MULTIPLICADO
    for (let i = 0; i < 9; i++) {
        calculo_dv1 = cpf[i] * incremento_dv1;
        incremento_dv1 -= 1;
        lista_dv1.push(calculo_dv1);
    }

    // VERIFICA SE O NONO DÍGITO É DIFERENTE DE "NaN"
    if (!isNaN(lista_dv1.at(-1))) {
        for (let i = 0; i < lista_dv1.length; i++) {
            soma_lista_dv1 += lista_dv1[i];
        }
    }

    // CALCULA O PRIMEIRO DÍGITO VERIFICADOR
    if (soma_lista_dv1 % 11 <= 1) {
        d_vef1 = 0;
    } else {
        d_vef1 = 11 - (soma_lista_dv1 % 11);
    }

    // CÁLCULOS PARA O SEGUNDO DÍGITO VERIFICADOR
    // ITERA SOBRE OS 10 PRIMEIROS DÍGITOS E RETORNA COM UMA LISTA COM CADA DÍGITO MULTIPLICADO
    for (let i = 0; i < 10; i++) {
        calculo_dv2 = cpf[i] * incremento_dv2;
        incremento_dv2 -= 1;
        lista_dv2.push(calculo_dv2);
    }

    // VERIFICA SE O DÉCIMO DÍGITO É DIFERENTE DE "NaN"
    if (!isNaN(lista_dv2.at(-1))) {
        for (let i = 0; i < lista_dv2.length; i++) {
            soma_lista_dv2 += lista_dv2[i];
        }
    }

    // CALCULA O SEGUNDO DÍGITO VERIFICADOR
    if (soma_lista_dv2 % 11 <= 1) {
        d_vef2 = 0;
    } else {
        d_vef2 = 11 - (soma_lista_dv2 % 11);
    }

    // JUNTA TODOS OS DÍGITOS DO CPF EM UMA STRING
    cpf = cpf.join('');

    // VERIFICA SE OS DÍGITOS VERIFICADORES DIGITADOS COINCIDEM COM OS DÍGITOS CALCULADOS E SE O CPF DIGITADO NÃO SÃO APENAS NÚMEROS REPETIDOS
    if ((dv1 === d_vef1 && dv2 === d_vef2) && !(verificar_numeros_repetidos(cpf))) {
        removeError(4);
    } else {
        setError(4);
    }

}

function celValidate() {
    const input = document.getElementById('celular');
    let numeros = input.value.replace(/\D/g, ''); // só números

    // Se o usuário começar sem o +55, já forçamos no início
    if (!numeros.startsWith("55")) {
        numeros = "55" + numeros;
    }

    // Verifica se tem exatamente 13 dígitos (55 + DDD + número com 9 dígitos)
    if (numeros.length === 13) {
        const ddd = numeros.substring(2, 4);
        const numero = numeros.substring(4);

        // Formata: (+55)XX-XXXXXXXXXX
        input.value = `(+55)${ddd}-${numero}`;
        removeError(5);
    } else {
        setError(5);
    }
}

function cepValidate() {
    const cep = campos[6].value.replace(/\D/g, '');
    cep.length >= 8 ? removeError(6) : setError(6);
}

function ruaValidate() {
    campos[7].value.length < 3 ? setError(7) : removeError(7);
}

function estadoValidate() {
    estadosBrasil.includes(campos[8].value.trim()) ? removeError(8) : setError(8);
}

function cidadeValidate() {
    campos[9].value.length < 3 ? setError(9) : removeError(9);
}

function numeroValidate() {
    campos[10].value < 0 ? setError(10) : removeError(10);
}

function bairroValidate() {
    campos[11].value.length < 3 ? setError(11) : removeError(11);
}

function loginValidate() {

    // Impede qualquer caractere não alfabético (sem espaços).
    document.getElementById("login").addEventListener("input", function () {
        this.value = this.value.replace(/[^A-Za-zÀ-ÿ]/g, ""); 
    });

    campos[13].value.length < 6 ? setError(12) : removeError(12);
}

function senhaValidate() {

    // Impede qualquer caractere não alfabético (sem espaços).
    campos[14].addEventListener("input", function () {
        this.value = this.value.replace(/[^A-Za-zÀ-ÿ]/g, ""); 
    });

    campos[14].value.length < 8 ? setError(13) : removeError(13);
}

function confirmarSenhaValidate() {

    // Impede qualquer caractere não alfabético (sem espaços).
    campos[15].addEventListener("input", function () {
        this.value = this.value.replace(/[^A-Za-zÀ-ÿ]/g, ""); 
    });

    campos[15].value !== campos[14].value ? setError(14) : removeError(14);
}

function userRoleValidate() {

    if (!campos[16].checked && !campos[17].checked) {
        setError(15);
    } else {
        removeError(15);
    }

}

function userPrestadorRoleValidate() {
    
    if (campos[17].checked && campos[18].value === '') {
        setError(16);
    } else {
        removeError(16);
    }

}

function profilePhoto() {
    let profilePhotoPreview = document.getElementById('profilePhotoPreview');

    if (input.files.length === 0) {
        setError(17);
        profilePhotoPreview.style.display = 'none';
    } else {
        removeError(17);
        profilePhotoPreview.style.width = '200px';
    }
}

// Evento de submit do formulário
btnRegister.addEventListener('click', (event) => {
    // Execução de validações
    nameValidate();
    emailValidate();
    dateValidate();
    sexoValidate();
    cpfValidate();
    celValidate();
    cepValidate();
    ruaValidate();
    estadoValidate();
    cidadeValidate();
    numeroValidate();
    bairroValidate();
    loginValidate();
    senhaValidate();
    confirmarSenhaValidate();
    userRoleValidate();
    userPrestadorRoleValidate();
    profilePhoto();

    const temErro = Array.from(spans).some(span => span.style.display === 'block');

    if (temErro) {
        event.preventDefault();
        return;
    }
});