<?php
include "Invoice.php";

$codigo_produto = $_POST['codigo_produto'];

$stmt = $conn->prepare("SELECT * FROM produto WHERE id_produto = ?");

$stmt-> bind_param("s", $codigo_produto);

$stmt->bind_result($id_produto, $nome, $preco_custo, $preco_venda, $qtd_estoque);

if($stmt->execute()){

    while($stmt->fetch()){
        $saida[] = array("id_produto"=>$id_produto, "nome"=>$nome, "preco_custo"=>$preco_custo, "preco_venda"=>$preco_venda, "qtd_estoque"=>$qtd_estoque);
    }
    echo json_encode($saida);

}

$stmt->close();
