-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 08/05/2025 às 01:55
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
-- Banco de dados: `pi3`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `aluno`
--

CREATE TABLE `aluno` (
  `cpf` bigint(11) NOT NULL,
  `senha` varbinary(85) NOT NULL,
  `nome` varbinary(150) NOT NULL,
  `nascimento` date NOT NULL,
  `genero` set('M','F','O') NOT NULL,
  `classe` varchar(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `aluno`
--

INSERT INTO `aluno` (`cpf`, `senha`, `nome`, `nascimento`, `genero`, `classe`) VALUES
(3, 0x243279243130246f4666794e636a4a7959356270494b69344f7458594f524c6672503754586f2e4162747778537a38394a486a705058667246524165, 0x616c756e6f747265737465737465, '2025-05-06', 'M', 'E2-B'),
(4, 0x243279243130244c6f3645546c345831513067434c7831432e35754d756f36544a63385954426e50686f624d664c7642656e6e37577a68703941304f, 0x416c756e6f2054657374652034, '2025-05-08', 'O', 'E2-A'),
(12, 0x2432792431302450487568504a6a3651696268696f4666495a786a4a2e5230466a3467537641397a75304e6e4b673749623045306e6d4152684b6a57, 0x416c756e6f20546573746520446f6973, '2025-05-05', 'M', '1-A'),
(10000000000, 0x243279243130247172347068334173786d53684c49346e565574447675636f3438526c6c723657317135337636735938682e776974504c6456726a57, 0x416c756e6f205465737465, '2021-08-30', 'F', 'E2-A');

-- --------------------------------------------------------

--
-- Estrutura para tabela `materia`
--

CREATE TABLE `materia` (
  `nome` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `materia`
--

INSERT INTO `materia` (`nome`) VALUES
('ciência'),
('geografia'),
('história'),
('matemática'),
('português');

-- --------------------------------------------------------

--
-- Estrutura para tabela `nota`
--

CREATE TABLE `nota` (
  `id` int(150) NOT NULL,
  `aluno` bigint(11) NOT NULL,
  `materia` varchar(150) NOT NULL,
  `bimestre` set('1','2','3','4') NOT NULL,
  `valor` int(2) NOT NULL,
  `profResponsavel` bigint(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `nota`
--

INSERT INTO `nota` (`id`, `aluno`, `materia`, `bimestre`, `valor`, `profResponsavel`) VALUES
(3, 12, 'ciência', '1', 0, 1),
(4, 12, 'ciência', '1', 5, 1),
(5, 12, 'ciência', '2', 4, 1),
(6, 12, 'geografia', '1', 3, 1);

-- --------------------------------------------------------

--
-- Estrutura para tabela `professor`
--

CREATE TABLE `professor` (
  `cpf` bigint(11) NOT NULL,
  `senha` varbinary(85) NOT NULL,
  `nome` varbinary(150) NOT NULL,
  `nascimento` date NOT NULL,
  `genero` set('M','F','O') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `professor`
--

INSERT INTO `professor` (`cpf`, `senha`, `nome`, `nascimento`, `genero`) VALUES
(1, 0x243279243130244b5538755635353759496a6478384462475579583865526255706f614968785a4c5a6453536a3456657a6a516c5a77374243443679, 0x61646d, '2025-05-01', 'M');

-- --------------------------------------------------------

--
-- Estrutura para tabela `serie`
--

CREATE TABLE `serie` (
  `classe` varchar(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `serie`
--

INSERT INTO `serie` (`classe`) VALUES
('1-A'),
('1-B'),
('2-A'),
('2-B'),
('3-A'),
('3-B'),
('4-A'),
('4-B'),
('5-A'),
('5-B'),
('E1-A'),
('E1-B'),
('E2-A'),
('E2-B');

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `aluno`
--
ALTER TABLE `aluno`
  ADD PRIMARY KEY (`cpf`),
  ADD KEY `aluno_serie` (`classe`);

--
-- Índices de tabela `materia`
--
ALTER TABLE `materia`
  ADD PRIMARY KEY (`nome`);

--
-- Índices de tabela `nota`
--
ALTER TABLE `nota`
  ADD PRIMARY KEY (`id`),
  ADD KEY `alunoCpf` (`aluno`),
  ADD KEY `profCpf` (`profResponsavel`),
  ADD KEY `materia` (`materia`);

--
-- Índices de tabela `professor`
--
ALTER TABLE `professor`
  ADD PRIMARY KEY (`cpf`);

--
-- Índices de tabela `serie`
--
ALTER TABLE `serie`
  ADD PRIMARY KEY (`classe`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `nota`
--
ALTER TABLE `nota`
  MODIFY `id` int(150) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Restrições para tabelas despejadas
--

--
-- Restrições para tabelas `aluno`
--
ALTER TABLE `aluno`
  ADD CONSTRAINT `aluno_serie` FOREIGN KEY (`classe`) REFERENCES `serie` (`classe`) ON UPDATE CASCADE;

--
-- Restrições para tabelas `nota`
--
ALTER TABLE `nota`
  ADD CONSTRAINT `alunoCpf` FOREIGN KEY (`aluno`) REFERENCES `aluno` (`cpf`) ON UPDATE CASCADE,
  ADD CONSTRAINT `materia` FOREIGN KEY (`materia`) REFERENCES `materia` (`nome`) ON UPDATE CASCADE,
  ADD CONSTRAINT `profCpf` FOREIGN KEY (`profResponsavel`) REFERENCES `professor` (`cpf`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
