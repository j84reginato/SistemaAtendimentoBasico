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

