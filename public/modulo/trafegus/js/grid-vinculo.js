/**
 * Funcao dinamica que recebe os parametros e adiciona no combobox e na grid
 * @param {type} success - function jQuery
 * @param {type} parametro - nome da pessoa
 */



/**
 * Funcao dinamica que recebe os parametros e adiciona no combobox e na grid
 * @param {type} success - function jQuery
 * @param {type} parametro - nome da pessoa
 */
function getGridFornecedor(parametro) {
    $('#scren-modal').modal('show');
    $.ajax({
        type: "Post",
        url: System.projeto_admin + "fornecedor/listaFornecedor?parametro=" + parametro,
        dataType: 'json',
        success: function (data) {

            if (data != null) {
                //console.log(data);
                var items = $.map(data.rows, function (item, index) {
                    return {
                        id: "#",
                        codFornecedor: item.codFornecedor,
                        descNome: item.descNome,
                        descTelefone: item.descTelefone,
                        descEmail: item.descEmail,
                        descCpfCnpj: item.descCpfCnpj,
                        opcao: item.opcao
                    };
                });

                $('#dg').datagrid('loadData', items);
                $("#cc").textbox('setValue', '');
            } else {
                dialog_grid_no_fornecedor(parametro);
            }
            $('#scren-modal').modal('hide');
        },
        error: function (jqXHR, textStatus, errorThrown) {
            $('#scren-modal').modal('hide');
            for (i in jqXHR) {
                if (i != "channel")
                    document.write(i + " : " + jqXHR[i] + "<br>")
            }
        }
    });
}



function dialog_grid_no_fornecedor() {
    $('#ResMessage').html('<span>Dados não encotrado!</span>');
    $('#dialog').dialog({
        title: 'Atenção',
        width: 300,
        height: 80,
        closed: false,
        cache: false,
        modal: true,
        buttons: [{
                text: 'close',
                handler: function () {
                    $(".panel-tool-close").click();
                }
            }],
    });
    $('#dialog').dialog('open');
}





//marcara cnpj e  cpf
$(document.body).on('change', '#codTipoFornecedor', function (e) {
    //doStuff :selected'
    var optVal = $("#codTipoFornecedor option:selected").text();

    if (optVal == 'Pessoa Física') {

        $(".documento").attr("id", "descCpf");
        $(".documento").attr("onblur", "javascript: validarCPF(this.value);");
        $(".documento").mask("999.999.999-99", {reverse: true});
        $(".documento").attr('maxlength', 14);
        $(".documento").attr('placeholder', 'Informe o CPF');
        $(".documento").attr('label', 'CPF');
    } else if (optVal == 'Pessoa Jurídica') {


        $(".documento").attr("id", "descCnpj");
        $(".documento").removeAttr('onblur');
        $(".documento").removeAttr('onkeypress');
        $(".documento").attr('maxlength', 18);
        $(".documento").attr('placeholder', 'Informe o CNPJ');
        $(".documento").attr('label', ' CNPJ');
        $(".documento").mask('99.999.999/9999-99', {reverse: true});


    } else if (optVal == 'Estrangeiro') {

        $(".documento").attr("id", "Estrangeiro");
        $(".documento").attr("id", "Estrangeiro");
        $(".documento").mask("99999999999999");
        $(".documento").attr('placeholder', 'Informe o Documento');
        $(".documento").attr('label', 'Documento Estrangeiro');
        $(".documento").removeAttr('onblur');
        $(".documento").removeAttr('onkeypress');
        $(".documento").unmask();
    }

});

$(document).ready(function ($) {
    $('#descTelefone').bind('keydown', soNums);
    $('#descFax').bind('keydown', soNums);
   

});
/*
 * Inicializado o filter
 * @returns {undefined}
 */
function loadSuccessEvent() {
    $('#dg').datagrid('enableFilter');
    var fields = ['id', 'opcao', 'stsAtivo'];
    esconderCampoFilter(fields);
}

/*
 * função para  permitir o funcionamento da paginação com filtro
 */

function loadAndSetGridData() {
    var listUrl = System.projeto + "/admin/vinculo/getGridVinculo?page=1&rows=1000";
    $("dg").datagrid('loading');  // show the loading msg
    //  var dados ={'page':page,'rows':rows};
    $.ajax({
        url: listUrl,
        type: 'POST',
        dataType: 'json',
        contentType: 'application/json',
        //      data:dados,
        error: function (xhr, status, err) { //quando da erro 
            $("dg").datagrid('loaded');  // close the loading msg
            $("dg").datagrid('loadData', {total: 0, rows: []});
        },
        success: function (response) {
            $("dg").datagrid('loaded');
            if (response.rows.length !== 0) {
                $('#dg').datagrid('loadData', response.rows);
            } else {
                $("dg").datagrid('loadData', {total: 0, rows: []});
            }
        }
    });
}



function loadGoogleMapAjax() {
    var listUrl = System.projeto + "/vinculo/getCordenadaVeiculo?page=1&rows=100";
   
    $.ajax({
        url: listUrl,
        type: 'POST',
        dataType: 'json',
        contentType: 'application/json',
        error: function (xhr, status, err) { 
  
        },
        success: function (response) {
           
        }
    });
}



//somente numeros barra e traço
function soNums(e) {
    //alert(e.which);

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