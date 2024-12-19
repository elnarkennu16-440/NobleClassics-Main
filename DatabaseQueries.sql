CREATE TABLE `cart` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `name` varchar(100) NOT NULL,
  `price` int NOT NULL,
  `quantity` int NOT NULL,
  `image` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
);

CREATE TABLE `message` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `number` varchar(12) NOT NULL,
  `message` varchar(500) NOT NULL,
  `sent_at` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
);


CREATE TABLE `orders` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `name` varchar(100) NOT NULL,
  `number` varchar(12) NOT NULL,
  `email` varchar(100) NOT NULL,
  `method` varchar(50) NOT NULL,
  `address` varchar(500) NOT NULL,
  `total_products` varchar(1000) NOT NULL,
  `total_price` int NOT NULL,
  `placed_on` varchar(50) NOT NULL,
  `payment_status` varchar(20) NOT NULL DEFAULT 'pending',
  PRIMARY KEY (`id`)
);

CREATE TABLE `products` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `price` int NOT NULL,
  `image` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
);


INSERT INTO `products` (`id`, `name`, `price`, `image`) VALUES
(1, 'PRIDE AND PREJUDICE', 650, 'PrideAndPrejudiceBook1.jpg'),
(2, '1984', 520, '1984Book2.jpg'),
(3, 'TO KILL A MOCKING BIRD', 620, 'ToKillAMockingBirdBook3.jpg'),
(4, 'MOBY DICK', 499, 'MobyDickBook4.jpg'),
(5, 'THE GREAT GATSBY', 580, 'TheGreatGatsbyBook5.jpg'),
(6, 'JANE EYRE', 720, 'JaneEyreBook6.jpg'),
(7, 'CRIME AND PUNISHMENT', 650, 'CrimeAndPunishmentBook7.jpg'),
(8, 'THE CATCHER IN THE RYE', 520, 'TheCatcherInTheRyeBook8.jpg'),
(9, 'LES MISERABLES', 799, 'LesMiserablesBook10.jpg');


CREATE TABLE `register` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `user_type` varchar(20) NOT NULL DEFAULT 'user',
  PRIMARY KEY (`id`)
);

ALTER TABLE `cart`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;

ALTER TABLE `message`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

ALTER TABLE `orders`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

ALTER TABLE `products`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

ALTER TABLE `register`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

COMMIT;
