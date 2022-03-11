<?php
$servidor = "localhost";
$usuario = "root";
$senha = "";
$dbname = "sisauto";

//Criar a conexão
$conn = mysqli_connect($servidor, $usuario, $senha, $dbname);
?>
<?Php
class Invoice{
	private $host  = 'localhost';
    private $user  = 'root';
    private $password   = "";
    private $database  = "sisauto";   
	private $invoiceUserTable = 'login';	
	private $ordemServicoTable = 'ordem_servico';
	private $ordemServicoItemTable = 'ordem_servico_item';
	private $productTable = 'produto';
	private $clientTable = 'cliente';
	private $dbConnect = false;
    public function __construct(){
        if(!$this->dbConnect){ 
            $conn = new mysqli($this->host, $this->user, $this->password, $this->database);
            if($conn->connect_error){
                die("Error failed to connect to MySQL: " . $conn->connect_error);
            }else{
                $this->dbConnect = $conn;
            }
        }
    }
	public function getData($sqlQuery) {
		$result = mysqli_query($this->dbConnect, $sqlQuery);
		if(!$result){
			die('Error in query: '. mysqli_error());
		}
		$data= array();
		while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
			$data[]=$row;            
		}
		return $data;
	}
	public function getNumRows($sqlQuery) {
		$result = mysqli_query($this->dbConnect, $sqlQuery);
		if(!$result){
			die('Error in query: '. mysqli_error());
		}
		$numRows = mysqli_num_rows($result);
		return $numRows;
	}
	public function loginUsers($usuario, $password){
		$sqlQuery = "
			SELECT id_usuario, nome, usuario, senha
			FROM ".$this->invoiceUserTable." 
			WHERE usuario='".$usuario."' AND senha='".$password."'";
        return  $this->getData($sqlQuery);
	}	
	public function checkLoggedIn(){
		if(!$_SESSION['id_usuario']) {
			header("Location:dash.php");
		}
	}	

	public function saveOrdemServico($POST) {		
		$sqlInsert = "
			INSERT INTO ".$this->ordemServicoTable."(id_usuario, id_cliente, total_antes_taxa, desconto_ordem_servico, total_depois_taxa, valor_pago, valor_devido, observacao) 
			VALUES ('".$POST['id_usuario']."', '".$POST['cliente']."', '".$POST['subTotal']."', '".$POST['taxRate']."','".$POST['totalAftertax']."', '".$POST['amountPaid']."', '".$POST['amountDue']."', '".$POST['notes']."')";		
		mysqli_query($this->dbConnect, $sqlInsert);
		$lastInsertId = mysqli_insert_id($this->dbConnect);
		for ($i = 0; $i < count($POST['productCode']); $i++) {
			$sqlInsertItem = "
			INSERT INTO ".$this->ordemServicoItemTable."(id_ordem_servico, codigo_item, item_nome, item_quantidade, item_preco, valor_total_item) 
			VALUES ('".$lastInsertId."', '".$POST['productCode'][$i]."', '".$POST['productName'][$i]."', '".$POST['quantity'][$i]."', '".$POST['price'][$i]."', '".$POST['total'][$i]."')";			
			mysqli_query($this->dbConnect, $sqlInsertItem);
		}       	
	}	

	public function saveProduto($POST) {	
		$pc = $POST['preco_custo'];
		$pv = $POST['preco_venda'];	
		$sqlInsert = "
			INSERT INTO ".$this->productTable."(nome, preco_custo, preco_venda, qtd_estoque) 
			VALUES ('".$POST['nome_produto']."', '".$pc."', '".$pv."', '".$POST['estoque']."')";		
		mysqli_query($this->dbConnect, $sqlInsert);
	}	

	public function saveCliente($POST) {	
		$sqlInsert = "
			INSERT INTO ".$this->clientTable."(tipo_cliente, nome, documento, telefone, logradouro, bairro, numero, cep, cidade, estado) 
			VALUES ('".$POST['tipo_cliente']."', '".$POST['nome_cliente']."', '".$POST['documento']."', '".$POST['telefone']."','".$POST['logradouro']."','".$POST['bairro']."','".$POST['numero']."', '".$POST['cep']."', '".$POST['cidade']."', '".$POST['estado']."')";		
		mysqli_query($this->dbConnect, $sqlInsert);
	}	

	/*public function saveInvoice($POST) {		
		$sqlInsert = "
			INSERT INTO ".$this->invoiceOrderTable."(user_id, order_receiver_name, order_receiver_address, order_total_before_tax, order_tax_per, order_total_after_tax, order_amount_paid, order_total_amount_due, note) 
			VALUES ('".$POST['userId']."', '".$POST['companyName']."', '".$POST['address']."', '".$POST['subTotal']."', '".$POST['taxAmount']."', '".$POST['taxRate']."', '".$POST['totalAftertax']."', '".$POST['amountPaid']."', '".$POST['amountDue']."', '".$POST['notes']."')";		
		mysqli_query($this->dbConnect, $sqlInsert);
		$lastInsertId = mysqli_insert_id($this->dbConnect);
		for ($i = 0; $i < count($POST['productCode']); $i++) {
			$sqlInsertItem = "
			INSERT INTO ".$this->invoiceOrderItemTable."(order_id, item_code, item_name, order_item_quantity, order_item_price, order_item_final_amount) 
			VALUES ('".$lastInsertId."', '".$POST['productCode'][$i]."', '".$POST['productName'][$i]."', '".$POST['quantity'][$i]."', '".$POST['price'][$i]."', '".$POST['total'][$i]."')";			
			mysqli_query($this->dbConnect, $sqlInsertItem);
		}       	
	}	*/
	public function updateInvoice($POST) {
		if($POST['id_ordem_servico']) {	
			$sqlInsert = "
				UPDATE ".$this->ordemServicoTable." 
				SET cliente = '".$POST['companyName']."', total_antes_taxa = '".$POST['subTotal']."',desconto_ordem_servico = '".$POST['taxRate']."', total_depois_taxa = '".$POST['totalAftertax']."', valor_pago = '".$POST['amountPaid']."', valor_devido = '".$POST['amountDue']."', observacao = '".$POST['notes']."' 
				WHERE id_usuario = '".$POST['id_usario']."' AND id_ordem_servico = '".$POST['id_ordem_servico']."'";		
			mysqli_query($this->dbConnect, $sqlInsert);	
		}		
		$this->deleteInvoiceItems($POST['id_ordem_servico']);
		for ($i = 0; $i < count($POST['productCode']); $i++) {			
			$sqlInsertItem = "
			INSERT INTO ".$this->ordemServicoItemTable."(id_ordem_servico, codigo_item, item_nome, item_quantidade, item_preco, valor_total_item) 
			VALUES ( '".$POST['id_ordem_servico']."', '".$POST['productCode'][$i]."', '".$POST['productName'][$i]."', '".$POST['quantity'][$i]."', '".$POST['price'][$i]."', '".$POST['total'][$i]."')";			
			mysqli_query($this->dbConnect, $sqlInsertItem);			
		}       	
	}	
	public function getInvoiceList(){
		$sqlQuery = "
			SELECT * FROM ".$this->ordemServicoTable." AS OST
			LEFT JOIN ".$this->invoiceUserTable." L ON OST.id_usuario = L.id_usuario";
		return  $this->getData($sqlQuery);
	}	
	public function getInvoice($invoiceId){
		$sqlQuery = "
			SELECT * FROM ".$this->ordemServicoTable." 
			WHERE id_usuario = '".$_SESSION['id_usuario']."' AND id_ordem_servico = '$invoiceId'";
		$result = mysqli_query($this->dbConnect, $sqlQuery);	
		$row = mysqli_fetch_array($result, MYSQLI_ASSOC);
		return $row;
	}

	public function getVenda($id_venda){
		$sqlQuery = "SELECT v.id_venda, v.data_venda, v.total_venda, v.forma_pagamento, c.nome AS nome_cliente, c.documento, c.telefone, c.logradouro, c.bairro, c.numero, c.cep, c.cidade, c.estado, l.nome AS nome_usuario FROM vendas v LEFT JOIN cliente c ON v.id_cliente = c.id_cliente LEFT JOIN login l ON l.id_usuario = v.id_usuario WHERE v.id_venda = '$id_venda'";
		$result = mysqli_query($this->dbConnect, $sqlQuery);	
		$row = mysqli_fetch_array($result, MYSQLI_ASSOC);
		return $row;
	}
	public function getVendaItem($id_venda){
		$sqlQuery = "SELECT vp.id_produto, vp.qtd, vp.preco_venda, vp.total, p.nome FROM vendas_produtos vp JOIN produto p ON vp.id_produto = p.id_produto WHERE vp.id_venda = '$id_venda'";
		return  $this->getData($sqlQuery);	
	}

	public function getInvoiceItems($invoiceId){
		$sqlQuery = "
			SELECT * FROM ".$this->ordemServicoItemTable." 
			WHERE id_ordem_servico = '$invoiceId'";
		return  $this->getData($sqlQuery);	
	}
	public function deleteInvoiceItems($invoiceId){
		$sqlQuery = "
			DELETE FROM ".$this->ordemServicoItemTable." 
			WHERE id_ordem_servico = '".$invoiceId."'";
		mysqli_query($this->dbConnect, $sqlQuery);				
	}
	public function deleteInvoice($invoiceId){
		$sqlQuery = "
			DELETE FROM ".$this->ordemServicoTable." 
			WHERE id_ordem_servico = '".$invoiceId."'";
		mysqli_query($this->dbConnect, $sqlQuery);	
		$this->deleteInvoiceItems($invoiceId);	
		return 1;
	}

	public function getProductList(){
		$sqlQuery = "
			SELECT id_produto, nome, preco_custo,preco_venda, qtd_estoque, preco_venda-preco_custo as lucro FROM ".$this->productTable."";
		return  $this->getData($sqlQuery);
	}	

	public function somaProdutos(){
		$sqlQuery = "
			SELECT count(*) as contagem,sum(preco_custo) as soma_preco_custo, sum(preco_venda) as soma_preco_venda, sum(preco_venda)-sum(preco_custo) as lucro  FROM ".$this->productTable."";
		return  $this->getData($sqlQuery);
	}	
}
?>