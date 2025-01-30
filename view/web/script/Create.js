
// VARIAVEIS
let name_ = document.getElementById("name");
let email = document.getElementById('email');
let password = document.getElementById('password');
let passwordConfirm = document.getElementById('passwordConfirm');
let form = document.querySelector('form');
let textMessageDanger = document.getElementById('text-message-danger');
let textMessageSuccess = document.getElementById('text-message-success');

// EVENTO AO CLICAR
form.addEventListener('submit',(e) =>{
    e.preventDefault();
    let returnVerify = verify(form)
    if(returnVerify)
    {
        insert(form);
    }
});

// FUNÇÃO QUE ENVIA OS DADOS
async function insert()
{
    let url = "http://localhost/fullcontrol/procura/email";
    let data = new FormData(form)
    const rawResponse = await fetch(url, {
        method: 'POST',
        body: data
    });
    const content = await rawResponse.json();
    if(content == null)
    {
        textMessageDanger.textContent  = ""
        textMessageSuccess.textContent = "Carregando...";
        form.submit();
        
    }else if(content.length > 0)
    {
        textMessageDanger.textContent = "";
        const ul = document.createElement('ul');
        const li = document.createElement('li');
        ul.appendChild(li);
        li.textContent = "E-mail ja cadastrado. Utilize outro e-mail.";
        textMessageDanger.appendChild(ul);
        return false;
    }
}

// VERIFICA A COMPLEXIDADE DA SENHA E SE FORMULARIO ESTÁ PREENCHIDO
function verify(formParams)
{
    let verifyStatus = [];

    if(formParams.name.value == ""
        || formParams.email.value == ""
        || formParams.password.value == ""
        || formParams.passwordConfirm.value == ""
    )
    {
        verifyStatus.push('Preencha todos os campos');
    }
    if (formParams.password.value.length < 8 || formParams.password.value.length > 15){
        verifyStatus.push("Crie uma senha entre 8 e 15 digitos");
    }
    if (!formParams.password.value.match(/[a-z]/g))
    {
        verifyStatus.push("Precisa ter letras minusculas");
    }
    if (!formParams.password.value.match(/[A-Z]/g)) {
        verifyStatus.push("Precisa ter letras maiúsculas");
    }
    if (!password.value.match(/[0-9]/g)) {
        verifyStatus.push("Precisa ter números");
    }
    if (!formParams.password.value.match(/[\W/!@#$%&*]/g)) {
        verifyStatus.push("Precisa ter caracteres especiais");
    }
    if (formParams.password.value != formParams.passwordConfirm.value)
    {
        verifyStatus.push("As senhas não são iguais");
    }
    if (!formParams.email.value.match(/^[^\s]+@[^\s]+\.[^\s]+$/))
    {
        verifyStatus.push("Insira um e-mail válido");
    }
    if(verifyStatus.length > 0)
    {
        textMessageDanger.textContent = "";
        let ul = document.createElement('ul');
        verifyStatus.forEach((value,key)=>
        {
            const li = document.createElement('li');
            li.textContent = value;
            ul.appendChild(li);
        });
        textMessageDanger.appendChild(ul);
        return false;
    }else{
        return true;
    }
}

