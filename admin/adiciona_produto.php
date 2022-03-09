<?php
session_start();
$msg = '';
include 'Invoice.php';
$invoice = new Invoice();
$invoice->checkLoggedIn();

if (!empty($_POST["nome_produto"]) && !empty($_POST["estoque"]) && !empty($_POST["preco_custo"]) && !empty($_POST["preco_venda"]) && isset($_POST["btn-cadastrar"])) {
    $invoice->saveProduto($_POST);

    $msg = $_SESSION['$msg'] = "Produto Cadastrado com sucesso";
}

?>
<?php include("../inc/header.php"); ?>



<body>



    <div class="wrapper">

       <?php include("../inc/sidebar.php"); ?>
        <div class="main_content">
            <div class="header">Olá <?php echo $_SESSION['usuario']; ?> Seja Bem vindo!!!</div>
            <div class="info">
                <div class="row">
                    <h2>Adicionar Produto</h2>
                </div>

                <?php if ($msg) { ?>
                    <div class="alert alert-success" id="msg"><?php echo $msg;  //echo "<meta http-equiv='refresh' content='0'>";
                                                                ?></div>
                <?php } ?>
                <form class="row g-3" action="" id="add-prod-form" method="post" role="form">
                    <div class="col-md-6">
                        <label for="nome_produto" class="form-label">Nome:</label>
                        <input required type="text" class="form-control" name="nome_produto" id="nome_produto" autofocus="on" required>
                    </div>
                    <div class="col-md-6">
                        <label for="estoque" class="form-label">Estoque:</label>
                        <input type="number" class="form-control" name="estoque" id="estoque" required>
                    </div>
                    <div class="col-md-6">
                        <label for="preco_custo" class="form-label">Preço de Custo:</label>
                        <input type="number" class="form-control" name="preco_custo" id="preco_custo" step="any" required>
                    </div>
                    <div class="col-md-6">
                        <label for="preco_venda" class="form-label">Preço de Venda:</label>
                        <input type="number" class="form-control" name="preco_venda" id="preco_venda" step="any" required>
                    </div>

                    <div class="d-grid gap-2 d-md-block">
                        <button class="btn btn-success" type="submit" name="btn-cadastrar">Cadastrar</button>
                        <a href="dash.php"><button class="btn btn-danger" type="button">Cancelar</button></a>
                    </div>

                </form>




            </div>

        </div>
    </div>



    <?php include("../inc/footer.php"); ?>
</body>

</html>