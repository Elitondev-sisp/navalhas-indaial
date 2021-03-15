-- phpMyAdmin SQL Dump
-- version 5.0.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 16-Fev-2021 às 02:10
-- Versão do servidor: 10.4.14-MariaDB
-- versão do PHP: 7.2.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `bd_navalhas`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `acesso_usuarios`
--

CREATE TABLE `acesso_usuarios` (
  `id_acesso` int(11) NOT NULL,
  `id_menu` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `consulta` varchar(1) NOT NULL DEFAULT 'N'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `acesso_usuarios`
--

INSERT INTO `acesso_usuarios` (`id_acesso`, `id_menu`, `id_usuario`, `consulta`) VALUES
(1, 8, 3, 'S');

-- --------------------------------------------------------

--
-- Estrutura da tabela `agendamentos`
--

CREATE TABLE `agendamentos` (
  `id_agendamento` int(11) NOT NULL,
  `data` date NOT NULL,
  `id_horario` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `id_produto` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `agendamentos`
--

INSERT INTO `agendamentos` (`id_agendamento`, `data`, `id_horario`, `id_usuario`, `id_produto`) VALUES
(1, '2021-02-15', 7, 1, 0);

-- --------------------------------------------------------

--
-- Estrutura da tabela `caixa`
--

CREATE TABLE `caixa` (
  `id_caixa` int(11) NOT NULL,
  `data` date NOT NULL,
  `id_produto` int(11) NOT NULL,
  `id_servico` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `convites`
--

CREATE TABLE `convites` (
  `id_convite` int(11) NOT NULL,
  `fk_id_destinatario` int(11) NOT NULL,
  `fk_id_remetente` int(11) NOT NULL,
  `fk_id_evento` int(11) NOT NULL,
  `status` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `eventos`
--

CREATE TABLE `eventos` (
  `id_evento` int(11) NOT NULL,
  `fk_id_usuario` int(11) DEFAULT NULL,
  `titulo` varchar(255) NOT NULL,
  `descricao` varchar(255) NOT NULL,
  `cor` varchar(7) DEFAULT NULL,
  `inicio` datetime NOT NULL,
  `termino` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `funcionarios`
--

CREATE TABLE `funcionarios` (
  `id_funcionario` int(11) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `sobrenome` varchar(100) NOT NULL,
  `cep` int(11) NOT NULL,
  `rua` varchar(100) NOT NULL,
  `bairro` varchar(100) NOT NULL,
  `cidade` varchar(100) NOT NULL,
  `estado` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `funcionarios`
--

INSERT INTO `funcionarios` (`id_funcionario`, `nome`, `sobrenome`, `cep`, `rua`, `bairro`, `cidade`, `estado`) VALUES
(32, 'Eliton', 'Souza', 89087334, 'Rua Rudimar Nardelli', 'Estrada das Areias', 'Indaial', 'SC');

-- --------------------------------------------------------

--
-- Estrutura da tabela `horarios`
--

CREATE TABLE `horarios` (
  `id_horario` int(11) NOT NULL,
  `horario` time(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `horarios`
--

INSERT INTO `horarios` (`id_horario`, `horario`) VALUES
(2, '08:00:00.000000'),
(5, '08:30:00.000000'),
(6, '09:00:00.000000'),
(7, '09:30:00.000000'),
(8, '10:00:00.000000'),
(9, '10:30:00.000000'),
(10, '11:00:00.000000'),
(11, '11:30:00.000000'),
(12, '12:00:00.000000'),
(13, '12:30:00.000000'),
(14, '13:00:00.000000'),
(15, '13:30:00.000000'),
(16, '14:00:00.000000'),
(17, '14:30:00.000000'),
(18, '15:00:00.000000'),
(19, '15:30:00.000000'),
(20, '16:00:00.000000'),
(21, '16:30:00.000000'),
(22, '17:00:00.000000'),
(23, '17:30:00.000000'),
(24, '18:00:00.000000'),
(25, '18:30:00.000000'),
(26, '19:00:00.000000'),
(27, '19:30:00.000000');

-- --------------------------------------------------------

--
-- Estrutura da tabela `menus`
--

CREATE TABLE `menus` (
  `id_menu` int(11) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `descricao` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `menus`
--

INSERT INTO `menus` (`id_menu`, `nome`, `descricao`) VALUES
(2, 'cadastro_produto', 'Cadastro de Produto'),
(3, 'cadastro_servico', 'Cadastro de Serviço'),
(4, 'cadastro_funcionario', 'Cadastro de Funcionário'),
(5, 'cadastro_usuario', 'Cadastro de Usuário'),
(6, 'controle_caixa', 'Controle de Caixa'),
(7, 'controle_agendamento', 'Controle de Agendamento'),
(8, 'novo_agendamento', 'Novo Agendamento');

-- --------------------------------------------------------

--
-- Estrutura da tabela `produtos`
--

CREATE TABLE `produtos` (
  `id_produto` int(11) NOT NULL,
  `codigo` varchar(40) NOT NULL,
  `descricao` varchar(200) NOT NULL,
  `preco` float NOT NULL,
  `tipo` varchar(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `produtos`
--

INSERT INTO `produtos` (`id_produto`, `codigo`, `descricao`, `preco`, `tipo`) VALUES
(6, '1234', 'Gel para Cabelos efeito seco', 43, 'P'),
(8, '123', 'Corte Masculino', 25, 'S'),
(9, '223', 'Colar padrão', 30, 'P'),
(10, '20', 'Corte + Barba', 25, 'S'),
(11, '444', 'Corte Degradê', 20, 'S');

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuarios`
--

CREATE TABLE `usuarios` (
  `id_usuario` int(11) NOT NULL,
  `nome` varchar(15) NOT NULL,
  `senha` text NOT NULL,
  `tipo` smallint(1) NOT NULL DEFAULT 0,
  `dt_nasc` date NOT NULL,
  `telefone` varchar(50) NOT NULL,
  `ativo` varchar(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `usuarios`
--

INSERT INTO `usuarios` (`id_usuario`, `nome`, `senha`, `tipo`, `dt_nasc`, `telefone`, `ativo`) VALUES
(3, 'Eliton', '7110eda4d09e062aa5e4a390b0a572ac0d2c0220', 2, '1996-11-28', '(47) 99164-5490', 'S'),
(5, 'Fabrício', '62857a4af57e2ca382fd3c722a2396913ef3d8c3', 0, '1969-12-31', '(47) 99164-5459', 'S'),
(24, 'Testei', '62857a4af57e2ca382fd3c722a2396913ef3d8c3', 0, '1994-11-28', '(47) 99464-5423', 'S'),
(25, 'Zé pilintro', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 0, '1969-12-31', '(47) 88822-2111', 'S'),
(26, '123', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 0, '1996-11-28', '(12) 3', 'S'),
(27, 'Anão ', '056eafe7cf52220de2df36845b8ed170c67e23e3', 0, '1996-11-28', '(47) 98860-3922', 'S'),
(28, 'suy', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 0, '1999-02-04', '(47) 99224-3054', 'S');

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `acesso_usuarios`
--
ALTER TABLE `acesso_usuarios`
  ADD PRIMARY KEY (`id_acesso`),
  ADD KEY `id_usuario` (`id_usuario`),
  ADD KEY `id_menu` (`id_menu`);

--
-- Índices para tabela `agendamentos`
--
ALTER TABLE `agendamentos`
  ADD PRIMARY KEY (`id_agendamento`),
  ADD UNIQUE KEY `id_agendamento` (`id_agendamento`),
  ADD KEY `id_produto` (`id_produto`);

--
-- Índices para tabela `caixa`
--
ALTER TABLE `caixa`
  ADD PRIMARY KEY (`id_caixa`),
  ADD KEY `idx_caixa_data` (`data`),
  ADD KEY `idx_caixa_produto` (`id_produto`),
  ADD KEY `idx_caixa_servico` (`id_servico`);

--
-- Índices para tabela `convites`
--
ALTER TABLE `convites`
  ADD PRIMARY KEY (`id_convite`),
  ADD KEY `fk_id_destinatario` (`fk_id_destinatario`),
  ADD KEY `fk_id_remetente` (`fk_id_remetente`),
  ADD KEY `fk_id_evento` (`fk_id_evento`);

--
-- Índices para tabela `eventos`
--
ALTER TABLE `eventos`
  ADD PRIMARY KEY (`id_evento`),
  ADD KEY `fk_id_usuario` (`fk_id_usuario`);

--
-- Índices para tabela `funcionarios`
--
ALTER TABLE `funcionarios`
  ADD PRIMARY KEY (`id_funcionario`);

--
-- Índices para tabela `horarios`
--
ALTER TABLE `horarios`
  ADD PRIMARY KEY (`id_horario`);

--
-- Índices para tabela `menus`
--
ALTER TABLE `menus`
  ADD PRIMARY KEY (`id_menu`),
  ADD UNIQUE KEY `menu_idx_id` (`id_menu`);

--
-- Índices para tabela `produtos`
--
ALTER TABLE `produtos`
  ADD PRIMARY KEY (`id_produto`),
  ADD KEY `idx_descricao` (`descricao`);

--
-- Índices para tabela `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id_usuario`),
  ADD KEY `idx_usuarios_telefone` (`telefone`),
  ADD KEY `idx_usuarios_dt_nasc` (`dt_nasc`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `acesso_usuarios`
--
ALTER TABLE `acesso_usuarios`
  MODIFY `id_acesso` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de tabela `agendamentos`
--
ALTER TABLE `agendamentos`
  MODIFY `id_agendamento` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de tabela `caixa`
--
ALTER TABLE `caixa`
  MODIFY `id_caixa` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de tabela `convites`
--
ALTER TABLE `convites`
  MODIFY `id_convite` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de tabela `eventos`
--
ALTER TABLE `eventos`
  MODIFY `id_evento` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de tabela `funcionarios`
--
ALTER TABLE `funcionarios`
  MODIFY `id_funcionario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT de tabela `horarios`
--
ALTER TABLE `horarios`
  MODIFY `id_horario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT de tabela `menus`
--
ALTER TABLE `menus`
  MODIFY `id_menu` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de tabela `produtos`
--
ALTER TABLE `produtos`
  MODIFY `id_produto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de tabela `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- Restrições para despejos de tabelas
--

--
-- Limitadores para a tabela `acesso_usuarios`
--
ALTER TABLE `acesso_usuarios`
  ADD CONSTRAINT `acesso_usuarios_ibfk_1` FOREIGN KEY (`id_menu`) REFERENCES `menus` (`id_menu`),
  ADD CONSTRAINT `acesso_usuarios_ibfk_2` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id_usuario`);

--
-- Limitadores para a tabela `convites`
--
ALTER TABLE `convites`
  ADD CONSTRAINT `convites_ibfk_1` FOREIGN KEY (`fk_id_destinatario`) REFERENCES `usuarios` (`id_usuario`),
  ADD CONSTRAINT `convites_ibfk_2` FOREIGN KEY (`fk_id_remetente`) REFERENCES `usuarios` (`id_usuario`),
  ADD CONSTRAINT `convites_ibfk_3` FOREIGN KEY (`fk_id_evento`) REFERENCES `eventos` (`id_evento`);

--
-- Limitadores para a tabela `eventos`
--
ALTER TABLE `eventos`
  ADD CONSTRAINT `eventos_ibfk_1` FOREIGN KEY (`fk_id_usuario`) REFERENCES `usuarios` (`id_usuario`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
