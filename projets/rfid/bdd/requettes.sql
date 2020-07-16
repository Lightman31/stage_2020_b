
DROP DATABASE IF EXISTS blet;

CREATE DATABASE blet DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;


CREATE TABLE SAV(id_sav INT PRIMARY KEY NOT NULL AUTO_INCREMENT, echeance DATE, nom_sav varchar(50), num_sav varchar(12) NOT NULL, UID bigint);



CREATE TABLE Statut(id_statut INT PRIMARY KEY NOT NULL AUTO_INCREMENT, nom_statut varchar(50) NOT NULL, inf_dat_statut DATETIME, sav int ,  FOREIGN KEY(sav) REFERENCES SAV(id_sav));

CREATE TABLE Emplacement(id_emplacement INT PRIMARY KEY NOT NULL AUTO_INCREMENT, nom_emplacement varchar(50) NOT NULL, inf_dat_emplacement DATETIME, sav int,  FOREIGN KEY(sav) REFERENCES SAV(id_sav));






INSERT INTO SAV(num_sav,UID ) VALUES( "16-174", 198093194043114);


INSERT INTO Statut(sav,inf_dat_statut,nom_statut) VALUES( (SELECT id_sav FROM `SAV` where UID = 198093194043114 ),NOW(),"en attente");

INSERT INTO Emplacement(sav,inf_dat_emplacement,nom_emplacement) VALUES( (SELECT id_sav FROM `SAV` where UID = 198093194043114 ),NOW(),"Logistique");

