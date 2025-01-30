// VARIAVEIS
let password = document.getElementById('password');
let passwordConfirm = document.getElementById('password-confirm');
let form = document.querySelector('form');
let textMessageDanger = document.getElementById('text-message-danger');
let textMessageSuccess = document.getElementById('text-message-success');
let buttonLogin = document.getElementById('button-login');
let buttonConfirm = document.getElementById('button-confirm');

// EVENTO AO SUBMETER FORMULARIO
form.addEventListener('submit',(e)=>{
    e.preventDefault();
    let returnVerify = verify();
    if (returnVerify) {
        insert(form);
    }
});

// FUNÇÃO QUE ENVIA OS DADOS
async function insert() {
    let url = "http://localhost/fullcontrol/resetPassword";
    let dataForm = new FormData(form);
    let data = {};
    dataForm.forEach((value, key) => {
        data[key] = value
    });
    let options = {
        method: "POST",
        headers: {
            "Content-Type": "application/json"
        },
        body: JSON.stringify(data)
    }
    try {
        const rawResponse = await fetch(url, options);
        const content = await rawResponse.json();
        if (content.status == 200)
        {
            textMessageDanger.textContent = "";
            textMessageSuccess.innerHTML = "<h4 class='mb-4'>Senha atualizada com sucesso!</h4>";
            password.style.display = 'none';
            passwordConfirm.style.display = 'none';
            buttonConfirm.style.display = 'none';
            buttonLogin.style.display = 'block';
        } else if (content.status == 400) {
            textMessageDanger.textContent = "";
            const ul = document.createElement('ul');
            const li = document.createElement('li');
            li.textContent = content.message;
            ul.appendChild(li);
            textMessageDanger.appendChild(ul);
        }
    } catch (error) {
        console.log('Ocorreu um erro na requisição', error);
        alert('Ocorreu um erro na requisição');
        return false;
    }
}

// VERIFICA A COMPLEXIDADE DA SENHA E SE FORMULARIO ESTÁ PREENCHIDO
function verify() {
    let verifyStatus = [];

    if( password.value == "" || passwordConfirm.value == "") {
        verifyStatus.push('Preencha todos os campos');
    }
    if (password.value.length < 8 || password.value.length > 15) {
        verifyStatus.push("Crie uma senha entre 8 e 15 digitos");
    }
    if (!password.value.match(/[a-z]/g)) {
        verifyStatus.push("Precisa ter letras minusculas");
    }
    if (!password.value.match(/[A-Z]/g)) {
        verifyStatus.push("Precisa ter letras maiúsculas");
    }
    if (!password.value.match(/[0-9]/g)) {
        verifyStatus.push("Precisa ter números");
    }
    if (!password.value.match(/[\W/!@#$%&*]/g)) {
        verifyStatus.push("Precisa ter caracteres especiais");
    }
    if (password.value != passwordConfirm.value) {
        verifyStatus.push("As senhas não são iguais");
    }
    if (verifyStatus.length > 0) {
        textMessageDanger.textContent = "";
        let ul = document.createElement('ul');
        verifyStatus.forEach((value, key) => {
            const li = document.createElement('li');
            li.textContent = value;
            ul.appendChild(li);
        });
        textMessageDanger.appendChild(ul);
        return false;
    } else {
        return true;
    }
}