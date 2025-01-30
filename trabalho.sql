-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 30/01/2025 às 13:32
-- Versão do servidor: 10.4.32-MariaDB
-- Versão do PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `trabalho`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `admin`
--

CREATE TABLE `admin` (
  `Id` int(11) NOT NULL,
  `Username` varchar(50) NOT NULL,
  `Senha` char(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `admin`
--

INSERT INTO `admin` (`Id`, `Username`, `Senha`) VALUES
(1, 'Admin', '21232f297a57a5a743894a0e4a801fc3');

-- --------------------------------------------------------

--
-- Estrutura para tabela `categoria`
--

CREATE TABLE `categoria` (
  `Id` int(11) NOT NULL,
  `Nome` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `categoria`
--

INSERT INTO `categoria` (`Id`, `Nome`) VALUES
(14, 'Adesivo'),
(23, 'Bone'),
(22, 'Caixa de Som'),
(17, 'CPU'),
(20, 'GPU'),
(24, 'Monitor Gamer'),
(12, 'Notebook'),
(1, 'Smartphone');

-- --------------------------------------------------------

--
-- Estrutura para tabela `produto`
--

CREATE TABLE `produto` (
  `Id` int(11) NOT NULL,
  `Nome` varchar(100) NOT NULL,
  `Descricao` text DEFAULT NULL,
  `Preco` decimal(10,2) NOT NULL,
  `CategoriaId` int(11) NOT NULL,
  `ImagemExt` varchar(7) NOT NULL,
  `Cachebuster` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `produto`
--

INSERT INTO `produto` (`Id`, `Nome`, `Descricao`, `Preco`, `CategoriaId`, `ImagemExt`, `Cachebuster`) VALUES
(47, 'Adesivo JavaScript', 'Sticker em Vinil impresso em alta resolução. Ideal para Notebooks mas como é impermeável e resistente a luz solar pode ser usado até em aplicações externas como carros, janelas com uma ótima durabilidade.', 3.99, 14, 'png', '1737156162'),
(48, 'Processador AMD Ryzen 7 5700X3D', ' O AMD Ryzen 7 5700X3D é um processador de alto desempenho, especialmente projetado para gamers. Com sua tecnologia 3D V-Cache, ele oferece um desempenho excepcional em jogos, permitindo que você experimente taxas de quadros mais altas e uma experiência de jogo mais fluida.', 1699.99, 17, 'webp', '1737115394'),
(49, 'Adesivo HTML', 'Sticker em Vinil impresso em alta resolução. Ideal para Notebooks mas como é impermeável e resistente a luz solar pode ser usado até em aplicações externas como carros, janelas com uma ótima durabilidade.', 2.99, 14, 'png', '1737115442'),
(50, 'Adesivo C++', 'Sticker em Vinil impresso em alta resolução. Ideal para Notebooks mas como é impermeável e resistente a luz solar pode ser usado até em aplicações externas como carros, janelas com uma ótima durabilidade.', 4.99, 14, 'png', '1737115470'),
(51, 'JBL PartyBox Stage 320', 'Curta o som com o poderoso JBL Pro Sound de dois woofers de 6,5 pol. que oferecem graves limpos, precisos e profundos, mesmo no volume máximo, e um par de tweeters de domo de 25 mm que produzem agudos cristalinos. Dentro ou ao ar livre, é possível preencher um espaço do tamanho de uma quadra de tênis com música.', 3899.99, 22, 'webp', '1737115548'),
(52, 'Processador AMD Ryzen 5 4600G', 'Esteja você jogando, trabalhando ou fazendo as tarefas do cotidiano, a velocidade sem precedentes dos processadores AMD Ryzen série 4000 G para desktop é imparável. Com os processadores AMD Ryzen para desktop, você está sempre na frente.', 819.99, 17, 'webp', '1737115592'),
(53, 'MSI NVIDIA GeForce RTX 4060 VENTUS 2X Black 8G OC', 'O VENTUS traz uma experiência fundamentalmente sólida para usuários que procuram uma placa gráfica de alto desempenho. Um design atualizado de aparência nítida com o TORX FAN 4.0 permite que o VENTUS passe por qualquer tarefa. ', 2399.99, 20, 'webp', '1737115644'),
(54, 'GIGABYTE NVIDIA RTX 4070 Super Windforce', 'Domine seus jogos com a potência da RTX 4070 SUPER. Equipada com a revolucionária arquitetura NVIDIA Ada Lovelace, esta placa de vídeo oferece um salto quântico em desempenho, proporcionando gráficos hiper-realistas e taxas de quadros incríveis.', 7099.99, 20, 'webp', '1737115728'),
(55, 'Notebook Gamer ASUS ROG Zephyrus G16, Intel Core Ultra 9 185H, 32GB, 2000GB SSD, RTX4080,16\" 2.5K, 2', 'Desempenho, precisão e sofisticação definem o ROG Zephyrus G16. Mais fino e elegante do que nunca, o ROG Zephyrus G16 continua mantendo o mesmo estilo e individualidade que sempre o diferenciou. Com um chassis totalmente em alumínio usinado em CNC, este notebook é a combinação perfeita de desempenho e estilo.', 31999.99, 12, 'webp', '1737115824'),
(56, 'ASROCK AMD RX 6600 CLD 8G', 'Dois ventiladores que fornecem forte desempenho de resfriamento e fazem seu equipamento de jogo permanecer frio. Ele é otimizado para oferecer uma excelente experiência de jogo com um design elegante e aerodinâmico.', 1399.99, 20, 'webp', '1737116037'),
(57, 'XFX AMD RX 6600 Core Gaming Speedster SWFT 210', 'Apresentando as placas de vídeo AMD Radeon RX 6600 Series, com a arquitetura inovadora AMD RDNA.\r\n\r\nProjetado para oferecer uma incrível experiência de jogo em 1080p, o AMD Radeon  RX 6600 Series capacita a próxima geração de jogos com visuais vívidos e experiências elevadas.\r\n\r\n\r\nEncontrar o equilíbrio entre um cartão bonito e maximizar seu desempenho é uma arte. \r\n\r\n\r\nOnde podíamos melhorar o fluxo de ar, nós o fizemos, abrimos enquanto mantemos o design limpo e fresco.', 1449.99, 20, 'webp', '1737116118'),
(58, 'Apple iPhone 15 (128 GB) Azul', 'Phone 15 Apple 128GB Azul<br> <br><br>A Dynamic Island Chega ao Iphone 15:<br>A Dynamic mostra alertas e Atividades ao Vivo para você não perder nenhuma informação enquanto faz outras coisas. Você pode acompanhar sua próxima corrida, saber quem está ligando, confirmar as informações do seu voo e muito mais. <br><br> <br><br>Design Inovador<br>O iPhone 15 tem vidro resistente colorido por infusão e design em alumínio. Ele aguenta o tranco contra respingos, água e poeira. A parte da frente em Ceramic Shield é mais resistente que qualquer vidro de smartphone. E a tela Super Retina XDR de 6,1 pol. é até duas vezes mais visível sob o sol em comparação com o iPhone 14. <br><br> <br><br>Câmera Grande-Angular de 48MP com Teleobjetiva de 2X<br>A câmera grande-angular de 48 MP fotografa em altíssima resolução. Assim, fica ainda mais fácil fazer fotos com detalhes incríveis. A teleobjetiva de 2x com qualidade óptica ajuda no enquadramento do close perfeito. <br><br> <br><br>O Futuro Chegou aos Retratos<br>Faça retratos com mais detalhes e intensidade de cores. É só tocar para mudar o foco de uma pessoa para outra, mesmo depois do clique. <br><br> <br><br>Poderoso Chip A16 Bionic<br>O chip ultrarrápido possibilita recursos avançados, como a fotografia computacional, as transições fluidas da Dynamic Island e o Isolamento de Voz para ligações. E o A16 Bionic tem eficiência de sobra para que a bateria dure o dia todo.  <br><br> <br><br>Conectividade USB-C<br>Com a porta USB-C, você recarrega seu iPhone 15 com o mesmo cabo que usa para recarregar o Mac ou o iPad. Você pode até utilizar o iPhone 15 para recarregar o Apple Watch ou os AirPods. <br><br> <br><br>Recurso Essencial de Segurança<br>Com a Detecção de Acidente, o iPhone é capaz de identificar se você sofreu um acidente grave de carro e ligar para a emergência se você não puder.  <br><br> <br><br>Projetado para fazer a Diferença<br>O iPhone protege sua privacidade e dá a você o controle dos seus dados. Ele é feito com mais materiais reciclados para minimizar o impacto ambiental. E vem com recursos integrados para tornar o iPhone acessível a todas as pessoas. ', 4999.99, 1, 'webp', '1737118118'),
(59, 'Samsung Galaxy S24 256GB Violeta', 'O Samsung Galaxy S24 é um produto com poucos concorrentes em termos de multimídia graças à câmera de 50 megapixels que permite ao Samsung Galaxy S24 tirar fotos fantásticas com uma resolução de 8165x6124 pixels e gravar vídeos em 8K a espantosa resolução de 7680x4320 pixels. A espessura de 7.6mm torna o Samsung Galaxy S24 um dos telefones mais completos e finos.', 6399.99, 1, 'png', '1737118248'),
(60, 'Bone do Vasco', 'Torça para seu time como um vascaino de verdade.', 120.99, 23, 'webp', '1737121332'),
(64, 'Adesivo Python', 'Sticker em Vinil impresso em alta resolução. Ideal para Notebooks mas como é impermeável e resistente a luz solar pode ser usado até em aplicações externas como carros, janelas com uma ótima durabilidade.', 4.99, 14, 'png', '1737225371'),
(65, 'Monitor Gamer Curvo LG UltraGear LG 34\", UltraWide, 160Hz, WQHD, 1ms, DisplayPort e HDMI, AMD FreeSy', 'Experiência Imersiva e Produtividade<br>Se você está em busca de uma experiência imersiva para diversos tipos de jogos, como estratégia, FPS e corrida, este monitor é perfeito para você. Com a resolução QHD UltraWide (3440x1440), você ganha 30% a mais de área de tela, garantindo que nenhum detalhe do jogo passe despercebido. Além disso, o modelo conta com som estéreo 7W com MaxxAudio, oferecendo uma qualidade de som envolvente. A proporção de tela 21:9 também aumenta sua produtividade, permitindo que você acesse dois conteúdos simultaneamente na mesma tela, ideal para jogar e transmitir ou trabalhar ao mesmo tempo.<br><br> <br><br>Taxa de Atualização e Tempo de Resposta<br>Com uma taxa de atualização de 160Hz, o monitor garante uma jogabilidade suave e fluida, especialmente durante a transição de quadros nos jogos. O tempo de resposta de 1ms (MBR) torna o monitor extremamente responsivo, proporcionando uma experiência de jogo mais ágil e precisa.<br><br> <br><br>Recursos<br>Gamer para te dar ainda mais vantagem enquanto joga como o AMD FreeSync Premium, Black Stabilizer, Crosshair, Dynamic Action Sync e Motion Blur Reduction.', 2199.99, 24, 'webp', '1737404302');

-- --------------------------------------------------------

--
-- Estrutura para tabela `usuario`
--

CREATE TABLE `usuario` (
  `Id` int(11) NOT NULL,
  `usuario` varchar(50) NOT NULL,
  `senha` char(32) NOT NULL,
  `email` varchar(50) NOT NULL,
  `telefone` varchar(17) NOT NULL,
  `primeiro_nome` varchar(50) NOT NULL,
  `sobrenome` varchar(50) NOT NULL,
  `nascimento` date NOT NULL,
  `CPF` char(20) NOT NULL,
  `numero` int(11) NOT NULL,
  `bairro` text NOT NULL,
  `endereco` text NOT NULL,
  `cidade` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `usuario`
--

INSERT INTO `usuario` (`Id`, `usuario`, `senha`, `email`, `telefone`, `primeiro_nome`, `sobrenome`, `nascimento`, `CPF`, `numero`, `bairro`, `endereco`, `cidade`) VALUES
(7, 'Rodolfo', '25f9e794323b453885f5181f1b624d0b', 'rodolfo@outlook.com', '2233421282', 'Roldofo', 'Da Silva', '1997-03-06', '40245523251', 687, 'Jardim La Salle', 'Rua Três', 'Toledo');

-- --------------------------------------------------------

--
-- Estrutura para tabela `venda`
--

CREATE TABLE `venda` (
  `Id` int(11) NOT NULL,
  `UsuarioId` int(11) NOT NULL,
  `ProdutoId` int(11) NOT NULL,
  `Quantidade` int(11) NOT NULL,
  `Valor` decimal(10,2) NOT NULL,
  `Metodo_Pagamento` varchar(20) NOT NULL,
  `Endereco` text NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `venda`
--

INSERT INTO `venda` (`Id`, `UsuarioId`, `ProdutoId`, `Quantidade`, `Valor`, `Metodo_Pagamento`, `Endereco`, `timestamp`) VALUES
(23, 7, 47, 5, 19.95, 'MercadoPago', '687, Rua Três, Jardim La Salle, Toledo', '2025-01-20 20:15:50'),
(24, 7, 52, 3, 2459.97, 'Boleto', '687, Rua Três, Jardim La Salle, Toledo', '2025-01-20 20:16:18'),
(25, 7, 65, 3, 6599.97, 'Pix', '687, Rua Três, Jardim La Salle, Toledo', '2025-01-20 20:18:34'),
(26, 7, 64, 3, 14.97, 'Boleto', '687, Rua Três, Jardim La Salle, Toledo', '2025-01-20 20:38:48');

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`Id`),
  ADD UNIQUE KEY `Username` (`Username`);

--
-- Índices de tabela `categoria`
--
ALTER TABLE `categoria`
  ADD PRIMARY KEY (`Id`),
  ADD UNIQUE KEY `Nome` (`Nome`);

--
-- Índices de tabela `produto`
--
ALTER TABLE `produto`
  ADD PRIMARY KEY (`Id`),
  ADD KEY `CategoriaId` (`CategoriaId`);

--
-- Índices de tabela `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`Id`),
  ADD UNIQUE KEY `usuario` (`usuario`),
  ADD UNIQUE KEY `CPF` (`CPF`);

--
-- Índices de tabela `venda`
--
ALTER TABLE `venda`
  ADD PRIMARY KEY (`Id`),
  ADD KEY `UsuarioId` (`UsuarioId`),
  ADD KEY `ProdutoId` (`ProdutoId`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `admin`
--
ALTER TABLE `admin`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de tabela `categoria`
--
ALTER TABLE `categoria`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT de tabela `produto`
--
ALTER TABLE `produto`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=66;

--
-- AUTO_INCREMENT de tabela `usuario`
--
ALTER TABLE `usuario`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de tabela `venda`
--
ALTER TABLE `venda`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- Restrições para tabelas despejadas
--

--
-- Restrições para tabelas `produto`
--
ALTER TABLE `produto`
  ADD CONSTRAINT `produto_ibfk_1` FOREIGN KEY (`CategoriaId`) REFERENCES `categoria` (`Id`) ON DELETE CASCADE;

--
-- Restrições para tabelas `venda`
--
ALTER TABLE `venda`
  ADD CONSTRAINT `venda_ibfk_1` FOREIGN KEY (`UsuarioId`) REFERENCES `usuario` (`Id`) ON DELETE CASCADE,
  ADD CONSTRAINT `venda_ibfk_2` FOREIGN KEY (`ProdutoId`) REFERENCES `produto` (`Id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
