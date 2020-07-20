

pour créer sav
UPDATE SAV SET UID = NULL WHERE UID = 198093194043114;
INSERT INTO SAV(num_sav,emplacement,UID ) VALUES( "16-175","Service", 198093194043114);
INSERT INTO Statut(sav,inf_dat,nom_statut) VALUES( (SELECT id_sav FROM `SAV` where UID = 198093194043114 ),NOW(),"Service Logistique");



pour changer emplacmeent 

UPDATE SAV SET emplacement = 'atelier'  WHERE UID = 198093194043114;
INSERT INTO Statut(sav,inf_dat,nom_statut) VALUES( (SELECT id_sav FROM `SAV` where UID = 198093194043114 ),NOW(),"atelier");

