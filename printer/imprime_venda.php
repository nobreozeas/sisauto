<?php
session_start();
include("../admin/Invoice.php");
$vendas = new Invoice();
$vendas->checkLoggedIn();


$venda = $vendas->getVenda($_GET['id_venda']);
$venda_item = $vendas->getVendaItem($_GET['id_venda']);

$saida = '';

$saida .= '<!DOCTYPE html>
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
            width: 100%;
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
        }
        .prod{
            text-align:center;
        }
        #tfo{
            text-align:right;
            
        }
        #td_total{
            font-size:16px;
        }

        .wrapper-page {
            page-break-after: always;
        }
        
        .wrapper-page:last-child {
            page-break-after: avoid;
        }
    
    </style>
</head>

<body>';
$i = 1;
    while($i<=2){
$saida .= '<div class="wrapper-page"><table border="1" class="geral">
        <thead>
            <tr>
                <td colspan="1"><img src="dompdf/logo_dionisio.png" alt=""></td>
                <td class="texto" colspan="6">
                    Serviços de Motor de Partida, <br> Alternadores e Instalação 12v e 24v<br>
                    Tel: (68) 3221-4894 / (68) 99996-7290<br>
                    Rod. AC 40 KM 11 - Ramal da Garapeira 200mts <br>
                    Email: dionisioautoeletrica@gmail.com
                </td>
            </tr>
        </thead>';
        $saida .= '<tbody>
            <tr>
                <td colspan="1">DATA DA VENDA: '. date('d/m/Y',  strtotime($venda['data_venda'])).'</td>
                <td colspan="2">Nº VENDA: '. $venda['id_venda'].'</td>
                <td colspan="2">VENDEDOR: '. strtoupper($venda['nome_usuario']).'</td>
                <td colspan="2">Pagamento: '. strtoupper($venda['forma_pagamento']).'</td>
            </tr>
            <tr>
                <td colspan="2">
                    <strong>CLIENTE:</strong> '.strtoupper($venda['nome_cliente']).'<br>
                    <strong> DOCUMENTO:</strong> '. strtoupper($venda['documento']).'<br>
                    <strong>TELEFONE:</strong> '. strtoupper($venda['telefone']).'
                </td>
                <td colspan="5">
                <strong>ENDEREÇO:</strong> '.$endereco = strtoupper($venda['logradouro'] . ', ' . $venda['numero'] . ', ' . $venda['bairro'] . '-' . $venda['cep']).' <br>
                <strong>CIDADE:</strong> '.strtoupper($venda['cidade']).'<br>
                <strong>ESTADO:</strong> '.strtoupper($venda['estado']).'
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
                        <tbody class="prod">';
                                $count = 0;
                                foreach ($venda_item as $vendaItens) {
                                    $count++;
                            $saida .='<tr>
                                <td>'.$count.'</td>
                                <td>'.$vendaItens['id_produto'].'</td>
                                <td>
                                    '.strtoupper($vendaItens['nome']).'
                                </td>
                                <td>'.number_format($vendaItens['preco_venda'], 2, ",", ".").'</td>
                                <td>'. $vendaItens['qtd'].'</td>
                                <td>'. number_format($vendaItens['total'], 2, ",", ".").'</td>
                            </tr>';
                                }
                        $saida .= '</tbody>
                        <tfoot id="tfo">
                            <tr>
                                <td id="td_total" colspan="7"><strong>TOTAL: R$ '. number_format($venda['total_venda'], 2, ",", ".").'</strong></td>
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
    </table></div>';
                 $i++;           }

$saida .='</body>

</html>';

require_once 'dompdf/lib/html5lib/Parser.php';
require_once 'dompdf/lib/php-svg-lib-master/src/autoload.php';
require_once 'dompdf/lib/php-svg-lib/src/autoload.php';
require_once 'dompdf/autoload.inc.php';
use Dompdf\Dompdf;
$dompdf = new Dompdf();

$dompdf->loadHtml(html_entity_decode($saida));

$dompdf->render();
$dompdf->stream("teste.pdf", array("Attachment"=> false));