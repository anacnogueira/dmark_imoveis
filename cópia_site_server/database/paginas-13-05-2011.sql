-- phpMyAdmin SQL Dump
-- version 3.3.9
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tempo de Geração: Mai 13, 2011 as 05:22 PM
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
(1, 'a_empresa', 'A empresa', 'ConteÃºdo sobre a empresa'),
(2, 'parceiros', 'Parceiros', 'Conteudo sobre parceiros'),
(3, 'trabalhe_conosco', 'Trabalhe Conosco', 'Conteudo sobre trabalhe conosco'),
(4, 'nossa_equipe', 'Nossa equipe', 'ConteÃºdo sobre nossa equipe');
