-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 06-Set-2019 às 19:08
-- Versão do servidor: 10.4.6-MariaDB
-- versão do PHP: 7.3.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `ponto`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `employees`
--

CREATE TABLE `employees` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `rolefk` int(11) NOT NULL,
  `admission` date NOT NULL,
  `gender` varchar(1) NOT NULL,
  `status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `employees`
--

INSERT INTO `employees` (`id`, `name`, `rolefk`, `admission`, `gender`, `status`) VALUES
(1, 'ELIANE DA SILVA AZEVEDO', 1, '2013-02-25', 'F', 1),
(2, 'RENAN ROSÁRIO TEIXEIRA', 4, '2008-06-16', 'M', 1),
(3, 'AÉCIO PEREIRA SANTIAGO', 4, '2019-06-03', 'M', 1),
(4, 'ALANE DA CRUZ NERI', 2, '2018-01-03', 'F', 1),
(5, 'BRUNA MENDONÇA NASCIMENTO', 1, '2018-12-01', 'F', 1),
(6, 'BRUCE SOUZA CRUZ', 3, '2019-07-03', 'M', 1),
(7, 'CRISTIANO BASTOS MIRANDA', 7, '2010-08-02', 'M', 1),
(8, 'ALYSSON SILVA BRITO', 7, '2010-09-03', 'M', 1),
(9, 'DAVID SÉRGIO NOGUEIRA', 7, '2010-11-01', 'M', 1),
(10, 'DENIS OLIVEIRA MONTES', 4, '2019-02-04', 'M', 1),
(11, 'DHIELYTON LOPES DE OLIVEIRA ARAUJO', 4, '2018-09-24', 'M', 1),
(12, 'DIEGO MATEUS ARAÚJO DE JESUS', 3, '2018-11-05', 'M', 1),
(13, 'ELISMAR DE ANDRADE AZEVEDO', 3, '2017-06-06', 'M', 1),
(14, 'EDERSON PAZ RIBEIRO', 4, '2018-04-16', 'M', 1),
(15, 'EDUARDO ANUNCIAÇÃO DOS SANTOS', 6, '2010-04-01', 'M', 1),
(16, 'GESSAN DOS SANTOS ANDRADE', 3, '2011-03-01', 'M', 1),
(17, 'HEITOR LUCAS SANTOS SILVA', 3, '2018-06-04', 'M', 1),
(18, 'JADSON JOSÉ NERI GONZAGA', 4, '2018-06-04', 'M', 1),
(19, 'JEFTÉ GOES SALVADOR SILVA', 4, '2016-07-01', 'M', 1),
(20, 'JEREMIAS ALMEIDA JÚNIOR', 3, '2017-09-21', 'M', 1),
(21, 'JONATHAS  ARAUJO ALMEIDA', 3, '2017-04-03', 'M', 1),
(22, 'JOSÉ SAULO OLIVEIRA', 3, '2017-03-01', 'M', 1),
(23, 'LAERTE DA SILVA CARNEIRO', 3, '2015-06-16', 'M', 1),
(24, 'LAIS MARQUES FERREIRA', 6, '2012-04-12', 'F', 1),
(25, 'LINSMAR DO NASCIMENTO DA CRUZ', 4, '2013-10-10', 'M', 1),
(26, 'LUCAS GABRIEL DA SILVA E SILVA', 3, '2018-11-05', 'M', 1),
(27, 'LUCIANO DE OLIVEIRA SOUZA', 4, '2017-12-04', 'M', 1),
(28, 'LUIZ CÉSAR PINHEIRO DE OLIVEIRA', 3, '2010-04-01', 'M', 1),
(29, 'LUIZ FELIPE LINS NUNES', 3, '2016-04-02', 'M', 1),
(30, 'MARCELO F. CARDOSO', 3, '2017-08-01', 'M', 1),
(31, 'MARCO ANTONIO LIMA', 4, '2002-08-01', 'M', 1),
(32, 'MARCUS VINÍCIUS MACÊDO DE SOUSA', 3, '2019-07-03', 'M', 1),
(33, 'MATEUS FERREIRA TAVARES', 1, '2009-05-04', 'M', 1),
(34, 'MATHEUS SOUZA SANTOS', 4, '2018-08-13', 'M', 1),
(35, 'OTÁVIO RIBEIRO HIGINO', 1, '2013-02-20', 'M', 1),
(36, 'ROBENIL CEDRAZ', 7, '2015-06-01', 'M', 1),
(37, 'RONALDO RUIZ FILHO', 4, '2016-01-04', 'M', 1),
(38, 'THIAGO N. DE ALCANTARA', 3, '2017-03-03', 'M', 1),
(39, 'THOMAS PEREIRA DE OLIVEIRA', 2, '2019-08-04', 'M', 1),
(40, 'VANESSA DE JESUS SERAFIM', 8, '2019-06-03', 'M', 1),
(41, 'VINÍCIUS SILVA OLIVEIRA', 7, '2018-08-01', 'M', 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `hours`
--

CREATE TABLE `hours` (
  `id` int(11) NOT NULL,
  `employeefk` int(11) NOT NULL,
  `date` date NOT NULL,
  `type` int(11) NOT NULL DEFAULT 0,
  `hour1` time NOT NULL DEFAULT '00:00:00',
  `hour2` time NOT NULL DEFAULT '00:00:00',
  `hour3` time NOT NULL DEFAULT '00:00:00',
  `hour4` time NOT NULL DEFAULT '00:00:00',
  `hour5` time NOT NULL DEFAULT '00:00:00',
  `hour6` time NOT NULL DEFAULT '00:00:00',
  `typedatefk` int(11) DEFAULT NULL,
  `balance` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `hours`
--

INSERT INTO `hours` (`id`, `employeefk`, `date`, `type`, `hour1`, `hour2`, `hour3`, `hour4`, `hour5`, `hour6`, `typedatefk`, `balance`) VALUES
(1, 1, '2019-09-01', 0, '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', 1, '00:00:00'),
(2, 1, '2019-09-02', 0, '07:55:00', '12:17:00', '13:23:00', '18:00:00', '00:00:00', '00:00:00', 2, '00:59:00'),
(3, 1, '2019-09-03', 0, '07:51:00', '12:08:00', '13:49:00', '18:00:00', '00:00:00', '00:00:00', 2, '00:28:00'),
(4, 37, '2019-09-01', 0, '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', 1, '00:00:00'),
(5, 37, '2019-09-02', 0, '07:57:00', '12:29:00', '12:53:00', '17:28:00', '00:00:00', '00:00:00', 2, '01:07:00'),
(6, 37, '2019-09-03', 0, '07:48:00', '12:29:00', '12:59:00', '17:28:00', '00:00:00', '00:00:00', 2, '01:10:00'),
(7, 37, '2019-09-04', 0, '07:41:00', '11:42:00', '12:49:00', '17:28:00', '00:00:00', '00:00:00', 2, '00:40:00'),
(8, 40, '2019-09-01', 0, '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', 1, '00:00:00'),
(9, 40, '2019-09-02', 0, '08:01:00', '12:44:00', '13:38:00', '17:00:00', '00:00:00', '00:00:00', 2, '00:05:00'),
(10, 40, '2019-09-03', 0, '07:32:00', '13:04:00', '13:49:00', '17:00:00', '00:00:00', '00:00:00', 2, '00:43:00'),
(11, 40, '2019-09-04', 0, '06:49:00', '12:30:00', '13:31:00', '16:56:00', '00:00:00', '00:00:00', 2, '01:06:00'),
(12, 23, '2019-09-01', 0, '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', 1, '00:00:00'),
(13, 2, '2019-09-01', 0, '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', 1, '02:00:00'),
(14, 9, '2019-08-01', 0, '07:51:00', '12:35:00', '13:48:00', '18:05:00', '00:00:00', '00:00:00', 2, '03:01:00'),
(15, 9, '2019-08-02', 0, '07:57:00', '11:57:00', '13:30:00', '18:00:00', '00:00:00', '00:00:00', 2, '02:30:00'),
(16, 9, '2019-08-03', 0, '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', 3, '-04:00:00'),
(17, 9, '2019-08-04', 0, '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', 1, '02:00:00'),
(18, 9, '2019-08-05', 0, '07:48:00', '12:24:00', '13:23:00', '18:04:00', '00:00:00', '00:00:00', 2, '03:17:00'),
(19, 9, '2019-08-06', 0, '07:39:00', '12:24:00', '13:23:00', '17:58:00', '00:00:00', '00:00:00', 2, '03:20:00'),
(20, 9, '2019-08-07', 0, '07:48:00', '12:16:00', '13:19:00', '17:46:00', '00:00:00', '00:00:00', 2, '02:55:00'),
(21, 9, '2019-08-08', 0, '07:53:00', '12:36:00', '13:39:00', '18:05:00', '00:00:00', '00:00:00', 2, '03:09:00'),
(22, 9, '2019-08-09', 0, '07:54:00', '12:00:00', '13:47:00', '18:02:00', '00:00:00', '00:00:00', 2, '02:21:00'),
(23, 9, '2019-08-10', 0, '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', 3, '-04:00:00'),
(24, 9, '2019-08-11', 0, '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', 1, '02:00:00'),
(25, 9, '2019-08-12', 0, '07:59:00', '12:57:00', '14:04:00', '18:02:00', '00:00:00', '00:00:00', 2, '02:56:00'),
(26, 9, '2019-08-13', 0, '08:01:00', '11:51:00', '12:57:00', '18:01:00', '00:00:00', '00:00:00', 2, '02:54:00'),
(27, 9, '2019-08-14', 0, '07:58:00', '11:50:00', '13:00:00', '18:04:00', '00:00:00', '00:00:00', 2, '02:56:00'),
(28, 9, '2019-08-15', 0, '07:58:00', '11:40:00', '12:44:00', '18:05:00', '00:00:00', '00:00:00', 2, '03:03:00'),
(29, 9, '2019-08-16', 0, '08:08:00', '12:54:00', '13:42:00', '18:06:00', '00:00:00', '00:00:00', 2, '03:10:00'),
(30, 9, '2019-08-17', 0, '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', 1, '02:00:00'),
(31, 9, '2019-08-18', 0, '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', 1, '02:00:00'),
(32, 9, '2019-08-20', 0, '08:00:00', '12:10:00', '13:03:00', '18:11:00', '00:00:00', '00:00:00', 2, '03:18:00'),
(33, 9, '2019-08-21', 0, '07:52:00', '11:56:00', '13:10:00', '18:04:00', '00:00:00', '00:00:00', 2, '02:58:00'),
(34, 9, '2019-08-22', 0, '07:52:00', '11:54:00', '13:02:00', '18:07:00', '00:00:00', '00:00:00', 2, '03:07:00'),
(35, 9, '2019-08-23', 0, '07:54:00', '11:57:00', '13:25:00', '18:03:00', '00:00:00', '00:00:00', 2, '02:41:00'),
(36, 9, '2019-08-24', 0, '08:05:00', '10:20:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', 3, '-01:45:00'),
(37, 9, '2019-08-25', 0, '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', 1, '02:00:00'),
(38, 9, '2019-08-26', 0, '07:51:00', '12:03:00', '13:07:00', '18:01:00', '00:00:00', '00:00:00', 2, '03:06:00'),
(39, 9, '2019-08-27', 0, '07:45:00', '12:34:00', '13:43:00', '17:44:00', '00:00:00', '00:00:00', 2, '02:50:00'),
(40, 9, '2019-08-28', 0, '07:43:00', '12:14:00', '13:35:00', '17:44:00', '00:00:00', '00:00:00', 2, '02:40:00'),
(41, 9, '2019-08-29', 0, '07:49:00', '12:00:00', '13:00:00', '23:00:00', '00:00:00', '00:00:00', 2, '08:11:00'),
(42, 9, '2019-08-30', 0, '07:40:00', '12:00:00', '13:00:00', '18:00:00', '18:00:00', '21:30:00', 2, '06:50:00'),
(43, 9, '2019-08-31', 0, '08:00:00', '12:00:00', '13:00:00', '17:30:00', '00:00:00', '00:00:00', 3, '06:30:00'),
(44, 1, '2019-08-12', 0, '07:59:00', '12:57:00', '14:04:00', '18:02:00', '00:00:00', '00:00:00', 1, '10:56:00'),
(45, 9, '2019-08-19', 0, '07:46:00', '12:22:00', '13:37:00', '17:53:00', '00:00:00', '00:00:00', 2, '02:52:00');

-- --------------------------------------------------------

--
-- Estrutura da tabela `roles`
--

CREATE TABLE `roles` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `roles`
--

INSERT INTO `roles` (`id`, `name`) VALUES
(1, 'ASSISTENTE ADMINISTRATIVO'),
(2, 'ASSISTENTE COMERCIAL'),
(3, 'TÉCNICO DE SUPORTE'),
(4, 'PROGRAMADOR'),
(5, 'ASSISTENTE FINANCEIRO'),
(6, 'TÉCNICO DE TECNOLOGIA'),
(7, 'TÉCNICO DE IMPLANTAÇÃO'),
(8, 'ASSISTENTE DE SERVIÇOS GERAIS');

-- --------------------------------------------------------

--
-- Estrutura da tabela `typedates`
--

CREATE TABLE `typedates` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `time` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `typedates`
--

INSERT INTO `typedates` (`id`, `name`, `time`) VALUES
(1, 'Domingos/Feriados/Etc', '00:00:00'),
(2, 'Dias Úteis', '08:00:00'),
(3, 'Sábados', '04:00:00'),
(4, 'Férias', '00:00:00');

-- --------------------------------------------------------

--
-- Estrutura da tabela `users`
--

CREATE TABLE `users` (
  `user_id` int(12) NOT NULL,
  `name` varchar(50) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `status` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `users`
--

INSERT INTO `users` (`user_id`, `name`, `email`, `password`, `status`) VALUES
(1, 'Eliane Azevedo', 'eliane@protonsistemas.com.br', '123456', 1);

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `employees`
--
ALTER TABLE `employees`
  ADD PRIMARY KEY (`id`),
  ADD KEY `employee_rolefk` (`rolefk`);

--
-- Índices para tabela `hours`
--
ALTER TABLE `hours`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQUE` (`employeefk`,`type`,`date`),
  ADD KEY `hours_employeefk` (`employeefk`),
  ADD KEY `hours_typedatefk` (`typedatefk`);

--
-- Índices para tabela `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `typedates`
--
ALTER TABLE `typedates`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `employees`
--
ALTER TABLE `employees`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT de tabela `hours`
--
ALTER TABLE `hours`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT de tabela `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de tabela `typedates`
--
ALTER TABLE `typedates`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de tabela `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Restrições para despejos de tabelas
--

--
-- Limitadores para a tabela `employees`
--
ALTER TABLE `employees`
  ADD CONSTRAINT `employee_rolefk` FOREIGN KEY (`rolefk`) REFERENCES `roles` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `hours`
--
ALTER TABLE `hours`
  ADD CONSTRAINT `hours_employeefk` FOREIGN KEY (`employeefk`) REFERENCES `employees` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `hours_typedatefk` FOREIGN KEY (`typedatefk`) REFERENCES `typedates` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
