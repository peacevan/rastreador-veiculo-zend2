jQuery(document).ready(function () {
    // Toda requisição ajax abrirá o modal loading
    $(document).ajaxStart(function () {
        $('#scren-modal').modal('show');
    });
    $(document).ajaxStop(function () {
        $('#scren-modal').modal('hide');
    });

   
    // Definindo Máscaras
    $('#cpf').mask('999.999.999-99');
    $('#telefone').mask('(99)9999-9999');
    $('#descRamal').bind('keydown', soNums);

//somente numeros barra e traço
function soNums(e) {
    //teclas adicionais permitidas (tab,delete,backspace,setas direita e esquerda)
    keyCodesPermitidos = new Array(8, 9, 37, 39, 46, 193, 111, 109, 189, 187, 107);

    //numeros e 0 a 9 do teclado alfanumerico
    for (x = 48; x <= 57; x++) {
        keyCodesPermitidos.push(x);
    }
    //numeros e 0 a 9 do teclado numerico
    for (x = 96; x <= 105; x++) {
        keyCodesPermitidos.push(x);
    }
    //Pega a tecla digitada
    keyCode = e.which;
    //Verifica se a tecla digitada é permitida
    if ($.inArray(keyCode, keyCodesPermitidos) != -1) {
        return true;
    }
    return false;
}


/**
 * Função para validar CPF
 */
function validacaoCpf(cpf) {
    if (!/^\d{3}\.\d{3}\.\d{3}\-\d{2}/.test(cpf)) {
        return false;
    }

    var valido = true;
    switch (cpf) {
        case '000.000.000-00':
            valido = false;
            break;
        case '111.111.111-11':
            valido = false;
            break;
        case '222.222.222-22':
            valido = false;
            break;
        case '333.333.333-33':
            valido = false;
            break;
        case '444.444.444-77':
            valido = false;
            break;
        case '555.555.555-55':
            valido = false;
            break;
        case '666.666.666-66':
            valido = false;
            break;
        case '777.777.777-77':
            valido = false;
            break;
        case '888.888.888-88':
            valido = false;
            break;
        case '999.999.999-99':
            valido = false;
            break;
    }
    return valido;
}




