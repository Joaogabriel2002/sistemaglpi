-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 15/06/2025 às 21:36
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
(85, 1040, '2025-06-09 15:58:42', 'João', 'Verificando...'),
(86, 1043, '2025-06-11 20:02:24', 'João', 'Foi informado que a senha do Wifi é Penis2020'),
(87, 1044, '2025-06-11 20:08:49', 'João', 'Verificando...'),
(88, 1046, '2025-06-11 20:19:11', 'João', 'l'),
(90, 1047, '2025-06-12 20:04:00', 'João', 'teste'),
(91, 1047, '2025-06-12 20:04:20', 'João', 'Chamado finalizado'),
(92, 1048, '2025-06-14 22:14:22', 'João', 'a'),
(93, 1056, '2025-06-15 12:59:04', 'João', 'Teste'),
(94, 1057, '2025-06-15 13:14:45', 'João', 'testee'),
(95, 1058, '2025-06-15 13:21:21', 'João', 's');

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
(1035, 'Fechado', 'Baixa', 'Teste', 'aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa testando limite de caracteres aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa ainda testando aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa viva o FLamengo aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa', '2025-06-05 21:47:31', '2025-06-11 20:08:26', 20, 'João', 'joao.gabriel@chesiquimica.com.br', 'TI'),
(1036, 'Cancelado', NULL, 'teste', 'aaaaa', '2025-06-07 13:38:20', NULL, 25, 'Usuario', 'usuario@gmail.com', 'Qualidade'),
(1037, 'Cancelado', NULL, 'Teste', 'teste', '2025-06-07 14:36:41', NULL, 27, 'Teste', 'teste@teste.com', 'Logistica'),
(1038, 'Cancelado', NULL, 'Teste', 'Este é um chamado teste', '2025-06-07 14:47:37', NULL, 20, 'João', 'joao.gabriel@chesiquimica.com.br', 'TI'),
(1039, 'Cancelado', NULL, 'Chamado Teste', 'ESPESSANTE ACRILICO TINTA 8110', '2025-06-07 15:17:09', NULL, 29, 'Teste', 'testeeeeeeeeee@teste.com', 'Formulacao'),
(1040, 'Fechado', 'Baixa', 'INTERNET CAIU ', 'MINHA INTERNET CAIU ', '2025-06-09 15:58:10', '2025-06-09 20:44:23', 33, 'PAULO', 'EMBALAGENS@CHESIQUIMICA.COM.BR', 'Qualidade'),
(1041, 'Cancelado', NULL, 'chamado', 'teste do chamdo', '2025-06-10 16:10:16', NULL, 30, 'BERNARDO', 'bernardolimasilva13139@gmail.com', 'TI'),
(1042, 'Cancelado', NULL, 'chamado usuario', 'chamadooooooo o oooo ooo oo oo', '2025-06-10 17:10:56', NULL, 32, 'user', 'user@gmail', 'Logistica'),
(1043, 'Fechado', 'Baixa', 'wi-fi', 'preciso da senha wifi da rede da empresa ', '2025-06-11 20:01:49', '2025-06-11 20:02:24', 34, 'Ryan', 'ryancarvalho@gmail.com', 'Logistica'),
(1044, 'Cancelado', 'Média', 'bebe reborne', 'preciso de um bebe reborne', '2025-06-11 20:08:13', NULL, 34, 'Ryan', 'ryancarvalho@gmail.com', 'Logistica'),
(1045, 'Fechado', NULL, 'teste', 'testando ', '2025-06-11 20:09:55', '2025-06-12 19:00:27', 34, 'Ryan', 'ryancarvalho@gmail.com', 'Logistica'),
(1046, 'Fechado', NULL, 'AAA', 'aa', '2025-06-11 20:12:54', '2025-06-12 19:00:35', 35, 'Usuario', 'usuario@gmail.com', 'SAC'),
(1047, 'Fechado', 'Baixa', 'Chamado Teste', 'Problema na impressora', '2025-06-12 20:02:15', '2025-06-12 20:04:20', 37, 'William', 'willian@gmail.com', 'Contabilidade'),
(1048, 'Aberto', NULL, 'd', 'd', '2025-06-14 22:12:27', NULL, 44, 'Yuri', 'yuri@gmail.com', 'Teste'),
(1049, 'Aberto', NULL, 'Teste', 'aaaa', '2025-06-15 10:19:34', NULL, 20, 'João', 'joao.gabriel@chesiquimica.com.br', 'TI'),
(1050, 'Aberto', NULL, 'Impressora queimou', 'Minha impressora queimou', '2025-06-15 10:19:55', NULL, 20, 'João', 'joao.gabriel@chesiquimica.com.br', 'TI'),
(1051, 'Aberto', NULL, 'Chamado Teste', 'ESPESSANTE ACRILICO TINTA 8110', '2025-06-15 10:26:18', NULL, 20, 'João', 'joao.gabriel@chesiquimica.com.br', 'TI'),
(1052, 'Aberto', NULL, 'Teste', 'Este é um chamado teste', '2025-06-15 10:34:12', NULL, 20, 'João', 'joao.gabriel@chesiquimica.com.br', 'TI'),
(1053, 'Aberto', NULL, 'Flavia', 'Flavia teste', '2025-06-15 10:34:45', NULL, 20, 'João', 'joao.gabriel@chesiquimica.com.br', 'TI'),
(1054, 'Aberto', NULL, 'Instalar Teorema', 'teste', '2025-06-15 11:40:13', NULL, 20, 'João', 'joao.gabriel@chesiquimica.com.br', 'TI'),
(1055, 'Aberto', NULL, 'Instalar Teorema', 'Este é um chamado teste', '2025-06-15 11:48:26', NULL, 20, 'João', 'joao.gabriel@chesiquimica.com.br', 'TI'),
(1056, 'Aberto', 'Baixa', 'teste', 'Este é um chamado teste', '2025-06-15 12:52:17', NULL, 45, 'João', 'joaoogbriel3meia@gmail.com', 'Teste'),
(1057, 'Em Andamento', 'Baixa', 'aaaa', 'vb', '2025-06-15 13:14:20', NULL, 45, 'João', 'joaoogbriel3meia@gmail.com', 'Teste'),
(1058, 'Aberto', NULL, 'teste', 'ss', '2025-06-15 13:21:09', NULL, 45, 'João', 'joaoogbriel3meia@gmail.com', 'Teste');

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
(9, 'HP Laser MPF 135w', 'Impressora'),
(10, 'EPSON 544 - Tinta Preta', 'Impressora'),
(11, 'EPSON 544 - Tinta Amarela', 'Impressora'),
(12, 'EPSON 544 - Tinta Azul', 'Impressora'),
(13, 'EPSON 544 - Tinta Vermelho', 'Impressora');

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
  `data_movimentacao` timestamp NOT NULL DEFAULT current_timestamp(),
  `motivo` varchar(100) DEFAULT NULL,
  `usuario_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `estoque`
--

INSERT INTO `estoque` (`id`, `item_id`, `nota_fiscal`, `fornecedor`, `quantidade`, `tipo_movimentacao`, `data_movimentacao`, `motivo`, `usuario_id`) VALUES
(22, 8, '000', 'João', 10, 'ENTRADA', '2025-06-12 23:07:35', 'Entrada de Material', 20),
(23, 8, '', '', 5, 'SAIDA', '2025-06-12 23:08:52', 'Perda', 20),
(24, 8, '000', 'João', 1, 'ENTRADA', '2025-06-13 00:34:53', 'Entrada de Material', 20),
(25, 8, '', '', 5, 'SAIDA', '2025-06-13 00:46:23', 'Perda', 20),
(26, 8, '', '', 1, 'SAIDA', '2025-06-13 00:46:31', 'Perda', 20),
(27, 8, '11', 'João', 1, 'ENTRADA', '2025-06-14 11:46:11', 'Entrada de Material', 20),
(28, 8, '', '', 1, 'SAIDA', '2025-06-14 14:44:30', 'Perda', 20),
(29, 8, '000', 'João', 1, 'ENTRADA', '2025-06-14 14:58:45', 'Entrada de Material', 20),
(31, 8, NULL, NULL, 1, 'SAIDA', '2025-06-14 15:41:49', 'Entrega de Suprimento', 20);

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
(6, 'João', '00000000000000', '429914244466', 'joao@joao.com', 'Rua tal');

-- --------------------------------------------------------

--
-- Estrutura para tabela `imobilizados`
--

CREATE TABLE `imobilizados` (
  `id` int(11) NOT NULL,
  `patrimonio` varchar(50) DEFAULT NULL,
  `modelo_id` int(11) NOT NULL,
  `localizacao` varchar(100) DEFAULT NULL,
  `nota_fiscal` varchar(50) DEFAULT NULL,
  `usuario_id` int(11) DEFAULT NULL,
  `status` varchar(20) DEFAULT 'Ativo',
  `modelo` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `imobilizados`
--

INSERT INTO `imobilizados` (`id`, `patrimonio`, `modelo_id`, `localizacao`, `nota_fiscal`, `usuario_id`, `status`, `modelo`) VALUES
(8, '2025', 9, 'Laboratório', '0000', 37, 'Ativo', 'Impressora');

--
-- Acionadores `imobilizados`
--
DELIMITER $$
CREATE TRIGGER `before_insert_imobilizados` BEFORE INSERT ON `imobilizados` FOR EACH ROW BEGIN
  DECLARE v_descricao VARCHAR(100);

  SELECT tipo INTO v_descricao
  FROM equipamentos
  WHERE idEquipamento = NEW.modelo_id;

  SET NEW.modelo = v_descricao;
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
  `modeloTonnerId` int(11) NOT NULL,
  `cor` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `impressora_tonner`
--

INSERT INTO `impressora_tonner` (`id`, `impressoraId`, `modeloTonnerId`, `cor`) VALUES
(8, 9, 8, NULL),
(9, 11, 12, NULL),
(10, 12, 11, NULL),
(11, 10, 10, NULL),
(12, 13, 13, NULL);

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
(8, 'Tonner 01', 'Tonner'),
(9, 'Teclado', 'Material De Escritório'),
(10, 'EPSON 544 - Tinta Preta', 'Tonner'),
(11, 'EPSON 544 - Tinta Azul', 'Tonner'),
(12, 'EPSON 544 - Tinta Amarela', 'Tonner'),
(13, 'EPSON 544 - Tinta Vermelho', 'Tonner');

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
('Teste', 'Barracão 01'),
('TI', 'Local Indefinido');

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
(60, 1062, '2025-06-12 20:11:30', 'João', 'Em estoque'),
(61, 1062, '2025-06-12 20:11:39', 'João', 'Entregue'),
(63, 1064, '2025-06-14 08:37:44', 'João', 'Sem estoque'),
(64, 1064, '2025-06-14 08:44:47', 'João', 'Sem estoque'),
(65, 1063, '2025-06-14 08:45:46', 'João', 'Sem estoque'),
(66, 1063, '2025-06-14 08:46:27', 'João', 'Em estoque'),
(68, 1065, '2025-06-14 11:42:56', 'João', 'Em estoque'),
(69, 1066, '2025-06-14 11:44:17', 'João', 'Em estoque'),
(70, 1067, '2025-06-14 11:58:27', 'João', 'Sem estoque'),
(71, 1067, '2025-06-14 11:58:56', 'João', 'Em estoque'),
(72, 1068, '2025-06-14 12:10:28', 'João', 'Em estoque'),
(73, 1068, '2025-06-14 12:10:45', 'João', 'Em estoque'),
(74, 1068, '2025-06-14 12:11:16', 'João', 'Em estoque'),
(75, 1069, '2025-06-14 12:31:55', 'João', ''),
(77, 1069, '2025-06-14 12:36:17', 'João', 'Em estoque'),
(78, 1069, '2025-06-14 12:41:49', 'João', 'Em estoque'),
(79, 1071, '2025-06-14 20:24:58', 'João', 'Sem estoque'),
(80, 1074, '2025-06-14 22:13:03', 'João', 'Sem estoque'),
(81, 1074, '2025-06-14 22:13:43', 'João', 'Sem estoque'),
(82, 1076, '2025-06-15 13:06:38', 'João', 'Sem estoque'),
(83, 1076, '2025-06-15 13:07:02', 'João', 'Sem estoque'),
(84, 1079, '2025-06-15 13:15:49', 'João', 'Sem estoque'),
(85, 1079, '2025-06-15 13:17:34', 'João', 'Sem estoque'),
(86, 1079, '2025-06-15 13:19:00', 'João', 'Sem estoque');

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
(1062, 'Fechado', '', '2025-06-12 20:10:50', '2025-06-12 20:11:39', 37, 'William', 'willian@gmail.com', 'Contabilidade', 'Entregue', 9, 8),
(1063, 'Fechado', '', '2025-06-12 20:25:52', '2025-06-14 08:46:27', 20, 'João', 'joao.gabriel@chesiquimica.com.br', 'TI', 'Em estoque', 9, 8),
(1064, 'Fechado', '', '2025-06-12 21:35:44', '2025-06-14 08:44:47', 20, 'João', 'joao.gabriel@chesiquimica.com.br', 'TI', 'Sem estoque', 9, 8),
(1065, 'Fechado', '', '2025-06-14 11:39:40', '2025-06-14 11:42:56', 20, 'João', 'joao.gabriel@chesiquimica.com.br', 'TI', 'Em estoque', 9, 8),
(1066, 'Fechado', '', '2025-06-14 11:43:06', '2025-06-14 11:44:17', 20, 'João', 'joao.gabriel@chesiquimica.com.br', 'TI', 'Em estoque', 9, 8),
(1067, 'Fechado', '', '2025-06-14 11:44:22', '2025-06-14 11:58:56', 20, 'João', 'joao.gabriel@chesiquimica.com.br', 'TI', 'Em estoque', 9, 8),
(1068, 'Fechado', '', '2025-06-14 12:00:03', '2025-06-14 12:11:16', 20, 'João', 'joao.gabriel@chesiquimica.com.br', 'TI', 'Em estoque', 9, 8),
(1069, 'Fechado', '', '2025-06-14 12:31:39', '2025-06-14 12:41:49', 20, 'João', 'joao.gabriel@chesiquimica.com.br', 'TI', 'Em estoque', 9, 8),
(1070, 'Aberto', '', '2025-06-14 12:42:13', NULL, 20, 'João', 'joao.gabriel@chesiquimica.com.br', 'TI', NULL, 9, 8),
(1071, 'Aberto', '', '2025-06-14 20:24:49', NULL, 20, 'João', 'joao.gabriel@chesiquimica.com.br', 'TI', 'Sem estoque', 9, 8),
(1072, 'Aberto', '', '2025-06-14 22:01:46', NULL, 20, 'João', 'joao.gabriel@chesiquimica.com.br', 'TI', NULL, 9, 8),
(1073, 'Aberto', '', '2025-06-14 22:07:01', NULL, 20, 'João', 'joao.gabriel@chesiquimica.com.br', 'TI', NULL, 11, 12),
(1074, 'Em andamento', '', '2025-06-14 22:11:01', NULL, 44, 'Yuri', 'yuri@gmail.com', 'Teste', 'Sem estoque', 11, 12),
(1075, 'Aberto', '', '2025-06-15 12:35:01', NULL, 20, 'João', 'joao.gabriel@chesiquimica.com.br', 'TI', NULL, 11, 12),
(1076, 'Em andamento', '', '2025-06-15 12:42:59', NULL, 20, 'João', 'joao.gabriel@chesiquimica.com.br', 'TI', 'Sem estoque', 11, 12),
(1077, 'Aberto', '', '2025-06-15 12:43:52', NULL, 20, 'João', 'joao.gabriel@chesiquimica.com.br', 'TI', NULL, 12, 11),
(1078, 'Aberto', '', '2025-06-15 12:44:56', NULL, 20, 'João', 'joao.gabriel@chesiquimica.com.br', 'TI', NULL, 9, 8),
(1079, 'Em andamento', '', '2025-06-15 13:06:22', NULL, 45, 'João', 'joaoogbriel3meia@gmail.com', 'Teste', 'Sem estoque', 12, 11);

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
(29, 'Teste da Silva', 'testeeeeeeeeee@teste.com', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 'Formulacao', 'Barracão 2'),
(30, 'BERNARDO DE LIMA', 'bernardolimasilva13139@gmail.com', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 'TI', 'Barracão 2'),
(31, 'bernado', 'b@gmail', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 'TI', 'Barracão 2'),
(32, 'user', 'user@gmail', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 'Logistica', 'Barracão 3'),
(34, 'Ryan Neves Carvalho', 'ryancarvalho@gmail.com', '989b6e1abf7b666dec009b8932bc53fe0a0c3ac2', 'Logistica', 'Barracão 3'),
(36, 'teste', 'teste@gmail.com', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 'SAC', 'Local Indefinido'),
(37, 'William Oliveira', 'willian@gmail.com', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 'Contabilidade', 'Barracão 4'),
(38, 'TESTE NIGGA', 'nigga@gmail.com', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 'TI', 'Local Indefinido'),
(39, 'Teste ADM', 'teste2@teste.com', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 'Teste', 'Barracão 01'),
(40, 'Lucas', 'lucas@lucas.com', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 'Teste', 'Barracão 01'),
(41, 'jao', 'jaumlagoinha@gmail.com', '5247cbfafeeddcd4bb8da690fe989ce422a40656', 'Teste', 'Barracão 01'),
(42, 'Mario', 'mkt@chesiquimica.com.br', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 'Teste', 'Barracão 01'),
(43, 'Juca', 'juca@gmail.com', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 'TI', 'Local Indefinido'),
(44, 'Yuri', 'yuri@gmail.com', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 'Teste', 'Barracão 01'),
(45, 'João Gabriel', 'joaoogbriel3meia@gmail.com', '03a6b5a43cfe2e2315e141182e6b3e47f1f61c6f', 'Teste', 'Barracão 01');

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
  ADD KEY `item_id` (`item_id`),
  ADD KEY `fk_usuario_id` (`usuario_id`);

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
  ADD KEY `usuario_id` (`usuario_id`),
  ADD KEY `modelo_id` (`modelo_id`);

--
-- Índices de tabela `impressora_tonner`
--
ALTER TABLE `impressora_tonner`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `unq_impressora_cor` (`impressoraId`,`cor`),
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
  MODIFY `id_atualizacao` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=96;

--
-- AUTO_INCREMENT de tabela `chamados`
--
ALTER TABLE `chamados`
  MODIFY `chamadoId` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1059;

--
-- AUTO_INCREMENT de tabela `equipamentos`
--
ALTER TABLE `equipamentos`
  MODIFY `idEquipamento` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT de tabela `estoque`
--
ALTER TABLE `estoque`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT de tabela `fornecedor`
--
ALTER TABLE `fornecedor`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de tabela `imobilizados`
--
ALTER TABLE `imobilizados`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de tabela `impressora_tonner`
--
ALTER TABLE `impressora_tonner`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de tabela `itens`
--
ALTER TABLE `itens`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT de tabela `movimentacao`
--
ALTER TABLE `movimentacao`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `tonneratualizacao`
--
ALTER TABLE `tonneratualizacao`
  MODIFY `id_atualizacao` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=87;

--
-- AUTO_INCREMENT de tabela `tonnersolicitacao`
--
ALTER TABLE `tonnersolicitacao`
  MODIFY `solicitacaoId` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1080;

--
-- AUTO_INCREMENT de tabela `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

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
  ADD CONSTRAINT `estoque_ibfk_1` FOREIGN KEY (`item_id`) REFERENCES `itens` (`id`),
  ADD CONSTRAINT `fk_usuario_id` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`id`);

--
-- Restrições para tabelas `imobilizados`
--
ALTER TABLE `imobilizados`
  ADD CONSTRAINT `imobilizados_ibfk_1` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`id`),
  ADD CONSTRAINT `imobilizados_ibfk_2` FOREIGN KEY (`modelo_id`) REFERENCES `equipamentos` (`idEquipamento`);

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
