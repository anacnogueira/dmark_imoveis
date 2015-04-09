-- phpMyAdmin SQL Dump
-- version 3.3.9
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tempo de Geração: Mai 11, 2011 as 03:10 PM
-- Versão do Servidor: 5.1.39
-- Versão do PHP: 5.3.6

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Banco de Dados: 'dmarkimoveis'
--

-- --------------------------------------------------------

--
-- Estrutura da tabela 'fotos'
--

DROP TABLE IF EXISTS fotos;
CREATE TABLE IF NOT EXISTS fotos (
  id int(11) NOT NULL AUTO_INCREMENT,
  imovel_id int(11) NOT NULL,
  foto varchar(100) NOT NULL,
  PRIMARY KEY (id)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela 'fotos'
--

INSERT INTO fotos (id, imovel_id, foto) VALUES
(1, 1, 'imovel_001.jpg'),
(2, 2, 'imovel_002.jpg'),
(3, 3, 'imovel_003.jpg');

-- --------------------------------------------------------

--
-- Estrutura da tabela 'imovels'
--

DROP TABLE IF EXISTS imovels;
CREATE TABLE IF NOT EXISTS imovels (
  id int(11) NOT NULL AUTO_INCREMENT,
  descricao varchar(100) NOT NULL,
  tipo_id int(11) NOT NULL,
  categoria_id int(11) NOT NULL,
  bairro_id int(11) NOT NULL,
  area_terreno float(8,2) NOT NULL,
  area_construida float(8,2) NOT NULL,
  dorms int(4) NOT NULL,
  banheiros int(4) NOT NULL,
  suites int(4) NOT NULL,
  sala int(4) NOT NULL,
  garagem varchar(20) NOT NULL,
  obs text NOT NULL,
  valor float(10,2) NOT NULL,
  contato text NOT NULL,
  paalavras_chave text NOT NULL,
  usuario_id int(11) NOT NULL,
  `status` enum('S','N') NOT NULL,
  destaque enum('S','N') NOT NULL,
  created datetime NOT NULL,
  modified datetime NOT NULL,
  PRIMARY KEY (id)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela 'imovels'
--

INSERT INTO imovels (id, descricao, tipo_id, categoria_id, bairro_id, area_terreno, area_construida, dorms, banheiros, suites, sala, garagem, obs, valor, contato, paalavras_chave, usuario_id, `status`, destaque, created, modified) VALUES
(1, 'Jardim Colonia - JacareÃ­', 2, 8, 1, 360.00, 0.00, 0, 0, 0, 0, '0', 'Ã“timo terreno, localizado prÃ³ximo da rodovia, topografia com leve aclive.\r\nVale Ã  pena conferir!', 30000.00, 'ANa Claudia', 'terreno,360,jacarei,parque sto antonio', 1, 'S', 'S', '2011-05-06 20:29:35', '2011-05-06 20:29:35'),
(2, 'SOBRADO VILLA BRANCA', 3, 4, 2, 378.00, 274.00, 3, 2, 3, 1, '4', '    Area Servico\r\n    Churrasq\r\n    Cozinha\r\n    Lareira\r\n    Lavabo\r\n    Sacada\r\n    Sala Jantar\r\n', 650000.00, '', '', 1, 'S', 'S', '2011-05-10 19:33:49', '2011-05-10 19:33:49'),
(3, 'Vila Ema SÃ£o JosÃ© Dos Campos', 2, 1, 4, 449.00, 400.00, 7, 2, 4, 1, '', 'Excelente cobertura no melhor bairro de S. J. Campos, com piscina, churrasqueira, sauna, lareira, terraÃ§o de 100mÂ² com linda vista panorÃ¢mica da cidade, Vale Ã  pena conferir!', 180000.00, '', '', 1, 'S', 'S', '2011-05-10 19:39:09', '2011-05-10 19:39:09');
