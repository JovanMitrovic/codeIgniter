SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

CREATE TABLE `articles` (
  `id` int(11) NOT NULL,
  `title` varchar(60) CHARACTER SET utf8 NOT NULL,
  `description` text CHARACTER SET utf8 NOT NULL,
  `created_at` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


INSERT INTO `articles` (`id`, `title`, `description`, `created_at`) VALUES
(1, 'Naslov članka jedan', '<p>ok</p>', '2020-11-22'),
(2, 'Naslov članka dva', '<p>ok</p>', '2020-11-22'),
(3, 'Naslov članka tri', '<p>ok <strong>tekst</strong></p>', '2020-11-22');

CREATE TABLE `images` (
  `id` int(11) NOT NULL,
  `article_id` int(11) NOT NULL,
  `name` varchar(100) CHARACTER SET utf8 NOT NULL,
  `size` varchar(100) CHARACTER SET utf8 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(64) CHARACTER SET utf8 NOT NULL,
  `password` varchar(64) CHARACTER SET utf8 NOT NULL,
  `email` varchar(50) CHARACTER SET utf8 NOT NULL,
  `first_name` varchar(250) NOT NULL,
  `last_name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `users` (`id`, `username`, `password`, `email`, `first_name`, `last_name`) VALUES
(2, 'admin', '$2y$10$3vUPpBUFBOUzCDtstZxjbuWXazBuTgQZEetC5h/UU.NFHqtqGtmhS', 'admin@admin.com', 'Marko', 'Marković');

ALTER TABLE `articles`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `images`
  ADD PRIMARY KEY (`id`),
  ADD KEY `article_id` (`article_id`);

ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `articles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

ALTER TABLE `images`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

