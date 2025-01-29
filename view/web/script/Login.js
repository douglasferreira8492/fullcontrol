
let form           = document.querySelector('form');
let messageDanger  = document.getElementById('text-message-danger');
let messageSuccess = document.getElementById('text-message-success');
let email          = document.getElementById('email');
let password       = document.getElementById('password');

form.addEventListener('submit',(e)=>{
    e.preventDefault();
    let returnVerify = verify();
    if(returnVerify)
    {
        login();
    }
});

function verify()
{
    if(email.value == '' || password.value == '')
    {
        messageDanger.textContent = 'Preencha todos os campos.';
        return false;
    }
    return true;
}

async function login()
{
    let url = 'http://localhost/fullcontrol/';
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
        if(content.status == 200)
        {
            window.location.href = 'http://localhost/fullcontrol/admin/dashboard';
        } else if (content.status == 400){
            messageDanger.textContent = content.message;
        }   
    } catch (error) {
        console.log('Ocorreu um erro na requisição', error);
        alert('Ocorreu um erro na requisição');
        return false;
    }
}