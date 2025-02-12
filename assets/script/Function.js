const ROOT = 'http://localhost/fullcontrol/';
const TRADUCAO = base_url('assets/script/datatable-portugues.json');
function base_url(uri = null)
{
    if(uri)
    {
        return ROOT + uri;
    }
    return ROOT;
}
let cnpjObj = document.querySelector('.mask-cp');
let cpfObj = document.querySelector('.mask-cpf');
let phoneObj = document.querySelector('.phone');
let cepObj = document.querySelector('.mask-cep');

cnpjObj.addEventListener('keyup',(e)=>{
    let returnCNPJ = formatCNPJ(cnpjObj);
    cnpjObj.value = returnCNPJ;
});

cpfObj.addEventListener('keyup', (e) => {
    let cpfReturn = formatCPF(cpfObj);
    cpfObj.value = cpfReturn;
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
    cnpj = cnpj.substring(0, 18);
    cnpj = cnpj.replace(/\D/g, "");
    cnpj = cnpj.replace(/(\d{2})(\d)/, "$1.$2");
    cnpj = cnpj.replace(/(\d{3})(\d)/, "$1.$2");
    cnpj = cnpj.replace(/(\d{3})(\d)/, "$1/$2");
    cnpj = cnpj.replace(/(\d{4})(\d)/, "$1-$2");
    return cnpj;
}

function formatCPF(obj)
{
    let returnCPF;
    if (typeof (obj) == 'object') {
        returnCPF = obj.value
    } else {
        returnCPF = obj;
    }
    returnCPF = returnCPF.substring(0, 14);
    returnCPF = returnCPF.replace(/\D/g, ''); 
    returnCPF = returnCPF.replace(/(\d{3})(\d{3})(\d{3})(\d{2})/g, "\$1.\$2.\$3-\$4");
    return returnCPF;
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

function removeMascara(value)
{
    // Substitui qualquer caractere que não seja número por uma string vazia
    return value.replace(/\D/g, '');
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

function validaCNPJ(cnpj)
{
    var b = [6, 5, 4, 3, 2, 9, 8, 7, 6, 5, 4, 3, 2]
    var c = String(cnpj).replace(/[^\d]/g, '')

    if (c.length !== 14)
    {
        return false
    }
    if (/0{14}/.test(c))
    {
        return false
    }
    for (var i = 0, n = 0; i < 12; n += c[i] * b[++i]){
        if (c[12] != (((n %= 11) < 2) ? 0 : 11 - n))
        {
            return false;
        }
    }
    for (var i = 0, n = 0; i <= 12; n += c[i] * b[i++])
    {
        if (c[13] != (((n %= 11) < 2) ? 0 : 11 - n))
        {
            return false
        }
    }
    return true
}

function validaCPF(cpf)
{
    var Soma = 0
    var Resto

    var strCPF = String(cpf).replace(/[^\d]/g, '')

    if (strCPF.length !== 11)
        return false

    if ([
        '00000000000',
        '11111111111',
        '22222222222',
        '33333333333',
        '44444444444',
        '55555555555',
        '66666666666',
        '77777777777',
        '88888888888',
        '99999999999',
    ].indexOf(strCPF) !== -1)
        return false

    for (i = 1; i <= 9; i++)
        Soma = Soma + parseInt(strCPF.substring(i - 1, i)) * (11 - i);

    Resto = (Soma * 10) % 11

    if ((Resto == 10) || (Resto == 11))
        Resto = 0

    if (Resto != parseInt(strCPF.substring(9, 10)))
        return false

    Soma = 0

    for (i = 1; i <= 10; i++)
        Soma = Soma + parseInt(strCPF.substring(i - 1, i)) * (12 - i)

    Resto = (Soma * 10) % 11

    if ((Resto == 10) || (Resto == 11))
        Resto = 0

    if (Resto != parseInt(strCPF.substring(10, 11)))
        return false

    return true
}