
let name_ = document.getElementById("name");
let email = document.getElementById('email');
let password = document.getElementById('password');
let passwordConfirm = document.getElementById('password-confirm');
let form = document.querySelector('form');
let textMessage = document.getElementById('text-message');

form.addEventListener('submit',(e) =>{
    
    if (name_.value == "" || email.value == "" || password.value == "" || passwordConfirm.value == ""){
        textMessage.textContent = "Preencha todos os campos.";
        e.preventDefault();
        return
    }
    if(password.value.length < 8 ){
        textMessage.textContent = "A senha precisa ter no mínimo 8 caracteres.";
        e.preventDefault();
        return
    }
    if(password.value != passwordConfirm.value)
    {
        textMessage.textContent = "As senhas são diferentes.";
        e.preventDefault();
        return
    }
    e.preventDefault()
    getEmail(form)
});

async function getEmail(form)
{
    let url = "http://localhost/fullcontrol/procura/email";
    let data = new FormData(form)
    const rawResponse = await fetch(url, {
        method: 'POST',
        body: data
    });
    const content = await rawResponse.json();
    if(content != null)
    {
        textMessage.textContent = "E-mail ja cadastrado";
        return
    }else{
        form.submit()
    }
}

