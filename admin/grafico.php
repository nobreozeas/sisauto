<?php

include("Invoice.php");

$sql = "SELECT id_venda, sum(total_venda) total, MONTH(data_venda) as mes, YEAR(data_venda) ano, DATE_FORMAT(data_venda, '%m/%Y') as data_v FROM vendas WHERE data_venda BETWEEN CURDATE() - INTERVAL 1 YEAR AND CURDATE() GROUP BY MONTH(data_venda) ORDER BY data_venda";

$stmt = mysqli_query($conn, $sql);

while($resultado = $stmt->fetch_array()){
    $resultado_arr[] = $resultado; 
}
echo json_encode($resultado_arr);