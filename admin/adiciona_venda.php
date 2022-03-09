<?php
session_start();
include 'Invoice.php';
$invoice = new Invoice();
$invoice->checkLoggedIn();

if (!empty($_POST['cliente']) && $_POST['cliente']) {
  //$invoice->saveOrdemServico($_POST);
  header("Location:../index.php");
}

$cliente = "SELECT * FROM cliente";
$resultado_cliente = mysqli_query($conn, $cliente);

$venda = "SELECT id_venda FROM vendas ORDER BY id_venda DESC limit 1";
$r = mysqli_query($conn, $venda);

?>

<?php include("../inc/header.php"); ?>

<body>

  <div class="wrapper">
    <?php include("../inc/sidebar.php"); ?>


    <div class="main_content">
      <div class="header">Olá <?php echo $_SESSION['usuario']; ?> Seja Bem vindo!!!</div>
      <div class="info">
        <!-- Button trigger modal -->
        <div class="row">
          <div class="col-md-3">
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalproduto">
              Pesquisar Produto
            </button>
          </div>
        </div>
        <caption>Adicionar Produto</caption>
        <form id="form-produto">
          <table class="table table-bordered">
            <tr>
              <th>Cod Produto</th>
              <th>Nome</th>
              <th>Preço</th>
              <th>Quantidade</th>
              <th>Total</th>
              <th>Ação</th>
            </tr>

            <tr>
              <td width=3>
                <input type="text" class="form-control" id="codigo_produto" name="codigo_produto" placeholder="codigo" required autofocus="on">
              </td>
              <td>
                <input type="text" class="form-control" id="nome_produto" name="nome_produto" placeholder="nome" disabled="disabled">
              </td>
              <td>
                <input type="text" class="form-control" id="preco_produto" name="preco_produto" placeholder="preco" disabled="disabled">
              </td>
              <td>
                <input type="number" class="form-control" id="quantidade_produto" name="quantidade_produto" placeholder="quantidade" min="1" value="1" required>
              </td>
              <td>
                <input type="text" class="form-control" id="total_produto" name="total_produto" placeholder="total" disabled="disabled">
              </td>
              <td>
                <button type="button" class="btn btn-success" id="btnAddProd" onclick="adicionaProduto(); foc()">Adicionar</button>
              </td>
            </tr>
          </table>
        </form>
        <caption>Produtos</caption>
        <table class="table table-bordered" id="listaProduto">
          <thead>
            <tr>
              <th>Remover</th>
              <th>Codigo Produto</th>
              <th>Nome</th>
              <th>Preço Unit.</th>
              <th>Quantidade</th>
              <th>Subtotal</th>
            </tr>
          </thead>

          <tbody></tbody>
        </table>
        
        <div class="row">
          <div class="col-md-4">
            <label style="color: black;"><strong>Total</strong></label>
            <input type="text" class="form-control" id="total_venda" name="total_venda" placeholder="Total" disabled="disabled">
          </div>
          <div class="col-md-4">
              <label for="cliente">Cliente:</label>
              <select class="form-select" name="id_cliente" id="id_cliente" required>
                <option value="">Selecione</option>
                <?php while ($dado = $resultado_cliente->fetch_array()) { ?>
                <option value="<?php echo $dado['id_cliente']; ?>"><?php echo strtoupper($dado['nome']); ?> - <?php echo $dado['documento']; ?></option>
                <?php } ?>
              </select>
          </div>
          <div class="col-md-4">
            <label style="color: black;"><strong>Forma de Pagamento</strong></label>
            <select name="forma_pagamento" id="forma_pagamento" class="form-select" required>
              <option value="">Selecione</option>
              <option value="dinheiro">Dinheiro</option>
              <option value="cartao">Cartão</option>
            </select>
          </div>
        </div>
        <div class="row">
            <div class="col-md-3">
              <input type="hidden" value="<?php echo $_SESSION['id_usuario']; ?>" class="form-control" name="id_usuario" id="id_usuario">
              <button class="btn btn-primary form-control" id="btn-salva-venda" onclick="addVenda()">Salvar</button>
            </div>
            <div class="col-md-3">
              <button class="btn btn-warning form-control">Cancelar</button>
            </div>
          </div>


        <!-- Modal -->
        <div class="modal fade" id="modalproduto" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Pesquisar Produto</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
                <form action="pesquisa.php" method="POST">
                  <div class="input-group mb-3">
                    <input type="text" class="form-control" name="pesquisa" id="pesquisa" placeholder="Buscar...">
                  </div>
                </form>
                <table class="table">
                  <thead>
                    <th>Cod.</th>
                    <th>Nome</th>
                    <th>Preço</th>
                    <th>Qtd</th>
                  </thead>
                  <tbody class="resultado"></tbody>
                </table>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
              </div>
            </div>
          </div>
        </div>
        <!-- vams la -->

        <div class="modal fade" id="modal_sucesso_cad" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-body">
        <h3 class="text-success text-center">Venda adicionada com Sucesso!</h3>

        <?php while ($d = $r->fetch_array()) { ?>
                <h5>Codigo da Venda: #<?= $d['id_venda']+1; ?></h5>
                <?php } ?>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-success" data-bs-dismiss="modal" onclick="refresh()">OK</button>
      </div>
    </div>
  </div>
</div>


      </div>
    </div>
  </div>
  <?php include("../inc/footer.php"); ?>
</body>
</html>