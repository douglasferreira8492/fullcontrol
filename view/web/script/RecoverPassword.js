
// VARIAVEIS
let form  = document.querySelector('form');
let email = document.getElementById('email');
let messageSuccess  = document.getElementById('text-message-success');
let messageDanger   = document.getElementById('text-message-danger');
let buttonConfirm   = document.getElementById('button-confirm');
let buttonLogin     = document.getElementById('button-login');
let textInsertEmail = document.getElementById('text-insert-email');

// EVENTO AO SUBMETER O FORMULÁRIO
form.addEventListener('submit',(e)=>{
    e.preventDefault();
    let resp = verify();
    if(resp)
    {
        pushEmail();
    }
});

// VERIFICA SE ESTÁ PREENCHIDO E SE É UM E-MAIL VÁLIDO
function verify()
{
    if (email.value == "" || !email.value.match(/^[^\s]+@[^\s]+\.[^\s]+$/))
    {
        messageDanger.textContent = "";
        const ul = document.createElement('ul');
        const li = document.createElement('li');
        li.textContent = "Você precisa preencher com o email cadastrado.";
        ul.appendChild(li);
        messageDanger.appendChild(ul);
        return false;
    }
    return true;
}

//  ENVIA O E-MAIL
async function pushEmail()
{
    let url = "http://localhost/fullcontrol/recoverPassword";
    let dataForm = new FormData(form);
    let data = {};
    dataForm.forEach((value,key) => {
        data[key] = value;
    });
    let options = {
        method: "POST",
        headers: {
            'Content-Type' : "application/json"
        },
        body: JSON.stringify(data)
    }
    messageDanger.textContent = "";
    messageSuccess.innerHTML = "<h4 class='mb-4'>Carregando....</h4>";
    const rawResponse = await fetch(url,options);
    const content = await rawResponse.json();

    if(content.status == 200)
    {
        messageDanger.textContent = "";
        messageSuccess.innerHTML = "<h4 class='mb-4'>Email enviado com sucesso!</h4>";
        textInsertEmail.textContent = '';
        buttonConfirm.style.display = 'none';
        buttonLogin.style.display   = 'block';
        email.style.display         = 'none';
    }
    if(content.status == 400)
    {
        messageSuccess.textContent = "";
        const ul = document.createElement('ul');
        const li = document.createElement('li');
        li.textContent = content.message;
        ul.appendChild(li);
        messageDanger.appendChild(ul);
    }
}