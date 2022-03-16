<?php

use FontLib\Table\Type\head;
session_start();
include_once 'Invoice.php';
include("../inc/footer.php");

$id_venda =$_GET['id_venda'];

$vendas = new Invoice();
$vendas->checkLoggedIn();

if($vendas->getVenda($id_venda)){
    $venda = $vendas->getVenda($_GET['id_venda']);
    $venda_item = $vendas->getVendaItem($_GET['id_venda']);

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        body {
            font-family: "Helvetica";
        }

        

        table {
            margin: auto;
            border: 1px solid black;
            border-collapse: collapse;
            width: 70%;
        }



        img {
            width: 250px;
        }

        .texto {
            text-align: center;
            font-weight: bold;
        }

        .tabela_produto {
            border: 1px solid black;
            border-collapse: collapse;
            width: 100%;
        }

        .prod {
            text-align: center;

        }

        #tfo {
            text-align: right;

        }

        #td_total {
            font-size: 16px;
        }

        .btn_func {
            display: flex;
            justify-content: center;
            margin-top: 20px;
        }
        .btn_func button{
            width: 100px;
            height: 50px;
            margin-left: 20px;
            border: none;
            border-radius: 3px;
            cursor: pointer;
            color:antiquewhite;
        }

        #btn_print{
            background-color: #0B5ED7;
            
        }
        #btn_print:hover{
            background-color: blue;

        }
        #btn_delete{
            background-color: #eb3a34;
        }
        #btn_delete:hover{
            background-color: red;
        }

    </style>
</head>

<body>
    

    <table border="1" class="geral">
        <thead>
            <tr>
                <td colspan="1"><img src="../imagens/logo_dionisio.PNG" alt=""></td>
                <td class="texto" colspan="6">
                    Serviços de Motor de Partida, <br> Alternadores e Instalação 12v e 24v<br>
                    Tel: (68) 3221-4894 / (68) 99996-7290<br>
                    Rod. AC 40 KM 11 - Ramal da Garapeira 200mts <br>
                    Email: dionisioautoeletrica@gmail.com
                </td>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td colspan="1">DATA DA VENDA:<?= date('d/m/Y',  strtotime($venda['data_venda'])); ?></td>
                <td colspan="2">Nº VENDA: <?= $venda['id_venda'] ?></td>
                <td colspan="3">VENDEDOR: <?= strtoupper($venda['nome_usuario']); ?></td>
                <td colspan="3">PAGAMENTO: <?= strtoupper($venda['forma_pagamento']); ?></td>
            </tr>
            <tr>
                <td colspan="2">
                    <strong>CLIENTE:</strong> <?= strtoupper($venda['nome_cliente']); ?><br>
                    <strong> DOCUMENTO:</strong> <?= strtoupper($venda['documento']); ?><br>
                    <strong>TELEFONE:</strong> <?= strtoupper($venda['telefone']); ?>
                </td>
                <td colspan="5">
                    <strong>ENDEREÇO:</strong> <?= $endereco = strtoupper($venda['logradouro'] . ', ' . $venda['numero'] . ', ' . $venda['bairro'] . '-' . $venda['cep']); ?> <br>
                    <strong>CIDADE:</strong> <?= strtoupper($venda['cidade']); ?><br>
                    <strong>ESTADO:</strong> <?= strtoupper($venda['estado']); ?>
                </td>
            </tr>
            <tr>
                <td colspan="7">
                    <table class="tabela_produto" border="1">
                        <thead class="prod">
                            <tr>
                                <td>ITEM</td>
                                <td>COD.</td>
                                <td>DESCRIÇÃO</td>
                                <td>VALOR UNIT.</td>
                                <td>QTD</td>
                                <td>SUBTOTAL</td>
                            </tr>
                        </thead>
                        <tbody class="prod">
                            <?php $count = 0;
                            foreach ($venda_item as $vendaItens) {
                                $count++; ?>
                                <tr>
                                    <td><?= $count; ?></td>
                                    <td><?= $vendaItens['id_produto']; ?></td>
                                    <td><?= strtoupper($vendaItens['nome']); ?></td>
                                    <td><?= number_format($vendaItens['preco_venda'], 2, ",", "."); ?></td>
                                    <td><?= $vendaItens['qtd']; ?></td>
                                    <td><?= number_format($vendaItens['total'], 2, ",", "."); ?></td>
                                </tr>
                            <?php } ?>
                        </tbody>
                        <tfoot id="tfo">
                            <tr>
                                <td id="td_total" colspan="7"><strong>TOTAL: R$ <?= number_format($venda['total_venda'], 2, ",", "."); ?></strong></td>
                            </tr>
                        </tfoot>
                    </table>
                </td>
            </tr>
        </tbody>
        <tfoot>
            <tr>
                <td colspan="7" style="font-size: 12px;">
                    <ul>
                        <li>AS TROCAS DE PRODUTOS DEVERÃO SER FEITAS MEDIANTE A APRESENTAÇÃO DESTE COMPROVANTE</li>
                        <li>A TROCA SOMENTE SERÁ ACEITA EM CASO DE DEFEITO COM O PRODUTO, E QUANDO ESTE NÃO TIVER SIDO VIOLADO (ART. 26 do CDC)</li>
                    </ul>
                </td>
            </tr>
        </tfoot>
    </table>
    
    <div class="btn_func">
        <a href="../printer/imprime_venda.php?id_venda=<?= $venda['id_venda']; ?>"><button id="btn_print">Imprimir <i class="fa-solid fa-print"></i></button></a>
        <a href="delete.php?id_venda=<?= $venda['id_venda']; ?>"><button id="btn_delete">Excluir <i class="fa-solid fa-trash-can"></i></button></a>
        
    </div>


</body>

</html>

<?php }else{
    echo "A venda nao existe";
} ?>