-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 02-Out-2018 às 01:57
-- Versão do servidor: 5.7.14
-- PHP Version: 7.0.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `selfservice_bd`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `ss_pedido`
--

CREATE TABLE `ss_pedido` (
  `pd_id` bigint(20) NOT NULL,
  `pd_titulo` text,
  `pd_conteudo` text,
  `pd_us_id` int(11) NOT NULL,
  `pd_servico` text,
  `pd_data` datetime DEFAULT NULL,
  `pd_prazo` date DEFAULT NULL,
  `pd_habilidades` text,
  `pd_nivel` text,
  `pd_visibilidade` text
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `ss_proposta`
--

CREATE TABLE `ss_proposta` (
  `pp_id` bigint(20) NOT NULL,
  `pp_us_id` bigint(20) NOT NULL,
  `pp_descricao` text,
  `pp_valor` text,
  `pp_data` date DEFAULT NULL,
  `pp_tempo` int(11) DEFAULT NULL,
  `pp_valorFinal` text
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `ss_servicos`
--

CREATE TABLE `ss_servicos` (
  `sv_id` bigint(20) NOT NULL,
  `sv_tipo` varchar(255) DEFAULT NULL,
  `sv_descricao` text,
  `sv_valorComum` text,
  `sv_valorMercado` text
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `ss_usuarios`
--

CREATE TABLE `ss_usuarios` (
  `us_id` bigint(20) NOT NULL,
  `us_data` datetime DEFAULT NULL,
  `us_nome` varchar(255) DEFAULT NULL,
  `us_email` varchar(255) DEFAULT NULL,
  `us_login` varchar(60) DEFAULT NULL,
  `us_pass` varchar(255) DEFAULT NULL,
  `us_dataNascimento` date DEFAULT NULL,
  `us_endereco` text,
  `us_uf` varchar(255) DEFAULT NULL,
  `us_cidade` varchar(255) DEFAULT NULL,
  `us_bairro` varchar(255) DEFAULT NULL,
  `us_definicao` tinyint(1) DEFAULT NULL,
  `us_sobre` text,
  `us_experiencia` text,
  `us_areas` text,
  `us_habilidades` text
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `ss_usuarios`
--

INSERT INTO `ss_usuarios` (`us_id`, `us_data`, `us_nome`, `us_email`, `us_login`, `us_pass`, `us_dataNascimento`, `us_endereco`, `us_uf`, `us_cidade`, `us_bairro`, `us_definicao`, `us_sobre`, `us_experiencia`, `us_areas`, `us_habilidades`) VALUES
(1, '2018-09-05 00:00:00', 'Felipe Augusto Gonçalves Basilio', 'FeehGb@live.com', 'feehgb', 'f17b91', '1991-05-17', 'R. dos eucaliptos, n 13', 'PR', 'Curitiba', 'Barreirinha', 0, 'Sou profissional na área de web designer a 15 anos e estou em busca de novos serviços na area', 'Tenho experiencia na area de web a 20 anos', 'limpeza, jardinagem, pintura, concertos, drywall', 'nenhuma'),
(2, '2018-09-05 00:00:00', 'Ryan Silva Silveira', 'FeehGb@live.com', 'feehgb', 'f17b91', '1991-05-17', 'R. dos eucaliptos, n 13', 'PR', 'Curitiba', 'Barreirinha', 0, 'Sou profissional na área de web designer a 15 anos e estou em busca de novos serviços na area', 'Tenho experiencia na area de web a 20 anos', 'limpeza, jardinagem, pintura, concertos, drywall', 'nenhuma');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `ss_pedido`
--
ALTER TABLE `ss_pedido`
  ADD PRIMARY KEY (`pd_id`),
  ADD KEY `pd_us_id` (`pd_us_id`),
  ADD KEY `pd_data` (`pd_data`);

--
-- Indexes for table `ss_proposta`
--
ALTER TABLE `ss_proposta`
  ADD PRIMARY KEY (`pp_id`),
  ADD KEY `pp_us_id` (`pp_us_id`),
  ADD KEY `pp_data` (`pp_data`);

--
-- Indexes for table `ss_servicos`
--
ALTER TABLE `ss_servicos`
  ADD PRIMARY KEY (`sv_id`),
  ADD KEY `sv_tipo` (`sv_tipo`);

--
-- Indexes for table `ss_usuarios`
--
ALTER TABLE `ss_usuarios`
  ADD PRIMARY KEY (`us_id`),
  ADD KEY `us_data` (`us_data`),
  ADD KEY `us_cidade` (`us_cidade`),
  ADD KEY `us_bairro` (`us_bairro`),
  ADD KEY `us_uf` (`us_uf`),
  ADD KEY `us_login` (`us_login`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `ss_pedido`
--
ALTER TABLE `ss_pedido`
  MODIFY `pd_id` bigint(20) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `ss_proposta`
--
ALTER TABLE `ss_proposta`
  MODIFY `pp_id` bigint(20) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `ss_servicos`
--
ALTER TABLE `ss_servicos`
  MODIFY `sv_id` bigint(20) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `ss_usuarios`
--
ALTER TABLE `ss_usuarios`
  MODIFY `us_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
