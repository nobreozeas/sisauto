<?php
session_start();
include_once 'Invoice.php';
$venda = new Invoice();
$venda->checkLoggedIn();

$id_venda = $_GET['id_venda'];

if(!empty($id_venda) && $id_venda) {
		
    $venda->deleteVenda($id_venda);
    $_SESSION['msg'] = "A venda foi deletada";
    header("Location: relatorio_vendas.php");
}

