-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 26-Fev-2022 às 16:59
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
-- Banco de dados: `banco-de-dados`
--
CREATE DATABASE IF NOT EXISTS `banco-de-dados` DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci;
USE `banco-de-dados`;

-- --------------------------------------------------------

--
-- Estrutura da tabela `dado_contato`
--

DROP TABLE IF EXISTS `dado_contato`;
CREATE TABLE `dado_contato` (
  `id` int(11) NOT NULL,
  `tipo` tinyint(4) NOT NULL,
  `desc` varchar(1000) COLLATE utf8_unicode_ci DEFAULT NULL,
  `idPessoa` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Extraindo dados da tabela `dado_contato`
--

INSERT INTO `dado_contato` (`id`, `tipo`, `desc`, `idPessoa`) VALUES
(1, 0, 'Teste', 1),
(2, 0, 'TESS', 2),
(3, 1, 'ASDasd', 2);

-- --------------------------------------------------------

--
-- Estrutura da tabela `dado_pessoas`
--

DROP TABLE IF EXISTS `dado_pessoas`;
CREATE TABLE `dado_pessoas` (
  `id` int(11) NOT NULL,
  `nome` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `cpf` varchar(25) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Extraindo dados da tabela `dado_pessoas`
--

INSERT INTO `dado_pessoas` (`id`, `nome`, `cpf`) VALUES
(1, 'asd', '111.111.111-11'),
(2, 'Wiliam', '111.111.111-11');

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `dado_contato`
--
ALTER TABLE `dado_contato`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `dado_pessoas`
--
ALTER TABLE `dado_pessoas`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `dado_contato`
--
ALTER TABLE `dado_contato`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de tabela `dado_pessoas`
--
ALTER TABLE `dado_pessoas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=78;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
