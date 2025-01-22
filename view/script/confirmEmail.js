let textMessage = document.getElementById('text-message')
let confirmNumber = document.getElementById('number_confirm')
let cript = btoa(confirmNumber.value)
confirmNumber.value = cript
let confirm = document.getElementById('confirm')
let form = document.querySelector('form')
form.addEventListener('submit', (e) => {
    if (confirm.value != atob(confirmNumber.value)) {
        textMessage.textContent = "Código incorreto. Verifique no e-mail cadastrado."
        e.preventDefault()
    }
})