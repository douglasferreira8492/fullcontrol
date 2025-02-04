
let cnpjObj = document.querySelector('.mask-cp');
let phoneObj = document.querySelector('.phone');
let cepObj = document.querySelector('.mask-cep');

cnpjObj.addEventListener('keyup',(e)=>{
    formatCNPJ(cnpjObj);
});

cepObj.addEventListener('keyup', (e) => {
    formatCEP(cepObj);
});

phoneObj.addEventListener("keyup",(e) => {
    formatPhone(phoneObj)
})

function formatCNPJ(obj)
{
    let cnpj = obj.value
    cnpj = cnpj.substring(0, 18)
    cnpj = cnpj.replace(/\D/g, "");
    cnpj = cnpj.replace(/(\d{2})(\d)/, "$1.$2");
    cnpj = cnpj.replace(/(\d{3})(\d)/, "$1.$2");
    cnpj = cnpj.replace(/(\d{3})(\d)/, "$1/$2");
    cnpj = cnpj.replace(/(\d{4})(\d)/, "$1-$2");
    obj.value = cnpj
}

function formatPhone(obj)
{
    phoneValue = obj.value
    phoneValue = phoneValue.substring(0, 15)
    phoneValue = phoneValue.replace(/\D/g, "");
    phoneValue = phoneValue.replace(/^(\d{2})(\d)/g, "($1) $2");
    phoneValue = phoneValue.replace(/(\d)(\d{4})$/, "$1-$2");
    obj.value = phoneValue
}

function formatCEP(obj) {
    cep = obj.value;
    cep = cep.substring(0, 9)
    cep = cep.replace(/\D/g, '');
    cep = cep.replace(/^(\d{5})(\d{3})$/, '$1-$2');
    obj.value = cep;
}

function removeMascaraCNPJ(cnpj) {
    // Substitui qualquer caractere que não seja número por uma string vazia
    return cnpj.replace(/\D/g, '');
}

function converterData(data) {
    const partes = data.split('/'); // Divide a data em partes usando o '/'
    const dia = partes[0];
    const mes = partes[1];
    const ano = partes[2];
    // Retorna no formato YYYY-mm-dd
    return `${ano}-${mes}-${dia}`;
}
