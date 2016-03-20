-- phpMyAdmin SQL Dump
-- version 4.0.10deb1
-- http://www.phpmyadmin.net
--
-- Hoszt: localhost
-- Létrehozás ideje: 2016. Már 19. 18:50
-- Szerver verzió: 5.5.47-0ubuntu0.14.04.1
-- PHP verzió: 5.5.9-1ubuntu4.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Adatbázis: `whoosaler`
--

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `customer`
--

CREATE TABLE IF NOT EXISTS `customer` (
  `id` int(11) NOT NULL,
  `name` varchar(45) DEFAULT NULL,
  `address` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- A tábla adatainak kiíratása `customer`
--

INSERT INTO `customer` (`id`, `name`, `address`) VALUES
(1, 'Lidl Óbuda 1', '1035 Budapest Rádl Árok 7'),
(2, 'CBA Raktár utca', '1035 Budapet Raktár utca 16'),
(3, 'CBA Flórián tér', '1037 Budapest Flórián tér 9');

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `product`
--

CREATE TABLE IF NOT EXISTS `product` (
  `id` int(11) NOT NULL,
  `name` varchar(45) DEFAULT NULL,
  `desc` varchar(100) DEFAULT NULL,
  `stock` int(5) DEFAULT NULL,
  `price` int(7) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- A tábla adatainak kiíratása `product`
--

INSERT INTO `product` (`id`, `name`, `desc`, `stock`, `price`) VALUES
(1, 'Kirstályvíz 6x1,5 (liter)', 'Az árak és a mennyiség egy zsugor ásványvízre értend?k', 3000, 240),
(2, 'Magyar tejföl 450ml', '', 4000, 350),
(3, 'Túró rudi 15gr', '15 grammos túró rudi', 7000, 200);

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `sale`
--

CREATE TABLE IF NOT EXISTS `sale` (
  `product_id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `stock` int(5) DEFAULT NULL,
  `price` int(7) DEFAULT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  KEY `product_id` (`product_id`),
  KEY `customer_id` (`customer_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- A tábla adatainak kiíratása `sale`
--

INSERT INTO `sale` (`product_id`, `customer_id`, `stock`, `price`, `date`) VALUES
(1, 1, 100, 24000, '2016-03-19 17:49:57'),
(2, 1, 200, 70000, '2016-03-19 17:49:57');

--
-- Megkötések a kiírt táblákhoz
--

--
-- Megkötések a táblához `sale`
--
ALTER TABLE `sale`
  ADD CONSTRAINT `sale_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`),
  ADD CONSTRAINT `sale_ibfk_2` FOREIGN KEY (`customer_id`) REFERENCES `customer` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
