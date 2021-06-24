-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 24-Jun-2021 às 17:32
-- Versão do servidor: 10.4.11-MariaDB
-- versão do PHP: 7.4.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `devsbook`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `posts`
--

CREATE TABLE `posts` (
  `id` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `type` varchar(20) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `body` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `posts`
--

INSERT INTO `posts` (`id`, `id_user`, `type`, `created_at`, `body`) VALUES
(1, 1, 'text', '2021-06-18 20:30:02', 'made in black river'),
(2, 1, 'text', '2021-06-18 20:30:38', '2º teste de um post'),
(3, 1, 'photo', '2021-06-18 20:58:11', '144f579459f6b19fb7e1604cbbb61e1f.jpg'),
(5, 1, 'text', '2021-06-19 04:06:46', 'apresentando o sistema'),
(18, 4, 'text', '2021-06-24 15:23:53', 'amendoim');

-- --------------------------------------------------------

--
-- Estrutura da tabela `post_comments`
--

CREATE TABLE `post_comments` (
  `id` int(11) NOT NULL,
  `id_post` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `body` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `post_comments`
--

INSERT INTO `post_comments` (`id`, `id_post`, `id_user`, `created_at`, `body`) VALUES
(1, 5, 4, '2021-06-24 15:14:26', 'asdf'),
(2, 5, 4, '2021-06-24 15:22:19', 'teste');

-- --------------------------------------------------------

--
-- Estrutura da tabela `post_likes`
--

CREATE TABLE `post_likes` (
  `id` int(11) NOT NULL,
  `id_post` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `post_likes`
--

INSERT INTO `post_likes` (`id`, `id_post`, `id_user`, `created_at`) VALUES
(1, 5, 4, '2021-06-24 15:31:37');

-- --------------------------------------------------------

--
-- Estrutura da tabela `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(200) NOT NULL,
  `name` varchar(100) NOT NULL,
  `birthdate` date DEFAULT NULL,
  `city` varchar(100) DEFAULT NULL,
  `work` varchar(100) DEFAULT NULL,
  `avatar` varchar(100) DEFAULT 'default.jpg',
  `cover` varchar(100) DEFAULT 'cover.jpg',
  `token` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `users`
--

INSERT INTO `users` (`id`, `email`, `password`, `name`, `birthdate`, `city`, `work`, `avatar`, `cover`, `token`) VALUES
(1, 'gustavosimonato@email.com', '$2y$10$44/SiZkh1O24McXe6d6kxuvnGn8opZKWFBGsnhMxOO3Hrfwgjggki', 'gustavo simonato', '2014-02-10', 'São José do Rio Preto', 'Dono de casa', '8dc0649cf58eef2cca00484251bc60d4.jpg', 'cover.jpg', '9f05850e5afdefa9d4e2a21b3d7199d4'),
(2, 'markito@email.com', '$2y$10$wOVuKIZAyCsXH.CzdtiexuBNxhSEIlm6Ol3phk7V/0sPT2cABBze6', 'markito', '2000-12-12', NULL, NULL, 'default.jpg', 'cover.jpg', '6141af895a2f6e7a2fc24b328290fdaa'),
(3, 'jurassi@email.com', '$2y$10$p9ukc.yAD7O..t0qW9Jasuq8CqU3JuUhZVjySF2x1yuKtnJXykY/S', 'jurassi', '2015-12-12', NULL, NULL, 'default.jpg', 'cover.jpg', 'a7f3c6d410be495e019c5395ad493308'),
(4, 'joao@gmail.com', '$2y$10$azicFSV7CXUf7xjU5hF6Ie2Z5xoCAZS6oJwHHbSnVDMjlHpOoD/5S', 'joao', '1970-01-01', 'São José do Rio Preto', NULL, 'default.jpg', 'cover.jpg', NULL);

-- --------------------------------------------------------

--
-- Estrutura da tabela `user_relations`
--

CREATE TABLE `user_relations` (
  `id` int(11) NOT NULL,
  `user_from` int(11) NOT NULL,
  `user_to` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `user_relations`
--

INSERT INTO `user_relations` (`id`, `user_from`, `user_to`) VALUES
(3, 4, 1),
(4, 1, 4);

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `post_comments`
--
ALTER TABLE `post_comments`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `post_likes`
--
ALTER TABLE `post_likes`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `user_relations`
--
ALTER TABLE `user_relations`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT de tabela `post_comments`
--
ALTER TABLE `post_comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de tabela `post_likes`
--
ALTER TABLE `post_likes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de tabela `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de tabela `user_relations`
--
ALTER TABLE `user_relations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
