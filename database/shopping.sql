-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 05-Nov-2022 às 15:40
-- Versão do servidor: 10.4.24-MariaDB
-- versão do PHP: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `shopping`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `stock`
--

CREATE TABLE `stock` (
  `ID` int(11) NOT NULL,
  `livroName` varchar(24) NOT NULL,
  `livroPrice` varchar(11) NOT NULL DEFAULT '5',
  `livroDescription` varchar(1024) NOT NULL,
  `livroCategory` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `stock`
--

INSERT INTO `stock` (`ID`, `livroName`, `livroPrice`, `livroDescription`, `livroCategory`) VALUES
(1, 'Os Anos', '4.99', 'Estendendo-se por um período que vai de 1941 a 2006, em \"Os Anos\" conta-se uma história que é simultaneamente coletiva e pessoal, transversal e intimista, de sessenta anos da vida de um país e da vida de uma mulher. Através de pequenos fragmentos narrativos, por meio da relação entre fotografias, canções, filmes, objetos ou eventos da história recente, mais do que uma desconcertante autobiografia, Annie Ernaux constrói uma recordação de um «nós», num relato sobre o que fica quando o tempo passa: «Tudo se apagará num segundo...', 1),
(2, 'Não Obedeças Mais', '5', 'Quando iniciei a minha aventura literária a minha missão era levar amor-próprio a quem me lia. Não era, não é, e nunca será, ser aceite ou aclamado por todos.Com este livro aprofundo a necessidade de cada um se comprometer com a sua própria verdade, de forma que atinja a liberdade ilimitada que tem e que ninguém lhe pode dar ou roubar.Para isso há que tirar o medo da vontade, há que enfrentar o S.I.S.T.E.M.A., olhos nos olhos, porque se há um ponto fraco do medo, é, sem sombra de dúvidas, ser olhado de frente. Nestas...', 1),
(3, 'Spy x Family - Livro 5', '6.99', 'Depois de frustar um plano terrorista, a falsa família Forger dá as boas-vindas a um novo membro. Bond, o cão Bond esconde um amor infinito por Anya e tem o dom de adivinhar o futuro.A operação estrige parece finalmente no bom caminho, mas os exames que Anya tem que fazer podem comprometer a delicada missão de Loid Forger, também conhecido como crepúsculo.', 1),
(4, 'O Ladrão de Folhas', '5.50', 'O Esquilo está mesmo zangado! Ontem havia tantas folhas bonitas na sua árvore, mas... e hoje? Algumas desapareceram! Devem ter sido roubadas. E isso quer dizer que... Há por aí um ladrão de folhas! Uma história inteligente e divertida sobre um esquilo surpreendido pela inevitável mudança das estações.', 1),
(5, 'O Acontecimento', '2.99', 'Uma jovem de 23 anos, estudante universitária brilhante, descobre que está grávida. Tomada pela vergonha, consciente de que aquela gravidez representará um falhanço social para si e para a sua família, sabe que não poderá ter aquela criança. Mas, na França de 1963, o aborto é ilegal e não existe ninguém a quem possa acorrer. Quarenta anos mais tarde, as memórias daquele acontecimento continuam presentes, num trauma impossível de ultrapassar e cujas sombras se estendem para além da história individual. Escrito com uma...', 1),
(6, 'Faithful and Virtuous Ni', '4.50', 'GANHADOR DO PRÊMIO NOBEL DE LITERATURA &mdash; Você entra no mundo deste livro fascinante através de um de seus muitos portais oníricos, e cada vez que você entra é o mesmo lugar, mas foi organizado de forma diferente. Você era uma mulher. Você era um homem. Esta é uma história de aventura, um encontro com o desconhecido, a jornada destemida de um cavaleiro ao reino da morte; esta é uma história do mundo que você sempre conheceu, aquela primeira cartilha onde na página três apareceu um cachorro, na página cinco uma bola e cada faceta familiar foi feita para...', 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `users`
--

CREATE TABLE `users` (
  `ID` int(11) NOT NULL,
  `fName` varchar(24) NOT NULL,
  `lName` varchar(24) NOT NULL,
  `password` varchar(64) NOT NULL,
  `email` varchar(256) NOT NULL,
  `newslettet` tinyint(1) NOT NULL,
  `reg_time` timestamp NOT NULL DEFAULT current_timestamp(),
  `admin` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `users`
--

INSERT INTO `users` (`ID`, `fName`, `lName`, `password`, `email`, `newslettet`, `reg_time`, `admin`) VALUES
(1, 'Maxim', 'Dudai', '123456', 'maxim.dudai01@gmail.com', 0, '2022-10-02 11:32:56', 1),
(2, 'Test', 'tesT', '123456', 'test@gmail.com', 0, '2022-11-04 21:25:46', 0);

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `stock`
--
ALTER TABLE `stock`
  ADD PRIMARY KEY (`ID`);

--
-- Índices para tabela `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `stock`
--
ALTER TABLE `stock`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de tabela `users`
--
ALTER TABLE `users`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
