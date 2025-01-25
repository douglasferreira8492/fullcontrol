
let textMessage = document.getElementById('text-message');
let textMessageSuccess = document.getElementById('text-message-success');
let confirmNumber = document.getElementById('number_confirm');
let hashNumber = btoa(confirmNumber.value);
confirmNumber.value = hashNumber;
let form = document.querySelector('form');
let confirmCode = document.getElementById('confirm');
let buttonConfirm = document.getElementById('button-confirm');
let buttonLogin   = document.getElementById('button-login');

form.addEventListener('submit', (e) => {
    
    e.preventDefault();
    
    let data = new FormData(form);
    let verifyReturn = verifyCode(confirmCode,confirmNumber);
    
    if(verifyReturn)
    {
        let result = insert(data);
        console.log(result)
        if(result)
        {
            textMessageSuccess.textContent = "Usuário cadastrado com sucesso. Faça o login e continue.";
            confirmCode.setAttribute('type','hidden');
            buttonConfirm.style.display = "none";
            buttonLogin.style.display = "block";
        }
    }
    
})

function verifyCode(confirmCode,confirmNumber)
{
    if (confirmCode.value == atob(confirmNumber.value))
    {
        return true;
    }else{
        textMessage.textContent = "Código incorreto. Verifique no e-mail cadastrado.";
        return false;
    }
}

async function insert(data)
{

    let url = "http://localhost/fullcontrol/criar";
    const rawResponse = await fetch(url, {
            method: "POST",
            body: data
    });
    let content =  await rawResponse.json();
    return content;
}