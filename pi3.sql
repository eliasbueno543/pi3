-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 04, 2025 at 05:53 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pi3`
--

-- --------------------------------------------------------

--
-- Table structure for table `aluno`
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
-- Dumping data for table `aluno`
--

INSERT INTO `aluno` (`cpf`, `senha`, `nome`, `nascimento`, `genero`, `classe`) VALUES
(10000000000, 0x243279243130247172347068334173786d53684c49346e565574447675636f3438526c6c723657317135337636735938682e776974504c6456726a57, 0x416c756e6f205465737465, '2021-08-30', 'F', 'E2-A');

-- --------------------------------------------------------

--
-- Table structure for table `professor`
--

CREATE TABLE `professor` (
  `cpf` bigint(11) NOT NULL,
  `senha` varbinary(85) NOT NULL,
  `nome` varbinary(150) NOT NULL,
  `nascimento` date NOT NULL,
  `genero` set('M','F','O') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `professor`
--

INSERT INTO `professor` (`cpf`, `senha`, `nome`, `nascimento`, `genero`) VALUES
(1, 0x24327924313024387438362f39637833444677467532476e762e6c382e786e5631452e69414331427a75367a4f63734a544d2e5171754b2f6a2e5432, 0x61646d, '2025-05-03', 'O');

-- --------------------------------------------------------

--
-- Table structure for table `serie`
--

CREATE TABLE `serie` (
  `classe` varchar(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `serie`
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
-- Indexes for dumped tables
--

--
-- Indexes for table `aluno`
--
ALTER TABLE `aluno`
  ADD PRIMARY KEY (`cpf`),
  ADD KEY `aluno_serie` (`classe`);

--
-- Indexes for table `professor`
--
ALTER TABLE `professor`
  ADD PRIMARY KEY (`cpf`);

--
-- Indexes for table `serie`
--
ALTER TABLE `serie`
  ADD PRIMARY KEY (`classe`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `aluno`
--
ALTER TABLE `aluno`
  ADD CONSTRAINT `aluno_serie` FOREIGN KEY (`classe`) REFERENCES `serie` (`classe`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
