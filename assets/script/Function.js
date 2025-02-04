
let cnpjObj = document.querySelector('.mask-cp');
let phoneObj = document.querySelector('.phone');
let cepObj = document.querySelector('.mask-cep');

cnpjObj.addEventListener('keyup',(e)=>{
    let returnCNPJ = formatCNPJ(cnpjObj);
    cnpjObj.value = returnCNPJ;
});

cepObj.addEventListener('keyup', (e) =>{
    let returnCEP = formatCEP(cepObj);
    cepObj.value = returnCEP;
});

phoneObj.addEventListener("keyup",(e) => {
    let returnPhone = formatPhone(phoneObj);
    phoneObj.value = returnPhone;
})

function formatCNPJ(obj)
{
    let cnpj;
    if(typeof(obj) == 'object')
    {
        cnpj = obj.value
    }else{
        cnpj = obj;
    }
    cnpj = cnpj.substring(0, 18)
    cnpj = cnpj.replace(/\D/g, "");
    cnpj = cnpj.replace(/(\d{2})(\d)/, "$1.$2");
    cnpj = cnpj.replace(/(\d{3})(\d)/, "$1.$2");
    cnpj = cnpj.replace(/(\d{3})(\d)/, "$1/$2");
    cnpj = cnpj.replace(/(\d{4})(\d)/, "$1-$2");
    return cnpj;
}

function formatPhone(obj)
{
    let phoneValue;
    if(typeof(obj) == 'object')
    {
        phoneValue = obj.value
    } else {
        phoneValue = obj;
    }
    phoneValue = phoneValue.substring(0, 15)
    phoneValue = phoneValue.replace(/\D/g, "");
    phoneValue = phoneValue.replace(/^(\d{2})(\d)/g, "($1) $2");
    phoneValue = phoneValue.replace(/(\d)(\d{4})$/, "$1-$2");
    return phoneValue
}

function formatCEP(obj)
{
    let cep = obj;
    if (typeof(obj) == 'object') {
        cep = obj.value
    } else {
        cep = obj;
    }
    cep = cep.substring(0, 9)
    cep = cep.replace(/\D/g, '');
    cep = cep.replace(/^(\d{5})(\d{3})$/, '$1-$2');
    return cep;
}

function removeMascaraCNPJ(cnpj)
{
    // Substitui qualquer caractere que não seja número por uma string vazia
    return cnpj.replace(/\D/g, '');
}

function converterData(data)
{
    const partes = data.split('/'); // Divide a data em partes usando o '/'
    const dia = partes[0];
    const mes = partes[1];
    const ano = partes[2];
    // Retorna no formato YYYY-mm-dd
    return `${ano}-${mes}-${dia}`;
}
