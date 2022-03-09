-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 07-Mar-2022 às 04:14
-- Versão do servidor: 10.4.22-MariaDB
-- versão do PHP: 8.1.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `sisauto`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `cliente`
--

CREATE TABLE `cliente` (
  `id_cliente` int(11) NOT NULL,
  `tipo_cliente` varchar(100) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `documento` varchar(14) NOT NULL,
  `telefone` varchar(11) NOT NULL,
  `logradouro` varchar(100) NOT NULL,
  `bairro` varchar(100) NOT NULL,
  `numero` varchar(10) NOT NULL,
  `cep` varchar(10) NOT NULL,
  `cidade` varchar(100) NOT NULL,
  `estado` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `cliente`
--

INSERT INTO `cliente` (`id_cliente`, `tipo_cliente`, `nome`, `documento`, `telefone`, `logradouro`, `bairro`, `numero`, `cep`, `cidade`, `estado`) VALUES
(1, 'fisica', 'Ozeas Silva Nobre', '03357858240', '6832215218', 'Rua Seringueira', 'Vila Acre', '178', '69909-734', 'Rio Branco', 'AC'),
(2, 'juridica', 'trasnportadora rh', '17398456000187', '6832215123', 'Rua Seringueira', 'Vila Acre', '456', '69909734', 'rio branco', 'acre'),
(3, 'fisica', 'prefeitura de rio branco', '74586932000125', '6832245869', 'rua fulano de tal', 'centro', '123', '69909728', 'rio branco', 'acre');

-- --------------------------------------------------------

--
-- Estrutura da tabela `invoice_order`
--

CREATE TABLE `invoice_order` (
  `order_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `order_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `order_receiver_name` varchar(250) NOT NULL,
  `order_receiver_address` text NOT NULL,
  `order_total_before_tax` decimal(10,2) NOT NULL,
  `order_total_tax` decimal(10,2) NOT NULL,
  `order_tax_per` varchar(250) NOT NULL,
  `order_total_after_tax` double(10,2) NOT NULL,
  `order_amount_paid` decimal(10,2) NOT NULL,
  `order_total_amount_due` decimal(10,2) NOT NULL,
  `note` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `invoice_order`
--

INSERT INTO `invoice_order` (`order_id`, `user_id`, `order_date`, `order_receiver_name`, `order_receiver_address`, `order_total_before_tax`, `order_total_tax`, `order_tax_per`, `order_total_after_tax`, `order_amount_paid`, `order_total_amount_due`, `note`) VALUES
(2, 123456, '2021-01-31 14:03:42', 'abcd', 'Admin\r\nA - 4000, Ashok Nagar, New Delhi,\r\n 110096 India.\r\n12345678912\r\nadmin@phpzag.com', '342400.00', '684800.00', '200', 1027200.00, '45454.00', '981746.00', 'this note txt'),
(682, 123456, '2021-08-19 15:13:36', 'ABCD pvt ltd', 'New Delhi India', '750000.00', '7500.00', '1', 757500.00, '20000.00', '737500.00', 'this is a note'),
(683, 123456, '2021-08-19 16:54:15', 'XYZ', 'Newyork USA', '1320000.00', '26400.00', '2', 1346400.00, '20000.00', '1326400.00', 'some note');

-- --------------------------------------------------------

--
-- Estrutura da tabela `invoice_order_item`
--

CREATE TABLE `invoice_order_item` (
  `order_item_id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `item_code` varchar(250) NOT NULL,
  `item_name` varchar(250) NOT NULL,
  `order_item_quantity` decimal(10,2) NOT NULL,
  `order_item_price` decimal(10,2) NOT NULL,
  `order_item_final_amount` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `invoice_order_item`
--

INSERT INTO `invoice_order_item` (`order_item_id`, `order_id`, `item_code`, `item_name`, `order_item_quantity`, `order_item_price`, `order_item_final_amount`) VALUES
(4100, 2, '13555', 'Face Mask', '120.00', '2000.00', '240000.00'),
(4101, 2, '34', 'mobile', '10.00', '10000.00', '100000.00'),
(4102, 2, '34', 'mobile battery', '1.00', '34343.00', '34343.00'),
(4103, 2, '34', 'mobile cover', '10.00', '200.00', '2000.00'),
(4104, 2, '36', 'testing', '1.00', '2400.00', '2400.00'),
(4364, 682, '123456', 'iphone 6s', '12.00', '25000.00', '300000.00'),
(4365, 682, '345678', 'one plus', '10.00', '45000.00', '450000.00'),
(4368, 683, '00123', 'iphone 12', '10.00', '80000.00', '800000.00'),
(4369, 683, '00124', 'iphone 8', '13.00', '40000.00', '520000.00');

-- --------------------------------------------------------

--
-- Estrutura da tabela `invoice_user`
--

CREATE TABLE `invoice_user` (
  `id` int(11) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `first_name` varchar(100) NOT NULL,
  `last_name` varchar(100) NOT NULL,
  `mobile` bigint(20) NOT NULL,
  `address` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `invoice_user`
--

INSERT INTO `invoice_user` (`id`, `email`, `password`, `first_name`, `last_name`, `mobile`, `address`) VALUES
(123456, 'admin@phpzag.com', '12345', 'Admin', '', 12345678912, 'New Delhi 110096 India.');

-- --------------------------------------------------------

--
-- Estrutura da tabela `login`
--

CREATE TABLE `login` (
  `id_usuario` int(11) NOT NULL,
  `nome` varchar(200) NOT NULL,
  `usuario` varchar(200) NOT NULL,
  `senha` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `login`
--

INSERT INTO `login` (`id_usuario`, `nome`, `usuario`, `senha`) VALUES
(1, 'ozeas silva nobre', 'ozeasnobre', '12345'),
(2, 'joao da silva', 'joao', '123');

-- --------------------------------------------------------

--
-- Estrutura da tabela `ordem_servico`
--

CREATE TABLE `ordem_servico` (
  `id_ordem_servico` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `data_ordem_servico` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `id_cliente` int(11) DEFAULT NULL,
  `total_antes_taxa` float NOT NULL,
  `desconto_ordem_servico` float NOT NULL,
  `total_depois_taxa` float NOT NULL,
  `valor_pago` float NOT NULL,
  `valor_devido` float NOT NULL,
  `observacao` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `ordem_servico`
--

INSERT INTO `ordem_servico` (`id_ordem_servico`, `id_usuario`, `data_ordem_servico`, `id_cliente`, `total_antes_taxa`, `desconto_ordem_servico`, `total_depois_taxa`, `valor_pago`, `valor_devido`, `observacao`) VALUES
(2, 0, '2022-02-07 16:57:11', 0, 0, 0, 0, 0, 0, ''),
(3, 0, '2022-02-07 16:57:25', 0, 0, 0, 0, 0, 0, ''),
(4, 0, '2022-02-07 16:57:26', 0, 0, 0, 0, 0, 0, ''),
(5, 0, '2022-02-07 16:57:27', 0, 0, 0, 0, 0, 0, ''),
(6, 0, '2022-02-07 16:57:39', 0, 0, 0, 0, 0, 0, ''),
(7, 1, '2022-02-07 17:01:38', 0, 35, 5, 10, 10, 0, 'ddddddd'),
(8, 1, '2022-02-07 17:10:05', 0, 300, 10, 270, 270, 0, 'teste de notas'),
(10, 2, '2022-02-09 12:19:02', 0, 47.98, 5, 45.58, 45.58, 0, 'crcrr'),
(11, 0, '2022-02-10 19:00:13', 0, 0, 0, 0, 0, 0, ''),
(12, 1, '2022-02-16 09:51:42', 1, 68, 0, 68, 0, 68, 'isso é apenas um teste.'),
(13, 1, '2022-02-16 10:12:27', 2, 47.1, 0, 47.1, 0, 47.1, ''),
(14, 1, '2022-02-16 10:50:59', 1, 25.5, 10, 22.95, 22.95, 0, 'testes'),
(15, 1, '2022-02-16 10:51:59', 2, 273.69, 5, 260.01, 260.01, 0, 'teste'),
(16, 1, '2022-03-06 19:33:14', 1, 250, 10, 225, 0, 225, 'dfbdb');

-- --------------------------------------------------------

--
-- Estrutura da tabela `ordem_servico_item`
--

CREATE TABLE `ordem_servico_item` (
  `id_ordem_servico_item` int(11) NOT NULL,
  `id_ordem_servico` int(11) NOT NULL,
  `codigo_item` varchar(200) NOT NULL,
  `item_nome` varchar(200) NOT NULL,
  `item_quantidade` float NOT NULL,
  `item_preco` float NOT NULL,
  `valor_total_item` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `ordem_servico_item`
--

INSERT INTO `ordem_servico_item` (`id_ordem_servico_item`, `id_ordem_servico`, `codigo_item`, `item_nome`, `item_quantidade`, `item_preco`, `valor_total_item`) VALUES
(2, 7, '12', 'ddddd', 2, 10, 20),
(3, 7, '100', 'dddddsssss', 3, 5, 15),
(4, 8, '123', 'macarrao', 10, 20, 200),
(5, 8, '456', 'farinha', 5, 20, 100),
(7, 10, '1111', 'felipe alberto', 2, 23.99, 47.98),
(8, 12, '1', 'teste', 1, 23, 23),
(9, 12, '2', 'teste2', 1, 45, 45),
(10, 13, '', '', 2, 23.55, 47.1),
(11, 14, '1', 'lavadora', 1, 25.5, 25.5),
(12, 15, '2', 'verao', 2, 36.54, 73.08),
(13, 15, '1', 'teste', 3, 66.87, 200.61),
(14, 16, '1', 'jk,mh', 1, 250, 250);

-- --------------------------------------------------------

--
-- Estrutura da tabela `produto`
--

CREATE TABLE `produto` (
  `id_produto` int(11) NOT NULL,
  `nome` varchar(200) NOT NULL,
  `preco_custo` float NOT NULL,
  `preco_venda` float NOT NULL,
  `qtd_estoque` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `produto`
--

INSERT INTO `produto` (`id_produto`, `nome`, `preco_custo`, `preco_venda`, `qtd_estoque`) VALUES
(72, 'vela de ignição', 10.5, 78.33, 10),
(73, 'oleo de motor', 2.56, 25, 10),
(74, 'parabrisa palio', 125, 235.25, 2),
(75, 'motor de partida ', 123, 786.47, 10),
(76, 'escapamento fiat uno 1.0', 789, 1897.54, 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `vendas`
--

CREATE TABLE `vendas` (
  `id_venda` int(11) NOT NULL,
  `id_cliente` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `data_venda` date NOT NULL DEFAULT current_timestamp(),
  `total_venda` float NOT NULL,
  `forma_pagamento` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `vendas`
--

INSERT INTO `vendas` (`id_venda`, `id_cliente`, `id_usuario`, `data_venda`, `total_venda`, `forma_pagamento`) VALUES
(1, 2, 1, '2022-03-06', 1897.54, 'dinheiro'),
(2, 3, 1, '2022-03-06', 3795.08, 'cartao'),
(3, 3, 1, '2022-03-06', 1897.54, 'dinheiro'),
(4, 0, 1, '2022-03-06', 235.25, '#'),
(5, 0, 1, '2022-03-07', 0, ''),
(6, 1, 1, '2022-03-07', 235.25, 'cartao');

-- --------------------------------------------------------

--
-- Estrutura da tabela `vendas_produtos`
--

CREATE TABLE `vendas_produtos` (
  `id_vendas_produtos` int(11) NOT NULL,
  `id_venda` int(11) NOT NULL,
  `id_produto` int(11) NOT NULL,
  `qtd` int(11) NOT NULL,
  `preco_venda` float NOT NULL,
  `total` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `vendas_produtos`
--

INSERT INTO `vendas_produtos` (`id_vendas_produtos`, `id_venda`, `id_produto`, `qtd`, `preco_venda`, `total`) VALUES
(1, 1, 76, 1, 1897.54, 1897.54),
(2, 2, 76, 2, 1897.54, 3795.08),
(3, 3, 76, 1, 1897.54, 1897.54),
(4, 4, 74, 1, 235.25, 235.25),
(5, 6, 74, 1, 235.25, 235.25);

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `cliente`
--
ALTER TABLE `cliente`
  ADD PRIMARY KEY (`id_cliente`);

--
-- Índices para tabela `invoice_order`
--
ALTER TABLE `invoice_order`
  ADD PRIMARY KEY (`order_id`);

--
-- Índices para tabela `invoice_order_item`
--
ALTER TABLE `invoice_order_item`
  ADD PRIMARY KEY (`order_item_id`);

--
-- Índices para tabela `invoice_user`
--
ALTER TABLE `invoice_user`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `login`
--
ALTER TABLE `login`
  ADD PRIMARY KEY (`id_usuario`);

--
-- Índices para tabela `ordem_servico`
--
ALTER TABLE `ordem_servico`
  ADD PRIMARY KEY (`id_ordem_servico`);

--
-- Índices para tabela `ordem_servico_item`
--
ALTER TABLE `ordem_servico_item`
  ADD PRIMARY KEY (`id_ordem_servico_item`);

--
-- Índices para tabela `produto`
--
ALTER TABLE `produto`
  ADD PRIMARY KEY (`id_produto`);

--
-- Índices para tabela `vendas`
--
ALTER TABLE `vendas`
  ADD PRIMARY KEY (`id_venda`);

--
-- Índices para tabela `vendas_produtos`
--
ALTER TABLE `vendas_produtos`
  ADD PRIMARY KEY (`id_vendas_produtos`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `cliente`
--
ALTER TABLE `cliente`
  MODIFY `id_cliente` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de tabela `invoice_order`
--
ALTER TABLE `invoice_order`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=684;

--
-- AUTO_INCREMENT de tabela `invoice_order_item`
--
ALTER TABLE `invoice_order_item`
  MODIFY `order_item_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4370;

--
-- AUTO_INCREMENT de tabela `invoice_user`
--
ALTER TABLE `invoice_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=123457;

--
-- AUTO_INCREMENT de tabela `login`
--
ALTER TABLE `login`
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de tabela `ordem_servico`
--
ALTER TABLE `ordem_servico`
  MODIFY `id_ordem_servico` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT de tabela `ordem_servico_item`
--
ALTER TABLE `ordem_servico_item`
  MODIFY `id_ordem_servico_item` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT de tabela `produto`
--
ALTER TABLE `produto`
  MODIFY `id_produto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=77;

--
-- AUTO_INCREMENT de tabela `vendas`
--
ALTER TABLE `vendas`
  MODIFY `id_venda` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de tabela `vendas_produtos`
--
ALTER TABLE `vendas_produtos`
  MODIFY `id_vendas_produtos` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
