var isNew = true;
let estoque = 0;
getCodigoProduto();

function getCodigoProduto() {

    $("#codigo_produto").keyup(function(e) {

        $.ajax({
            type: "POST",
            url: 'get_produto.php',
            dataType: "JSON",
            data: { codigo_produto: $("#codigo_produto").val() },

            success: function(data) {


                $("#nome_produto").val(data[0].nome);
                $("#preco_produto").val(data[0].preco_venda);
                estoque = Number(data[0].qtd_estoque);

                $("#quantidade_produto").focus();
                document.getElementById("btnAddProd").disabled = false;


            },

            error: function() {
                $("#nome_produto").val("Produto não cadastrado");
                $("#preco_produto").val(0);
                $("#total_produto").val(0);
                document.getElementById("btnAddProd").disabled = true;


            }



        });
    });

}

$(function() {
    $("#preco_produto, #quantidade_produto").on("keydown keyup click focus", qtd);


    function qtd() {
        var f = $("#preco_produto").val();
        var x = parseFloat(f);
        var sum = (x * Number($("#quantidade_produto").val()));
        //var t = sum.toLocaleString('pt-br', {minimumFractionDigits: 2});

        $("#total_produto").val(sum);
    }
});

function adicionaProduto() {
    var produto = {

        codigo_produto: $("#codigo_produto").val(),
        nome_produto: $("#nome_produto").val(),
        preco_produto: $("#preco_produto").val(),
        quantidade_produto: $("#quantidade_produto").val(),
        total_produto: $("#total_produto").val()



    };
    addRow(produto);
    $("#form-produto")[0].reset();
}
var total = 0.00;

function addRow(produto) {
    let qtd = $("#quantidade_produto").val();

    if ($("#codigo_produto").val().length == 0) {
        document.getElementById("btnAddProd").disabled = true;
        alert("Insira o Codigo do produto!");


    } else if (estoque < qtd) {
        alert("Produto com estoque menor que a quantidade desejada");
    } else {

        var $tableB = $("#listaProduto tbody");
        var $row = $(
            "<tr>" +
            "<td><button class='btn btn-danger btn-sm' name='record' onclick='removeLinha(this)'>Remover</button></td>" +
            "<td>" + produto.codigo_produto + "</td>" +
            "<td>" + produto.nome_produto + "</td>" +
            "<td>" + produto.preco_produto + "</td>" +
            "<td>" + produto.quantidade_produto + "</td>" +
            "<td>" + produto.total_produto + "</td>" +
            "</tr>"
        );

        $row.data("codigo_produto", produto.codigo_produto);
        $row.data("nome_produto", produto.nome);
        $row.data("preco_produto", produto.preco_produto);
        $row.data("quantidade_produto", produto.quantidade_produto);
        $row.data("total_produto", produto.total_produto);

        $tableB.append($row);

        total += Number(produto.total_produto);
        $('#total_venda').val(total);
    }
}

var total_venda;

function removeLinha(obj) {

    total_venda = parseFloat($(obj).parent().parent().find('td:last').text(), 10);

    total -= total_venda;
    $('#total_venda').val(total);

    $(obj).parent().parent().remove();
}

function addVenda() {
    var table_data = [];

    $("#listaProduto tbody tr").each(function(row, tr) {
        var sub = {
            "codigo_produto": $(tr).find('td:eq(1)').text(),
            "nome_produto": $(tr).find('td:eq(2)').text(),
            "preco_produto": $(tr).find('td:eq(3)').text(),
            "quantidade_produto": $(tr).find('td:eq(4)').text(),
            "total_produto": $(tr).find('td:eq(5)').text()

        };
        table_data.push(sub);
    });

    $.ajax({
        type: "POST",
        url: "add_venda.php",
        dataType: 'JSON',
        data: {
            total_venda: $("#total_venda").val(),
            id_usuario: $("#id_usuario").val(),
            id_cliente: $("#id_cliente").val(),
            forma_pagamento: $("#forma_pagamento").val(),
            data: table_data
        },
        success: function(data) {

            if (isNew) {
                $("#modal_sucesso_cad").modal('show');

            }


        },
        error: function(xhr, status, error) {

            console.log(xhr.responseText);
        }
    });

}

function refresh() {
    window.location.reload();
}

function foc() {
    $("#codigo_produto").focus();
}