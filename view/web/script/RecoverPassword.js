
let form            = document.querySelector('form');
let email           = document.getElementById('email');
let messageSuccess  = document.getElementById('text-message-success');
let messageDanger   = document.getElementById('text-message-danger');
let buttonConfirm   = document.getElementById('button-confirm');
let buttonLogin     = document.getElementById('button-login');
let textInsertEmail = document.getElementById('text-insert-email');

form.addEventListener('submit',(e)=>{
    e.preventDefault();
    let resp = verify();
    if(resp)
    {
        pushEmail();
    }
});

function verify()
{
    if(email == '')
    {
        messageDanger.textContent = "Você precisa preencher com o email cadastrado.";
        return false;
    }
    return true;
}
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

    const rawResponse = await fetch(url,options);
    const content = await rawResponse.json();

    if(content.status == 200)
    {
        messageSuccess.textContent  = "Email enviado com sucesso!";
        messageDanger.textContent   = "";
        textInsertEmail.textContent = '';
        buttonConfirm.style.display = 'none';
        buttonLogin.style.display   = 'block';
        email.style.display         = 'none';
    }
    if(content.status == 400)
    {
        messageDanger.textContent = content.message;
    }
}