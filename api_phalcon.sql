DROP TABLE IF EXISTS `clientes`;

CREATE TABLE `clientes` (
  `id` mediumint(8) unsigned NOT NULL auto_increment,
  `id_user` varchar(255),
  `nome` varchar(255) default NULL,
  `telefone` varchar(100) default NULL,
  `email` varchar(255) default NULL,
  `cidade` varchar(50) default NULL,
  `ativo` varchar(255) default NULL,
  PRIMARY KEY (`id`)
) AUTO_INCREMENT=1;

INSERT INTO `clientes` (`id`,`id_user`,`nome`,`telefone`,`email`,`cidade`,`ativo`)
VALUES
  (1,"34874","Fuller Holland","(51) 1529-4574","a.sollicitudin.orci@outlook.edu","Rajasthan","true"),
  (2,"58546","Coby Mosley","(63) 6561-7773","vel.turpis@aol.ca","Sindh","true"),
  (3,"40235","Kirestin Nixon","(86) 7891-6524","consectetuer.euismod.est@outlook.org","Limón","false"),
  (4,"97855","Ila Guzman","(81) 2696-3753","mus.proin@outlook.edu","Tomsk Oblast","false"),
  (5,"45540","Hop Blanchard","(73) 3577-2677","duis@icloud.net","Carmarthenshire","true"),
  (6,"76653","Yetta Ramsey","(04) 6282-1258","dictum.eu.eleifend@hotmail.net","East Java","false"),
  (7,"82970","Tanek Pate","(22) 7530-8689","ultricies.dignissim.lacus@hotmail.net","Aquitaine","true"),
  (8,"29574","Garrett Fuentes","(25) 8122-2544","duis.ac@protonmail.couk","Thanh Hóa","false"),
  (9,"78099","Nero Willis","(23) 1889-7172","ante.lectus.convallis@google.net","Caquetá","false"),
  (10,"61558","Jessamine Hunt","(46) 0652-2879","vel.venenatis@aol.net","Rio de Janeiro","true");
