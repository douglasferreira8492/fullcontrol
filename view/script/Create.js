let name = document.getElementById("name");
let email = document.getElementById('email');
let password = document.getElementById('password');
let passwordConfirm = document.getElementById('password-confirm');
let button = document.getElementById('button');
let textMessage = document.getElementById('text-message');

button.addEventListener("click", (e) => {
    if (name.value == '' || email.value == '' || password.value == '' || passwordConfirm.value == '') {
        textMessage.textContent = 'Você precisa preencher todos os campos!';
        e.preventDefault()
    }
    if (password.value.length < 8) {
        textMessage.textContent = 'A senha precisa ter no mínimo 8 caracteres!';
        e.preventDefault()
    }
    if (password.value != passwordConfirm.value) {
        textMessage.textContent = 'As duas senhas não são iguais!';
        e.preventDefault()
    }
});