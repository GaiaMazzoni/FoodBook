CREATE DATABASE `foodbook`;

USE `foodbook`;

CREATE TABLE `belong` (
  `IdCategory` decimal(4,0) NOT NULL,
  `Username` varchar(20) NOT NULL,
  `IdPost` decimal(6,0) NOT NULL
);

CREATE TABLE `category` (
  `IdCategory` decimal(4,0) NOT NULL,
  `CategoryName` varchar(20) NOT NULL
);

CREATE TABLE `comment` (
  `Post_Publisher` varchar(20) NOT NULL,
  `Username_Who_Commented` varchar(20) NOT NULL,
  `IdPost` decimal(6,0) NOT NULL,
  `DateAndTime` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `Comment_Text` text NOT NULL
);

CREATE TABLE `follow` (
  `Follower_Username` varchar(20) NOT NULL,
  `Username` varchar(20) NOT NULL
);

CREATE TABLE `image` (
  `Username` varchar(20) NOT NULL,
  `IdPost` decimal(6,0) NOT NULL,
  `Images` varchar(255) NOT NULL
);

CREATE TABLE `likes` (
  `Post_Publisher` varchar(20) NOT NULL,
  `Username_Who_Liked` varchar(20) NOT NULL,
  `IdPost` decimal(6,0) NOT NULL
);

CREATE TABLE `notification` (
  `UsernameTo` varchar(20) NOT NULL,
  `UsernameFrom` varchar(20) NOT NULL,
  `Type` int(1) NOT NULL,
  `DateAndTime` timestamp NOT NULL DEFAULT current_timestamp(),
  `IdPost` decimal(6,0) NOT NULL,
  `IsRead` int(1) NOT NULL
);

CREATE TABLE `post` (
  `Username` varchar(20) NOT NULL,
  `IdPost` decimal(6,0) NOT NULL,
  `DateAndTime` date NOT NULL,
  `Text` text NOT NULL
);

CREATE TABLE `users` (
  `Username` varchar(20) NOT NULL,
  `Name` varchar(20) NOT NULL,
  `Surname` varchar(20) NOT NULL,
  `BirthDate` date NOT NULL,
  `Password` varchar(255) NOT NULL,
  `ProfilePicture` varchar(255) DEFAULT NULL,
  `E_mail` varchar(30) NOT NULL,
  `Bio` varchar(150) DEFAULT NULL
);


ALTER TABLE `belong`
  ADD PRIMARY KEY (`Username`,`IdPost`,`IdCategory`),
  ADD UNIQUE KEY `ID_BELONG_IND` (`Username`,`IdPost`,`IdCategory`),
  ADD KEY `REF_BELON_CATEG_IND` (`IdCategory`);

ALTER TABLE `category`
  ADD PRIMARY KEY (`IdCategory`),
  ADD UNIQUE KEY `ID_CATEGORY_IND` (`IdCategory`);

ALTER TABLE `comment`
  ADD PRIMARY KEY (`Post_Publisher`,`Username_Who_Commented`,`DateAndTime`);

ALTER TABLE `follow`
  ADD PRIMARY KEY (`Follower_Username`,`Username`),
  ADD UNIQUE KEY `ID_FOLLOW_IND` (`Follower_Username`,`Username`),
  ADD KEY `REF_FOLLO_USER_1_IND` (`Username`);

ALTER TABLE `image`
  ADD PRIMARY KEY (`Username`,`IdPost`,`Images`),
  ADD UNIQUE KEY `ID_Images_IND` (`Username`,`IdPost`,`Images`);

ALTER TABLE `likes`
  ADD PRIMARY KEY (`Post_Publisher`,`Username_Who_Liked`,`IdPost`);

ALTER TABLE `notification`
  ADD PRIMARY KEY (`UsernameTo`,`UsernameFrom`,`DateAndTime`);

ALTER TABLE `post`
  ADD PRIMARY KEY (`Username`,`IdPost`),
  ADD UNIQUE KEY `ID_POST_IND` (`Username`,`IdPost`);

ALTER TABLE `users`
  ADD PRIMARY KEY (`Username`),
  ADD UNIQUE KEY `ID_USER_IND` (`Username`);

ALTER TABLE `belong`
  ADD CONSTRAINT `EQU_BELON_POST` FOREIGN KEY (`Username`,`IdPost`) REFERENCES `post` (`Username`, `IdPost`),
  ADD CONSTRAINT `REF_BELON_CATEG_FK` FOREIGN KEY (`IdCategory`) REFERENCES `category` (`IdCategory`);

ALTER TABLE `comment`
  ADD CONSTRAINT `REF_COMM_USER_FK` FOREIGN KEY (`Post_Publisher`,`Username_Who_Commented`) REFERENCES `notification` (`UsernameTo`, `UsernameFrom`);

ALTER TABLE `follow`
  ADD CONSTRAINT `REF_FOLLO_USER_1_FK` FOREIGN KEY (`Username`) REFERENCES `users` (`Username`);

ALTER TABLE `image`
  ADD CONSTRAINT `REF_Image_POST` FOREIGN KEY (`Username`,`IdPost`) REFERENCES `post` (`Username`, `IdPost`);

ALTER TABLE `likes`
  ADD CONSTRAINT `REF_INTER_USER_FK` FOREIGN KEY (`Post_Publisher`,`Username_Who_Liked`) REFERENCES `notification` (`UsernameTo`, `UsernameFrom`);

ALTER TABLE `post`
  ADD CONSTRAINT `REF_POST_USER` FOREIGN KEY (`Username`) REFERENCES `users` (`Username`);