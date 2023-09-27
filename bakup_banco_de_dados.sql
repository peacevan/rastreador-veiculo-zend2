-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               8.0.30 - MySQL Community Server - GPL
-- Server OS:                    Win64
-- HeidiSQL version:             7.0.0.4053
-- Date/time:                    2023-09-26 21:29:52
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET FOREIGN_KEY_CHECKS=0 */;

-- Dumping database structure for trafegus_test
CREATE DATABASE IF NOT EXISTS `trafegus_test` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `trafegus_test`;


-- Dumping structure for table trafegus_test.localizacao_veiculo
CREATE TABLE IF NOT EXISTS `localizacao_veiculo` (
  `id` int NOT NULL AUTO_INCREMENT,
  `longetude` int DEFAULT NULL,
  `latitude` int DEFAULT NULL,
  `data_ceated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `id_veiculo` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_localizacao` (`id_veiculo`),
  CONSTRAINT `fk_localizacao` FOREIGN KEY (`id_veiculo`) REFERENCES `veiculo` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table trafegus_test.localizacao_veiculo: ~0 rows (approximately)
/*!40000 ALTER TABLE `localizacao_veiculo` DISABLE KEYS */;
/*!40000 ALTER TABLE `localizacao_veiculo` ENABLE KEYS */;


-- Dumping structure for table trafegus_test.motorista
CREATE TABLE IF NOT EXISTS `motorista` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nome` varchar(200) NOT NULL,
  `rg` varchar(20) NOT NULL,
  `cpf` varchar(11) NOT NULL,
  `telefone` varchar(20) NOT NULL,
  `id_veiculo` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_motorista_veiculo` (`id_veiculo`),
  CONSTRAINT `fk_motorista_veiculo` FOREIGN KEY (`id_veiculo`) REFERENCES `veiculo` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=37 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table trafegus_test.motorista: ~27 rows (approximately)
/*!40000 ALTER TABLE `motorista` DISABLE KEYS */;
INSERT INTO `motorista` (`id`, `nome`, `rg`, `cpf`, `telefone`, `id_veiculo`) VALUES
	(1, 'IVAN AMADO CARDOSO', '3211321', '3232', '71987605740', 1),
	(2, 'CASSIA ', '3211321', '3232', '71987605740', 1),
	(4, 'SAMILE', '3211321', '3232', '71987605740', 1),
	(7, 'SOFIA', '1236541', '78995555555', '719876057400', 3),
	(8, 'samile', '45454545', '5454545', '71987605740', 1),
	(9, 'samile', '45454545', '5454545', '71987605740', 1),
	(10, 'Cassia gomes de Jesus', '564654654465465', '65454654654', '71987605740', 2),
	(11, 'Cassia gomes de Jesus', '564654654465465', '65454654654', '71987605740', 2),
	(12, 'camila dos satns new', '564444', '6546546', '5665', 3),
	(13, 'samile amado ', '45454545', '5454545', '71987605740', 1),
	(15, 'SOFIA ', '1236541', '78995555555', '719876057400', 1),
	(16, 'SOFIA editado 2', '1236541', '78995555555', '719876057400', 1),
	(19, 'Cassia Gomes ', '564654654465465', '65454654654', '71987605740', 3),
	(20, 'Cassia Gomes  editado', '564654654465465', '65454654654', '71987605740', 1),
	(21, 'Cassia Gomes  nova edição', '564654654465465', '65454654654', '71987605740', 2),
	(22, 'Cassia gomes  alterado', '564654654465465', '65454654654', '71987605740', 1),
	(23, 'Cassia Gomes  novo teste', '564654654465465', '65454654654', '71987605740', 1),
	(25, 'IVAN AMADO CARDOSO', '1138976504', '019.499.385', '71987605740', 2),
	(26, 'IVAN AMADO CARDOSO', '1138976504', '01949938506', '71987605740', 2),
	(27, 'SOFIA  EDITADO', '1236541', '78995555555', '719876057400', 3),
	(28, 'SOFIA  EDITADO', '1236541', '78995555555', '719876057400', 1),
	(29, 'SOFIA  EDITADO NOVO', '1236541', '78995555555', '719876057400', 13),
	(30, 'SOFIA  EDITADO NOVO Novo', '1236541', '78995555555', '719876057400', 3),
	(32, 'CASSIA NOVO', '3211321', '3232', '71987605740', 3),
	(34, 'camila dos satns novo', '564444', '6546546', '5665', 3),
	(35, 'camila dos satns novo novo novo', '564444', '6546546', '5665', 3),
	(36, 'camila dos satns novo novo novo novo new', '564444', '6546546', '5665', 1);
/*!40000 ALTER TABLE `motorista` ENABLE KEYS */;


-- Dumping structure for table trafegus_test.veiculo
CREATE TABLE IF NOT EXISTS `veiculo` (
  `id` int NOT NULL AUTO_INCREMENT,
  `placa` varchar(7) DEFAULT NULL,
  `renavam` varchar(30) DEFAULT NULL,
  `modelo` varchar(20) DEFAULT NULL,
  `marca` varchar(20) DEFAULT NULL,
  `ano` int DEFAULT NULL,
  `latitude` varchar(50) DEFAULT NULL,
  `longitude` varchar(50) DEFAULT NULL,
  `cor` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table trafegus_test.veiculo: ~11 rows (approximately)
/*!40000 ALTER TABLE `veiculo` DISABLE KEYS */;
INSERT INTO `veiculo` (`id`, `placa`, `renavam`, `modelo`, `marca`, `ano`, `latitude`, `longitude`, `cor`) VALUES
	(1, '5646578', '65546546', 'Rech', 'Renault', 2023, '-34.397', '150.644', 'vermelho'),
	(2, '56465', '65546546', 'sedan', 'RENAUT', 2023, NULL, NULL, 'vermelho'),
	(3, '78987', '65546546', 'SUV', 'Renault', 2023, '-34.197', '150.844', 'vermelho'),
	(8, 'okb', '5465465464', 'PICASSO', 'CINTROEN', 2023, NULL, NULL, 'AZUL'),
	(11, 'DKJ5487', '5465465464', 'UNO', 'FIAT', 2023, NULL, NULL, 'AZUL'),
	(12, 'okb', '5465465464', 'C3', 'CINTROEN', 2023, NULL, NULL, 'VERMELHO'),
	(13, 'okb', '5465465464', 'C3', 'CINTROEN', 2023, NULL, NULL, 'PRETO'),
	(14, 'okb', '5465465464', 'C3', 'marca test', 2023, NULL, NULL, 'cor teste'),
	(15, 'okb', '5465465464', 'C3', 'CINTROEN', 2023, NULL, NULL, 'cor teste'),
	(17, 'okb', '5465465464', 'CLIO', 'RENAUT', 2023, NULL, NULL, 'BRANCO'),
	(18, 'OKR8425', '5465465464', 'SEDAM', 'FIAT', 200, NULL, NULL, 'PRETO');
/*!40000 ALTER TABLE `veiculo` ENABLE KEYS */;
/*!40014 SET FOREIGN_KEY_CHECKS=1 */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
