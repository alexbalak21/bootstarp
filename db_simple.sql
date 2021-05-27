CREATE TABLE `users` (
  `id` int(6) UNSIGNED NOT NULL,
  `email` varchar(50) NOT NULL,
  `firstname` varchar(50) NOT NULL,
  `lastname` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `token` varchar(255) DEFAULT NULL,
  `img` varchar(255) NOT NULL DEFAULT 'profile.png',
  `reg_date` date DEFAULT NULL,
  `validated` tinyint(1) DEFAULT 0,
  `validation` varchar(255) DEFAULT NULL,
  `activated` tinyint(1) DEFAULT 1
);


CREATE TABLE `events` (
  `id` int(6) UNSIGNED NOT NULL,
  `creatorID` int(6) UNSIGNED DEFAULT NULL,
  `name` varchar(150) DEFAULT NULL,
  `category` varchar(50) DEFAULT NULL,
  `place` varchar(255) DEFAULT NULL,
  `city` varchar(50) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `img` varchar(50) DEFAULT NULL,
  `active` tinyint(1) NOT NULL DEFAULT 1,
  `postDate` date DEFAULT NULL,
  `date` date DEFAULT NULL,
  `time` time DEFAULT NULL,
  `subscribed` int(2) DEFAULT 0,
  FOREIGN KEY (creatorID) REFERENCES users(id)
);

CREATE TABLE `subs` (
  `id` int(6) UNSIGNED NOT NULL,
  `eventID` int(6) UNSIGNED DEFAULT NULL,
  `userID` int(6) UNSIGNED DEFAULT NULL,
  `subTime` timestamp NOT NULL DEFAULT current_timestamp(),
  FOREIGN KEY (userID) REFERENCES users(id),
  FOREIGN KEY (eventID) REFERENCES events(id)
);


CREATE TABLE `messages` (
  `id` int(6) UNSIGNED NOT NULL,
  `formID` int(6) UNSIGNED DEFAULT NULL,
  `toID` int(6) UNSIGNED DEFAULT NULL,
  `subject` varchar(50) DEFAULT NULL,
  `body` text DEFAULT NULL,
  `sentAt` timestamp NOT NULL DEFAULT current_timestamp(),
  `read` tinyint(1) DEFAULT 0,
  FOREIGN KEY (formID) REFERENCES users(id),
  FOREIGN KEY (toID) REFERENCES users(id)
);