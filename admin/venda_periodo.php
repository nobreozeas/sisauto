<?php
session_start();
include("Invoice.php");
$invoice = new Invoice();
$invoice->checkLoggedIn();

$data_inicial = $_POST['data_inicial'];
$data_final = $_POST['data_final'];


$stmt = "SELECT v.id_venda, l.usuario, c.nome, v.total_venda, v.forma_pagamento, v.data_venda FROM vendas v LEFT OUTER JOIN cliente c ON v.id_cliente = c.id_cliente LEFT OUTER JOIN login AS l ON v.id_usuario = l.id_usuario WHERE v.data_venda BETWEEN '$data_inicial' AND '$data_final' ORDER BY v.data_venda DESC";

$result = mysqli_query($conn, $stmt);

?>
<?php require("../inc/header.php"); ?>
<body>
    <div class="container">
        <h2 class="text-center">Relatorio de Vendas - SISAUTO</h2>

        <table class="table table-bordered table-striped text-center">
            <thead class="bg-info">
                <th>Data</th>
                <th>Codigo</th>
                <th>Usuario</th>
                <th>Cliente</th>
                <th>Total</th>
                <th>Pagamento</th>
            </thead>

            <tbody>
            <?php while ($dado = $result->fetch_array()) { ?>
                <tr>
                    
                        <td><?= date('d/m/Y',  strtotime($dado['data_venda'])); ?></td>
                        <td># <?= $dado['id_venda']; ?></td>
                        <td><?= $dado['usuario'];?></td>
                        <td><?= $dado['nome'];?></td>
                        <td>R$ <?= number_format($dado['total_venda'], 2, ",", ".");?></td>
                        <td><?= $dado['forma_pagamento'];?></td>
                </tr>
                <?php } ?>
            </tbody>

        </table>
    </div>

</body>

</html>















