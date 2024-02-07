-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Creato il: Feb 07, 2024 alle 02:40
-- Versione del server: 10.4.28-MariaDB
-- Versione PHP: 8.0.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

--
-- Database: `foodbook`
--

-- --------------------------------------------------------

--
-- Struttura della tabella `belong`
--

CREATE TABLE `belong` (
  `IdCategory` decimal(4,0) NOT NULL,
  `Username` varchar(20) NOT NULL,
  `IdPost` decimal(6,0) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struttura della tabella `category`
--

CREATE TABLE `category` (
  `IdCategory` decimal(4,0) NOT NULL,
  `CategoryName` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dump dei dati per la tabella `category`
--

INSERT INTO `category` (`IdCategory`, `CategoryName`) VALUES
(1, 'Appetizer'),
(2, 'Cocktail'),
(3, 'Dessert'),
(4, 'Drink'),
(5, 'Fish'),
(6, 'Main Course'),
(7, 'Meat'),
(8, 'Salad'),
(9, 'Snack'),
(10, 'Soup'),
(11, '15min'),
(12, '30min'),
(13, '45min'),
(14, '1h-2h'),
(15, '2h-3h'),
(16, '3h-4h'),
(17, '4h+'),
(18, 'Gluten-Free'),
(19, 'Pescetarian'),
(20, 'Vegan'),
(21, 'Vegetarian'),
(22, 'Beginner'),
(23, 'Intermediate'),
(24, 'Expert'),
(25, '$'),
(26, '$$'),
(27, '$$$');

-- --------------------------------------------------------

--
-- Struttura della tabella `comment`
--

CREATE TABLE `comment` (
  `Post_Publisher` varchar(20) NOT NULL,
  `Username_Who_Commented` varchar(20) NOT NULL,
  `IdPost` decimal(6,0) NOT NULL,
  `DateAndTime` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `Comment_Text` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struttura della tabella `follow`
--

CREATE TABLE `follow` (
  `Follower_Username` varchar(20) NOT NULL,
  `Username` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struttura della tabella `image`
--

CREATE TABLE `image` (
  `Username` varchar(20) NOT NULL,
  `IdPost` decimal(6,0) NOT NULL,
  `Images` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struttura della tabella `likes`
--

CREATE TABLE `likes` (
  `Post_Publisher` varchar(20) NOT NULL,
  `Username_Who_Liked` varchar(20) NOT NULL,
  `IdPost` decimal(6,0) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struttura della tabella `notification`
--

CREATE TABLE `notification` (
  `UsernameTo` varchar(20) NOT NULL,
  `UsernameFrom` varchar(20) NOT NULL,
  `Type` int(1) NOT NULL,
  `DateAndTime` timestamp NOT NULL DEFAULT current_timestamp(),
  `IdPost` decimal(6,0) NOT NULL,
  `IsRead` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struttura della tabella `post`
--

CREATE TABLE `post` (
  `Username` varchar(20) NOT NULL,
  `IdPost` decimal(6,0) NOT NULL,
  `DateAndTime` date NOT NULL,
  `Text` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struttura della tabella `users`
--

CREATE TABLE `users` (
  `Username` varchar(20) NOT NULL,
  `Name` varchar(20) NOT NULL,
  `Surname` varchar(20) NOT NULL,
  `BirthDate` date NOT NULL,
  `Password` varchar(255) NOT NULL,
  `ProfilePicture` varchar(255) DEFAULT NULL,
  `E_mail` varchar(30) NOT NULL,
  `Bio` varchar(150) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indici per le tabelle scaricate
--

--
-- Indici per le tabelle `belong`
--
ALTER TABLE `belong`
  ADD PRIMARY KEY (`Username`,`IdPost`,`IdCategory`),
  ADD UNIQUE KEY `ID_BELONG_IND` (`Username`,`IdPost`,`IdCategory`),
  ADD KEY `REF_BELON_CATEG_IND` (`IdCategory`);

--
-- Indici per le tabelle `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`IdCategory`),
  ADD UNIQUE KEY `ID_CATEGORY_IND` (`IdCategory`);

--
-- Indici per le tabelle `comment`
--
ALTER TABLE `comment`
  ADD PRIMARY KEY (`Post_Publisher`,`Username_Who_Commented`,`DateAndTime`);

--
-- Indici per le tabelle `follow`
--
ALTER TABLE `follow`
  ADD PRIMARY KEY (`Follower_Username`,`Username`),
  ADD UNIQUE KEY `ID_FOLLOW_IND` (`Follower_Username`,`Username`),
  ADD KEY `REF_FOLLO_USER_1_IND` (`Username`);

--
-- Indici per le tabelle `image`
--
ALTER TABLE `image`
  ADD PRIMARY KEY (`Username`,`IdPost`,`Images`),
  ADD UNIQUE KEY `ID_Images_IND` (`Username`,`IdPost`,`Images`);

--
-- Indici per le tabelle `likes`
--
ALTER TABLE `likes`
  ADD PRIMARY KEY (`Post_Publisher`,`Username_Who_Liked`,`IdPost`);

--
-- Indici per le tabelle `notification`
--
ALTER TABLE `notification`
  ADD PRIMARY KEY (`UsernameTo`,`UsernameFrom`,`DateAndTime`);

--
-- Indici per le tabelle `post`
--
ALTER TABLE `post`
  ADD PRIMARY KEY (`Username`,`IdPost`),
  ADD UNIQUE KEY `ID_POST_IND` (`Username`,`IdPost`);

--
-- Indici per le tabelle `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`Username`),
  ADD UNIQUE KEY `ID_USER_IND` (`Username`);

--
-- Limiti per le tabelle scaricate
--

--
-- Limiti per la tabella `belong`
--
ALTER TABLE `belong`
  ADD CONSTRAINT `EQU_BELON_POST` FOREIGN KEY (`Username`,`IdPost`) REFERENCES `post` (`Username`, `IdPost`),
  ADD CONSTRAINT `REF_BELON_CATEG_FK` FOREIGN KEY (`IdCategory`) REFERENCES `category` (`IdCategory`);

--
-- Limiti per la tabella `comment`
--
ALTER TABLE `comment`
  ADD CONSTRAINT `REF_COMM_USER_FK` FOREIGN KEY (`Post_Publisher`,`Username_Who_Commented`) REFERENCES `notification` (`UsernameTo`, `UsernameFrom`);

--
-- Limiti per la tabella `follow`
--
ALTER TABLE `follow`
  ADD CONSTRAINT `REF_FOLLO_USER_1_FK` FOREIGN KEY (`Username`) REFERENCES `users` (`Username`);

--
-- Limiti per la tabella `image`
--
ALTER TABLE `image`
  ADD CONSTRAINT `REF_Image_POST` FOREIGN KEY (`Username`,`IdPost`) REFERENCES `post` (`Username`, `IdPost`);

--
-- Limiti per la tabella `likes`
--
ALTER TABLE `likes`
  ADD CONSTRAINT `REF_INTER_USER_FK` FOREIGN KEY (`Post_Publisher`,`Username_Who_Liked`) REFERENCES `notification` (`UsernameTo`, `UsernameFrom`);

--
-- Limiti per la tabella `post`
--
ALTER TABLE `post`
  ADD CONSTRAINT `REF_POST_USER` FOREIGN KEY (`Username`) REFERENCES `users` (`Username`);
COMMIT;

