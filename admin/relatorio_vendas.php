<?php
session_start();
include("Invoice.php");

$sql = "SELECT v.id_venda, l.usuario, c.nome, v.total_venda, v.forma_pagamento, v.data_venda FROM vendas v LEFT OUTER JOIN cliente c ON v.id_cliente = c.id_cliente LEFT OUTER JOIN login AS l ON v.id_usuario = l.id_usuario ORDER BY v.data_venda DESC";

$stmt = mysqli_query($conn, $sql);

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
                <th>Ação</th>
            </thead>

            <tbody>
            <?php while ($dado = $stmt->fetch_array()) { ?>
                <tr>
                    
                
                        <td><?= date('d/m/Y',  strtotime($dado['data_venda'])); ?></td>
                        <td># <?= $dado['id_venda']; ?></td>
                        <td><?= $dado['usuario'];?></td>
                        <td><?= $dado['nome'];?></td>
                        <td>R$ <?= number_format($dado['total_venda'], 2, ",", ".");?></td>
                        <td><?= $dado['forma_pagamento'];?></td>
                        <td><a href="imprime_venda.php?id_venda=<?= $dado['id_venda']; ?>">print</a></td>
                </tr>
                <?php } ?>
            </tbody>

        </table>
    </div>

</body>

</html>