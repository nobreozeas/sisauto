<?php
session_start();
$msg = '';
include 'Invoice.php';
$invoice = new Invoice();
$invoice->checkLoggedIn();

if ( isset($_POST["btn-cadastrar"])) {
    $invoice->saveCliente($_POST);

    $msg = $_SESSION['$msg'] = "Cliente Cadastrado com sucesso";
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
                    <h2>Adicionar Cliente</h2>
                </div>

                <?php if ($msg) { ?>
                    <div class="alert alert-success" id="msg"><?php echo $msg;  //echo "<meta http-equiv='refresh' content='0'>";
                                                                ?></div>
                <?php } ?>
                <form class="row g-3" action="" id="add-prod-form" method="post">
                <div class="col-md-6">
                        <label for="tipo_cliente" class="form-label">Tipo Cliente</label>
                        <select class="form-select" name="tipo_cliente" id="tipo_cliente" autofocus="on" required>
                            <option value="#">...</option>    
                            <option value="fisica">Pessoa Física</option>
                            <option value="juridica">Pessoa Jurídica</option>
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label for="nome_cliente" class="form-label">Nome/Razão Social:</label>
                        <input required type="text" class="form-control" name="nome_cliente" id="nome_cliente"  required>
                    </div>
                    <div class="col-md-6">
                        <label for="documento" class="form-label">CPF/CNPJ:</label>
                        <input type="text" class="form-control" name="documento" id="documento" required maxlength="14">
                    </div>
                    
                    <div class="col-md-6">
                        <label for="telefone" class="form-label">Telefone:</label>
                        <input type="text" class="form-control" name="telefone" id="telefone" required maxlength="11">
                    </div>
                    <div class="col-md-5">
                        <label for="logradouro" class="form-label">Logradouro:</label>
                        <input type="text" class="form-control" name="logradouro" id="logradouro" required>
                    </div>
                    <div class="col-md-4">
                        <label for="bairro" class="form-label">Bairro:</label>
                        <input type="text" class="form-control" name="bairro" id="bairro" required>
                    </div>
                    <div class="col-md-3">
                        <label for="numero" class="form-label">Nº:</label>
                        <input type="text" class="form-control" name="numero" id="numero" required>
                    </div>
                    <div class="col-md-4">
                        <label for="cep" class="form-label">CEP:</label>
                        <input type="text" class="form-control" name="cep" id="cep" required maxlength="8">
                    </div>
                    <div class="col-md-4">
                        <label for="cidade" class="form-label">Cidade:</label>
                        <input type="text" class="form-control" name="cidade" id="cidade" required>
                    </div>
                    <div class="col-md-4">
                        <label for="estado" class="form-label">Estado:</label>
                        <input type="text" class="form-control" name="estado" id="estado" required>
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