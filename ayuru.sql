-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 09/06/2025 às 20:27
-- Versão do servidor: 9.2.0
-- Versão do PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `ayuru`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `atropelamentos`
--

CREATE TABLE `atropelamentos` (
  `id_at` int NOT NULL,
  `usuario` varchar(1000) COLLATE utf8mb4_unicode_ci NOT NULL,
  `especie` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `familia` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `classe` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `endereco` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `latitude` int NOT NULL,
  `longitude` int NOT NULL,
  `descricao` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `data` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `hora` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `foto` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `classificacao` varchar(1000) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tipo` varchar(1000) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Despejando dados para a tabela `atropelamentos`
--

INSERT INTO `atropelamentos` (`id_at`, `usuario`, `especie`, `familia`, `classe`, `endereco`, `latitude`, `longitude`, `descricao`, `data`, `hora`, `foto`, `classificacao`, `tipo`) VALUES
(1, 'gersilva', 'Leopardus wiedii', 'Felídeos', 'Mammalia', 'Não possui', -232177211, -469431103, 'Muito lindo!', '2025-02-18', '18:19', 'Margay.jpg', 'mamifero', 'fauna'),
(2, 'seiko', 'Eira barbara', 'Mustelídeos', 'Mammalia', '', -232320713, -469184423, 'De língua para fora!', '2025-06-03', '16:27', 'Irara_(Papa-mel).jpg', 'mamifero', 'fauna');

-- --------------------------------------------------------

--
-- Estrutura para tabela `enc_especies`
--

CREATE TABLE `enc_especies` (
  `id_enc` int NOT NULL,
  `usuario` varchar(1000) COLLATE utf8mb4_unicode_ci NOT NULL,
  `especie` varchar(1000) COLLATE utf8mb4_unicode_ci NOT NULL,
  `endereco` varchar(1000) COLLATE utf8mb4_unicode_ci NOT NULL,
  `latitude` int NOT NULL,
  `longitude` int NOT NULL,
  `descricao` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `data` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `hora` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `foto` varchar(1000) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Despejando dados para a tabela `enc_especies`
--

INSERT INTO `enc_especies` (`id_enc`, `usuario`, `especie`, `endereco`, `latitude`, `longitude`, `descricao`, `data`, `hora`, `foto`) VALUES
(1, 'seiko', 'Ambystoma mexicanum', 'Antiguo Canal Cuemanco 3, Pista Olímpica Virgilio Uribe, Xochimilco, 16043 Ciudad de México, CDMX, México', 192847562, -99102319, 'Encontrado na beira do Lago de Xochimilco', '2025-06-11', '17:31', 'axolote1.jpg'),
(2, 'gersilva', 'Ambystoma mexicanum', 'Antiguo Canal Cuemanco, Pista Olímpica Virgilio Uribe, Xochimilco, 16034 Ciudad de México, CDMX, México', 19287967, -991019287, 'Primeira vez vendo essa espécie!', '2025-05-07', '16:45', 'axolote2.jpg'),
(3, 'gersilva', 'Nasua nasua', 'Não possui', -232370142, -469733321, 'Encontrei uma família deles enquanto pesquisava', '2025-03-16', '16:52', 'quati.jpg'),
(4, 'seiko', 'Bauhinia forficata', 'Av. Luiz José Sereno - Serra do Japi, Jundiaí - SP', -232321955, -46956896, 'Já estava florescendo!', '2025-05-20', '18:15', 'pata-de-vaca.jpg'),
(5, 'gersilva', 'Croton floribundus', 'Av. Manoel Teixeira Cabral - Aglomeração Urbana de Jundiaí, Jundiaí - SP, 13211-224', -232177211, -469431103, 'Esta era bem grande!', '2025-06-19', '17:13', 'capixingui.jpg');

-- --------------------------------------------------------

--
-- Estrutura para tabela `especies`
--

CREATE TABLE `especies` (
  `especie` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `familia` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `classe` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `tipo` varchar(6) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `foto` varchar(1000) COLLATE utf8mb4_unicode_ci NOT NULL,
  `classificacao` varchar(1000) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Despejando dados para a tabela `especies`
--

INSERT INTO `especies` (`especie`, `familia`, `classe`, `tipo`, `foto`, `classificacao`) VALUES
('Ambystoma mexicanum', 'Ambystomatidae', 'Amphibia', 'fauna', 'axolote1.jpg', 'anfibio'),
('Bauhinia forficata', 'Fabaceae', 'Magnoliopsida', 'flora', 'pata-de-vaca.jpg', 'arvore'),
('Croton floribundus', 'Euphorbiaceae', 'Magnoliopsida', 'flora', 'capixingui.jpg', 'arvore'),
('Nasua nasua', 'Procionídeos', 'Mammalia', 'fauna', 'quati.jpg', 'mamifero');

-- --------------------------------------------------------

--
-- Estrutura para tabela `usuarios`
--

CREATE TABLE `usuarios` (
  `usuario` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nome` varchar(1000) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `celular` int NOT NULL,
  `conhecimento` varchar(70) COLLATE utf8mb4_unicode_ci NOT NULL,
  `comprovante` varchar(1000) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `especialidade` varchar(1000) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `senha` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Despejando dados para a tabela `usuarios`
--

INSERT INTO `usuarios` (`usuario`, `nome`, `email`, `celular`, `conhecimento`, `comprovante`, `especialidade`, `senha`) VALUES
('gersilva', 'Geraldo', 'gerrrrr@gmail.com', 328924023, 'amador', '', '', 'silvageraldo'),
('seiko', 'Mariana Fukuoka', 'mariana@gmail.com', 989278989, 'amador', '', '', 'abacaxi');

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `atropelamentos`
--
ALTER TABLE `atropelamentos`
  ADD PRIMARY KEY (`id_at`),
  ADD KEY `familia` (`familia`),
  ADD KEY `classe` (`classe`),
  ADD KEY `endereco` (`endereco`);

--
-- Índices de tabela `enc_especies`
--
ALTER TABLE `enc_especies`
  ADD PRIMARY KEY (`id_enc`);

--
-- Índices de tabela `especies`
--
ALTER TABLE `especies`
  ADD PRIMARY KEY (`especie`),
  ADD KEY `familia` (`familia`),
  ADD KEY `classe` (`classe`),
  ADD KEY `tipo` (`tipo`);

--
-- Índices de tabela `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`usuario`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `atropelamentos`
--
ALTER TABLE `atropelamentos`
  MODIFY `id_at` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de tabela `enc_especies`
--
ALTER TABLE `enc_especies`
  MODIFY `id_enc` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
