<?php
session_start();

include 'Invoice.php';
$invoice = new Invoice();
$invoice->checkLoggedIn();

$consulta = "SELECT count(v.id_venda) as qtd_vendas, sum(v.total_venda) as tota_venda, sum(vp.qtd) as qtd_produtos FROM vendas AS v JOIN vendas_produtos AS vp ON v.id_venda = vp.id_venda";
$resulta_consulta = mysqli_query($conn, $consulta);

?>
<?php require("../inc/header.php"); ?>

<body>

    <div class="wrapper">
        <?php require("../inc/sidebar.php"); ?>

        <div class="main_content">
            <div class="header">Olá <?php echo $_SESSION['usuario']; ?> Seja Bem vindo!!!</div>

            <div class="info">
                <h2>Relatório de Vendas</h2>
                <div id="menu_vendas">
                    <h5>Vendas por período</h5>
                    <form class="form-inline" action="venda_periodo.php" method="POST">
                        <div class="row g-3">
                            <div class="col-md-3">
                                <label for="">De:</label>
                                <input type="date" name="data_inicial" class="form-control" placeholder="First name" aria-label="First name">
                            </div>
                            <div class="col-md-3">
                                <label for="">Até:</label>
                                <input type="date" name="data_final" class="form-control" placeholder="Last name" aria-label="Last name">
                            </div>
                            <div class="col-md-3">
                                <input style="margin-top: 23px;" type="submit" class="form-control btn btn-primary" value="Buscar">
                            </div>
                        </div>
                    </form>
                    <form>
                        <label class="form-label">Pesquisar Venda:</label>
                        <div class="input-group">
                            <input type="text" class="form-control" placeholder="Insira o codigo da venda" aria-describedby="button-addon2">
                            <button class="btn btn-primary" type="submit" id="button-addon2">Pesquisar</button>
                        </div>
                    </form>

                    <a href="relatorio_vendas.php"><button type="button" class="btn btn-warning">Listar todas as vendas</button></a>
                </div>

                <div class="d-flex justify-content-around">
                    <?php while ($dado = $resulta_consulta->fetch_array()) { ?>

                        <div class="bg-success cards text-white text-center">Vendas<br><?= $dado['qtd_vendas']; ?></div>
                        <div class="bg-info cards text-white text-center">Produtos vendidos<br><?= $dado['qtd_produtos']; ?></div>
                        <div class="bg-primary cards text-white text-center">Receita<br>R$ <?= number_format($dado['tota_venda'], 2, ",", "."); ?></div>
                    <?php } ?>
                </div>

                <!--h5>Vendas (intervalo de um ano)</h5>-->
                <div class="canvas">
                    <canvas id="myChart"></canvas>
                </div>





            </div>
        </div>
    </div>



    <?php require("../inc/footer.php"); ?>

</body>

</html>