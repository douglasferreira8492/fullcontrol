
let name_ = document.getElementById("name");
let email = document.getElementById('email');
let password = document.getElementById('password');
let passwordConfirm = document.getElementById('passwordConfirm');
let form = document.querySelector('form');
let textMessage = document.getElementById('text-message');

form.addEventListener('submit',(e) =>{
    e.preventDefault();
    returnVerify = verify(form)
    if(returnVerify)
    {
        getEmail(form)
    }
    
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

    console.log(content)
    if(content == null)
    {
        textMessage.textContent = "Carregando...";
        form.submit()
        
    }else if(content.length > 0){
        textMessage.textContent = "E-mail ja cadastrado. Utilize outro e-mail.";
        return
    }
}

function verify(formParams)
{
    if(formParams.name.value == ""
        || formParams.email.value == ""
        || formParams.password.value == ""
        || formParams.passwordConfirm.value == ""
    )
    {
        textMessage.textContent = "Preencha todos os campos.";
        return false;
    }
    if (formParams.password.value.length < 8 ){
        textMessage.textContent = "A senha precisa ter no mínimo 8 caracteres.";
        return false;
    }
    if (formParams.password.value != formParams.passwordConfirm.value)
    {
        textMessage.textContent = "As senhas são diferentes.";
        return false;
    }
    return true;
}

