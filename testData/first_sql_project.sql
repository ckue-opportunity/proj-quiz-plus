-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: mysql_db:3306
-- Generation Time: Jun 27, 2021 at 01:54 PM
-- Server version: 5.7.34
-- PHP Version: 7.4.20

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `first_sql_project`
--

-- --------------------------------------------------------

--
-- Table structure for table `Answer`
--

CREATE TABLE `Answer` (
  `Id` int NOT NULL,
  `Text` varchar(500) NOT NULL,
  `IsRightAnswer` tinyint(1) NOT NULL,
  `QuestionId` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Answer`
--

INSERT INTO `Answer` (`Id`, `Text`, `IsRightAnswer`, `QuestionId`) VALUES
(1, 'Weil die Banane sonst seltsam aussehen würde. ', 1, 1),
(2, 'Weiss nicht.', 0, 1),
(3, '8', 1, 2),
(4, '6', 0, 2),
(5, '9', 0, 2),
(6, 'Weil die Banane sonst nicht in die Schale passen würde.', 0, 1),
(7, '7', 0, 3),
(8, '8', 1, 3),
(9, '9', 0, 3),
(10, '2', 0, 4),
(11, '9', 0, 4),
(12, '3', 1, 4),
(13, '5', 0, 5),
(14, '7', 1, 5),
(15, '6', 0, 5);

-- --------------------------------------------------------

--
-- Table structure for table `Guess`
--

CREATE TABLE `Guess` (
  `Id` int NOT NULL,
  `QuizRunId` int NOT NULL,
  `QuestionId` int NOT NULL,
  `AnswerId` int NOT NULL,
  `IsRightGuess` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `Question`
--

CREATE TABLE `Question` (
  `Id` int NOT NULL,
  `Text` varchar(500) NOT NULL,
  `Type` enum('NONSENSE','IT','NATURE','MATH') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Question`
--

INSERT INTO `Question` (`Id`, `Text`, `Type`) VALUES
(1, 'Warum ist die Banane krumm? ', 'NONSENSE'),
(2, 'Wieviele Beine hat eine Spinne?', 'NATURE'),
(3, '3 + 5 = ? ', 'MATH'),
(4, '10 - 7 = ? ', 'MATH'),
(5, 'Wieviele Junge haben die Schwäne dieses Jahr am Lindli? ', 'NATURE'),
(6, '3 * 7 = ?', 'MATH');

-- --------------------------------------------------------

--
-- Table structure for table `QuizRun`
--

CREATE TABLE `QuizRun` (
  `Id` int NOT NULL,
  `UserId` int NOT NULL,
  `Timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `ShopOrder`
--

CREATE TABLE `ShopOrder` (
  `Id` int NOT NULL,
  `Status` enum('ORDERED','SENT','PAID','RETURNED') NOT NULL,
  `OrderDate` date NOT NULL,
  `CustomerId` int NOT NULL,
  `CustomerName` varchar(100) NOT NULL,
  `CustomerAddress` varchar(100) NOT NULL,
  `ArticleId` int NOT NULL,
  `ArticleName` varchar(100) NOT NULL,
  `ArticleQuantity` int NOT NULL,
  `ArticlePrice` float NOT NULL,
  `TotalPrice` float NOT NULL,
  `Comment` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ShopOrder`
--

INSERT INTO `ShopOrder` (`Id`, `Status`, `OrderDate`, `CustomerId`, `CustomerName`, `CustomerAddress`, `ArticleId`, `ArticleName`, `ArticleQuantity`, `ArticlePrice`, `TotalPrice`, `Comment`) VALUES
(1, 'ORDERED', '2021-06-22', 1, 'Neuer Kunde', 'Addresse des neuen Kunden', 1, 'Superguter Artikel', 3, 5, 15, 1),
(2, 'ORDERED', '2021-06-22', 1, 'Neuer Kunde', 'Addresse des neuen Kunden', 1, 'Ein anderer superguter Artikel', 2, 20, 40, 1);

-- --------------------------------------------------------

--
-- Table structure for table `User`
--

CREATE TABLE `User` (
  `Id` int NOT NULL,
  `Firstname` varchar(100) NOT NULL,
  `Lastname` varchar(100) NOT NULL,
  `Email` varchar(100) NOT NULL,
  `Password` varchar(100) NOT NULL,
  `Age` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `User`
--

INSERT INTO `User` (`Id`, `Firstname`, `Lastname`, `Email`, `Password`, `Age`) VALUES
(1, 'Adelheide', 'Oberberger', 'adelheide@opportunity.ch', '97p05&%', 55),
(2, 'Mauer', 'Blümchen', 'mauer@opportunity.ch', '678/%658986', 22);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `Answer`
--
ALTER TABLE `Answer`
  ADD PRIMARY KEY (`Id`),
  ADD KEY `answer_question` (`QuestionId`);

--
-- Indexes for table `Guess`
--
ALTER TABLE `Guess`
  ADD PRIMARY KEY (`Id`),
  ADD KEY `guess_question` (`QuestionId`),
  ADD KEY `guess_quizRun` (`QuizRunId`),
  ADD KEY `guess_answer` (`AnswerId`);

--
-- Indexes for table `Question`
--
ALTER TABLE `Question`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `QuizRun`
--
ALTER TABLE `QuizRun`
  ADD PRIMARY KEY (`Id`),
  ADD KEY `quizRun_user` (`UserId`);

--
-- Indexes for table `ShopOrder`
--
ALTER TABLE `ShopOrder`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `User`
--
ALTER TABLE `User`
  ADD PRIMARY KEY (`Id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `Answer`
--
ALTER TABLE `Answer`
  MODIFY `Id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `Guess`
--
ALTER TABLE `Guess`
  MODIFY `Id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `Question`
--
ALTER TABLE `Question`
  MODIFY `Id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `QuizRun`
--
ALTER TABLE `QuizRun`
  MODIFY `Id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `User`
--
ALTER TABLE `User`
  MODIFY `Id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `Answer`
--
ALTER TABLE `Answer`
  ADD CONSTRAINT `answer_question` FOREIGN KEY (`QuestionId`) REFERENCES `Question` (`Id`);

--
-- Constraints for table `Guess`
--
ALTER TABLE `Guess`
  ADD CONSTRAINT `guess_answer` FOREIGN KEY (`AnswerId`) REFERENCES `Answer` (`Id`),
  ADD CONSTRAINT `guess_question` FOREIGN KEY (`QuestionId`) REFERENCES `Question` (`Id`),
  ADD CONSTRAINT `guess_quizRun` FOREIGN KEY (`QuizRunId`) REFERENCES `QuizRun` (`Id`);

--
-- Constraints for table `QuizRun`
--
ALTER TABLE `QuizRun`
  ADD CONSTRAINT `quizRun_user` FOREIGN KEY (`UserId`) REFERENCES `User` (`Id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
