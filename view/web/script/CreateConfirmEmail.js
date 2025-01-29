
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
    let verifyReturn = verifyCode(confirmCode,confirmNumber);
    if(verifyReturn)
    {
        insert(form);
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

async function insert(form) {
    // Cria um objeto FormData a partir do formulário
    let formData = new FormData(form);
    // Cria um objeto para armazenar os dados como um objeto JSON
    let data = {};
    // Preenche o objeto 'data' com os valores do FormData
    formData.forEach((value, key) => {
        data[key] = value;
    });
    // Opções para a requisição fetch
    const options = {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'  // Indica que estamos enviando JSON
        },
        body: JSON.stringify(data)  // Transforma o objeto 'data' em uma string JSON
    };
    let url = "http://localhost/fullcontrol/criar";  // URL do seu endpoint PHP
    try {
        const rawResponse = await fetch(url, options);
        const content = await rawResponse.json();

        // Aqui você pode lidar com a resposta do servidor
        // console.log(content);
        if (content.status === 200) {
            textMessageSuccess.textContent = content.message;
            confirmCode.setAttribute('type', 'hidden');
            buttonConfirm.style.display = "none";
            buttonLogin.style.display = "block";
        }else if (content.status === 400) {
            textMessageSuccess.textContent = content.message;
        }
    } catch (error) {
        console.error('Erro na requisição:', error);
        alert('Ocorreu um erro na requisição!');
        return false;
    }
}