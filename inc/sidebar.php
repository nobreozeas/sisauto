<div class="sidebar">
  <h2><a href="">SISAUTO</a></h2>
  <ul>
      <li><a href="dash.php"><i class="fas fa-home"></i>Inicio</a></li>
      <li>
          <div class="dropend">
              <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-solid fa-coins"></i>Vendas</a>

                  <ul class="dropdown-menu" id="drop" aria-labelledby="dropdownMenuLink">
                      <li><a class="dropdown-item" href="lista_vendas.php"><i class="fas fa-solid fa-list"></i>Relatorio de Vendas</a></li>
                      <li><a class="dropdown-item" href="adiciona_venda.php"><i class="fas fa-solid fa-plus"></i>Nova Venda</a></li>
                  </ul>
          </div>
      </li>

      <li>
          <div class="dropend">
              <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-solid fa-wrench"></i>Ordem de Serviço</a>

                  <ul class="dropdown-menu" id="drop" aria-labelledby="dropdownMenuLink">
                      <li><a class="dropdown-item" href="lista_ordem_servico.php"><i class="fas fa-solid fa-list"></i>Listar OS</a></li>
                      <li><a class="dropdown-item" href="ordem_servico.php"><i class="fas fa-solid fa-plus"></i>Adicionar OS</a></li>
                  </ul>
          </div>
      </li>

      <li>
          <div class="dropend">
              <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-solid fa-barcode"></i>Produtos</a>

                  <ul class="dropdown-menu" id="drop" aria-labelledby="dropdownMenuLink">
                      <li><a class="dropdown-item" href="lista_produto.php"><i class="fas fa-solid fa-list"></i>Listar Produtos</a></li>
                      <li><a class="dropdown-item" href="adiciona_produto.php"><i class="fas fa-solid fa-plus"></i>Adicionar Produto</a></li>
                  </ul>
          </div>
      </li>

      <li>
          <div class="dropend">
              <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-solid fa-users"></i>Clientes</a>

                  <ul class="dropdown-menu" id="drop" aria-labelledby="dropdownMenuLink">
                      <li><a class="dropdown-item" href="lista_clientes.php"><i class="fas fa-solid fa-list"></i>Listar Clientes</a></li>
                      <li><a class="dropdown-item" href="adiciona_cliente.php"><i class="fas fa-solid fa-plus"></i>Adicionar Cliente</a></li>
                  </ul>
          </div>
      </li>

     
      <li><a href="#" data-bs-toggle="modal" data-bs-target="#exampleModal"><i class="fas fa-solid fa-question"></i>Ajuda</a></li>
      <li><a href="action.php?action=logout"><i class="fas fa-solid fa-power-off"></i>Sair</a></li>
  </ul>
</div>


<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Suporte</h5>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="col-md-6"><img src="../imagens/suporte.png" alt="" width="200"></div>
          <div class="col-md-6"><p>Para suporte relacionado ao uso do <strong>SISAUTO</strong>, por favor contactar o administrador do sistema.</p></div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Entendi</button>
      </div>
    </div>
  </div>
</div>