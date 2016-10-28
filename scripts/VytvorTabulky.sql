-- Generated by Oracle SQL Developer Data Modeler 4.1.1.888
--   at:        2015-12-14 16:24:38 CET
--   site:      Oracle Database 11g
--   type:      Oracle Database 11g




CREATE TABLE janoch_uzivatel
  (
    ID_uzivatel    INT NOT NULL AUTO_INCREMENT,
    Jmeno          VARCHAR (30) ,
    Prijmeni       VARCHAR (30) ,
    Login          VARCHAR (40) ,
    Heslo          VARCHAR (35) ,
    Email          VARCHAR (35) ,
    Janoch_prava_ID_prav INTEGER,
    PRIMARY KEY ( ID_uzivatel )
  ) ;

CREATE TABLE janoch_hodnoceni
  (
    janoch_uzivatel_ID_uzivatel   INTEGER NOT NULL ,
    janoch_prispevky_ID_prispevku INTEGER NOT NULL ,
    originalita INT NULL ,
    tema INT NULL ,
    technicka_kvalita INT NULL ,
    jazykova_kvalita INT NULL ,
    doporuceni INT NULL ,
    poznamky MEDIUMTEXT NULL
  );
ALTER TABLE janoch_hodnoceni ADD CONSTRAINT janoch_hodnoceni_PK PRIMARY KEY ( janoch_uzivatel_ID_uzivatel, janoch_prispevky_ID_prispevku ) ;


CREATE TABLE janoch_prava
  ( ID_prav INTEGER NOT NULL, nazev VARCHAR (20), PRIMARY KEY ( ID_prav )
  ) ;

CREATE TABLE janoch_prispevky
  (
    ID_prispevku INTEGER NOT NULL AUTO_INCREMENT,
    nazev        VARCHAR (50) ,
    autori  VARCHAR(100),
    abstract TEXT(600) ,
    soubor VARCHAR (50) ,
    prijato VARCHAR(20) NULL DEFAULT 'NE' ,
    janoch_uzivatel_ID_uzivatel INTEGER ,
    PRIMARY KEY ( ID_prispevku )
  ) ;
  
INSERT INTO `janochweb.bo8676`.`janoch_uzivatel` (`ID_uzivatel`, `Jmeno`, `Prijmeni`, `Login`, `Heslo`, `Email`, `Janoch_prava_ID_prav`) VALUES ('null', 'Vaclav', 'Janoch', 'Venous', 'janoch1', NULL, '1');
INSERT INTO `janochweb.bo8676`.`janoch_uzivatel` (`ID_uzivatel`, `Jmeno`, `Prijmeni`, `Login`, `Heslo`, `Email`, `Janoch_prava_ID_prav`) VALUES ('null', 'Filip', 'Zibar', 'Fista', 'janoch1', NULL, '2');
INSERT INTO `janochweb.bo8676`.`janoch_uzivatel` (`ID_uzivatel`, `Jmeno`, `Prijmeni`, `Login`, `Heslo`, `Email`, `Janoch_prava_ID_prav`) VALUES ('null', 'Roman', 'Vitek', 'Romanek', 'janoch1', NULL, '2');
INSERT INTO `janochweb.bo8676`.`janoch_uzivatel` (`ID_uzivatel`, `Jmeno`, `Prijmeni`, `Login`, `Heslo`, `Email`, `Janoch_prava_ID_prav`) VALUES ('null', 'Lukas', 'Brejcha', 'Luky', 'janoch1', NULL, '2');
INSERT INTO `janochweb.bo8676`.`janoch_uzivatel` (`ID_uzivatel`, `Jmeno`, `Prijmeni`, `Login`, `Heslo`, `Email`, `Janoch_prava_ID_prav`) VALUES ('null', 'Tomas', 'Voracek', 'Vory', 'janoch1', NULL, '3');
INSERT INTO `janochweb.bo8676`.`janoch_uzivatel` (`ID_uzivatel`, `Jmeno`, `Prijmeni`, `Login`, `Heslo`, `Email`, `Janoch_prava_ID_prav`) VALUES ('null', 'Marek', 'Baran', 'Parek', 'janoch1', NULL, '3');
INSERT INTO `janochweb.bo8676`.`janoch_uzivatel` (`ID_uzivatel`, `Jmeno`, `Prijmeni`, `Login`, `Heslo`, `Email`, `Janoch_prava_ID_prav`) VALUES ('null', 'Robin', 'Biker', 'Rob', 'janoch1', NULL, '3');

INSERT INTO `janochweb.bo8676`.`janoch_prispevky` (`ID_prispevku`, `nazev`, `autori`, `abstract`, `soubor`, `prijato`, `janoch_uzivatel_ID_uzivatel`) VALUES ('null', 'ZeleznaSparta3', 'Voracek', NULL, 'soubory/Fista/zadani-sp.pdf', 'NE', '5');
INSERT INTO `janochweb.bo8676`.`janoch_prispevky` (`ID_prispevku`, `nazev`, `autori`, `abstract`, `soubor`, `prijato`, `janoch_uzivatel_ID_uzivatel`) VALUES ('null', 'Sparta vecna zustane', 'Voracek', NULL, 'soubory/Fista/zadani-sp.pdf', 'NE', '5');
INSERT INTO `janochweb.bo8676`.`janoch_prispevky` (`ID_prispevku`, `nazev`, `autori`, `abstract`, `soubor`, `prijato`, `janoch_uzivatel_ID_uzivatel`) VALUES ('null', 'Viktora', 'Baran', NULL, 'soubory/Fista/zadani-sp.pdf', 'NE', '6');
INSERT INTO `janochweb.bo8676`.`janoch_prispevky` (`ID_prispevku`, `nazev`, `autori`, `abstract`, `soubor`, `prijato`, `janoch_uzivatel_ID_uzivatel`) VALUES ('null', 'Nova Slavia', 'Biker', NULL, 'soubory/Fista/zadani-sp.pdf', 'NE', '7');

INSERT INTO `janochweb.bo8676`.`janoch_hodnoceni` (`janoch_uzivatel_ID_uzivatel`, `janoch_prispevky_ID_prispevku`, `originalita`, `tema`, `technicka_kvalita`, `jazykova_kvalita`, `doporuceni`, `poznamky`) VALUES ('2', '1', '4', '5', '2', '3', '1', NULL);
INSERT INTO `janochweb.bo8676`.`janoch_hodnoceni` (`janoch_uzivatel_ID_uzivatel`, `janoch_prispevky_ID_prispevku`, `originalita`, `tema`, `technicka_kvalita`, `jazykova_kvalita`, `doporuceni`, `poznamky`) VALUES ('3', '3', '4', '1', '3', '3', '2', NULL);
INSERT INTO `janochweb.bo8676`.`janoch_hodnoceni` (`janoch_uzivatel_ID_uzivatel`, `janoch_prispevky_ID_prispevku`, `originalita`, `tema`, `technicka_kvalita`, `jazykova_kvalita`, `doporuceni`, `poznamky`) VALUES ('4', '4', '5', '5', '2', '3', '1', NULL);
INSERT INTO `janochweb.bo8676`.`janoch_hodnoceni` (`Janoch_uzivatel_ID_uzivatel`, `janoch_prispevky_ID_prispevku`, `originalita`, `tema`, `technicka_kvalita`, `jazykova_kvalita`, `doporuceni`, `poznamky`) VALUES ('2', '2', '4', '5', '2', '3', '4', NULL);

INSERT INTO `janochweb.bo8676`.`janoch_prava` (`ID_prav`, `nazev`) VALUES ('1', 'Admin');
INSERT INTO `janochweb.bo8676`.`janoch_prava` (`ID_prav`, `nazev`) VALUES ('2', 'Recenzent');
INSERT INTO `janochweb.bo8676`.`janoch_prava` (`ID_prav`, `nazev`) VALUES ('3', 'Autor');
-- Oracle SQL Developer Data Modeler Summary Report: 
-- 
-- CREATE TABLE                             4
-- CREATE INDEX                             0
-- ALTER TABLE                              8
-- CREATE VIEW                              0
-- ALTER VIEW                               0
-- CREATE PACKAGE                           0
-- CREATE PACKAGE BODY                      0
-- CREATE PROCEDURE                         0
-- CREATE FUNCTION                          0
-- CREATE TRIGGER                           0
-- ALTER TRIGGER                            0
-- CREATE COLLECTION TYPE                   0
-- CREATE STRUCTURED TYPE                   0
-- CREATE STRUCTURED TYPE BODY              0
-- CREATE CLUSTER                           0
-- CREATE CONTEXT                           0
-- CREATE DATABASE                          0
-- CREATE DIMENSION                         0
-- CREATE DIRECTORY                         0
-- CREATE DISK GROUP                        0
-- CREATE ROLE                              0
-- CREATE ROLLBACK SEGMENT                  0
-- CREATE SEQUENCE                          0
-- CREATE MATERIALIZED VIEW                 0
-- CREATE SYNONYM                           0
-- CREATE TABLESPACE                        0
-- CREATE USER                              0
-- 
-- DROP TABLESPACE                          0
-- DROP DATABASE                            0
-- 
-- REDACTION POLICY                         0
-- 
-- ORDS DROP SCHEMA                         0
-- ORDS ENABLE SCHEMA                       0
-- ORDS ENABLE OBJECT                       0
-- 
-- ERRORS                                   0
-- WARNINGS                                 0