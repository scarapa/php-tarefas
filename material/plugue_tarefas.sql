-- phpMyAdmin SQL Dump
-- version 4.6.6deb5ubuntu0.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Tempo de geração: 22/11/2020 às 12:13
-- Versão do servidor: 10.4.14-MariaDB-1:10.4.14+maria~bionic
-- Versão do PHP: 7.2.24-0ubuntu0.18.04.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `plugue_tarefas`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `status`
--

CREATE TABLE `status` (
  `id` int(11) NOT NULL,
  `descricao` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Fazendo dump de dados para tabela `status`
--

INSERT INTO `status` (`id`, `descricao`) VALUES
(1, 'A Fazer'),
(2, 'Fazendo'),
(3, 'Concluído');

-- --------------------------------------------------------

--
-- Estrutura para tabela `tarefas`
--

CREATE TABLE `tarefas` (
  `id` int(7) NOT NULL,
  `id_pai` int(5) NOT NULL,
  `titulo` varchar(70) NOT NULL,
  `descricao` text NOT NULL,
  `status` int(2) NOT NULL,
  `posicao` int(3) NOT NULL,
  `dt_create` datetime NOT NULL DEFAULT current_timestamp(),
  `dt_inicio` date DEFAULT NULL,
  `dt_final` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Fazendo dump de dados para tabela `tarefas`
--

INSERT INTO `tarefas` (`id`, `id_pai`, `titulo`, `descricao`, `status`, `posicao`, `dt_create`, `dt_inicio`, `dt_final`) VALUES
(1, 0, 'WEBSERVER', 'servidor', 0, 0, '2020-11-18 20:38:14', NULL, NULL),
(2, 0, 'Criar dominio', 'producar um dominio que remeta a ideia de digital', 1, 10, '2020-11-18 20:47:27', NULL, NULL),
(3, 1, 'Criar website', '', 1, 20, '2020-11-18 21:02:25', NULL, NULL),
(4, 3, 'Criar api rest', 'API Restfull , caminho completo:\r\ndominio/galeria_app/v1/[plataforma]', 1, 10, '2020-11-18 21:27:19', NULL, NULL),
(5, 0, 'APLICATIVO', 'galeria de imagens que exibira anuncios caso o usuario nao esteja logado', 2, 20, '2020-11-18 21:35:35', NULL, NULL),
(6, 5, 'tela pastas', '- exibir grid\r\n- exibir list', 2, 10, '2020-11-18 22:18:23', NULL, NULL),
(7, 5, 'tela arquivo', '- exibir grid\r\n- exibir list\r\n', 2, 20, '2020-11-18 22:19:47', NULL, NULL);

--
-- Índices de tabelas apagadas
--

--
-- Índices de tabela `status`
--
ALTER TABLE `status`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `tarefas`
--
ALTER TABLE `tarefas`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de tabelas apagadas
--

--
-- AUTO_INCREMENT de tabela `status`
--
ALTER TABLE `status`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT de tabela `tarefas`
--
ALTER TABLE `tarefas`
  MODIFY `id` int(7) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
