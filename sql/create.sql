-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: 16-Dez-2021 às 05:12
-- Versão do servidor: 5.7.26
-- versão do PHP: 7.3.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";

--
-- Database: `teste_care`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `nfe`
--

DROP TABLE IF EXISTS `nfe`;
CREATE TABLE IF NOT EXISTS `nfe` (
  `CODIGO` int(11) NOT NULL AUTO_INCREMENT,
  `NUMERO` int(11) NOT NULL,
  `DATA` varchar(100) NOT NULL,
  `CPF` varchar(100) DEFAULT NULL,
  `CNPJ` varchar(100) DEFAULT NULL,
  `NOME` varchar(200) NOT NULL,
  `LOGRADOURO` varchar(200) NOT NULL,
  `NUMEROCASA` int(11) NOT NULL,
  `COMPLEMENTO` varchar(20) DEFAULT NULL,
  `BAIRRO` varchar(200) NOT NULL,
  `CODIGOMUNICIPIO` int(10) NOT NULL,
  `MUNICIPIO` varchar(200) NOT NULL,
  `UF` varchar(3) NOT NULL,
  `CEP` varchar(15) NOT NULL,
  `CODIGOPAIS` int(10) NOT NULL,
  `TOTAL` varchar(10) NOT NULL,
  `CAMINHOARQUIVO` varchar(500) NOT NULL,
  `DATACADASTRO` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`CODIGO`)
) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=latin1;
