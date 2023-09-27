/**
 * Funcao dinamica que recebe os parametros e adiciona no combobox e na grid
 * @param {type} success - function jQuery
 * @param {type} parametro - nome da pessoa
 */
function setStatus(id) {
    $('#scren-modal').modal('show');
    $.ajax({
        type: "Post",
        url: System.projeto_admin + "fornecedor/setStatus/" + id,
        dataType: 'json',
        success: function (data) {
            if (data == true) {
                location.reload();
            } else {
                getMsg('Erro');
                $('#scren-modal').modal('hide');
            }
        },
        error: function () {
            $('#scren-modal').modal('hide')
            getMsg('Erro');
        }
    });
}


function PesquisaFornecedor() {
    var parametro = $.trim($(".textbox-value").val());

    if (parametro != null) {
        if (parametro.length >= 1) {

            getGridFornecedor(parametro);
        }
    }
}
/**
 * Funcao dinamica que recebe os parametros e adiciona no combobox e na grid
 * @param {type} success - function jQuery
 * @param {type} parametro - nome da pessoa
 */
function getGridMotorista(parametro) {
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
    //$('#descNumContaCorrente').bind('keydown',soNums); 
    //$('#descNumAgencia').bind('keydown',soNums); 

    /*  jQuery(function ($) {
     // $('.date').mask('00/00/0000');
     $('.time').mask('00:00:00');
     $('.date_time').mask('00/00/0000 00:00:00');
     $('.cep').mask('99999-999');
     $('.phone').mask('9999-9999');
     $('.telefone').mask('(99)9999-9999');
     $('.phone_us').mask('(000)0000-0009');
     $('.mixed').mask('AAA 000-S0S');
     $('.cpf').mask('999.999.999-99', {reverse: true});
     $('.cnpj').mask('99.99.99/9999-99', {reverse: true});
     $('.money').mask('000.000.000.000.000,00', {reverse: true});
     $('.money2').mask("#.##0,00", {reverse: true});
     $('.onlyNumbers').mask('99999999999999');
     //$('.numbanco').mask('######');
     //$('.numagencia').mask('99999');
     //$('.numcofdgfdgnta').mask('9999999999');
     $.fn.extend({
     myMethod: function () {
     $(this).onlyNumbers();
     }
     });
     });*/
    //$('#descFax').mask('(99)99999-9999',{autoclear: false});
    //$('#descTelefone').mask('(99)99999-9999',{autoclear: false});
    //$('#descNumContaCorrente').mask('999999-?9',{autoclear: true});

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
    var listUrl = System.projeto + "/admin/fornecedor/getGridFornecedor?page=1&rows=1000";
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

