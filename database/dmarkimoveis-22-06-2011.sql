-- phpMyAdmin SQL Dump
-- version 3.3.9
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tempo de Geração: Jun 22, 2011 as 10:13 PM
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
-- Estrutura da tabela 'bairros'
--

DROP TABLE IF EXISTS bairros;
CREATE TABLE IF NOT EXISTS bairros (
  id int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  cidade_id int(11) NOT NULL,
  PRIMARY KEY (id)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela 'bairros'
--

INSERT INTO bairros (id, `name`, cidade_id) VALUES
(1, 'Parque Sto Antonio', 1),
(2, 'Centro', 1),
(3, 'Cidade Salvador', 1),
(4, 'Vista Verde', 2),
(5, 'Jd. Industrias', 2),
(6, 'Jd. das IndÃºstrias', 1),
(7, 'Vila Branca', 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela 'categorias'
--

DROP TABLE IF EXISTS categorias;
CREATE TABLE IF NOT EXISTS categorias (
  id int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  PRIMARY KEY (id)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela 'categorias'
--

INSERT INTO categorias (id, `name`) VALUES
(1, 'Apartamento'),
(3, 'Ãrea'),
(4, 'Casa'),
(5, 'ChÃ¡cara'),
(6, 'Comercial'),
(7, 'SÃ­tio'),
(8, 'Terreno');

-- --------------------------------------------------------

--
-- Estrutura da tabela 'cidades'
--

DROP TABLE IF EXISTS cidades;
CREATE TABLE IF NOT EXISTS cidades (
  id int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  PRIMARY KEY (id)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela 'cidades'
--

INSERT INTO cidades (id, `name`) VALUES
(1, 'JacareÃ­'),
(2, 'SÃ£o JosÃ© dos Campos'),
(3, 'TaubatÃ©'),
(4, 'CaÃ§apava');

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
(7, 1, 'imovel_2_20110622064117.jpg'),
(8, 1, 'imovel_3_20110622064119.jpg'),
(9, 1, 'imovel_4_20110622064122.jpg');

-- --------------------------------------------------------

--
-- Estrutura da tabela 'grupos'
--

DROP TABLE IF EXISTS grupos;
CREATE TABLE IF NOT EXISTS grupos (
  id int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  PRIMARY KEY (id)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela 'grupos'
--

INSERT INTO grupos (id, `name`) VALUES
(1, 'Admin'),
(2, 'UsuÃ¡rio comum'),
(3, 'Teste'),
(4, 'anaclaudia');

-- --------------------------------------------------------

--
-- Estrutura da tabela 'imovels'
--

DROP TABLE IF EXISTS imovels;
CREATE TABLE IF NOT EXISTS imovels (
  id int(11) NOT NULL AUTO_INCREMENT,
  descricao varchar(100) DEFAULT NULL,
  tipo_id int(11) DEFAULT NULL,
  categoria_id int(11) DEFAULT NULL,
  bairro_id int(11) DEFAULT NULL,
  area_terreno float(8,2) DEFAULT NULL,
  area_construida float(8,2) DEFAULT NULL,
  dorms int(4) DEFAULT NULL,
  banheiros int(4) DEFAULT NULL,
  suites int(4) DEFAULT NULL,
  sala int(4) DEFAULT NULL,
  garagem varchar(20) DEFAULT NULL,
  obs text,
  valor float(10,2) DEFAULT NULL,
  contato text,
  paalavras_chave text,
  usuario_id int(11) DEFAULT NULL,
  `status` enum('S','N') DEFAULT NULL,
  destaque enum('S','N') DEFAULT NULL,
  created datetime DEFAULT NULL,
  modified datetime DEFAULT NULL,
  PRIMARY KEY (id)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela 'imovels'
--

INSERT INTO imovels (id, descricao, tipo_id, categoria_id, bairro_id, area_terreno, area_construida, dorms, banheiros, suites, sala, garagem, obs, valor, contato, paalavras_chave, usuario_id, `status`, destaque, created, modified) VALUES
(1, 'SOBRADO VILLA BRANCA', 2, 4, 7, 250.00, 163.00, 3, NULL, 1, NULL, '', 'LINDO IMÃ“VEL - Projeto estilo neo italiano com muito requinte, no bairro que mais valoriza em JacareÃ­!\r\nEm fase de acabamento.\r\nAgende sua visita.\r\nCaracterÃ­sticas do ImÃ³vel\r\n\r\n    Area Servico\r\n    Cozinha\r\n    Sacada\r\n    Sala Jantar\r\n\r\n', 320000.00, '', NULL, 1, 'S', 'S', '2011-06-22 20:41:26', '2011-06-22 20:45:53');

-- --------------------------------------------------------

--
-- Estrutura da tabela 'paginas'
--

DROP TABLE IF EXISTS paginas;
CREATE TABLE IF NOT EXISTS paginas (
  id int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  titulo varchar(100) NOT NULL,
  content text NOT NULL,
  PRIMARY KEY (id)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela 'paginas'
--

INSERT INTO paginas (id, `name`, titulo, content) VALUES
(1, 'a_empresa', 'A empresa', 'ConteÃºdo sobre a empresa gfdgdgdfgdfg'),
(2, 'parceiros', 'Parceiros', 'Conteudo sobre parceiros'),
(3, 'trabalhe_conosco', 'Trabalhe Conosco', 'Conteudo sobre trabalhe conosco'),
(4, 'nossa_equipe', 'Nossa equipe', 'ConteÃºdo sobre nossa equipe');

-- --------------------------------------------------------

--
-- Estrutura da tabela 'tipos'
--

DROP TABLE IF EXISTS tipos;
CREATE TABLE IF NOT EXISTS tipos (
  id int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL,
  PRIMARY KEY (id)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela 'tipos'
--

INSERT INTO tipos (id, `name`) VALUES
(1, 'Compra'),
(2, 'Venda'),
(3, 'LocaÃ§Ã£o'),
(4, 'tipoteste');

-- --------------------------------------------------------

--
-- Estrutura da tabela 'usuarios'
--

DROP TABLE IF EXISTS usuarios;
CREATE TABLE IF NOT EXISTS usuarios (
  id int(11) NOT NULL AUTO_INCREMENT,
  nome varchar(50) NOT NULL,
  email varchar(50) NOT NULL,
  cpf varchar(14) DEFAULT NULL,
  telefone varchar(13) DEFAULT NULL,
  celular varchar(13) DEFAULT NULL,
  cep varchar(9) DEFAULT NULL,
  endereco varchar(50) DEFAULT NULL,
  complemento varchar(50) DEFAULT NULL,
  bairro varchar(50) DEFAULT NULL,
  cidade varchar(50) DEFAULT NULL,
  estado varchar(2) DEFAULT NULL,
  data_nascimento date DEFAULT NULL,
  grupo_id int(11) NOT NULL,
  `password` varchar(255) NOT NULL,
  created datetime NOT NULL,
  modified datetime NOT NULL,
  ativo enum('S','N') NOT NULL,
  randow varchar(255) DEFAULT NULL,
  PRIMARY KEY (id)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela 'usuarios'
--

INSERT INTO usuarios (id, nome, email, cpf, telefone, celular, cep, endereco, complemento, bairro, cidade, estado, data_nascimento, grupo_id, `password`, created, modified, ativo, randow) VALUES
(1, 'Ana Claudia Nogueira', 'anacnogueira@gmail.com', '330.872.648-30', '(12)3951-6900', '', '12309-000', 'Av. Vale do ParaaÃ­ba,164', '', 'Pque Sto Antonio', 'JacareÃ­', 'SP', '1983-09-24', 1, '7c4a8d09ca3762af61e59520943dc26494f8941b', '2011-06-14 16:37:16', '2011-06-14 16:43:40', 'S', NULL);
