<?php
session_start();
include("Invoice.php");
$vendas = new Invoice();
$vendas->checkLoggedIn();

//use Dompdf\Dompdf;

// include autoloader
//require_once("../dompdf/autoload.inc.php");

//Criando a Instancia
//$dompdf = new DOMPDF();

$venda = $vendas->getVenda($_GET['id_venda']);
$venda_item = $vendas->getVendaItem($_GET['id_venda']);



//$dompdf->render();

//Exibibir a página
//	$dompdf->stream(
//	"relatorio_celke.pdf", 
//	array(
//		"Attachment" => false //Para realizar o download somente alterar para true
//	)
//	);



?>

<?php require("../inc/header.php"); ?>

<body>




    <div class="container">
        <table class="table table-bordered border-dark" style="font-size: 12px; margin:0px">
            <thead>
                <tr>
                    <td class="align-middle" colspan="1">
                        <img src="../imagens/logo_dionisio.PNG" width="250">
                    </td>
                    <td colspan="5">
                        <h5 class="text-center text-danger"><strong>Serviços de Motor de Partida, Alternadores e Instalação 12v e 24v</strong></h5>
                        <h5 class="text-center"><strong>Tel: (68) 3221-4894 / (68) 99996-7290</strong></h5>
                        <h6 class="text-center">Rod. AC 40 KM 11 - Ramal da Garapeira 200mts</h6>
                        <h6 class="text-center">Email: dionisioautoeletrica@gmail.com</h6>
                    </td>
                </tr>
                <tr>
                    <th colspan="2">DATA DA VENDA: <?= date('d/m/Y',  strtotime($venda['data_venda']));  ?></th>
                    <th colspan="2">Nº VENDA: #<?= $venda['id_venda'];  ?></th>
                    <th colspan="2">VENDEDOR: <?= strtoupper($venda['nome_usuario']); ?></th>
                </tr>
                <tr>
                    <td colspan="3" style="font-size: 12px;">
                        CLIENTE: <?= strtoupper($venda['nome_cliente']); ?><br>
                        DOCUMENTO: <?= strtoupper($venda['documento']); ?><br>
                        TELEFONE: <?= strtoupper($venda['telefone']); ?>
                    </td>
                    <td colspan="3">
                        ENDEREÇO: <?= $endereco = strtoupper($venda['logradouro'] . ', ' . $venda['numero'] . ', ' . $venda['bairro'] . '-' . $venda['cep']); ?> <br>
                        CIDADE: <?= strtoupper($venda['cidade']); ?><br>
                        ESTADO: <?= strtoupper($venda['estado']); ?>
                    </td>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td colspan="6">
                        <table class="table table-striped">
                            <thead>
                                <tr class="text-center">
                                    <td>ITEM</td>
                                    <td>COD.</td>
                                    <td>DESCRIÇÃO</td>
                                    <td>VALOR UNIT.</td>
                                    <td>QTD</td>
                                    <td>SUBTOTAL</td>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $count = 1;
                                foreach ($venda_item as $vendaItens) { ?>
                                    <tr class="text-center">
                                        <td><?= $count++; ?></td>
                                        <td class="id_p"><?= $vendaItens['id_produto']; ?></td>
                                        <td>
                                            <?php $encoding = 'UTF-8'; // ou ISO-8859-1...
                                           echo mb_convert_case($vendaItens['nome'], MB_CASE_UPPER, $encoding);
                                            ?>
                                        </td>
                                        <td><?= number_format($vendaItens['preco_venda'], 2, ",", "."); ?></td>
                                        <td><?= $vendaItens['qtd']; ?></td>
                                        <td><?= number_format($vendaItens['total'], 2, ",", "."); ?></td>
                                    </tr>
                                <?php } ?>
                                <tr>
                                    <td class="text-end" colspan="6" style="font-size: 14px;"><strong>TOTAL: R$ <?= number_format($venda['total_venda'], 2, ",", "."); ?></strong></td>
                                </tr>
                            </tbody>
                        </table>
                    </td>
                </tr>

            </tbody>
            <tfoot>
                <tr>
                    <td colspan="6">
                        <ul style="font-size: 11px;">
                            <li>AS TROCAS DE PRODUTOS DEVERÃO SER FEITAS MEDIANTE A APRESENTAÇÃO DESTE COMPROVANTE</li>
                            <li>A TROCA SOMENTE SERÁ ACEITA EM CASO DE DEFEITO COM O PRODUTO, E QUANDO ESTE NÃO TIVER SIDO VIOLADO (ART. 26 do CDC)</li>
                            <li></li>
                        </ul>
                    </td>
                </tr>
            </tfoot>

        </table>
    </div>

    <?php require("../inc/footer.php"); ?>
</body>

</html>