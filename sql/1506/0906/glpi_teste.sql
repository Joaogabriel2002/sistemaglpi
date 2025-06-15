-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 09/06/2025 às 22:42
-- Versão do servidor: 10.4.32-MariaDB
-- Versão do PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `glpi_teste`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `atualizacoes`
--

CREATE TABLE `atualizacoes` (
  `id_atualizacao` int(20) NOT NULL,
  `chamadoId` int(20) DEFAULT NULL,
  `dt_atualizacao` datetime NOT NULL DEFAULT current_timestamp(),
  `tecnico` varchar(100) DEFAULT NULL,
  `comentario` varchar(300) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `atualizacoes`
--

INSERT INTO `atualizacoes` (`id_atualizacao`, `chamadoId`, `dt_atualizacao`, `tecnico`, `comentario`) VALUES
(68, 1027, '2025-06-04 19:38:20', 'João', 'OI'),
(69, 1028, '2025-06-05 19:23:23', 'João', 'Estou verificando...'),
(72, 1029, '2025-06-05 20:13:04', 'João', 'teste'),
(73, 1031, '2025-06-05 21:22:11', 'João', '.'),
(74, 1031, '2025-06-05 21:22:14', 'João', '..'),
(75, 1031, '2025-06-05 21:22:17', 'João', 'a'),
(76, 1031, '2025-06-05 21:22:21', 'João', 'a'),
(77, 1031, '2025-06-05 21:22:27', 'João', 'aaa'),
(78, 1031, '2025-06-05 21:22:31', 'João', 'aaaa'),
(79, 1031, '2025-06-05 21:22:35', 'João', 'aaaa'),
(80, 1033, '2025-06-05 21:42:02', 'João', 'n'),
(83, 1034, '2025-06-07 14:56:15', 'João', 'teste'),
(84, 1035, '2025-06-07 15:06:13', 'João', 'a'),
(85, 1040, '2025-06-09 15:58:42', 'João', 'Verificando...');

-- --------------------------------------------------------

--
-- Estrutura para tabela `chamados`
--

CREATE TABLE `chamados` (
  `chamadoId` int(20) NOT NULL,
  `status` varchar(20) NOT NULL,
  `tipoChamado` varchar(20) DEFAULT NULL,
  `tituloChamado` varchar(60) NOT NULL,
  `descricaoChamado` varchar(1000) DEFAULT NULL,
  `dtAbertura` datetime NOT NULL DEFAULT current_timestamp(),
  `dtFechamento` datetime DEFAULT NULL,
  `autorId` int(11) DEFAULT NULL,
  `autorNome` varchar(40) NOT NULL,
  `autorEmail` varchar(60) NOT NULL,
  `autorSetor` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `chamados`
--

INSERT INTO `chamados` (`chamadoId`, `status`, `tipoChamado`, `tituloChamado`, `descricaoChamado`, `dtAbertura`, `dtFechamento`, `autorId`, `autorNome`, `autorEmail`, `autorSetor`) VALUES
(1027, 'Cancelado', NULL, 'Teste', 'teste', '2025-06-04 19:38:07', NULL, 20, 'João', 'joao.gabriel@chesiquimica.com.br', 'TI'),
(1028, 'Fechado', 'Baixa', 'Problema impressora', 'Estou com problema na minha impressora', '2025-06-05 19:22:20', '2025-06-05 19:23:55', 22, 'Willian', 'willian@gmail.com', 'Comercial'),
(1029, 'Fechado', 'Média', 'teste', 'teste', '2025-06-05 19:24:52', '2025-06-05 21:14:55', 22, 'Willian', 'willian@gmail.com', 'Comercial'),
(1030, 'Fechado', 'Alta', 'Chamado Teste', 'teste', '2025-06-05 19:31:51', '2025-06-05 19:32:29', 20, 'João', 'joao.gabriel@chesiquimica.com.br', 'TI'),
(1031, 'Fechado', 'Baixa', 'Teste', 'teste', '2025-06-05 19:39:27', '2025-06-05 21:22:41', 24, 'Ryan', 'ryan@gmail.com', 'Saneantes'),
(1032, 'Cancelado', NULL, 'tete', 'aa', '2025-06-05 21:25:38', NULL, 20, 'João', 'joao.gabriel@chesiquimica.com.br', 'TI'),
(1033, 'Fechado', 'Baixa', 'teste', 'Este é um chamado teste', '2025-06-05 21:34:19', '2025-06-05 21:42:08', 20, 'João', 'joao.gabriel@chesiquimica.com.br', 'TI'),
(1034, 'Fechado', 'Baixa', 'Teste ', 'Erro ao buscar descrição.', '2025-06-05 21:43:35', '2025-06-07 15:05:45', 20, 'João', 'joao.gabriel@chesiquimica.com.br', 'TI'),
(1035, 'Em Andamento', 'Baixa', 'Teste', 'aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa testando limite de caracteres aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa ainda testando aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa viva o FLamengo aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa', '2025-06-05 21:47:31', NULL, 20, 'João', 'joao.gabriel@chesiquimica.com.br', 'TI'),
(1036, 'Aberto', NULL, 'teste', 'aaaaa', '2025-06-07 13:38:20', NULL, 25, 'Usuario', 'usuario@gmail.com', 'Qualidade'),
(1037, 'Aberto', NULL, 'Teste', 'teste', '2025-06-07 14:36:41', NULL, 27, 'Teste', 'teste@teste.com', 'Logistica'),
(1038, 'Aberto', NULL, 'Teste', 'Este é um chamado teste', '2025-06-07 14:47:37', NULL, 20, 'João', 'joao.gabriel@chesiquimica.com.br', 'TI'),
(1039, 'Aberto', NULL, 'Chamado Teste', 'ESPESSANTE ACRILICO TINTA 8110', '2025-06-07 15:17:09', NULL, 29, 'Teste', 'testeeeeeeeeee@teste.com', 'Formulacao'),
(1040, 'Em Andamento', 'Baixa', 'INTERNET CAIU ', 'MINHA INTERNET CAIU ', '2025-06-09 15:58:10', NULL, 33, 'PAULO', 'EMBALAGENS@CHESIQUIMICA.COM.BR', 'Qualidade');

--
-- Acionadores `chamados`
--
DELIMITER $$
CREATE TRIGGER `Data de Fechamento` BEFORE UPDATE ON `chamados` FOR EACH ROW begin 	if new.STATUS='Fechado' then
		set new.dtFechamento = NOW();
	end if;
end
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estrutura para tabela `equipamentos`
--

CREATE TABLE `equipamentos` (
  `idEquipamento` int(11) NOT NULL,
  `descricaoEquipamento` varchar(100) NOT NULL,
  `tipo` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `equipamentos`
--

INSERT INTO `equipamentos` (`idEquipamento`, `descricaoEquipamento`, `tipo`) VALUES
(1, 'HP Laser MPF 135w', 'Impressora'),
(4, 'Impressora Teste', 'Impressora'),
(5, 'Computador teste', 'Computador'),
(6, 'Monitor Tal', 'Outros'),
(7, 'Gol G4', 'Impressora');

-- --------------------------------------------------------

--
-- Estrutura para tabela `estoque`
--

CREATE TABLE `estoque` (
  `id` int(11) NOT NULL,
  `item_id` int(11) DEFAULT NULL,
  `nota_fiscal` varchar(20) DEFAULT NULL,
  `fornecedor` varchar(100) DEFAULT NULL,
  `quantidade` int(11) DEFAULT NULL,
  `tipo_movimentacao` varchar(20) NOT NULL,
  `data_movimentacao` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `estoque`
--

INSERT INTO `estoque` (`id`, `item_id`, `nota_fiscal`, `fornecedor`, `quantidade`, `tipo_movimentacao`, `data_movimentacao`) VALUES
(43, 1, '000', 'Fornecedor Teste', 5, 'ENTRADA', '2025-06-08 18:25:34'),
(44, 2, '000', 'Fornecedor Teste', 2, 'ENTRADA', '2025-06-08 18:25:34'),
(45, 1, '22', 'Fornecedor Teste', 5, 'ENTRADA', '2025-06-08 18:29:11'),
(46, 4, '22', 'Fornecedor Teste', 222, 'ENTRADA', '2025-06-08 18:40:25'),
(47, 3, '22', 'Fornecedor Teste', 1, 'ENTRADA', '2025-06-08 18:40:25'),
(49, 3, NULL, NULL, 200, 'ENTRADA', '2025-06-08 18:50:13'),
(50, 3, NULL, NULL, 200, 'ENTRADA', '2025-06-08 18:53:07'),
(51, 3, NULL, NULL, 200, 'ENTRADA', '2025-06-08 18:53:20'),
(52, 3, NULL, NULL, 200, 'ENTRADA', '2025-06-08 18:56:10'),
(53, 3, '', '', 200, 'SAIDA', '2025-06-08 18:56:37'),
(54, 3, '', '', 200, 'SAIDA', '2025-06-08 18:57:45'),
(55, 3, '', '', 401, 'SAIDA', '2025-06-08 18:58:10'),
(56, 3, '', '', 400, 'SAIDA', '2025-06-08 18:58:22'),
(57, 3, '22', 'Fornecedor Teste', 400, 'ENTRADA', '2025-06-08 19:01:17'),
(58, 4, '', '', 222, 'SAIDA', '2025-06-08 19:02:49'),
(59, 1, '', '', 1, 'SAIDA', '2025-06-08 19:03:54'),
(60, 3, '11111', 'Fornecedor Teste', 1, 'ENTRADA', '2025-06-08 23:20:15'),
(61, 3, '', '', 1, 'SAIDA', '2025-06-08 23:20:34'),
(62, 3, '00000', 'Fornecedor Teste', 5, 'ENTRADA', '2025-06-08 23:22:25'),
(63, 3, '', '', 4, 'SAIDA', '2025-06-08 23:23:13'),
(64, 5, '123', 'Fornecedor Teste', 10, 'ENTRADA', '2025-06-09 12:05:27'),
(65, 4, '5980', 'João Gabriel', 5, 'ENTRADA', '2025-06-09 13:03:23'),
(66, 4, '', '', 4, 'SAIDA', '2025-06-09 13:03:54');

-- --------------------------------------------------------

--
-- Estrutura para tabela `fornecedor`
--

CREATE TABLE `fornecedor` (
  `id` int(11) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `cnpj` varchar(18) NOT NULL,
  `telefone` varchar(15) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `endereco` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `fornecedor`
--

INSERT INTO `fornecedor` (`id`, `nome`, `cnpj`, `telefone`, `email`, `endereco`) VALUES
(1, 'João Gabriel', '02.125.191/0001-43', '(42) 3225-0537', 'joaoogbriel3meia@gmail.com', '221 Rua Navajo'),
(3, 'Teste', '12345678912345', '42991424466', 'joao@joao.com.br', 'Rua tal, numero tal, bairro tal');

-- --------------------------------------------------------

--
-- Estrutura para tabela `imobilizados`
--

CREATE TABLE `imobilizados` (
  `id` int(11) NOT NULL,
  `tipo` varchar(255) DEFAULT 'Outro',
  `patrimonio` varchar(50) DEFAULT NULL,
  `modelo` varchar(100) DEFAULT NULL,
  `localizacao` varchar(100) DEFAULT NULL,
  `nota_fiscal` varchar(50) DEFAULT NULL,
  `usuario_id` int(11) DEFAULT NULL,
  `status` varchar(20) DEFAULT 'Ativo'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `imobilizados`
--

INSERT INTO `imobilizados` (`id`, `tipo`, `patrimonio`, `modelo`, `localizacao`, `nota_fiscal`, `usuario_id`, `status`) VALUES
(10, 'Outro', '2025', '7', 'TI', '000', 30, 'ativo');

--
-- Acionadores `imobilizados`
--
DELIMITER $$
CREATE TRIGGER `trg_preencher_tipo_before_insert` BEFORE INSERT ON `imobilizados` FOR EACH ROW BEGIN
  DECLARE v_tipo VARCHAR(255);

  SELECT tipo INTO v_tipo FROM equipamentos WHERE descricaoEquipamento = NEW.modelo LIMIT 1;

  IF v_tipo IS NULL OR v_tipo = '' THEN
    SET NEW.tipo = 'Outro';
  ELSE
    SET NEW.tipo = v_tipo;
  END IF;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estrutura para tabela `impressora_tonner`
--

CREATE TABLE `impressora_tonner` (
  `id` int(11) NOT NULL,
  `impressoraId` int(11) NOT NULL,
  `modeloTonnerId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `impressora_tonner`
--

INSERT INTO `impressora_tonner` (`id`, `impressoraId`, `modeloTonnerId`) VALUES
(1, 1, 2),
(3, 4, 3);

-- --------------------------------------------------------

--
-- Estrutura para tabela `itens`
--

CREATE TABLE `itens` (
  `id` int(11) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `tipo` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `itens`
--

INSERT INTO `itens` (`id`, `nome`, `tipo`) VALUES
(1, 'Tonner 01', 'Tonner'),
(2, 'Tonner 02', 'Tonner'),
(3, 'item 01', 'Tonner'),
(4, 'item 02', 'Tonner'),
(5, 'Item 03', 'Tonner');

-- --------------------------------------------------------

--
-- Estrutura para tabela `movimentacao`
--

CREATE TABLE `movimentacao` (
  `id` int(11) NOT NULL,
  `estoque_id` int(11) DEFAULT NULL,
  `tipo` enum('entrada','baixa') NOT NULL,
  `quantidade` int(11) NOT NULL,
  `data_movimentacao` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `setores_locais`
--

CREATE TABLE `setores_locais` (
  `setor` varchar(40) NOT NULL,
  `local` varchar(40) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `setores_locais`
--

INSERT INTO `setores_locais` (`setor`, `local`) VALUES
('Almoxarifado', 'Barracão 2'),
('Apontamento', 'Barracão 2'),
('Comercial', 'Barracão 3'),
('Compras', 'Barracão 2'),
('Contabilidade', 'Barracão 4'),
('Cosmético', 'Barracão 4'),
('Expedição', 'Barracão 3'),
('Financeiro', 'Barracão 4'),
('Formulação', 'Barracão 2'),
('Laboratório', 'Barracão 4'),
('Logistica', 'Barracão 3'),
('Marketing', 'Barracão 1'),
('Qualidade', 'Barracão 2'),
('RH', 'Barracão 4'),
('Saneantes', 'Barracão 4'),
('TI', 'Barracão 2');

-- --------------------------------------------------------

--
-- Estrutura para tabela `tonneratualizacao`
--

CREATE TABLE `tonneratualizacao` (
  `id_atualizacao` int(20) NOT NULL,
  `solicitacaoId` int(11) NOT NULL,
  `dtAtualizacao` datetime NOT NULL DEFAULT current_timestamp(),
  `tecnico` varchar(100) DEFAULT NULL,
  `situacao` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `tonneratualizacao`
--

INSERT INTO `tonneratualizacao` (`id_atualizacao`, `solicitacaoId`, `dtAtualizacao`, `tecnico`, `situacao`) VALUES
(53, 1051, '2025-06-09 13:48:34', 'João', 'Em estoque'),
(54, 1052, '2025-06-09 13:48:53', 'João', 'Em estoque'),
(55, 1053, '2025-06-09 13:49:00', 'João', 'Em estoque');

-- --------------------------------------------------------

--
-- Estrutura para tabela `tonnersolicitacao`
--

CREATE TABLE `tonnersolicitacao` (
  `solicitacaoId` int(20) NOT NULL,
  `status` varchar(20) NOT NULL,
  `corTonner` varchar(20) DEFAULT NULL,
  `dtAbertura` datetime NOT NULL DEFAULT current_timestamp(),
  `dtFechamento` datetime DEFAULT NULL,
  `autorId` int(20) NOT NULL,
  `autorNome` varchar(40) NOT NULL,
  `autorEmail` varchar(60) NOT NULL,
  `autorSetor` varchar(40) NOT NULL,
  `situacao` varchar(40) DEFAULT NULL,
  `impressoraId` int(20) NOT NULL,
  `tonnerId` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `tonnersolicitacao`
--

INSERT INTO `tonnersolicitacao` (`solicitacaoId`, `status`, `corTonner`, `dtAbertura`, `dtFechamento`, `autorId`, `autorNome`, `autorEmail`, `autorSetor`, `situacao`, `impressoraId`, `tonnerId`) VALUES
(1051, 'Cancelado', '', '2025-06-09 13:45:43', NULL, 20, 'João', 'joao.gabriel@chesiquimica.com.br', 'TI', 'Em estoque', 1, 2),
(1052, 'Cancelado', '', '2025-06-09 13:46:34', NULL, 31, 'bernado', 'b@gmail', 'TI', 'Em estoque', 1, 2),
(1053, 'Cancelado', '', '2025-06-09 13:47:08', NULL, 20, 'João', 'joao.gabriel@chesiquimica.com.br', 'TI', 'Em estoque', 4, 3),
(1054, 'Aberto', '', '2025-06-09 13:49:09', NULL, 20, 'João', 'joao.gabriel@chesiquimica.com.br', 'TI', NULL, 1, 2),
(1055, 'Aberto', '', '2025-06-09 13:49:15', NULL, 20, 'João', 'joao.gabriel@chesiquimica.com.br', 'TI', NULL, 4, 3);

--
-- Acionadores `tonnersolicitacao`
--
DELIMITER $$
CREATE TRIGGER `dtFechamento` BEFORE UPDATE ON `tonnersolicitacao` FOR EACH ROW begin 	if new.STATUS='Fechado' then
		set new.dtFechamento = NOW();
	end if;
end
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `trg_before_insert_tonnersolicitacao` BEFORE INSERT ON `tonnersolicitacao` FOR EACH ROW BEGIN
  DECLARE v_tonnerId INT;
  SELECT modeloTonnerId INTO v_tonnerId FROM impressora_tonner WHERE impressoraId = NEW.impressoraId LIMIT 1;
  IF v_tonnerId IS NOT NULL THEN
    SET NEW.tonnerId = v_tonnerId;
  ELSE
    SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'Erro: impressoraId sem tonner associado!';
  END IF;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estrutura para tabela `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(20) NOT NULL,
  `nome` varchar(40) NOT NULL,
  `email` varchar(60) NOT NULL,
  `senha` varchar(40) NOT NULL,
  `setor` varchar(40) NOT NULL,
  `local` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `usuarios`
--

INSERT INTO `usuarios` (`id`, `nome`, `email`, `senha`, `setor`, `local`) VALUES
(20, 'João Gabriel dos Anjos', 'joao.gabriel@chesiquimica.com.br', '03a6b5a43cfe2e2315e141182e6b3e47f1f61c6f', 'TI', 'Barracão 2'),
(28, 'João Gabriel', 'joaoogbriel3meia@gmail.com', 'c510cd8607f92e1e09fd0b0d0d035c16d2428fa4', 'Marketing', 'Barracão 1'),
(29, 'Teste da Silva', 'testeeeeeeeeee@teste.com', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 'Formulacao', 'Barracão 2'),
(30, 'BERNARDO DE LIMA', 'bernardolimasilva13139@gmail.com', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 'TI', 'Barracão 2'),
(31, 'bernado', 'b@gmail', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 'TI', 'Barracão 2'),
(32, 'user', 'user@gmail', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 'Logistica', 'Barracão 3'),
(33, 'PAULO ROBERTO RODRIGUES NUNES', 'EMBALAGENS@CHESIQUIMICA.COM.BR', '1496aa696d9d35aa2c23b0f1ef3020df7f26f869', 'Qualidade', 'Barracão 2');

--
-- Acionadores `usuarios`
--
DELIMITER $$
CREATE TRIGGER `trg_set_local` BEFORE INSERT ON `usuarios` FOR EACH ROW BEGIN
    DECLARE v_local VARCHAR(100);

    -- Busca o local correspondente ao setor
    SELECT local INTO v_local 
    FROM setores_locais
    WHERE setor = NEW.setor
    LIMIT 1;

    -- Define o local para o novo registro
    IF v_local IS NOT NULL THEN
        SET NEW.local = v_local;
    ELSE
        SET NEW.local = 'Local Indefinido';
    END IF;
END
$$
DELIMITER ;

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `atualizacoes`
--
ALTER TABLE `atualizacoes`
  ADD PRIMARY KEY (`id_atualizacao`),
  ADD KEY `chamadoId` (`chamadoId`);

--
-- Índices de tabela `chamados`
--
ALTER TABLE `chamados`
  ADD PRIMARY KEY (`chamadoId`);

--
-- Índices de tabela `equipamentos`
--
ALTER TABLE `equipamentos`
  ADD PRIMARY KEY (`idEquipamento`);

--
-- Índices de tabela `estoque`
--
ALTER TABLE `estoque`
  ADD PRIMARY KEY (`id`),
  ADD KEY `item_id` (`item_id`);

--
-- Índices de tabela `fornecedor`
--
ALTER TABLE `fornecedor`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `cnpj` (`cnpj`);

--
-- Índices de tabela `imobilizados`
--
ALTER TABLE `imobilizados`
  ADD PRIMARY KEY (`id`),
  ADD KEY `usuario_id` (`usuario_id`);

--
-- Índices de tabela `impressora_tonner`
--
ALTER TABLE `impressora_tonner`
  ADD PRIMARY KEY (`id`),
  ADD KEY `impressoraId` (`impressoraId`),
  ADD KEY `modeloTonnerId` (`modeloTonnerId`);

--
-- Índices de tabela `itens`
--
ALTER TABLE `itens`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `movimentacao`
--
ALTER TABLE `movimentacao`
  ADD PRIMARY KEY (`id`),
  ADD KEY `estoque_id` (`estoque_id`);

--
-- Índices de tabela `setores_locais`
--
ALTER TABLE `setores_locais`
  ADD PRIMARY KEY (`setor`);

--
-- Índices de tabela `tonneratualizacao`
--
ALTER TABLE `tonneratualizacao`
  ADD PRIMARY KEY (`id_atualizacao`),
  ADD KEY `tonnerId` (`solicitacaoId`);

--
-- Índices de tabela `tonnersolicitacao`
--
ALTER TABLE `tonnersolicitacao`
  ADD PRIMARY KEY (`solicitacaoId`),
  ADD KEY `fk_tonner_impressora` (`impressoraId`),
  ADD KEY `fk_tonner_item` (`tonnerId`);

--
-- Índices de tabela `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `atualizacoes`
--
ALTER TABLE `atualizacoes`
  MODIFY `id_atualizacao` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=86;

--
-- AUTO_INCREMENT de tabela `chamados`
--
ALTER TABLE `chamados`
  MODIFY `chamadoId` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1041;

--
-- AUTO_INCREMENT de tabela `equipamentos`
--
ALTER TABLE `equipamentos`
  MODIFY `idEquipamento` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de tabela `estoque`
--
ALTER TABLE `estoque`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=67;

--
-- AUTO_INCREMENT de tabela `fornecedor`
--
ALTER TABLE `fornecedor`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de tabela `imobilizados`
--
ALTER TABLE `imobilizados`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de tabela `impressora_tonner`
--
ALTER TABLE `impressora_tonner`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de tabela `itens`
--
ALTER TABLE `itens`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de tabela `movimentacao`
--
ALTER TABLE `movimentacao`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `tonneratualizacao`
--
ALTER TABLE `tonneratualizacao`
  MODIFY `id_atualizacao` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;

--
-- AUTO_INCREMENT de tabela `tonnersolicitacao`
--
ALTER TABLE `tonnersolicitacao`
  MODIFY `solicitacaoId` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1056;

--
-- AUTO_INCREMENT de tabela `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- Restrições para tabelas despejadas
--

--
-- Restrições para tabelas `atualizacoes`
--
ALTER TABLE `atualizacoes`
  ADD CONSTRAINT `atualizacoes_ibfk_1` FOREIGN KEY (`chamadoId`) REFERENCES `chamados` (`chamadoId`);

--
-- Restrições para tabelas `estoque`
--
ALTER TABLE `estoque`
  ADD CONSTRAINT `estoque_ibfk_1` FOREIGN KEY (`item_id`) REFERENCES `itens` (`id`);

--
-- Restrições para tabelas `imobilizados`
--
ALTER TABLE `imobilizados`
  ADD CONSTRAINT `imobilizados_ibfk_1` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`id`);

--
-- Restrições para tabelas `impressora_tonner`
--
ALTER TABLE `impressora_tonner`
  ADD CONSTRAINT `impressora_tonner_ibfk_1` FOREIGN KEY (`impressoraId`) REFERENCES `equipamentos` (`idEquipamento`),
  ADD CONSTRAINT `impressora_tonner_ibfk_2` FOREIGN KEY (`modeloTonnerId`) REFERENCES `itens` (`id`);

--
-- Restrições para tabelas `movimentacao`
--
ALTER TABLE `movimentacao`
  ADD CONSTRAINT `movimentacao_ibfk_1` FOREIGN KEY (`estoque_id`) REFERENCES `estoque` (`id`);

--
-- Restrições para tabelas `tonneratualizacao`
--
ALTER TABLE `tonneratualizacao`
  ADD CONSTRAINT `solicitacaoId` FOREIGN KEY (`solicitacaoId`) REFERENCES `tonnersolicitacao` (`solicitacaoId`),
  ADD CONSTRAINT `tonneratualizacao_ibfk_1` FOREIGN KEY (`solicitacaoId`) REFERENCES `tonnersolicitacao` (`solicitacaoId`);

--
-- Restrições para tabelas `tonnersolicitacao`
--
ALTER TABLE `tonnersolicitacao`
  ADD CONSTRAINT `fk_tonner_impressora` FOREIGN KEY (`impressoraId`) REFERENCES `equipamentos` (`idEquipamento`) ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_tonner_item` FOREIGN KEY (`tonnerId`) REFERENCES `itens` (`id`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
