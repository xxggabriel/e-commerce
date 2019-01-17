-- MySQL dump 10.13  Distrib 5.7.24, for Linux (x86_64)
--
-- Host: localhost    Database: ecommerce
-- ------------------------------------------------------
-- Server version	5.7.24-0ubuntu0.18.04.1

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `tb_brand`
--

DROP TABLE IF EXISTS `tb_brand`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tb_brand` (
  `id_brand` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) NOT NULL,
  `logo` varchar(100) DEFAULT '/uploads/img/brand/sem-foto.jpg',
  PRIMARY KEY (`id_brand`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tb_brand`
--

LOCK TABLES `tb_brand` WRITE;
/*!40000 ALTER TABLE `tb_brand` DISABLE KEYS */;
INSERT INTO `tb_brand` VALUES (5,'Microsoft','uploads/img/brand/microsoft.gif-1547059633.gif'),(6,'Supreme','uploads/img/brand/supreme.gif-1547060205.gif'),(8,'Google','uploads/img/brand/googles-new-logo-5078286822539264.3-hp2x.gif-1546995996.jpg'),(9,'Intel','uploads/img/brand/intel.gif-1547060307.gif'),(10,'Shein','uploads/img/brand/shein-logo.png-1547489633.png'),(11,'Sansung','uploads/img/brand/samsung-logo-191-1.jpg-1547681917.jpg');
/*!40000 ALTER TABLE `tb_brand` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tb_cart`
--

DROP TABLE IF EXISTS `tb_cart`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tb_cart` (
  `cookie` varchar(100) NOT NULL,
  `id_product` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `amount` int(11) DEFAULT '1',
  `status` int(11) DEFAULT '4',
  PRIMARY KEY (`cookie`),
  KEY `fk_tb_cart_id_product_idx` (`id_product`),
  KEY `fk_tb_cart_status_idx` (`status`),
  KEY `fk_tb_cart_id_user_idx` (`id_user`),
  CONSTRAINT `fk_tb_cart_id_product` FOREIGN KEY (`id_product`) REFERENCES `tb_product` (`id_product`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_tb_cart_id_user` FOREIGN KEY (`id_user`) REFERENCES `tb_user` (`id_user`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_tb_cart_status` FOREIGN KEY (`status`) REFERENCES `tb_status` (`id_status`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tb_cart`
--

LOCK TABLES `tb_cart` WRITE;
/*!40000 ALTER TABLE `tb_cart` DISABLE KEYS */;
/*!40000 ALTER TABLE `tb_cart` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tb_category`
--

DROP TABLE IF EXISTS `tb_category`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tb_category` (
  `id_category` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) NOT NULL,
  PRIMARY KEY (`id_category`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tb_category`
--

LOCK TABLES `tb_category` WRITE;
/*!40000 ALTER TABLE `tb_category` DISABLE KEYS */;
INSERT INTO `tb_category` VALUES (2,'Roupas'),(3,'Celular'),(4,'Eletronicos');
/*!40000 ALTER TABLE `tb_category` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tb_cookie`
--

DROP TABLE IF EXISTS `tb_cookie`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tb_cookie` (
  `hash` varchar(128) NOT NULL,
  `cookie` varchar(45) NOT NULL,
  `id_user` int(11) NOT NULL,
  `date` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`hash`),
  KEY `fk_tb_cookie_id_user_idx` (`id_user`),
  CONSTRAINT `fk_tb_cookie_id_user` FOREIGN KEY (`id_user`) REFERENCES `tb_user` (`id_user`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tb_cookie`
--

LOCK TABLES `tb_cookie` WRITE;
/*!40000 ALTER TABLE `tb_cookie` DISABLE KEYS */;
INSERT INTO `tb_cookie` VALUES ('151e3198fe1447be969748653cf5b3fb','CKE',10,'2019-01-16 19:14:05');
/*!40000 ALTER TABLE `tb_cookie` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tb_photo_product`
--

DROP TABLE IF EXISTS `tb_photo_product`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tb_photo_product` (
  `id_photo` int(11) NOT NULL AUTO_INCREMENT,
  `id_product` int(11) NOT NULL,
  `directory` varchar(100) DEFAULT 'uploads/img/product/sem-foto.jpg',
  `ranking` int(11) DEFAULT '1',
  `date` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_photo`),
  KEY `fk_tb_photo_product_id_product_idx` (`id_product`),
  CONSTRAINT `fk_tb_photo_product_id_product` FOREIGN KEY (`id_product`) REFERENCES `tb_product` (`id_product`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=37 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tb_photo_product`
--

LOCK TABLES `tb_photo_product` WRITE;
/*!40000 ALTER TABLE `tb_photo_product` DISABLE KEYS */;
INSERT INTO `tb_photo_product` VALUES (11,8,'uploads',45,'2019-01-16 21:22:33'),(12,8,'uploads/img/product/shein-logo.png-1547681067.png',0,'2019-01-16 21:24:27'),(13,8,'uploads/img/product/sem-foto.png-1547681067.png',1,'2019-01-16 21:24:27'),(14,8,'uploads/img/product/Captura de tela de 2019-01-01 22-48-33.png-1547681067.png',2,'2019-01-16 21:24:27'),(28,22,'uploads/img/product/46917585_1SZ.jpg-1547685408.jpg',0,'2019-01-16 22:36:48'),(29,22,'uploads/img/product/46917585_1SZ.jpg-1547685408.jpg',1,'2019-01-16 22:36:49'),(30,22,'uploads/img/product/46917585_1SZ.jpg-1547685408.jpg',2,'2019-01-16 22:36:49'),(31,11,'uploads/img/product/132371225SZ.jpg-1547686394.jpg',0,'2019-01-16 22:53:14'),(32,11,'uploads/img/product/132371225_2SZ.jpg-1547686394.jpg',1,'2019-01-16 22:53:15'),(33,11,'uploads/img/product/132371225_6SZ.jpg-1547686394.jpg',2,'2019-01-16 22:53:15'),(34,12,'uploads/img/product/132229131SZ.jpg-1547686543.jpg',0,'2019-01-16 22:55:43'),(35,12,'uploads/img/product/132229131_2SZ.jpg-1547686543.jpg',1,'2019-01-16 22:55:44'),(36,12,'uploads/img/product/132229131_3SZ.jpg-1547686543.jpg',2,'2019-01-16 22:55:44');
/*!40000 ALTER TABLE `tb_photo_product` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tb_product`
--

DROP TABLE IF EXISTS `tb_product`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tb_product` (
  `id_product` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) NOT NULL,
  `title` varchar(150) DEFAULT 'Sem titulo',
  `description` text,
  `promotion` double(6,2) DEFAULT '0.00',
  `amount` int(11) DEFAULT '0',
  `cost_value` double(6,2) DEFAULT '0.00',
  `sale_value` double(6,2) NOT NULL DEFAULT '0.00',
  `id_brand` int(11) DEFAULT NULL,
  `id_provider` int(11) DEFAULT NULL,
  `id_category` int(11) DEFAULT NULL,
  `date` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_product`),
  KEY `fk_tb_product_id_provider_idx` (`id_provider`),
  KEY `fk_tb_product_id_brand_idx` (`id_brand`),
  KEY `fk_tb_product_id_category_idx` (`id_category`),
  CONSTRAINT `fk_tb_product_id_brand` FOREIGN KEY (`id_brand`) REFERENCES `tb_brand` (`id_brand`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_tb_product_id_category` FOREIGN KEY (`id_category`) REFERENCES `tb_category` (`id_category`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_tb_product_id_provider` FOREIGN KEY (`id_provider`) REFERENCES `tb_provider` (`id_provider`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tb_product`
--

LOCK TABLES `tb_product` WRITE;
/*!40000 ALTER TABLE `tb_product` DISABLE KEYS */;
INSERT INTO `tb_product` VALUES (5,'Placa Mãe 775','Placa Mãe 775','<p>Sem descrição 2019</p>',10.00,89,80.00,117.00,9,7,4,'2019-01-08 19:30:54'),(8,'Livro João e o pé de Feijão','João e o pé de Feijão','<p>Livro</p><figure class=\"media\"><oembed url=\"https://www.youtube.com/watch?v=3a6hwR79EXQ&amp;t=174s&amp;ab_channel=sertanejoasmelhores\"></oembed></figure>',7.00,15,89.00,147.00,5,6,2,'2019-01-08 20:13:10'),(10,'Blusa de oncinha ','Damasco Assimétrico Animal','<p>SHEIN Damasco Assimétrico Animal Festa Camisetas</p><ul><li>feminino</li><li>Shein</li></ul>',0.00,32,13.90,22.90,10,8,4,'2019-01-14 16:32:16'),(11,'Samsung  J5','Smartphone Samsung Galaxy J5 ','<p><strong>Smartphone Samsung Galaxy J5 Prime Dual Chip Android</strong></p><figure class=\"table\"><table><tbody><tr><td>Código</td><td>132229131</td></tr><tr><td>Código de barras</td><td>7892509093644, 7892509093675</td></tr><tr><td>Marca</td><td>Samsung</td></tr><tr><td>Modelo</td><td>Galaxy J5 Prime</td></tr><tr><td>Cor</td><td>Rosa</td></tr><tr><td>Tipo de Chip</td><td>Nano Chip</td></tr><tr><td>Quantidade de Chips</td><td>Dual Chip</td></tr><tr><td>Memória Interna</td><td>32GB</td></tr><tr><td>Memória RAM</td><td>2GB</td></tr><tr><td>Processador</td><td>Quad-Core 1.4GHz</td></tr><tr><td>Sistema Operacional</td><td>Android</td></tr><tr><td>Versão</td><td>Android 6.0.1</td></tr><tr><td>Tipo de tela</td><td>AMOLED</td></tr><tr><td>Tamanho do Display</td><td>5\"</td></tr><tr><td>Resolução</td><td>1280x720 (HD)</td></tr><tr><td>Câmera traseira</td><td>13MP</td></tr><tr><td>Câmera frontal</td><td>5MP</td></tr><tr><td>Filmadora</td><td>Full HD</td></tr><tr><td>Expansivo até</td><td>MicroSD até 200GB</td></tr><tr><td>Alimentação/Tipo de bateria</td><td>bi-volt, íons de lítio 2400 mAh</td></tr><tr><td>Banda</td><td>LTE</td></tr><tr><td>Conectividade</td><td>Wi-Fi, 3G, 4G</td></tr><tr><td>NFC</td><td>Não</td></tr><tr><td>TV</td><td>Não</td></tr><tr><td>Recursos de Chamada</td><td>Espera de Chamada</td></tr><tr><td>Conteúdo da Embalagem</td><td>Aparelho, Carregador, Cabos de Dados, Fone de ouvido, extrator de chip</td></tr><tr><td>Dimensões aproximadas do produto - cm (AxLxP)</td><td>14,2x6,9x0,8cm</td></tr><tr><td>Peso líq. aproximado do produto (kg)</td><td>143g</td></tr><tr><td>Garantia do Fornecedor</td><td>12 Meses</td></tr><tr><td>Referência do modelo</td><td>SM-G570MEDGZTO</td></tr><tr><td>Fornecedor</td><td>Samsung</td></tr><tr><td>SAC</td><td>4004-0000 (Capitais e grandes centros) ou 0800 124-421 (Demais cidades e regiões)</td></tr></tbody></table></figure>',0.00,45,527.54,799.99,11,7,3,'2019-01-16 21:44:33'),(12,'Galaxy J7 Ne','Smartphone Samsung Galaxy J7 Neo','<p><strong>ficha técnica</strong></p><h2>&nbsp;</h2><figure class=\"table\"><table><tbody><tr><td>Código</td><td>132371225</td></tr><tr><td>Código de barras</td><td>7892509094108, 7892509094160</td></tr><tr><td>Marca</td><td>Samsung</td></tr><tr><td>Modelo</td><td>SM-J701MT</td></tr><tr><td>Cor</td><td>Dourado</td></tr><tr><td>Tipo de Chip</td><td>Micro Chip</td></tr><tr><td>Quantidade de Chips</td><td>Dual Chip</td></tr><tr><td>Memória Interna</td><td>16GB</td></tr><tr><td>Memória RAM</td><td>2GB</td></tr><tr><td>Processador</td><td>Octa-Core 1.6 GHz</td></tr><tr><td>Sistema Operacional</td><td>Android</td></tr><tr><td>Versão</td><td>Android 7.0</td></tr><tr><td>Tipo de tela</td><td>AMOLED</td></tr><tr><td>Tamanho do Display</td><td>5.5\"</td></tr><tr><td>Resolução</td><td>1280x720 (HD)</td></tr><tr><td>Câmera traseira</td><td>13MP</td></tr><tr><td>Câmera frontal</td><td>5MP</td></tr><tr><td>Filmadora</td><td>Full HD</td></tr><tr><td>Expansivo até</td><td>MicroSD até 200GB</td></tr><tr><td>Alimentação/Tipo de bateria</td><td>Íons de Lítio, 3000 mAh</td></tr><tr><td>Banda</td><td>LTE</td></tr><tr><td>Conectividade</td><td>Wi-Fi, 3G, 4G</td></tr><tr><td>NFC</td><td>Não</td></tr><tr><td>TV</td><td>Digital</td></tr><tr><td>Recursos de Chamada</td><td>Viva Voz</td></tr><tr><td>Conteúdo da Embalagem</td><td>Aparelho, Carregador, Cabos de Dados, Fone de ouvido, dongle para antena de TV</td></tr><tr><td>Dimensões aproximadas do produto - cm (AxLxP)</td><td>15,2x7,8x0,7cm</td></tr><tr><td>Peso líq. aproximado do produto (kg)</td><td>170g</td></tr><tr><td>Garantia do Fornecedor</td><td>12 Meses</td></tr><tr><td>Referência do modelo</td><td>SM-J701MZDMZTO</td></tr><tr><td>Fornecedor</td><td>Samsung</td></tr><tr><td>SAC</td><td>Atendimento ao cliente:4004-0000 (Capitais e grandes centros)0800-124-421 (Demais cidades e regiões)Horário de Atendimento:Segunda à Sexta: 08:00h às 20:00h Sábados: 09:00h às 15:00h</td></tr></tbody></table></figure>',0.00,48,588.89,799.99,11,7,3,'2019-01-16 22:20:07'),(22,'Computador Com Monitor 19.5 Led','Computador Com Monitor 19.5 Led','<p>Computador Com Monitor 19.5 Led</p>',0.00,89,800.89,1544.89,5,9,4,'2019-01-16 22:36:07');
/*!40000 ALTER TABLE `tb_product` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tb_provider`
--

DROP TABLE IF EXISTS `tb_provider`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tb_provider` (
  `id_provider` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) NOT NULL,
  `email` varchar(60) NOT NULL,
  `phone` varchar(15) DEFAULT NULL,
  `cnpj` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id_provider`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tb_provider`
--

LOCK TABLES `tb_provider` WRITE;
/*!40000 ALTER TABLE `tb_provider` DISABLE KEYS */;
INSERT INTO `tb_provider` VALUES (6,'Paulo Roupas','pauloroupas@gmail.com','(11) 2987-2299','05.955.936/0001-90'),(7,'Kabum','contato@kabum.com.br','(19) 2114-4444','05.570.714/0001-59'),(8,'Shein','blogservice@shein.com','(11) 98874-5585','20.162.372/0001-21'),(9,'Americanas','contato@americanas','(11) 32554-8777','00.776.574/0006-60');
/*!40000 ALTER TABLE `tb_provider` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tb_status`
--

DROP TABLE IF EXISTS `tb_status`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tb_status` (
  `id_status` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id_status`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tb_status`
--

LOCK TABLES `tb_status` WRITE;
/*!40000 ALTER TABLE `tb_status` DISABLE KEYS */;
INSERT INTO `tb_status` VALUES (0,'desativo'),(1,'ativo'),(2,'usuario'),(3,'admin'),(4,'carrinho ativo'),(5,'carrinho abandonado'),(6,'desejo ativo'),(7,'desejo esquecido');
/*!40000 ALTER TABLE `tb_status` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tb_user`
--

DROP TABLE IF EXISTS `tb_user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tb_user` (
  `id_user` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(60) DEFAULT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(128) NOT NULL,
  `photo` varchar(100) DEFAULT 'uploads/img/user/sem-foto.jpg',
  `status` int(11) DEFAULT '2',
  `date` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_user`),
  UNIQUE KEY `email_UNIQUE` (`email`),
  KEY `fk_tb_user_status_idx` (`status`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tb_user`
--

LOCK TABLES `tb_user` WRITE;
/*!40000 ALTER TABLE `tb_user` DISABLE KEYS */;
INSERT INTO `tb_user` VALUES (10,'Gabriel Oliveira De Souza','gabrieloliveradesouza9@gmail.com','$2y$10$rXZTR3ws/g38RgreaAh1Cu0F4mpGI9u2uxCZ9KZUgold/bGNCwghy','uploads/img/user/Captura-de-tela-de-2019-01-01-22-48-33.png-1546975893.jpg',3,'2019-01-08 17:31:33'),(13,'Júlio Cocielo','juliococielo@gmail.com','$2y$10$Y8Ww3JMJ9R8nV9dXutI9Yu9VdfvK8RgFcMqHlBdSYT29qEF8oJWkq','uploads/img/user/15306311205b3b93d02d37f_1530631120_3x2_md.jpg-1546999973.jpg',2,'2019-01-09 00:12:53'),(14,'Juliana Souza','julianasouza@gmail.com','$2y$10$/G3RMpDjA0kBd/6ovCoSl.EzcrwtPokA9.S7PE1TqQfpJEX81wHfW','uploads/img/user/sem-foto.jpg',2,'2019-01-09 23:01:35'),(15,'Karine Santos Braga ','karinesantosbraga@gmail.com','$2y$10$f9NnFNIRIWVMCdHrdwMthOXkTrAnGxZPanqQDUbSaDbDS62rWsHZe','uploads/img/user/karina.jpg-1547657607.jpg',2,'2019-01-16 14:53:27'),(16,'Kéfera Buchmann','keferabuchmann@gmail.com','$2y$10$egKWrE1FIdk.qDuSeoUa0eUVTSvOXbRb3WoIoJynpgeHWMkqnzKq6','uploads/img/user/KéferaBuchmann.jpg-1547659672.jpg',2,'2019-01-16 15:01:25');
/*!40000 ALTER TABLE `tb_user` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tb_wish`
--

DROP TABLE IF EXISTS `tb_wish`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tb_wish` (
  `cookie` varchar(100) NOT NULL,
  `id_product` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `date` datetime DEFAULT CURRENT_TIMESTAMP,
  `status` int(11) DEFAULT '6',
  PRIMARY KEY (`cookie`),
  KEY `fk_tb_wish_id_product_idx` (`id_product`),
  KEY `fk_tb_wish_id_user_idx` (`id_user`),
  KEY `fk_tb_wish_status_idx` (`status`),
  CONSTRAINT `fk_tb_wish_id_product` FOREIGN KEY (`id_product`) REFERENCES `tb_product` (`id_product`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_tb_wish_id_user` FOREIGN KEY (`id_user`) REFERENCES `tb_user` (`id_user`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_tb_wish_status` FOREIGN KEY (`status`) REFERENCES `tb_status` (`id_status`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tb_wish`
--

LOCK TABLES `tb_wish` WRITE;
/*!40000 ALTER TABLE `tb_wish` DISABLE KEYS */;
/*!40000 ALTER TABLE `tb_wish` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping routines for database 'ecommerce'
--
/*!50003 DROP PROCEDURE IF EXISTS `create_brand` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`localhost`@`localhost` PROCEDURE `create_brand`(
pname varchar(45),
plogo varchar(100)
)
BEGIN
	IF plogo IS NULL THEN
		INSERT INTO tb_brand (name) VALUES (pname);
	ELSE 
		INSERT INTO tb_brand (name, logo) VALUES (pname, plogo);
    END IF;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `create_category` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`localhost`@`localhost` PROCEDURE `create_category`(
pname varchar(45)
)
BEGIN
	INSERT INTO tb_category (name) VALUES (pname);
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `create_cookie` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`localhost`@`localhost` PROCEDURE `create_cookie`(
pcookie varchar(45),
pid_user int,
phash varchar(128)
)
BEGIN
	declare x int;
	SET x = (SELECT id_user FROM tb_cookie);
    IF x IS NULL THEN
		INSERT INTO tb_cookie (cookie, id_user, hash) VALUE (pcookie, pid_user, phash);
    ELSE
		UPDATE tb_cookie SET cookie = pcookie, id_user = id_user, hash = phash;
    END IF;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `create_product` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`localhost`@`localhost` PROCEDURE `create_product`(
pname varchar(45),
ptitle varchar(45),
pdescription text,
ppromotion double(6,2),
pamount int,
pcost_value double(6,2),
psale_value double(6,2),
pid_brand int,
pid_provider int,
pid_category int
)
BEGIN
	INSERT INTO tb_product (name, title, description, promotion, amount, cost_value, sale_value, id_brand, id_provider, id_category) VALUES (pname, ptitle, pdescription, ppromotion, pamount, pcost_value, psale_value, pid_brand, pid_provider, pid_category);
    SELECT LAST_INSERT_ID() FROM tb_product LIMIT 1;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `create_provider` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`localhost`@`localhost` PROCEDURE `create_provider`(
pname varchar(45), 
pemail varchar(60),
pphone varchar(15),
pcnpj varchar(20)
)
BEGIN
	INSERT INTO tb_provider (name, email, phone, cnpj) VALUES (pname,pemail, pphone, pcnpj);
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `create_user` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`localhost`@`localhost` PROCEDURE `create_user`(
pname varchar(60),
pemail varchar(60),
ppassword varchar(128),
pphoto varchar(100),
pstatus int
)
BEGIN
	IF pstatus IS NULL AND pphoto IS NULL THEN
		INSERT INTO tb_user (name, email, password) VALUES (pname, pemail, ppassword);
	ELSEIF pstatus IS NULL THEN
		INSERT INTO tb_user (name, email, password, photo) VALUES (pname, pemail, ppassword, pphoto);
	ELSEIF pphoto IS NULL THEN
		INSERT INTO tb_user (name, email, password, status) VALUES (pname, pemail, ppassword, pstatus);
	ELSE
		INSERT INTO tb_user (name, email, password, photo, status) VALUES (pname, pemail, ppassword, pphoto, pstatus);
    END IF;
    
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `delete_brand` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`localhost`@`localhost` PROCEDURE `delete_brand`(
pid_brand int
)
BEGIN
	UPDATE tb_user SET id_brand = null;
	DELETE FROM tb_brand WHERE id_brand = pid_brand;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `delete_category` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`localhost`@`localhost` PROCEDURE `delete_category`(
pid_category int
)
BEGIN
	UPDATE tb_user SET id_category = null;
	DELETE FROM tb_category WHERE id_category = pid_category;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `delete_cookie` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`localhost`@`localhost` PROCEDURE `delete_cookie`(
phash varchar(128)
)
BEGIN
	DELETE FROM tb_cookie WHERE hash = phash;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `delete_product` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`localhost`@`localhost` PROCEDURE `delete_product`(
pid_product int
)
BEGIN
	DELETE FROM tb_product WHERE id_product = pid_product;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `delete_provider` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`localhost`@`localhost` PROCEDURE `delete_provider`(
pid_provider int
)
BEGIN
	UPDATE tb_user SET id_provider = null;
	DELETE FROM tb_provider WHERE id_provider = pid_provider;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `delete_user` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`localhost`@`localhost` PROCEDURE `delete_user`(
pid_user int
)
BEGIN
	DELETE FROM tb_cookie WHERE id_user = pid_user;
	DELETE FROM tb_user WHERE id_user = pid_user;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `pagination_product` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`localhost`@`localhost` PROCEDURE `pagination_product`(
plimit int,
precords int
)
BEGIN

	IF plimit IS NULL AND plimit IS NULL THEN
		SELECT SQL_CALC_FOUND_ROWS * FROM tb_product LIMIT 0,15;

    ELSE
		SELECT SQL_CALC_FOUND_ROWS * FROM tb_product LIMIT plimit,precords;

    END IF;
    SELECT id_product, FOUND_ROWS() FROM tb_product;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `read_brand` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`localhost`@`localhost` PROCEDURE `read_brand`(
pid_brand int
)
BEGIN
	IF pid_brand IS NULL THEN
		SELECT * FROM tb_brand;
    ELSE
		SELECt * FROM tb_brand WHERE id_brand = pid_brand;
    END IF;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `read_category` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`localhost`@`localhost` PROCEDURE `read_category`(
pid_category int
)
BEGIN
	IF pid_category IS NULL THEN
		SELECT * FROM tb_category;
    ELSE
		SELECT * FROM tb_category WHERE id_category = pid_category;
    END IF;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `read_photo_product` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`localhost`@`localhost` PROCEDURE `read_photo_product`(
pid_product int
)
BEGIN
	SELECT * FROM tb_photo_product WHERE id_product = pid_product ORDER BY ranking ASC;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `read_product` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`localhost`@`localhost` PROCEDURE `read_product`(
pid_product int
)
BEGIN
	IF pid_product IS NULL THEN
		SELECT * FROM tb_product;
    ELSE
		SELECT * FROM tb_product WHERE id_product = pid_product;
    END IF;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `read_provider` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`localhost`@`localhost` PROCEDURE `read_provider`(
pid_provider int
)
BEGIN
	IF pid_provider IS NULL THEN
		SELECT * FROM tb_provider ;
    ELSE
		SELECT * FROM tb_provider WHERE id_provider = pid_provider;
    END IF;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `read_user` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`localhost`@`localhost` PROCEDURE `read_user`(
pid_user int
)
BEGIN
	IF pid_user IS NULL THEN
		SELECT * FROM tb_user;
    ELSE
		SELECt * FROM tb_user WHERE id_user = pid_user;
    END IF;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `save_photo_product` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`localhost`@`localhost` PROCEDURE `save_photo_product`(
pid_product int, 
pdirectory varchar(100), 
pranking int
)
BEGIN
	INSERT INTO tb_photo_product (id_product, directory, ranking) VALUES (pid_product, pdirectory, pranking);
    SELECT LAST_INSERT_ID() FROM tb_photo_product LIMIT 1;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2019-01-16 22:57:52
