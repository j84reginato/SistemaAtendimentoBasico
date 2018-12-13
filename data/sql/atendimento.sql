# Host: localhost  (Version 5.7.14)
# Date: 2018-12-11 00:43:44
# Generator: MySQL-Front 6.0  (Build 1.163)


#
# Structure for table "tb_contatos"
#

DROP TABLE IF EXISTS `tb_contatos`;
CREATE TABLE `tb_contatos` (
  `pkContato` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(200) NOT NULL DEFAULT '',
  `email` varchar(200) NOT NULL DEFAULT '',
  `telefone` varchar(50) NOT NULL DEFAULT '',
  `assunto` varchar(50) NOT NULL DEFAULT '',
  `mensagem` text,
  `status` int(1) DEFAULT '1',
  `dataHora` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`pkContato`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

#
# Data for table "tb_contatos"
#

INSERT INTO `tb_contatos` VALUES (1,'Jonatan','teste@teste.com.br','','','teste',0,'2018-11-06 22:28:35'),(2,'Jonatan Noronha Reginato','vivigritten@yahoo.com.br','(41) 99999-5569','teste','teste',1,'2018-11-26 22:02:25'),(3,'Jonatan Noronha Reginato','vivigritten@yahoo.com.br','(41) 99999-5569','teste','teste',1,'2018-11-26 22:07:26'),(4,'Jonatan Noronha Reginato','vivigritten@yahoo.com.br','(41) 99999-5569','teste','teste',1,'2018-11-26 22:13:28'),(5,'Jonatan Noronha Reginato','vivigritten@yahoo.com.br','(41) 99999-5569','teste','teste',1,'2018-11-26 22:14:35'),(6,'Jonatan Noronha Reginato','noronha_reginato@hotmail.com','(41) 99999-5569','teste','retrgadzgf',1,'2018-11-27 09:34:56'),(7,'Jonatan Noronha Reginato','noronha_reginato@hotmail.com','(41) 99999-5569','teste','GSDGsFDs',1,'2018-11-27 09:50:55'),(8,'Jonatan Noronha Reginato','noronha_reginato@hotmail.com','(41) 99999-5569','teste','dgdzgdz',1,'2018-11-27 15:16:34'),(9,'Jonatan Noronha Reginato','noronha_reginato@hotmail.com','(41) 99999-5569','teste','rgdfgfdgfdf',1,'2018-11-27 15:18:14'),(10,'Jonatan Noronha Reginato','noronha_reginato@hotmail.com','(41) 99999-5569','dsghadfhfdh','fhgfjhgjgfdhggd',1,'2018-11-27 16:51:09'),(11,'Jonatan Noronha Reginato','noronha_reginato@hotmail.com','(41) 99999-5569','teste','gjcgfjgj',1,'2018-11-27 16:52:32'),(12,'Jonatan Noronha Reginato','noronha_reginato@hotmail.com','(41) 99999-5569','teste','tudhdgj',1,'2018-11-27 16:53:08'),(13,'Jonatan Noronha Reginato','noronha_reginato@hotmail.com','(41) 99999-5569','hngnhg','gdsfgfgfd',1,'2018-11-28 16:17:39'),(14,'Jonatan Noronha Reginato','noronha_reginato@hotmail.com','(41) 99999-5569','safadfa','effredg',1,'2018-11-28 20:18:55');

#
# Structure for table "tb_motivos_chamado"
#

DROP TABLE IF EXISTS `tb_motivos_chamado`;
CREATE TABLE `tb_motivos_chamado` (
  `pkMotivoChamado` int(11) NOT NULL AUTO_INCREMENT,
  `descricao` varchar(50) NOT NULL DEFAULT '',
  `status` int(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`pkMotivoChamado`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4;

#
# Data for table "tb_motivos_chamado"
#

INSERT INTO `tb_motivos_chamado` VALUES (1,'Cobrança/Fatura',1),(2,'Defeito',1),(3,'Desistência da compra',1),(4,'Promoção',1),(5,'Entrega',1);

#
# Structure for table "tb_status_chamado"
#

DROP TABLE IF EXISTS `tb_status_chamado`;
CREATE TABLE `tb_status_chamado` (
  `pkStatusChamado` int(11) NOT NULL AUTO_INCREMENT,
  `descricao` varchar(50) NOT NULL DEFAULT '',
  PRIMARY KEY (`pkStatusChamado`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC;

#
# Data for table "tb_status_chamado"
#

INSERT INTO `tb_status_chamado` VALUES (1,'Novo'),(2,'Atribuído'),(3,'Concluído');

#
# Structure for table "tb_tipos_chamado"
#

DROP TABLE IF EXISTS `tb_tipos_chamado`;
CREATE TABLE `tb_tipos_chamado` (
  `pkTipoChamado` int(11) NOT NULL AUTO_INCREMENT,
  `descricao` varchar(50) NOT NULL DEFAULT '',
  `status` int(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`pkTipoChamado`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC;

#
# Data for table "tb_tipos_chamado"
#

INSERT INTO `tb_tipos_chamado` VALUES (1,'Informação',1),(2,'Reclamação',1),(3,'Solicitação',1),(4,'Sugestão',1),(5,'Elogio',1);

#
# Structure for table "tb_tipos_usuario"
#

DROP TABLE IF EXISTS `tb_tipos_usuario`;
CREATE TABLE `tb_tipos_usuario` (
  `pkTipoUsuario` int(11) NOT NULL AUTO_INCREMENT,
  `descricao` varchar(50) NOT NULL DEFAULT '',
  PRIMARY KEY (`pkTipoUsuario`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC;

#
# Data for table "tb_tipos_usuario"
#

INSERT INTO `tb_tipos_usuario` VALUES (1,'Administrador'),(2,'Atendente'),(3,'Cliente');

#
# Structure for table "tb_usuarios"
#

DROP TABLE IF EXISTS `tb_usuarios`;
CREATE TABLE `tb_usuarios` (
  `pkUsuario` int(11) NOT NULL AUTO_INCREMENT,
  `fkTipoUsuario` int(11) NOT NULL DEFAULT '0',
  `usuario` varchar(50) NOT NULL DEFAULT '',
  `nome` varchar(200) NOT NULL DEFAULT '',
  `email` varchar(200) NOT NULL DEFAULT '',
  `senha` text NOT NULL,
  `status` int(11) NOT NULL DEFAULT '1',
  `dataHora` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `ultimoAcesso` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`pkUsuario`),
  KEY `fkTipoUsuario` (`fkTipoUsuario`),
  CONSTRAINT `pkTipoUsuario` FOREIGN KEY (`fkTipoUsuario`) REFERENCES `tb_tipos_usuario` (`pkTipoUsuario`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC;

#
# Data for table "tb_usuarios"
#

INSERT INTO `tb_usuarios` VALUES (1,1,'admin','Admin','admin@admin.com','$2y$10$bnG0xwDROu7PZGHeUwDuuem255u58xAGabhJabKjshM6B.xB4UgPq',1,'2018-12-05 22:46:18','2018-11-23 21:22:47'),(2,2,'atendente','Atendente','cliente@cliente.com','$2y$10$bnG0xwDROu7PZGHeUwDuuem255u58xAGabhJabKjshM6B.xB4UgPq',1,'2018-12-05 22:46:22','2018-11-23 21:22:47'),(3,3,'cliente','Cliente','atendente@atendente.com','$2y$10$bnG0xwDROu7PZGHeUwDuuem255u58xAGabhJabKjshM6B.xB4UgPq',1,'2018-12-05 22:46:28','2018-11-23 21:22:47'),(5,1,'admina','Jonatan Noronha Reginato','noronha_reginato@hotmail.com','$2y$10$bnG0xwDROu7PZGHeUwDuuem255u58xAGabhJabKjshM6B.xB4UgPq\n',1,'2018-12-05 22:44:47',NULL),(6,3,'reginato','Jonatan Noronha Reginato','noronha_reginato@hotmail.com','$2y$10$bnG0xwDROu7PZGHeUwDuuem255u58xAGabhJabKjshM6B.xB4UgPq',1,'2018-11-28 17:07:39',NULL),(7,1,'testeuser','Usuario teste','teste@teste.com.br','$2y$12$Xyz8xyLZRzC3h9VOKKJ5oeu43eJl.RfXlFQFyahx8Xbcc0pwT1cR2',1,'2018-12-06 21:14:43',NULL);

#
# Structure for table "tb_chamados"
#

DROP TABLE IF EXISTS `tb_chamados`;
CREATE TABLE `tb_chamados` (
  `pkChamado` int(11) NOT NULL AUTO_INCREMENT,
  `fkCliente` int(11) NOT NULL DEFAULT '0',
  `fkAtendente` int(11) NOT NULL DEFAULT '1',
  `fkMotivoChamado` int(11) DEFAULT NULL,
  `fkTipoChamado` int(11) DEFAULT NULL,
  `fkStatusChamado` int(11) DEFAULT '1',
  `mensagem` text NOT NULL,
  `avaliacao` int(1) DEFAULT NULL,
  `dataHoraAbertura` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `dataHoraFechamento` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`pkChamado`),
  KEY `fkAtendente` (`fkAtendente`),
  KEY `fkTipoChamado` (`fkTipoChamado`),
  KEY `fkStatusChamado` (`fkStatusChamado`),
  KEY `fkCliente` (`fkCliente`),
  KEY `pkMotivoChamado` (`fkMotivoChamado`),
  CONSTRAINT `pkAtendente` FOREIGN KEY (`fkAtendente`) REFERENCES `tb_usuarios` (`pkUsuario`),
  CONSTRAINT `pkCliente` FOREIGN KEY (`fkCliente`) REFERENCES `tb_usuarios` (`pkUsuario`),
  CONSTRAINT `pkMotivoChamado` FOREIGN KEY (`fkMotivoChamado`) REFERENCES `tb_motivos_chamado` (`pkMotivoChamado`),
  CONSTRAINT `pkStatusChamado` FOREIGN KEY (`fkStatusChamado`) REFERENCES `tb_status_chamado` (`pkStatusChamado`),
  CONSTRAINT `pkTipoChamado` FOREIGN KEY (`fkTipoChamado`) REFERENCES `tb_tipos_chamado` (`pkTipoChamado`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC;

#
# Data for table "tb_chamados"
#

INSERT INTO `tb_chamados` VALUES (1,1,1,1,2,1,'Solicito informações sobre entrega',NULL,'2018-12-11 00:04:34',NULL),(3,6,1,1,1,1,'qwerty',NULL,'2018-12-09 23:24:44',NULL),(4,6,1,1,1,1,'qwerty',NULL,'2018-12-09 23:32:43',NULL),(5,6,1,1,1,1,'qaz',NULL,'2018-12-09 23:34:39',NULL),(6,6,1,1,1,1,'teste',NULL,'2018-12-09 23:37:44',NULL),(7,6,1,1,1,1,'qwerty',NULL,'2018-12-09 23:39:39',NULL);

#
# Structure for table "tb_mensagens_chamados"
#

DROP TABLE IF EXISTS `tb_mensagens_chamados`;
CREATE TABLE `tb_mensagens_chamados` (
  `pkMensagemChamado` int(11) NOT NULL AUTO_INCREMENT,
  `fkChamado` int(11) NOT NULL DEFAULT '0',
  `fkUsuario` int(11) NOT NULL DEFAULT '0',
  `mensagem` text NOT NULL,
  `dataHora` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`pkMensagemChamado`),
  KEY `fkChamado` (`fkChamado`),
  KEY `fkUsuario` (`fkUsuario`),
  CONSTRAINT `pkChamado` FOREIGN KEY (`fkChamado`) REFERENCES `tb_chamados` (`pkChamado`),
  CONSTRAINT `pkUsuario` FOREIGN KEY (`fkUsuario`) REFERENCES `tb_usuarios` (`pkUsuario`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

#
# Data for table "tb_mensagens_chamados"
#

