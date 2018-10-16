-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 02-Set-2018 às 15:20
-- Versão do servidor: 10.1.19-MariaDB
-- PHP Version: 7.0.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `projeto_classificados`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `anuncios`
--

CREATE TABLE `anuncios` (
  `id` int(11) UNSIGNED NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `id_categoria` int(11) NOT NULL,
  `titulo` varchar(100) DEFAULT NULL,
  `descricao` text,
  `valor` float DEFAULT NULL,
  `estado` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `anuncios`
--

INSERT INTO `anuncios` (`id`, `id_usuario`, `id_categoria`, `titulo`, `descricao`, `valor`, `estado`) VALUES
(3, 1, 1, 'Hublot Editado', 'Algum produto de anÃºncio legal', 300, 1),
(4, 1, 2, 'Casaco de Fulano', 'DescriÃ§Ã£o luxuosa do casaco', 100, 0),
(5, 1, 4, 'Ferrari', 'Carro esportivo muito barato', 50, 1),
(6, 7, 7, 'Gato Chato ', '  Casal de gatos chatos para caceta  ', 2, 0),
(7, 7, 8, 'Teclado sem fio', '  Teclado faltando algumas letras, mas Ã© sem fio  ', 8, 1),
(8, 5, 7, 'Gata prenha PaÃ§oquinha', '      Vendo gata prenha de 3 gatinhos, chata pra caramba, nome PaÃ§oquinha      ', 9, 3),
(10, 5, 8, 'Monitor c/ linha de defeito', '    monitor aoc 19 polegadas com marcas de defeito no led    ', 20, 2),
(11, 7, 5, 'Boneco Chuck o Assasssino', ' Boneco assassino igual ao do filme. ele fala e mata de verdade ', 30, 4),
(12, 7, 6, 'Caixa de Som Blutufi', '      caixinha de som blutife e pendraive      ', 50, 2),
(13, 7, 10, 'miniatura de carro para colecionar ', ' Conjunto de Carrinhos miniatura pra colecionadores fanÃ¡ticos e que nÃ£o tem com que gastar, solteirÃµes, vitalinos que querem algo para se apegar.  ', 150, 5),
(14, 7, 6, 'Microsystem', 'Marca BritÃ¢nia', 50, 3),
(15, 8, 1, 'Rolex usado lindo', '  Lindo relÃ³gio rolex  ', 150, 3),
(18, 9, 8, 'Notebook usado', 'Velho', 400, 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `anuncios_imagens`
--

CREATE TABLE `anuncios_imagens` (
  `id` int(11) UNSIGNED NOT NULL,
  `id_anuncio` int(11) NOT NULL,
  `url` varchar(100) NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `anuncios_imagens`
--

INSERT INTO `anuncios_imagens` (`id`, `id_anuncio`, `url`) VALUES
(19, 8, 'e093d36a106b132f2820ece4c08418b8.jpg'),
(20, 8, '4caf0365081c31a5c805537517eed1cb.jpg'),
(22, 10, 'afba3c4549e0f20e0ccffe0c0ba3dae4.jpg'),
(23, 10, '978b434d205f74b9dcd374c67a5028b8.jpg'),
(24, 6, '7178eb647917dd59c1c37ce178a4b1fb.jpg'),
(25, 7, '0c181c8ccc30f574116075e66aca09d6.jpg'),
(26, 11, 'd725848f96159d0979cd4d85e2524f3f.jpg'),
(27, 12, '81e339757f3aabf2e5f05f6c8ac6b3b1.jpg'),
(28, 12, 'f8256a2c16c3954370cc5bc61912e40f.jpg'),
(29, 12, '4082502b02597ff6c1bfc6f30e2dec53.jpg'),
(30, 13, '6bec6f341b565ba633bc743ecf4b0a40.jpg'),
(31, 13, 'c3d5dd77baf0657bb655252cc681f85a.jpg'),
(32, 13, '7e28142c18f92a3b5d6c491a60fc37aa.jpg'),
(33, 13, '2b83f1205da9a9fec2aca23301801b20.jpg'),
(34, 15, '9bda70040a8f281614701f318162bd94.jpg'),
(39, 18, 'b4799a6447ed9b12d4c10856a4512215.jpg'),
(41, 3, '814ffa8d4f99ecc6d995e8ea5b590b70.jpg');

-- --------------------------------------------------------

--
-- Estrutura da tabela `categorias`
--

CREATE TABLE `categorias` (
  `id` int(11) UNSIGNED NOT NULL,
  `nome` varchar(100) NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `categorias`
--

INSERT INTO `categorias` (`id`, `nome`) VALUES
(1, 'Relógios'),
(2, 'Roupas'),
(3, 'Eletrônicos'),
(4, 'Carros'),
(5, 'Brinquedos'),
(6, 'Portáteis'),
(7, 'Animais'),
(8, 'Informática'),
(9, 'Cama Mesa e Banho'),
(10, 'Decorativos');

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) UNSIGNED NOT NULL,
  `nome` varchar(100) NOT NULL DEFAULT '',
  `email` varchar(100) NOT NULL DEFAULT '',
  `senha` varchar(32) NOT NULL DEFAULT '',
  `telefone` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `usuarios`
--

INSERT INTO `usuarios` (`id`, `nome`, `email`, `senha`, `telefone`) VALUES
(8, 'Pedro Henrique', 'pedro.infouece@gmail.com', 'e01990544e65e072602c9ba9a29f5c60', '985669157'),
(9, 'Cleosvaldo', 'cleo@gmail.com', 'a18774ec0e713bd9c8e6ba9995aec4de', '987654123');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `anuncios`
--
ALTER TABLE `anuncios`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `anuncios_imagens`
--
ALTER TABLE `anuncios_imagens`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `categorias`
--
ALTER TABLE `categorias`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `anuncios`
--
ALTER TABLE `anuncios`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
--
-- AUTO_INCREMENT for table `anuncios_imagens`
--
ALTER TABLE `anuncios_imagens`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;
--
-- AUTO_INCREMENT for table `categorias`
--
ALTER TABLE `categorias`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
