<?php

include ("Invoice.php");

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $stmt = $conn->prepare("INSERT INTO vendas (id_cliente, id_usuario, total_venda, forma_pagamento) VALUES (?,?,?,?)");
    $stmt->bind_param("iids", $id_cliente, $id_usuario, $total_venda, $forma_pagamento);

    $id_cliente = $_POST['id_cliente'];
    $id_usuario = $_POST['id_usuario'];
    $total_venda = $_POST['total_venda'];
    $forma_pagamento = $_POST['forma_pagamento'];

    if($stmt->execute()){
        $last_id = $conn->insert_id;
    }

    $relacao_lista = $_POST['data'];

    for($i=0;$i < count($relacao_lista); $i++){
        $stmt1 = $conn->prepare("INSERT INTO vendas_produtos (id_venda, id_produto, qtd, preco_venda, total) VALUES (?,?,?,?,?)");
        $stmt1->bind_param("iiidd", $last_id, $codigo_produto, $qtd, $preco_venda, $total_produto);

        $codigo_produto = $relacao_lista[$i]['codigo_produto'];
        $qtd = $relacao_lista[$i]['quantidade_produto'];
        $preco_venda = $relacao_lista[$i]['preco_produto'];
        $total_produto = $relacao_lista[$i]['total_produto'];

        if($stmt1->execute()){

            $stmt2 = $conn->prepare("UPDATE produto SET qtd_estoque = qtd_estoque-? WHERE id_produto = ?");
            $stmt2->bind_param("ii", $qtd, $codigo_produto);
            $stmt2->execute();

        }else{
            echo "error";

        }

        $stmt1->close();
        $stmt2->close();
    
    }
    

}

echo json_encode(array());
    $stmt->close();