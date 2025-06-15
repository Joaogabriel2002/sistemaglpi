-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 15/06/2025 às 21:43
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

-- --------------------------------------------------------

--
-- Estrutura para tabela `itens`
--

CREATE TABLE `itens` (
  `id` int(11) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `tipo` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
  MODIFY `id_atualizacao` int(20) NOT NULL AUTO_INCREMENT;

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `imobilizados`
--
ALTER TABLE `imobilizados`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `impressora_tonner`
--
ALTER TABLE `impressora_tonner`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

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
  MODIFY `id_atualizacao` int(20) NOT NULL AUTO_INCREMENT;

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
