<?php
session_start();
include 'Invoice.php';
$invoice = new Invoice();
$invoice->checkLoggedIn();


$pagina = (isset($_GET['pagina'])) ? $_GET['pagina'] : 1;

//Selecionar todos os cursos da tabela
$result_produto = "SELECT * FROM produto";
$resultado_produto = mysqli_query($conn, $result_produto);

//Contar o total de cursos
$total_produtos = mysqli_num_rows($resultado_produto);

//Seta a quantidade de cursos por pagina
$quantidade_pg = 20;

//calcular o número de pagina necessárias para apresentar os cursos
$num_pagina = ceil($total_produtos / $quantidade_pg);

//Calcular o inicio da visualizacao
$inicio = ($quantidade_pg * $pagina) - $quantidade_pg;

//Selecionar os cursos a serem apresentado na página
$result_produtos = "SELECT * FROM produto ORDER BY id_produto DESC limit $inicio, $quantidade_pg";
$resultado_produtos = mysqli_query($conn, $result_produtos);
$total_produtos = mysqli_num_rows($resultado_produtos);

?>

<?php include("../inc/header.php"); ?>

<body>


    <div class="wrapper">
    <?php include("../inc/sidebar.php"); ?>

        <div class="main_content">
            <div class="header">Olá <?php echo $_SESSION['usuario']; ?> Seja Bem vindo!!!</div>
            <div class="info">
                <?php if ($total_produtos == 0) {
                    echo '<div>Não existem produtos cadastrados.</div>';
                } else { ?>
                    <div class="table-responsive align-middle">
                        <table class="table table-md table-bordered align-middle table-striped table-hover container text-center" style="text-transform: uppercase;">
                            <thead>
                                <tr>
                                    <th scope="col">Codigo</th>
                                    <th scope="col">Nome</th>
                                    <th scope="col">Preço de Compra</th>
                                    <th scope="col">Preço de Venda</th>
                                    <th scope="col">Estoque</th>
                                    <th scope="col">Editar</th>
                                    <th scope="col">Excluir</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php while ($rows_cursos = mysqli_fetch_assoc($resultado_produtos)) { ?>

                                    <tr>
                                        <td><?php echo $rows_cursos['id_produto']; ?></td>
                                        <td><?php echo $rows_cursos['nome']; ?></td>
                                        <td>
                                            <?php
                                            $preco_custo = number_format($rows_cursos["preco_custo"], 2, ',', '.');
                                            echo $preco_custo;
                                            ?>
                                        </td>
                                        <td>
                                            <?php
                                            $preco_venda = number_format($rows_cursos["preco_venda"], 2, ',', '.');
                                            echo $preco_venda;
                                            ?>
                                        </td>
                                        <td>
                                            <?php if($rows_cursos['qtd_estoque']<=2){?>
                                                <p style="padding: 0px; margin:0px" class="text-danger"><?= $rows_cursos["qtd_estoque"]; ?></p>
                                            <?php    }else{ echo $rows_cursos["qtd_estoque"];} ?>
                                            
                                        </td>

                                        <td><a href="edit_invoice.php?update_id=' . $productDetails['id_produto']."  title="Edit Invoice" style="color: green"><i class="fa-solid fa-pen-to-square"></i></a></td>
                <td><a href="action.php" id="' . $productDetails['id_produto'] . '" class="deleteInvoice"  title="Delete Invoice"  style="color: red"><i class="fa-solid fa-trash"></i></a></td>
              </tr>
               <?php } ?>
        </tbody>
       
        </table>
        <?php
                    $pagina_anterior = $pagina - 1;
                    $pagina_posterior = $pagina + 1;
        ?>
            <nav aria-label="...">
                <ul class="pagination nav justify-content-center" style="margin-top:10px;">
                    <li class="page-item">
                        <?php if ($pagina_anterior != 0) { ?>
                            
                        <a href="lista_produto.php?pagina=<?php echo $pagina_anterior; ?>">
                        <span class="page-link">Ant</span></a>
                        <?php } else { ?>
                            <span class="page-link">Ant</span></a>

                            <?php } ?>
                    </li>

                    <?php
                    for ($i = 1; $i < $num_pagina + 1; $i++) { ?>
                            <li class="page-item"><a class="page-link" href="lista_produto.php?pagina=<?php echo $i; ?>"><?php echo $i; ?></a></li>
                        <?php } ?>



                        <li class="page-item">
                        <?php if ($pagina_posterior <= $num_pagina) { ?>
                            
                        <a href="lista_produto.php?pagina=<?php echo $pagina_posterior; ?>">
                        <span class="page-link">Prox</span></a>
                        <?php } else { ?>
                            <span class="page-link">Prox</span></a>

                            <?php } ?>
                    </li>
                </ul>
            </nav>

       
        </div>
    </div>
    <?php } ?>
    <?php include("../inc/footer.php"); ?>
</body>

</html>