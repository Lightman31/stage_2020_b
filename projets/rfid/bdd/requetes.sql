
DROP DATABASE IF EXISTS blet;

CREATE DATABASE blet DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;


CREATE TABLE SAV(id_sav INT PRIMARY KEY NOT NULL AUTO_INCREMENT, delai_theorique DATE,delai_confirme DATE, nom_sav varchar(50), num_sav varchar(12) NOT NULL, UID bigint);



CREATE TABLE Statut(id_statut INT PRIMARY KEY NOT NULL AUTO_INCREMENT, nom_statut varchar(50) NOT NULL, processus  varchar(50),inf_dat_statut DATETIME, sav int ,  FOREIGN KEY(sav) REFERENCES SAV(id_sav));

CREATE TABLE Emplacement(id_emplacement INT PRIMARY KEY NOT NULL AUTO_INCREMENT, nom_emplacement varchar(50) NOT NULL, inf_dat_emplacement DATETIME, sav int,  FOREIGN KEY(sav) REFERENCES SAV(id_sav));






INSERT INTO SAV(num_sav,UID ) VALUES( "16-174", 198093194043114);
INSERT INTO SAV(num_sav,UID ) VALUES( "20-001", 211111111111111);
INSERT INTO SAV(num_sav,UID ) VALUES( "20-002", 211222231111111);


INSERT INTO Statut(sav,inf_dat_statut,nom_statut) VALUES( (SELECT id_sav FROM `SAV` where UID = 198093194043114 ),NOW(),"Arrivée Client");

INSERT INTO Emplacement(sav,inf_dat_emplacement,nom_emplacement) VALUES( (SELECT id_sav FROM `SAV` where UID = 198093194043114 ),NOW(),"Logistique Entrée");

INSERT INTO Statut(sav,inf_dat_statut,nom_statut) VALUES( (SELECT id_sav FROM `SAV` where UID = 211111111111111 ),NOW(),"Arrivée Client");

INSERT INTO Emplacement(sav,inf_dat_emplacement,nom_emplacement) VALUES( (SELECT id_sav FROM `SAV` where UID = 211111111111111 ),NOW(),"Logistique Entrée");

INSERT INTO Statut(sav,inf_dat_statut,nom_statut) VALUES( (SELECT id_sav FROM `SAV` where UID = 211222231111111 ),NOW(),"Arrivée Client");

INSERT INTO Emplacement(sav,inf_dat_emplacement,nom_emplacement) VALUES( (SELECT id_sav FROM `SAV` where UID = 211222231111111 ),NOW(),"Logistique Entrée");

