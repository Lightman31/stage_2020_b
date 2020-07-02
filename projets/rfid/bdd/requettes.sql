
DROP DATABASE IF EXISTS blet;

CREATE DATABASE blet DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;


CREATE TABLE Societe(id_societe INT PRIMARY KEY NOT NULL AUTO_INCREMENT, nom_societe varchar(50));

CREATE TABLE Client(id_client INT PRIMARY KEY NOT NULL AUTO_INCREMENT, nom_client varchar(50), contact varchar(100), societe int , FOREIGN KEY(societe) REFERENCES Societe(id_societe));


CREATE TABLE SAV(id_sav INT PRIMARY KEY NOT NULL AUTO_INCREMENT, nom_sav varchar(50), num_sav varchar(10) NOT NULL, UID bigint, note text, emplacement varchar(30), client int,  FOREIGN KEY(client) REFERENCES Client(id_client));


CREATE TABLE Statut(id_statut INT PRIMARY KEY NOT NULL AUTO_INCREMENT, nom_statut varchar(50) NOT NULL, inf_dat DATETIME, sav int,  FOREIGN KEY(sav) REFERENCES SAV(id_sav));







INSERT INTO Societe(nom_societe) VALUES( "DEFAULT");
INSERT INTO Societe(nom_societe) VALUES( "SNCF");
INSERT INTO Societe(nom_societe) VALUES( "EDF");
INSERT INTO Societe(nom_societe) VALUES( "Evian");


INSERT INTO Client(nom_client,societe) VALUES( "René",1);
INSERT INTO Client(nom_client,societe) VALUES( "Jean",2);
INSERT INTO Client(nom_client,societe) VALUES( "Pierre",3);
INSERT INTO Client(nom_client,societe) VALUES( "René",2);
INSERT INTO Client(nom_client,societe) VALUES( "Service des stages bouteille de gaz",1);
INSERT INTO Client(nom_client,societe) VALUES( "Service de transports",2);
INSERT INTO Client(nom_client,societe) VALUES( "Service de routes",3);



INSERT INTO SAV(num_sav,emplacement,UID ) VALUES( "16-174","Service Logistique", 198093194043114);
INSERT INTO Statut(sav,inf_dat,nom_statut) VALUES( (SELECT id_sav FROM `SAV` where UID = 198093194043114 ),NOW(),"Service Logistique");

