<?php

include("Invoice.php");
$invoice = new Invoice();
$invoice->checkLoggedIn();

$palavra = $_POST['palavra'];

$sql = "SELECT * FROM produto WHERE nome LIKE '%$palavra%' LIMIT 20";

$resultado_produto = mysqli_query($conn, $sql);

if(($resultado_produto) && ($resultado_produto->num_rows != 0)){
  while($row_produto = $resultado_produto->fetch_array()){
    echo "
    <tr>
    <td>".$row_produto['id_produto']."</td>
    <td>".$row_produto['nome']."</td>
    <td>".$row_produto['preco_venda']."</td>
    <td>".$row_produto['qtd_estoque']."</td>
    </tr>
    ";
  }
}else{
  echo "Nenhum produto encontrado";
}



?>