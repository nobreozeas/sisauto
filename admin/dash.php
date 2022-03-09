<?php
session_start();
include 'Invoice.php';
$invoice = new Invoice();
$invoice->checkLoggedIn();

?>
<?php include("../inc/header.php"); ?>

<body>



    <div class="wrapper">

        <?php include("../inc/sidebar.php"); ?>
        <div class="main_content">
            <div class="header">Olá <?php echo $_SESSION['usuario']; ?> Seja Bem vindo!!!</div>
            <div class="info">
                <div class="banner" style="margin-left:200px">
                <img src="../imagens/banner.png" alt="" width="720px">
                </div>
                
            </div>

        </div>
    </div>

<?php include("../inc/footer.php"); ?>
</body>

</html>