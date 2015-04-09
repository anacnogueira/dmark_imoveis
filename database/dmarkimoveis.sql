-- phpMyAdmin SQL Dump
-- version 3.3.9
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tempo de Geração: Mai 07, 2011 as 01:30 PM
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
(5, 'Jd. Industrias', 2);

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
(2, 'SÃ£o JosÃ© dos Campos');

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
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela 'fotos'
--


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
  valor float(8,2) NOT NULL,
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
(1, 'Jardim Colonia - JacareÃ­', 2, 8, 1, 360.00, 0.00, 0, 0, 0, 0, '0', 'Ã“timo terreno, localizado prÃ³ximo da rodovia, topografia com leve aclive.\r\nVale Ã  pena conferir!', 30000.00, 'ANa Claudia', 'terreno,360,jacarei,parque sto antonio', 1, 'S', 'S', '2011-05-06 20:29:35', '2011-05-06 20:29:35');

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
(3, 'LocaÃ§Ã£o');

-- --------------------------------------------------------

--
-- Estrutura da tabela 'usuarios'
--

DROP TABLE IF EXISTS usuarios;
CREATE TABLE IF NOT EXISTS usuarios (
  id int(11) NOT NULL AUTO_INCREMENT,
  nome varchar(50) NOT NULL,
  email varchar(50) NOT NULL,
  senha varchar(100) NOT NULL,
  cpf varchar(14) DEFAULT NULL,
  telefone varchar(13) DEFAULT NULL,
  celular varchar(13) DEFAULT NULL,
  cep varchar(9) NOT NULL,
  endereco varchar(50) NOT NULL,
  complemento varchar(50) DEFAULT NULL,
  bairro varchar(50) NOT NULL,
  cidade varchar(50) NOT NULL,
  estado varchar(2) NOT NULL,
  data_nascimento date NOT NULL,
  created datetime NOT NULL,
  modified datetime NOT NULL,
  PRIMARY KEY (id)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela 'usuarios'
--

INSERT INTO usuarios (id, nome, email, senha, cpf, telefone, celular, cep, endereco, complemento, bairro, cidade, estado, data_nascimento, created, modified) VALUES
(1, 'Ana Claudia', 'anacnogueira@gmail.com', '123456', '33087264830', '1239516900', '1291618959', '12309-000', 'Av Vale do ParaÃ­ba,164', '', 'Parque Santo Antonio', '1', 'SP', '1991-09-24', '2011-05-06 20:28:02', '2011-05-06 20:28:02');
