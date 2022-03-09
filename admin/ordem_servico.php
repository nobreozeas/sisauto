<?php
session_start();
include 'Invoice.php';
$invoice = new Invoice();
$invoice->checkLoggedIn();

if (!empty($_POST['cliente']) && $_POST['cliente']) {
  $invoice->saveOrdemServico($_POST);
  header("Location:dash.php");
}

$cliente = "SELECT * FROM cliente";
$resultado_cliente = mysqli_query($conn, $cliente);
?>

<?php include("../inc/header.php"); ?>



<body>



  <div class="wrapper">
  <?php include("../inc/sidebar.php"); ?>


    <div class="main_content">
      <div class="header">Olá <?php echo $_SESSION['usuario']; ?> Seja Bem vindo!!!</div>
      <div class="info">
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
          <h1 class="h2">Ordem de Serviço</h1>
        </div>
        <div class="row">
          <form action="" id="invoice-form" method="post" class="invoice-form" role="form" novalidate="">
            <div class="load-animate animated fadeInUp">
              <input id="currency" type="hidden" value="$">
              <div class="row">
                <div class="col" style="margin-bottom: 20px;">

                <div class="form-group">
                        <label for="cliente">Cliente:</label>
                        <select class="form-select" name="cliente" id="cliente">
                          <option value="0">Selecione</option>
                          <?php while ($dado = $resultado_cliente->fetch_array()) { ?>
                            <option value="<?php echo $dado['id_cliente']; ?>"><?php echo $dado['nome']; ?></option>
                          <?php } ?>
                        </select>
                      </div>
                </div>
              </div>
              <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                  <table class="table table-bordered table-hover" id="invoiceItem">
                    <tr>
                      <th width="2%"><input id="checkAll" class="formcontrol" type="checkbox"></th>
                      <th width="15%">Codigo</th>
                      <th width="38%">Nome</th>
                      <th width="15%">Quantidade</th>
                      <th width="15%">Preço</th>
                      <th width="15%">Total</th>
                    </tr>
                    <tr>
                      <td><input class="itemRow" type="checkbox"></td>
                      <td><input type="text" name="productCode[]" id="productCode_1" class="form-control" autocomplete="off"></td>
                      <td><input type="text" name="productName[]" id="productName_1" class="form-control" autocomplete="off"></td>
                      <td><input type="number" name="quantity[]" id="quantity_1" class="form-control quantity" autocomplete="off"></td>
                      <td><input type="number" name="price[]" id="price_1" class="form-control price" autocomplete="off"></td>
                      <td><input type="number" name="total[]" id="total_1" class="form-control total" autocomplete="off"></td>
                    </tr>
                  </table>
                </div>
              </div>
              <div class="row">
                <div class="col-xs-12 col-sm-3 col-md-3 col-lg-3">
                  <button class="btn btn-danger delete" id="removeRows" type="button">- Deletar</button>
                  <button class="btn btn-success" id="addRows" type="button">+ Adicionar</button>
                </div>
              </div>
              <div class="row">
                <div class="col-xs-12 col-sm-8 col-md-8 col-lg-8">
                  <h3>Observações: </h3>
                  <div class="form-group">
                    <textarea class="form-control txt" rows="5" name="notes" id="notes" placeholder="Insira aqui as observações"></textarea>
                  </div>
                  <br>
                  <div class="form-group">
                    <input type="hidden" value="<?php echo $_SESSION['id_usuario']; ?>" class="form-control" name="id_usuario">
                    <input data-loading-text="Saving Invoice..." type="submit" name="invoice_btn" value="Salvar Ordem de Serviço" class="btn btn-success submit_btn invoice-save-btm">
                  </div>

                </div>
                <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
                  <span class="form-inline">
                    <div class="form-group">
                      <label>Subtotal: &nbsp;</label>
                      <div class="input-group">
                        <input value="" type="number" class="form-control" name="subTotal" id="subTotal" placeholder="Subtotal">
                      </div>
                    </div>
                    <div class="form-group">
                      <label>Desconto (%): &nbsp;</label>
                      <div class="input-group">
                        <input value="" type="number" class="form-control" name="taxRate" id="taxRate" placeholder="Desconto (%)">
                      </div>
                    </div>
                    <div class="form-group">
                      <label>Total: &nbsp;</label>
                      <div class="input-group">
                        <input value="" type="number" class="form-control" name="totalAftertax" id="totalAftertax" placeholder="Total">
                      </div>
                    </div>
                    <div class="form-group">
                      <label>Valor Pago: &nbsp;</label>
                      <div class="input-group">
                        <input value="" type="number" class="form-control" name="amountPaid" id="amountPaid" placeholder="Valor Pago">
                      </div>
                    </div>
                    <div class="form-group">
                      <label>Troco: &nbsp;</label>
                      <div class="input-group">
                        <input value="" type="number" class="form-control" name="amountDue" id="amountDue" placeholder="Troco">
                      </div>
                    </div>
                  </span>
                </div>
              </div>
              <div class="clearfix"></div>
            </div>
          </form>
        </div>
      </div>

    </div>
  </div>

  <?php include("../inc/footer.php"); ?>


  <!-- inicio da ordem de serviço- -->


</body>

</html>