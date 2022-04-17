-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 07-Abr-2022 às 02:02
-- Versão do servidor: 10.4.22-MariaDB
-- versão do PHP: 8.0.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `seguranca`
--
create database seguranca;
-- --------------------------------------------------------

--
-- Estrutura da tabela `people`
--

CREATE TABLE `people` (
  `Id` int(11) NOT NULL,
  `Name` varchar(256) NOT NULL,
  `BirthDate` datetime NOT NULL,
  `Salary` decimal(10,0) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `people`
--

INSERT INTO `people` (`Id`, `Name`, `BirthDate`, `Salary`) VALUES
(2, 'Hugo', '2022-06-04 00:00:00', '1000'),
(3, 'Erico', '1997-12-27 00:00:00', '800'),
(5, 'Silva', '1995-12-27 00:00:00', '150');

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `people`
--
ALTER TABLE `people`
  ADD PRIMARY KEY (`Id`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `people`
--
ALTER TABLE `people`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
