-- TABLE Table_de_connexion_a_la_base_de_gestion_de_parc_locatif --
CREATE TABLE IF NOT EXISTS Table_de_connexion_a_la_base_de_gestion_de_parc_locatif(
	id INTEGER NOT NULL AUTO_INCREMENT,
	username VARCHAR(100) NOT NULL,
	password VARCHAR(200) NOT NULL,
	nom VARCHAR(200) NOT NULL,
	prenom VARCHAR(200) NOT NULL,
	adresse_mail VARCHAR(100) NOT NULL,
	date_et_heure_de_derniere_connexion DATETIME NOT NULL,
	est_connecte BOOL NOT NULL,
	PRIMARY KEY(id)
);

-- TABLE Recuperation_du_mot_de_passe --
CREATE TABLE Recuperation_du_mot_de_passe(
	id INTEGER NOT NULL AUTO_INCREMENT,
	utilisateur INTEGER NOT NULL,
	code_de_recuperation_du_mot_de_passe BIGINT,
	temps_limite_pour_la_validite_du_code_de_recuperation DATETIME,
	PRIMARY KEY(id),
	FOREIGN KEY (utilisateur) REFERENCES Table_de_connexion_a_la_base_de_gestion_de_parc_locatif(id)
);

-- TABLE Type_de_public --
CREATE TABLE IF NOT EXISTS Type_de_public(
        id INTEGER NOT NULL AUTO_INCREMENT,
        libelle_du_type_de_public VARCHAR(50) NOT NULL,
	PRIMARY KEY(id)
);

-- TABLE Locataire --
CREATE TABLE IF NOT EXISTS Locataire(
        id INTEGER NOT NULL AUTO_INCREMENT,
        nom VARCHAR(100) NOT NULL,
        prenom VARCHAR(100) NOT NULL,
        adresse_d_habitation VARCHAR(100) NOT NULL,
        type_de_public INTEGER NOT NULL,
        date_d_arrivee DATE NOT NULL,
        adresse_mail VARCHAR(100),
        date_de_naissance DATE NOT NULL,
        numero_de_telephone VARCHAR(100) NOT NULL,
	PRIMARY KEY(id),
        FOREIGN KEY (type_de_public) REFERENCES Type_de_public(id)
);

-- TABLE Surface --
CREATE TABLE IF NOT EXISTS Surface(
        id INTEGER AUTO_INCREMENT NOT NULL,
        libelle_de_la_surface INTEGER NOT NULL,
	PRIMARY KEY(id)
);

-- TABLE Studio --
CREATE TABLE IF NOT EXISTS Studio(
        id INTEGER NOT NULL AUTO_INCREMENT,
        numero_du_studio INTEGER NOT NULL,
        surface INTEGER NOT NULL,
	FOREIGN KEY (surface) REFERENCES Surface(id),
	PRIMARY KEY(id)
);

-- TABLE Ensemble_des_conditions_du_contrat --
CREATE TABLE IF NOT EXISTS Ensemble_des_conditions_du_contrat(
	id INTEGER NOT NULL AUTO_INCREMENT,
	inclusion_edf BOOLEAN NOT NULL,
	inclusion_eau BOOLEAN NOT NULL,
	inclusion_internet BOOLEAN NOT NULL,
	inclusion_assurance_locative BOOLEAN NOT NULL,
	inclusion_charges_immeuble BOOLEAN NOT NULL,
	tom_en_sus BOOLEAN NOT NULL,
	PRIMARY KEY(id)
);

-- TABLE Type_de_contrat --
CREATE TABLE IF NOT EXISTS Type_de_contrat(
	id INTEGER NOT NULL AUTO_INCREMENT,
	libelle_du_type_de_contrat VARCHAR(100) NOT NULL,
	ensemble_des_conditions_du_contrat INTEGER NOT NULL,
	FOREIGN KEY (ensemble_des_conditions_du_contrat) REFERENCES Ensemble_des_conditions_du_contrat(id),
	PRIMARY KEY(id)
);

-- TABLE Coute --
CREATE TABLE IF NOT EXISTS Coute(
	prix_du_tarif INTEGER NOT NULL,
	prix_du_depot_de_garantie INTEGER NOT NULL,
	type_de_contrat INTEGER NOT NULL,
	type_de_public INTEGER NOT NULL,
	FOREIGN KEY (type_de_contrat) REFERENCES Type_de_contrat(id),
	FOREIGN KEY (type_de_public) REFERENCES Type_de_public(id)
);

-- Table Garant --
CREATE TABLE IF NOT EXISTS Garant(
	id INTEGER NOT NULL AUTO_INCREMENT,
	nom VARCHAR(100) NOT NULL,
        prenom VARCHAR(100) NOT NULL,
	date_de_naissance DATE NOT NULL,
	adresse_d_habitation VARCHAR(100) NOT NULL,
    PRIMARY KEY(id)
);

-- TABLE Contrat --
CREATE TABLE IF NOT EXISTS Contrat(
        id INTEGER NOT NULL AUTO_INCREMENT,
        locataire INTEGER NOT NULL,
        studio INTEGER NOT NULL,
        garant INTEGER,
        type_de_contrat INTEGER NOT NULL,
        date_de_debut_du_contrat DATE NOT NULL,
        date_de_fin_du_contrat DATE NOT NULL,
        date_du_jour DATE NOT NULL,
        montant_du_loyer INTEGER NOT NULL,
        encaissement_du_depot_de_garantie BOOLEAN NOT NULL,
        chemin_d_accee VARCHAR(100) NOT NULL,
        FOREIGN KEY (locataire) REFERENCES Locataire(id),
        FOREIGN KEY (studio) REFERENCES Studio(id),
        FOREIGN KEY (garant) REFERENCES Garant(id),
	FOREIGN KEY (type_de_contrat) REFERENCES Type_de_contrat(id),
	PRIMARY KEY(id)
);

-- TABLE Attestation --
CREATE TABLE IF NOT EXISTS Attestation(
    id INTEGER NOT NULL AUTO_INCREMENT,
    date_du_jour DATE NOT NULL,
    chemin_d_accee VARCHAR(100) NOT NULL,
    contrat INTEGER  NOT NULL,
    FOREIGN KEY (contrat) REFERENCES Contrat(id),
    PRIMARY KEY(id)
);

-- TABLE Preavit --
CREATE TABLE IF NOT EXISTS Preavit(
    id INTEGER NOT NULL AUTO_INCREMENT,
    date_du_jour DATE NOT NULL,
    chemin_d_accee VARCHAR(100) NOT NULL,
    contrat INTEGER  NOT NULL,
    FOREIGN KEY (contrat) REFERENCES Contrat(id),
    PRIMARY KEY(id)
);

-- TABLE Etat_des_lieux --
CREATE TABLE IF NOT EXISTS Etat_des_lieux(
    id INTEGER NOT NULL AUTO_INCREMENT,
    date_du_jour DATE NOT NULL,
    chemin_d_accee VARCHAR(100) NOT NULL,
    contrat INTEGER  NOT NULL,
    FOREIGN KEY (contrat) REFERENCES Contrat(id),
    PRIMARY KEY(id)
);

-- INSERTION DES UTTILISATEURS ET DE LEURS MOTS DE PASSE RESPECTIFS DANS LA TABLE Table_de_connexion_a_la_base_de_gestion_de_parc_locatif --
INSERT INTO Table_de_connexion_a_la_base_de_gestion_de_parc_locatif(username, password, nom, prenom, date_et_heure_de_derniere_connexion, est_connecte, adresse_mail) VALUES('nlievens', SHA1('123'), 'Lievens', 'Nicolas', NOW(), FALSE, 'nlievens@gmail.com');
INSERT INTO Table_de_connexion_a_la_base_de_gestion_de_parc_locatif(username, password, nom, prenom, date_et_heure_de_derniere_connexion, est_connecte, adresse_mail) VALUES('msanchez', SHA1('abc'), 'Sanchez', 'Marie', NOW(), FALSE, 'msanchez@gmail.com');

-- INSERTION DES UTTILISATEURS POUR FAIRE ENTRER LE CODE DE RECUPERATION EN CAS D'OUBLIS DU MOT DE PASSE DANS LA TABLE Recuperation_du_mot_de_passe --
INSERT INTO Recuperation_du_mot_de_passe(utilisateur, code_de_recuperation_du_mot_de_passe, temps_limite_pour_la_validite_du_code_de_recuperation) VALUES(1, NULL, NULL);
INSERT INTO Recuperation_du_mot_de_passe(utilisateur, code_de_recuperation_du_mot_de_passe, temps_limite_pour_la_validite_du_code_de_recuperation) VALUES(2, NULL, NULL);

-- INSERTION DE TOUTES LES CONDITIONS DU CONTRAT DE LOCATION DANS LA TABLE Ensemble_des_conditions_du_contrat --
INSERT INTO Ensemble_des_conditions_du_contrat(inclusion_edf, inclusion_eau, inclusion_internet, inclusion_assurance_locative, inclusion_charges_immeuble, tom_en_sus) VALUES(TRUE, TRUE, TRUE, TRUE, TRUE, TRUE);
INSERT INTO Ensemble_des_conditions_du_contrat(inclusion_edf, inclusion_eau, inclusion_internet, inclusion_assurance_locative, inclusion_charges_immeuble, tom_en_sus) VALUES(FALSE, TRUE, TRUE, TRUE, TRUE, TRUE);
INSERT INTO Ensemble_des_conditions_du_contrat(inclusion_edf, inclusion_eau, inclusion_internet, inclusion_assurance_locative, inclusion_charges_immeuble, tom_en_sus) VALUES(FALSE, TRUE, TRUE, FALSE, TRUE, TRUE);

-- INSERTION DES DIFFERENTS TYPES DE PUBLICS DANS LA TABLE Type_de_public --
INSERT INTO Type_de_public(libelle_du_type_de_public) VALUES("SOCIAL");
INSERT INTO Type_de_public(libelle_du_type_de_public) VALUES("MLJ");
INSERT INTO Type_de_public(libelle_du_type_de_public) VALUES("ETUDIANTS");
INSERT INTO Type_de_public(libelle_du_type_de_public) VALUES("AUTRES");

-- INSERTION DES DIFFERENTES SURFACES DANS LA TABLE Surface --
INSERT INTO Surface(libelle_de_la_surface) VALUES(15);
INSERT INTO Surface(libelle_de_la_surface) VALUES(18);

-- INSERTION DES DIFFERENTS STUDIOS COMPOSANT LE PARC LOCATIF DANS LA TABLE Studio --
INSERT INTO Studio(numero_du_studio, surface) VALUES(1, 1);
INSERT INTO Studio(numero_du_studio, surface) VALUES(2, 1);
INSERT INTO Studio(numero_du_studio, surface) VALUES(3, 1);
INSERT INTO Studio(numero_du_studio, surface) VALUES(4, 1);
INSERT INTO Studio(numero_du_studio, surface) VALUES(5, 1);
INSERT INTO Studio(numero_du_studio, surface) VALUES(6, 1);
INSERT INTO Studio(numero_du_studio, surface) VALUES(7, 1);
INSERT INTO Studio(numero_du_studio, surface) VALUES(8, 1);
INSERT INTO Studio(numero_du_studio, surface) VALUES(9, 1);
INSERT INTO Studio(numero_du_studio, surface) VALUES(10, 2);
INSERT INTO Studio(numero_du_studio, surface) VALUES(11, 2);
INSERT INTO Studio(numero_du_studio, surface) VALUES(12, 1);
INSERT INTO Studio(numero_du_studio, surface) VALUES(13, 1);
INSERT INTO Studio(numero_du_studio, surface) VALUES(14, 1);
INSERT INTO Studio(numero_du_studio, surface) VALUES(15, 1);
INSERT INTO Studio(numero_du_studio, surface) VALUES(16, 1);
INSERT INTO Studio(numero_du_studio, surface) VALUES(17, 1);
INSERT INTO Studio(numero_du_studio, surface) VALUES(18, 1);
INSERT INTO Studio(numero_du_studio, surface) VALUES(19, 1);
INSERT INTO Studio(numero_du_studio, surface) VALUES(20, 1);
INSERT INTO Studio(numero_du_studio, surface) VALUES(21, 1);
INSERT INTO Studio(numero_du_studio, surface) VALUES(22, 1);
INSERT INTO Studio(numero_du_studio, surface) VALUES(23, 1);
INSERT INTO Studio(numero_du_studio, surface) VALUES(24, 1);
INSERT INTO Studio(numero_du_studio, surface) VALUES(101, 1);
INSERT INTO Studio(numero_du_studio, surface) VALUES(102, 1);
INSERT INTO Studio(numero_du_studio, surface) VALUES(103, 1);
INSERT INTO Studio(numero_du_studio, surface) VALUES(104, 1);
INSERT INTO Studio(numero_du_studio, surface) VALUES(105, 1);
INSERT INTO Studio(numero_du_studio, surface) VALUES(106, 1);
INSERT INTO Studio(numero_du_studio, surface) VALUES(107, 1);
INSERT INTO Studio(numero_du_studio, surface) VALUES(108, 1);
INSERT INTO Studio(numero_du_studio, surface) VALUES(109, 1);
INSERT INTO Studio(numero_du_studio, surface) VALUES(110, 2);
INSERT INTO Studio(numero_du_studio, surface) VALUES(111, 2);
INSERT INTO Studio(numero_du_studio, surface) VALUES(112, 1);
INSERT INTO Studio(numero_du_studio, surface) VALUES(113, 1);
INSERT INTO Studio(numero_du_studio, surface) VALUES(114, 1);
INSERT INTO Studio(numero_du_studio, surface) VALUES(115, 1);
INSERT INTO Studio(numero_du_studio, surface) VALUES(116, 1);
INSERT INTO Studio(numero_du_studio, surface) VALUES(117, 1);
INSERT INTO Studio(numero_du_studio, surface) VALUES(118, 1);
INSERT INTO Studio(numero_du_studio, surface) VALUES(119, 1);
INSERT INTO Studio(numero_du_studio, surface) VALUES(120, 1);
INSERT INTO Studio(numero_du_studio, surface) VALUES(121, 1);
INSERT INTO Studio(numero_du_studio, surface) VALUES(122, 1);
INSERT INTO Studio(numero_du_studio, surface) VALUES(123, 1);
INSERT INTO Studio(numero_du_studio, surface) VALUES(124, 1);
INSERT INTO Studio(numero_du_studio, surface) VALUES(125, 1);
INSERT INTO Studio(numero_du_studio, surface) VALUES(126, 1);
INSERT INTO Studio(numero_du_studio, surface) VALUES(201, 1);
INSERT INTO Studio(numero_du_studio, surface) VALUES(202, 1);
INSERT INTO Studio(numero_du_studio, surface) VALUES(203, 1);
INSERT INTO Studio(numero_du_studio, surface) VALUES(204, 1);
INSERT INTO Studio(numero_du_studio, surface) VALUES(205, 1);
INSERT INTO Studio(numero_du_studio, surface) VALUES(206, 1);
INSERT INTO Studio(numero_du_studio, surface) VALUES(207, 1);
INSERT INTO Studio(numero_du_studio, surface) VALUES(208, 1);
INSERT INTO Studio(numero_du_studio, surface) VALUES(209, 1);
INSERT INTO Studio(numero_du_studio, surface) VALUES(210, 2);
INSERT INTO Studio(numero_du_studio, surface) VALUES(211, 2);
INSERT INTO Studio(numero_du_studio, surface) VALUES(212, 1);
INSERT INTO Studio(numero_du_studio, surface) VALUES(213, 1);
INSERT INTO Studio(numero_du_studio, surface) VALUES(214, 1);
INSERT INTO Studio(numero_du_studio, surface) VALUES(215, 1);
INSERT INTO Studio(numero_du_studio, surface) VALUES(216, 1);
INSERT INTO Studio(numero_du_studio, surface) VALUES(217, 1);
INSERT INTO Studio(numero_du_studio, surface) VALUES(218, 1);
INSERT INTO Studio(numero_du_studio, surface) VALUES(219, 1);
INSERT INTO Studio(numero_du_studio, surface) VALUES(220, 1);
INSERT INTO Studio(numero_du_studio, surface) VALUES(221, 1);
INSERT INTO Studio(numero_du_studio, surface) VALUES(222, 1);
INSERT INTO Studio(numero_du_studio, surface) VALUES(223, 1);
INSERT INTO Studio(numero_du_studio, surface) VALUES(224, 1);
INSERT INTO Studio(numero_du_studio, surface) VALUES(225, 1);
INSERT INTO Studio(numero_du_studio, surface) VALUES(226, 1);
INSERT INTO Studio(numero_du_studio, surface) VALUES(301, 1);
INSERT INTO Studio(numero_du_studio, surface) VALUES(302, 1);
INSERT INTO Studio(numero_du_studio, surface) VALUES(303, 1);
INSERT INTO Studio(numero_du_studio, surface) VALUES(304, 1);
INSERT INTO Studio(numero_du_studio, surface) VALUES(305, 1);
INSERT INTO Studio(numero_du_studio, surface) VALUES(306, 1);
INSERT INTO Studio(numero_du_studio, surface) VALUES(307, 1);
INSERT INTO Studio(numero_du_studio, surface) VALUES(308, 1);
INSERT INTO Studio(numero_du_studio, surface) VALUES(309, 1);
INSERT INTO Studio(numero_du_studio, surface) VALUES(310, 1);
INSERT INTO Studio(numero_du_studio, surface) VALUES(311, 1);
INSERT INTO Studio(numero_du_studio, surface) VALUES(312, 1);
INSERT INTO Studio(numero_du_studio, surface) VALUES(313, 1);
INSERT INTO Studio(numero_du_studio, surface) VALUES(314, 1);
INSERT INTO Studio(numero_du_studio, surface) VALUES(315, 1);
INSERT INTO Studio(numero_du_studio, surface) VALUES(316, 1);
INSERT INTO Studio(numero_du_studio, surface) VALUES(317, 1);
INSERT INTO Studio(numero_du_studio, surface) VALUES(318, 1);
INSERT INTO Studio(numero_du_studio, surface) VALUES(319, 1);
INSERT INTO Studio(numero_du_studio, surface) VALUES(320, 1);
INSERT INTO Studio(numero_du_studio, surface) VALUES(321, 1);
INSERT INTO Studio(numero_du_studio, surface) VALUES(322, 1);
INSERT INTO Studio(numero_du_studio, surface) VALUES(323, 1);
INSERT INTO Studio(numero_du_studio, surface) VALUES(324, 1);

-- INSERTION DES DIFFERENTS TYPES DE CONTRAT DANS LA TABLE Type_de_contrat --
INSERT INTO Type_de_contrat(libelle_du_type_de_contrat, ensemble_des_conditions_du_contrat) VALUES("0-3 mois avec EDF", 1);
INSERT INTO Type_de_contrat(libelle_du_type_de_contrat, ensemble_des_conditions_du_contrat) VALUES("0-3 mois sans EDF", 2);
INSERT INTO Type_de_contrat(libelle_du_type_de_contrat, ensemble_des_conditions_du_contrat) VALUES("A l'année", 3);



-- INSERTION DES DIFFERENTS LOCATAIRE DANS LA TABLE Locataire --
-- Rez de chaussée 21 ENTRÉE --

INSERT INTO Locataire(nom, prenom, adresse_d_habitation, type_de_public, date_d_arrivee, adresse_mail, date_de_naissance, numero_de_telephone) VALUES("REA", "Solange", "14 Avenue Jean Moulin, 66180 LE BOULOU", 1, '2013-06-18', NULL, '1978-08-03', "0601949294");
INSERT INTO Locataire(nom, prenom, adresse_d_habitation, type_de_public, date_d_arrivee, adresse_mail, date_de_naissance, numero_de_telephone) VALUES("MAHAOUCHI", "Illyess", "10 Avenue du Tech, 66100 PERPIGNAN", 2, '2018-09-03', "imahaouchi@gmail.com", '1995-01-13', "0650030083");
INSERT INTO Locataire(nom, prenom, adresse_d_habitation, type_de_public, date_d_arrivee, adresse_mail, date_de_naissance, numero_de_telephone) VALUES("BUTTIKOFER", "Dominique", "HLM St Assiscle, Bat. 8, 66000 PERPIGNAN", 1, '2014-03-12', NULL, '1961-05-16', "0607616698");
INSERT INTO Locataire(nom, prenom, adresse_d_habitation, type_de_public, date_d_arrivee, adresse_mail, date_de_naissance, numero_de_telephone) VALUES("HABOUBA", "Hakim", "42 Avenue Achilles Jubinal, 65000 TARBES", 1, '2013-03-05', "boyboyboyboy@hotmail.fr", '1970-00-00', "0659385980");
INSERT INTO Locataire(nom, prenom, adresse_d_habitation, type_de_public, date_d_arrivee, adresse_mail, date_de_naissance, numero_de_telephone) VALUES("MORENO", "Frédéric", "CROIX ROUGE Av. du Dr TOREILLES 66000 PERPIGNAN", 1, '2019-03-08', "fred92210@hotmail.fr", '1982-09-17', "0773268835");
INSERT INTO Locataire(nom, prenom, adresse_d_habitation, type_de_public, date_d_arrivee, adresse_mail, date_de_naissance, numero_de_telephone) VALUES("RIDE", "Emmanuel", "111 Avenue Joffre 66000 PERPIGNAN", 1, '2014-02-07', NULL, '1973-07-29', "0778435541");
INSERT INTO Locataire(nom, prenom, adresse_d_habitation, type_de_public, date_d_arrivee, adresse_mail, date_de_naissance, numero_de_telephone) VALUES("MOGINOT", "Lillo", "111 Avenue du Marechal Joffre, 66000 PERPIGNAN", 1, '2013-04-18', "lillomoginot1@hotmail.fr", '1991-05-28', "0782375536");
INSERT INTO Locataire(nom, prenom, adresse_d_habitation, type_de_public, date_d_arrivee, adresse_mail, date_de_naissance, numero_de_telephone) VALUES("RABALLAND", "Nolan", "14 Rue de la Républlique, 66170 NEFIACH", 3, '2018-11-02', "nonova66500@gmail.com", '1999-11-03', "0615512312");
INSERT INTO Locataire(nom, prenom, adresse_d_habitation, type_de_public, date_d_arrivee, adresse_mail, date_de_naissance, numero_de_telephone) VALUES("BOUDEBZA FARTAS", "Malika", "ErreurPasD Adresse", 1, '2016-06-24', "nacera400@hotmail.fr", '1956-01-28', "0752788033");
INSERT INTO Locataire(nom, prenom, adresse_d_habitation, type_de_public, date_d_arrivee, adresse_mail, date_de_naissance, numero_de_telephone) VALUES("LESNIAK", "Yannick", "Avenue du Roussillon, 66300 THUIR", 1, '2015-05-13', "ya.lesniak@laposte.net", '1974-06-26', "0788800210");
INSERT INTO Locataire(nom, prenom, adresse_d_habitation, type_de_public, date_d_arrivee, adresse_mail, date_de_naissance, numero_de_telephone) VALUES("GIACOMBONO", "Léa", "300 Avenue Charles Deperet, Bat.C, 66000 PERPIGNAN", 2, '2018-12-13', "leagiaconbono@gmail.com", '1997-10-15', "0766002334");
INSERT INTO Locataire(nom, prenom, adresse_d_habitation, type_de_public, date_d_arrivee, adresse_mail, date_de_naissance, numero_de_telephone) VALUES("DUPONT", "Paul", "13 RUE DES JONQUILLES 75000 PARIS", 1, '2019-02-03', NULL, '1900-01-01', "0662143020");
INSERT INTO Locataire(nom, prenom, adresse_d_habitation, type_de_public, date_d_arrivee, adresse_mail, date_de_naissance, numero_de_telephone) VALUES("LAIDOUNI", "Adel", "ErreurPasD'Adresse", 3, '2017-09-08', "top.adel@hotmail.fr", '1900-01-01', "0000000000");
INSERT INTO Locataire(nom, prenom, adresse_d_habitation, type_de_public, date_d_arrivee, adresse_mail, date_de_naissance, numero_de_telephone) VALUES("MATHIEU", "Antoine", "42 Rue Paul Valery, 66000 PERPIGNAN", 2, '2018-03-14', "amathieu2304@gmail.com", '1997-04-23', "0769793903");
INSERT INTO Locataire(nom, prenom, adresse_d_habitation, type_de_public, date_d_arrivee, adresse_mail, date_de_naissance, numero_de_telephone) VALUES("SOLA", "Georges", "4 Boulevard St Assiscle, 66000 PERPIGNAN", 1, '2018-12-14', "gsola078@gmail.com", '1960-09-07', "0643542446");
INSERT INTO Locataire(nom, prenom, adresse_d_habitation, type_de_public, date_d_arrivee, adresse_mail, date_de_naissance, numero_de_telephone) VALUES("TAAMALLAH", "Brahim", "16 Rue Benoit Fourneyron, 66000 PERPIGNAN", 1, '2018-06-07', "brahimtaamallah@gmail.com", '1978-06-18', "0627768025");
INSERT INTO Locataire(nom, prenom, adresse_d_habitation, type_de_public, date_d_arrivee, adresse_mail, date_de_naissance, numero_de_telephone) VALUES("ARSLAN", "Hilal", "Chez M. ARSLAN Harun, Boulevard Desnoyers, Res. Les oiseaux, Bat. 9, 66000 PERPIGNAN", 1, '2018-04-26', "hilalhan.arslan@gmail.com", '1991-09-04', "0646378251");
INSERT INTO Locataire(nom, prenom, adresse_d_habitation, type_de_public, date_d_arrivee, adresse_mail, date_de_naissance, numero_de_telephone) VALUES("LOMBARD", "Jean", "111 Avenue du Marechal Joffre, 66000 PERPIGNAN", 1, '2013-02-20', "attila-fender@gmx.fr", '1956-01-08', "0640593660");
INSERT INTO Locataire(nom, prenom, adresse_d_habitation, type_de_public, date_d_arrivee, adresse_mail, date_de_naissance, numero_de_telephone) VALUES("PARIS", "Patricia", "1 Rue de glaïeuls, 66000 PERPIGNAN", 1, '2014-01-08', "patricia-paris@gmx.fr", '1966-08-09', "0630479045/0645202351");
INSERT INTO Locataire(nom, prenom, adresse_d_habitation, type_de_public, date_d_arrivee, adresse_mail, date_de_naissance, numero_de_telephone) VALUES("RAMEAU", "Albert", "111 Avenue du Marechal Joffre, 66000 PERPIGNAN", 1, '2014-11-10', NULL, '1963-11-29', "0687459089");
INSERT INTO Locataire(nom, prenom, adresse_d_habitation, type_de_public, date_d_arrivee, adresse_mail, date_de_naissance, numero_de_telephone) VALUES("AIT HSSAIN", "Hicham", "23 bis Avenue de la gare, 66400 CERET", 1, '2018-03-09', NULL, '1970-10-05', "0671027858");

-- 1er Etage 25 ENTREE--
INSERT INTO Locataire(nom, prenom, adresse_d_habitation, type_de_public, date_d_arrivee, adresse_mail, date_de_naissance, numero_de_telephone) VALUES("ZAMIRE", "Ricardo", "AFPA, 66000 PERPIGNAN", 1, '2015-12-22', "zamirericardo@hotmail.fr", '1900-01-01', "0783722706");
INSERT INTO Locataire(nom, prenom, adresse_d_habitation, type_de_public, date_d_arrivee, adresse_mail, date_de_naissance, numero_de_telephone) VALUES("BAMBA", "Adamo Junior", "ErreurPasD Adresse", 4, '1900-01-01', NULL, '1900-01-01', "0000000000");
INSERT INTO Locataire(nom, prenom, adresse_d_habitation, type_de_public, date_d_arrivee, adresse_mail, date_de_naissance, numero_de_telephone) VALUES("DEVISSER ", "Felipe", "ErreurPasD Adresse", 4, '1900-01-01', NULL, '1900-01-01', "0000000000");
INSERT INTO Locataire(nom, prenom, adresse_d_habitation, type_de_public, date_d_arrivee, adresse_mail, date_de_naissance, numero_de_telephone) VALUES("JEAN JACQUES ", "Silven", "111 Avenue du Marechal Joffre, 66000 PERPIGNAN", 1, '2015-11-17', NULL, '1900-01-01', "0000000000");
INSERT INTO Locataire(nom, prenom, adresse_d_habitation, type_de_public, date_d_arrivee, adresse_mail, date_de_naissance, numero_de_telephone) VALUES("MICHEL", "Aimerick", "300 Avenue Charles Deperet, Bat.C, 66000 PERPIGNAN", 2, '2018-09-20', "michelaymerick66@gmail.com", '1900-01-01', "0648753598");
INSERT INTO Locataire(nom, prenom, adresse_d_habitation, type_de_public, date_d_arrivee, adresse_mail, date_de_naissance, numero_de_telephone) VALUES("VALLADARES", "Enrique", "ErreurPasD Adresse", 4, '1900-01-01', NULL, '1900-01-01', "0000000000");
INSERT INTO Locataire(nom, prenom, adresse_d_habitation, type_de_public, date_d_arrivee, adresse_mail, date_de_naissance, numero_de_telephone) VALUES("MASSIMISSA", "Hamel", "300 Avenue Charles Deperet, Bat.C, 66000 PERPIGNAN", 2, '2017-06-02', "massinissa75@gmail.com", '1900-01-01', "0624659136");
INSERT INTO Locataire(nom, prenom, adresse_d_habitation, type_de_public, date_d_arrivee, adresse_mail, date_de_naissance, numero_de_telephone) VALUES("BONNAUD DEMARS", "Elisa", "ErreurPasD Adresse", 4, '1900-01-01', NULL, '1900-01-01', "0000000000");
INSERT INTO Locataire(nom, prenom, adresse_d_habitation, type_de_public, date_d_arrivee, adresse_mail, date_de_naissance, numero_de_telephone) VALUES("FADLI", "Aicha", "2 Avenue de Belfort, 66000 PERPIGNAN", 1, '2017-12-15', "aicha.fadli66@laposte.net", '1900-01-01', "0761810169");
INSERT INTO Locataire(nom, prenom, adresse_d_habitation, type_de_public, date_d_arrivee, adresse_mail, date_de_naissance, numero_de_telephone) VALUES("NOZARET", "Alain", "7 rue des roses, 66450 POLLESTRES", 1, '2015-10-14', NULL, '1900-01-01', "0643480951");
INSERT INTO Locataire(nom, prenom, adresse_d_habitation, type_de_public, date_d_arrivee, adresse_mail, date_de_naissance, numero_de_telephone) VALUES("GONCALVES", "Alexandre", "ErreurPasD Adresse", 4, '1900-01-01', NULL, '1900-01-01', "0000000000");
INSERT INTO Locataire(nom, prenom, adresse_d_habitation, type_de_public, date_d_arrivee, adresse_mail, date_de_naissance, numero_de_telephone) VALUES("HLALI", "Hinda", "42 Avenue Aristide Briand,66000 PERPIGNAN", 1, '2018-03-21', "hindahlali@laposte.net", '1900-01-01', "0754329133");
INSERT INTO Locataire(nom, prenom, adresse_d_habitation, type_de_public, date_d_arrivee, adresse_mail, date_de_naissance, numero_de_telephone) VALUES("GAUYACQ", "Laure", "3 rue de la Biatère, 64400 Verdets", 3, '2017-10-09', "laure.gauyacq@hotmail.fr", '1994-06-23', "0679038061");
INSERT INTO Locataire(nom, prenom, adresse_d_habitation, type_de_public, date_d_arrivee, adresse_mail, date_de_naissance, numero_de_telephone) VALUES("ANNICELLI", "Nathan", "Chemin du Fangas, 84400 SAIGNON", 3, '2018-09-13', "n.annicelli8484@gmail.com", '1997-10-06', "0750237587");
INSERT INTO Locataire(nom, prenom, adresse_d_habitation, type_de_public, date_d_arrivee, adresse_mail, date_de_naissance, numero_de_telephone) VALUES("PASTRE", "Dilan", "13 rue des Micocouiller 66620 BROUILLA", 2, '2019-02-27', "pastredylan66@gmail.com", '1900-01-01', "0612981945");
INSERT INTO Locataire(nom, prenom, adresse_d_habitation, type_de_public, date_d_arrivee, adresse_mail, date_de_naissance, numero_de_telephone) VALUES("MAKHLOUA", "Abdelhamid", "Res. Les Jardins de Catalogne, 66000 PERPIGNAN", 1, '2017-07-24', "makhloua@hotmail.com", '1983-06-30', "0754106969");
INSERT INTO Locataire(nom, prenom, adresse_d_habitation, type_de_public, date_d_arrivee, adresse_mail, date_de_naissance, numero_de_telephone) VALUES("CHAPUT", "Pascal", "300 Avenue Charles Deperet, Bat.C, 66000 PERPIGNAN", 1, '2013-01-02', NULL, '1900-01-01', "0668533006");
INSERT INTO Locataire(nom, prenom, adresse_d_habitation, type_de_public, date_d_arrivee, adresse_mail, date_de_naissance, numero_de_telephone) VALUES("RENAULT", "Francis", "Avenue Jean Louis Torreilles, 66000 PERPIGNAN", 1, '2015-10-12', "francisrenault@live.fr", '1955-07-16', "0601999019");
INSERT INTO Locataire(nom, prenom, adresse_d_habitation, type_de_public, date_d_arrivee, adresse_mail, date_de_naissance, numero_de_telephone) VALUES("HERAIL", "Aurelien", "4 Chemin Passio Vella, 66100 PERPIGNAN", 1, '2015-04-29', "riddim.zoo@gmail.com", '1988-01-22', "0000000000");
INSERT INTO Locataire(nom, prenom, adresse_d_habitation, type_de_public, date_d_arrivee, adresse_mail, date_de_naissance, numero_de_telephone) VALUES("JEOFFRE", "Philippe", "6 ter Av. de LODEVE 34150 GIGNAC", 1, '2019-03/-08', "ph.jeoffre@gmail.com", '1985-04-18', "0770343274");
INSERT INTO Locataire(nom, prenom, adresse_d_habitation, type_de_public, date_d_arrivee, adresse_mail, date_de_naissance, numero_de_telephone) VALUES("RIGOGNE", "Gerard", "34 Avenue des Pervenches, 66000 PERPIGNANC", 1, '2018-08-21', "gerard.rigogne@laposte.net", '1944-03-03', "0643340962");
INSERT INTO Locataire(nom, prenom, adresse_d_habitation, type_de_public, date_d_arrivee, adresse_mail, date_de_naissance, numero_de_telephone) VALUES("DUPOUY", "William", "114 Rue Pierre Ciffre, 66000 PERPIGNAN", 1, '2018-03-15', NULL, '1978-11-24', "0000000000");
INSERT INTO Locataire(nom, prenom, adresse_d_habitation, type_de_public, date_d_arrivee, adresse_mail, date_de_naissance, numero_de_telephone) VALUES("GRAU", "Sebastien", "111 Avenue du Marechal Joffre, 66000 PERPIGNAN", 1, '2014-09-29', "sebastiengrau@hotmail.fr", '1982-06-23', "0629600270/0612720302");
INSERT INTO Locataire(nom, prenom, adresse_d_habitation, type_de_public, date_d_arrivee, adresse_mail, date_de_naissance, numero_de_telephone) VALUES("LENICE", "Johann", "20 Chemin du Mas Codine, 66000 PERPIGNAN", 1, '2014-02-27', NULL, '1962-01-30', "0785869464");
INSERT INTO Locataire(nom, prenom, adresse_d_habitation, type_de_public, date_d_arrivee, adresse_mail, date_de_naissance, numero_de_telephone) VALUES("JURAIN", "Loic", "24 rue Albert Schweitzer, 66250 SAINT LAURENT DE LA SALANQUE", 2, '2017-02-14', "ljurain62@gmail.com", '1995-01-18', "0650290045");

-- 2nd Etage 17 --
INSERT INTO Locataire(nom, prenom, adresse_d_habitation, type_de_public, date_d_arrivee, adresse_mail, date_de_naissance, numero_de_telephone) VALUES("REMISSE", "Lyvia", "35 Cité C Chazeau, 97260 LE MORNE ROUGE MARTINIQUE", 3, '2018-09-14', "marielucekassandra@gmail.com", '1997-01-09', "0696079401");
INSERT INTO Locataire(nom, prenom, adresse_d_habitation, type_de_public, date_d_arrivee, adresse_mail, date_de_naissance, numero_de_telephone) VALUES("MUNUERA", "Angele", "Rue Alfred CHAUCHARD Domaine du CREISSEL, 11100 NARBONNE", 3, '2018-09-01', "sarllebrun38@gmail.com", '2000-01-19', "0771711031");
INSERT INTO Locataire(nom, prenom, adresse_d_habitation, type_de_public, date_d_arrivee, adresse_mail, date_de_naissance, numero_de_telephone) VALUES("MACKER", "Mathieu", "Quartier les Bréguières, 84220 Saint Pantaléon", 3, '2018-09-15', "mathieu.macker@imerir.com", '1997-04-03', "0638462521");
INSERT INTO Locataire(nom, prenom, adresse_d_habitation, type_de_public, date_d_arrivee, adresse_mail, date_de_naissance, numero_de_telephone) VALUES("GRANO", "Philippe", "19 Avenue Bernard IV, 31600 MURET", 3, '2019-01-02', "philippe.grano@hotmail.fr", '1985-04-05', "0686575892");
INSERT INTO Locataire(nom, prenom, adresse_d_habitation, type_de_public, date_d_arrivee, adresse_mail, date_de_naissance, numero_de_telephone) VALUES("MONNET", "Remi", "ErreurPasD Adresse", 3, '2016-10-17', NULL, '1900-01-01', "0613755941");
INSERT INTO Locataire(nom, prenom, adresse_d_habitation, type_de_public, date_d_arrivee, adresse_mail, date_de_naissance, numero_de_telephone) VALUES("DIAZ", "Remi", "11 Bd Joliot Currie, 11000 CARCASSONNE", 4, '2018-09-14', "remi.diaz@imerir.com", '1900-01-01', "0620008537");
INSERT INTO Locataire(nom, prenom, adresse_d_habitation, type_de_public, date_d_arrivee, adresse_mail, date_de_naissance, numero_de_telephone) VALUES("CINNA", "Jeremy", "ErreurPasD Adresse", 3, '2018-10-19', NULL, '1900-01-01', "0696848014");
INSERT INTO Locataire(nom, prenom, adresse_d_habitation, type_de_public, date_d_arrivee, adresse_mail, date_de_naissance, numero_de_telephone) VALUES("IKHLEF", "Anne Laure", "ErreurPasD Adresse", 1, '2018-09-01', NULL, '1900-01-01', "0769826685");
INSERT INTO Locataire(nom, prenom, adresse_d_habitation, type_de_public, date_d_arrivee, adresse_mail, date_de_naissance, numero_de_telephone) VALUES("GONZALEZ", "Hugo", "ErreurPasD Adresse", 4, '2016-11-02', NULL, '1900-01-01', "0752415997");
INSERT INTO Locataire(nom, prenom, adresse_d_habitation, type_de_public, date_d_arrivee, adresse_mail, date_de_naissance, numero_de_telephone) VALUES("PALA", "Eric", "ErreurPasD Adresse", 4, '2018/03/19', "elodiepetitjean67@gmail.com", '1900/01/01', "0622224168");
INSERT INTO Locataire(nom, prenom, adresse_d_habitation, type_de_public, date_d_arrivee, adresse_mail, date_de_naissance, numero_de_telephone) VALUES("CAMARA", "Issa", "ErreurPasD Adresse", 3, '2018/09/01', NULL, '1900/01/01', "0648957995");
INSERT INTO Locataire(nom, prenom, adresse_d_habitation, type_de_public, date_d_arrivee, adresse_mail, date_de_naissance, numero_de_telephone) VALUES("ANTON", "Lea", "9 Rue des Marronniers, 60420 LE FRESTOY VAUX", 3, '2018-07-01', "8lea.anton8@gmail.com", '1999-03-27', "0781252843");
INSERT INTO Locataire(nom, prenom, adresse_d_habitation, type_de_public, date_d_arrivee, adresse_mail, date_de_naissance, numero_de_telephone) VALUES("MUYEMBE", "Herman", "6 allée du Myosotis 95180 MENUCOURT", 3, '2018-09-01', "jdidierbongibo@yahoo.fr", '1999-01-07', "0000000000");
INSERT INTO Locataire(nom, prenom, adresse_d_habitation, type_de_public, date_d_arrivee, adresse_mail, date_de_naissance, numero_de_telephone) VALUES("DACHE", "Alexandre", "7, Avenue Marceau, 58170 LUZY", 3, '2016-08-20', "a.dache@orange.fr", '1996-05-06', "0629506991");
INSERT INTO Locataire(nom, prenom, adresse_d_habitation, type_de_public, date_d_arrivee, adresse_mail, date_de_naissance, numero_de_telephone) VALUES("CELLI", "Guillaume", "ErreurPasD Adresse", 4, '2019-01-25', NULL, '1900-01-01', "0629506991");
INSERT INTO Locataire(nom, prenom, adresse_d_habitation, type_de_public, date_d_arrivee, adresse_mail, date_de_naissance, numero_de_telephone) VALUES("FOURNAL", "Samantha", "1 Allée Frédéric Jacques Temple Bat. C1 34830 JACOU", 4, '2019-02-01', "samantha.fournal@orange.fr", '1900-01-01', "0000000000");

-- 3eme Etage 9--
INSERT INTO Locataire(nom, prenom, adresse_d_habitation, type_de_public, date_d_arrivee, adresse_mail, date_de_naissance, numero_de_telephone) VALUES("DRUET", "Louann", "ErreurPasD Adresse", 3, '2018-08-29', NULL, '1900-01-01', "0619937145");
INSERT INTO Locataire(nom, prenom, adresse_d_habitation, type_de_public, date_d_arrivee, adresse_mail, date_de_naissance, numero_de_telephone) VALUES("MARIE-LUCE", "Kassandra", "13 Allée du Poitou, 92220 BAGNEUX", 3, '2018-09-07', "marielucekassandra@gmail.com", '1998-10-30', "0767384833");
INSERT INTO Locataire(nom, prenom, adresse_d_habitation, type_de_public, date_d_arrivee, adresse_mail, date_de_naissance, numero_de_telephone) VALUES("LEVEQUE", "Marine", "Les chevaliers, 17130 Chamouillac", 3, '2016-08-31', "marine.ordie@yahoo.fr", '1998-02-27', "0643600770");
INSERT INTO Locataire(nom, prenom, adresse_d_habitation, type_de_public, date_d_arrivee, adresse_mail, date_de_naissance, numero_de_telephone) VALUES("SALZE", "Simon", "29 rue du Tourtourel 34430, SAINT JEAN DE VEDAS", 3, '2018-09-17', "simon.somethy@gmail.com", '1997-07-10', "0788362160");
INSERT INTO Locataire(nom, prenom, adresse_d_habitation, type_de_public, date_d_arrivee, adresse_mail, date_de_naissance, numero_de_telephone) VALUES("SOUMARE", "Rokhaya", "ErreurPasD'Adresse", 3, '2018-08-25', "rokhayasoum@hotmail.com", '1900-01-01', "0767044809");
INSERT INTO Locataire(nom, prenom, adresse_d_habitation, type_de_public, date_d_arrivee, adresse_mail, date_de_naissance, numero_de_telephone) VALUES("SOUALAH", "Asma", "13 rue Honoré de BALSAC 94800 VILLEJUIF", 3, '2018-07-17', "asmasoualah18@gmail.com", '1996-06-26', "0669014827");
INSERT INTO Locataire(nom, prenom, adresse_d_habitation, type_de_public, date_d_arrivee, adresse_mail, date_de_naissance, numero_de_telephone) VALUES("LOUISONNE", "Laurent", "Chelin en Belliard La Durand, 97212 Saint-Joseph", 3, '2016-08-29', "louisonne.laurent@gmail.com", '1995-06-05', "0000000000");
INSERT INTO Locataire(nom, prenom, adresse_d_habitation, type_de_public, date_d_arrivee, adresse_mail, date_de_naissance, numero_de_telephone) VALUES("CHARTON", "Laura", "41 Rue du Bourg, 86170 YVERSAY", 3, '2018-09-03', "lauracharton54@gmail.com", '2000-02-03', "0687228515");
INSERT INTO Locataire(nom, prenom, adresse_d_habitation, type_de_public, date_d_arrivee, adresse_mail, date_de_naissance, numero_de_telephone) VALUES("BONTEMPS", "Damien", "25, Rue Paul Eluard, 33600 PESSAC", 3, '2016-09-12', "dmbontemps@orange.fr", '1995-09-29', "0631705988");

-- INSERTION DES DIFFERENTS GARANTS DANS LA TABLE Garants --

INSERT INTO Garant(nom, prenom, date_de_naissance, adresse_d_habitation) VALUES("BLAIN", "Rosario", '1964-08-10', "14 Rue de la République");
INSERT INTO Garant(nom, prenom, date_de_naissance, adresse_d_habitation) VALUES("GAUYACQ", "Romain", '1994-06-23', "3 Rue de la Biatère, 64400 VERDETS");
INSERT INTO Garant(nom, prenom, date_de_naissance, adresse_d_habitation) VALUES("ANNICELLI", "Nadine", '1969-10-02', "Chemin du Fangas, 84400 SAIGNON");
INSERT INTO Garant(nom, prenom, date_de_naissance, adresse_d_habitation) VALUES("REMISSE", "Christophe", '1981-03-25', "35 Cité C Chazeau, 97260 LE MORNE ROUGE MARTINIQUE");
INSERT INTO Garant(nom, prenom, date_de_naissance, adresse_d_habitation) VALUES("LEBRUN", "Sandrine", '1977-11-22', "Rue Alfred CHAUCHARD Domaine du CREISSEL, 11100 NARBONNE");
INSERT INTO Garant(nom, prenom, date_de_naissance, adresse_d_habitation) VALUES("MACKER", "Patrick", '1963-04-30', "Quartier les Bréguieres, 84220 SAINT PANTALEON");
INSERT INTO Garant(nom, prenom, date_de_naissance, adresse_d_habitation) VALUES("KLEIN SAINT-JOURS", "Anne", '1951-04-24', "19 Avenue Bernard IV, 31600 MURET");
INSERT INTO Garant(nom, prenom, date_de_naissance, adresse_d_habitation) VALUES("ANTON", "Olivier", '1973-01-18', "9 Rue des Marronniers, 60420 LE FRESTOY VAUX");
INSERT INTO Garant(nom, prenom, date_de_naissance, adresse_d_habitation) VALUES("BONGIBO", "Diody", '1961-10-03', "6 allée du Myosotis, 95180 MENUCOURT");
INSERT INTO Garant(nom, prenom, date_de_naissance, adresse_d_habitation) VALUES("DACHE", "Stephane", '1969-03-18', "7, Avenue Marceau, 58170 LUZY");
INSERT INTO Garant(nom, prenom, date_de_naissance, adresse_d_habitation) VALUES("CRIQUET", "Péguy", '1981-03-01', "13 Allée du Poitou, 92220 BAGNEUX");
INSERT INTO Garant(nom, prenom, date_de_naissance, adresse_d_habitation) VALUES("LEVEQUE", "Frédéric", '1967-01-25', "Les chevaliers, 17130 Chamouillac");
INSERT INTO Garant(nom, prenom, date_de_naissance, adresse_d_habitation) VALUES("SALZE", "Béatrice", '1962-08-14', "29 rue de Tourtourel, 34430 SAINT JEAN DE VEDAS");
INSERT INTO Garant(nom, prenom, date_de_naissance, adresse_d_habitation) VALUES("OUARAB", "Lamine", '1985-06-11', "13 Rue Honoré de BALSAC, 94800 VILLEJUIF");
INSERT INTO Garant(nom, prenom, date_de_naissance, adresse_d_habitation) VALUES("LOUISONNE", "Marie-Désiré", '1964-06-13', "Chelin en Belliard La Durand, 97212 Saint-Joseph");
INSERT INTO Garant(nom, prenom, date_de_naissance, adresse_d_habitation) VALUES("CAZEAUX", "Patricia", '1971-01-07', "41 rue du Bourg 86170 YVERSAY");
INSERT INTO Garant(nom, prenom, date_de_naissance, adresse_d_habitation) VALUES("BOMTEMPS", "Serge", '1961-10-20', "25 Rue Paul Eluard, 33600 PESSAC");

-- INSERTION DES DIFFERENTS CONTRATS DANS LA TABLE Contrat --
-- Rez de Chaussée --
INSERT INTO Contrat(locataire, studio, garant, type_de_contrat, date_de_debut_du_contrat, date_de_fin_du_contrat, montant_du_loyer, encaissement_du_depot_de_garantie, chemin_d_accee) VALUES(1, 1, NULL, 2, '2019-01-01', '2019-03-31', 337.00, TRUE, '0'); -- id 1 : type de public: sociale--
INSERT INTO Contrat(locataire, studio, garant, type_de_contrat, date_de_debut_du_contrat, date_de_fin_du_contrat, montant_du_loyer, encaissement_du_depot_de_garantie, chemin_d_accee) VALUES(2, 2, NULL, 2, '2019-01-01', '2019-03-31', 378.00, FALSE, '0');-- id 2 : type de public: mlj--
INSERT INTO Contrat(locataire, studio, garant, type_de_contrat, date_de_debut_du_contrat, date_de_fin_du_contrat, montant_du_loyer, encaissement_du_depot_de_garantie, chemin_d_accee) VALUES(3, 3, NULL, 2, '2019-01-01', '2019-03-31', 337.00, TRUE, '0');-- id 3 : type de public: sociale--
INSERT INTO Contrat(locataire, studio, garant, type_de_contrat, date_de_debut_du_contrat, date_de_fin_du_contrat, montant_du_loyer, encaissement_du_depot_de_garantie, chemin_d_accee) VALUES(4, 4, NULL, 2, '2019-01-01', '2019-03-31', 337.00, TRUE, '0');-- id 4 : type de public: sociale--
INSERT INTO Contrat(locataire, studio, garant, type_de_contrat, date_de_debut_du_contrat, date_de_fin_du_contrat, montant_du_loyer, encaissement_du_depot_de_garantie, chemin_d_accee) VALUES(5, 5, NULL, 2, '2019-03-08', '2019-05-31', 337.00, TRUE, '0');-- id 5 : type de public: sociale--
INSERT INTO Contrat(locataire, studio, garant, type_de_contrat, date_de_debut_du_contrat, date_de_fin_du_contrat, montant_du_loyer, encaissement_du_depot_de_garantie, chemin_d_accee) VALUES(6, 6, NULL, 2, '2019-02-01', '2019-04-30', 337.00, TRUE, '0');-- id 6 : type de public: sociale--
INSERT INTO Contrat(locataire, studio, garant, type_de_contrat, date_de_debut_du_contrat, date_de_fin_du_contrat, montant_du_loyer, encaissement_du_depot_de_garantie, chemin_d_accee) VALUES(7, 7, NULL, 2, '2019-03-01', '2019-05-31', 337.00, TRUE, '0');-- id 7 : type de public: sociale--
INSERT INTO Contrat(locataire, studio, garant, type_de_contrat, date_de_debut_du_contrat, date_de_fin_du_contrat, montant_du_loyer, encaissement_du_depot_de_garantie, chemin_d_accee) VALUES(8, 8, 1, 2, '2018-11-02', '2021-10-31', 395.00, TRUE, '0');-- id 8 : type de public: etudiant--
INSERT INTO Contrat(locataire, studio, garant, type_de_contrat, date_de_debut_du_contrat, date_de_fin_du_contrat, montant_du_loyer, encaissement_du_depot_de_garantie, chemin_d_accee) VALUES(9, 9, NULL, 2, '2019-01-01', '2019-04-01', 337.00, TRUE, '0');-- id 9 : type de public: sociale--
INSERT INTO Contrat(locataire, studio, garant, type_de_contrat, date_de_debut_du_contrat, date_de_fin_du_contrat, montant_du_loyer, encaissement_du_depot_de_garantie, chemin_d_accee) VALUES(10, 10, NULL, 2, '2019-03-01', '2019-05-31', 347.00 , TRUE, '0');-- id 10 : type de public: sociale--
INSERT INTO Contrat(locataire, studio, garant, type_de_contrat, date_de_debut_du_contrat, date_de_fin_du_contrat, montant_du_loyer, encaissement_du_depot_de_garantie, chemin_d_accee) VALUES(11, 11, NULL, 1, '2019-03-01', '2019-05-31', 388.00 , FALSE, '0');-- id 11 : type de public: mlj--
INSERT INTO Contrat(locataire, studio, garant, type_de_contrat, date_de_debut_du_contrat, date_de_fin_du_contrat, montant_du_loyer, encaissement_du_depot_de_garantie, chemin_d_accee) VALUES(12, 12, NULL, 2, '2019-02-03', '2019-04-30', 337.00 , TRUE, '0');-- id 12 : type de public: sociale--
INSERT INTO Contrat(locataire, studio, garant, type_de_contrat, date_de_debut_du_contrat, date_de_fin_du_contrat, montant_du_loyer, encaissement_du_depot_de_garantie, chemin_d_accee) VALUES(13, 13, NULL, 3, '2017-09-08', '2020-08-31', 395.00 , TRUE, '0');-- id 13 : type de public: etudiant--
INSERT INTO Contrat(locataire, studio, garant, type_de_contrat, date_de_debut_du_contrat, date_de_fin_du_contrat, montant_du_loyer, encaissement_du_depot_de_garantie, chemin_d_accee) VALUES(14, 14, NULL, 2, '2019-03-01', '2019-05-31', 378.00 , FALSE, '0');-- id 14 : type de public: mlj--
INSERT INTO Contrat(locataire, studio, garant, type_de_contrat, date_de_debut_du_contrat, date_de_fin_du_contrat, montant_du_loyer, encaissement_du_depot_de_garantie, chemin_d_accee) VALUES(15, 17, NULL, 2, '2019-03-01', '2019-05-31', 337.00  , TRUE, '0');-- id 15 : type de public: sociale--
INSERT INTO Contrat(locataire, studio, garant, type_de_contrat, date_de_debut_du_contrat, date_de_fin_du_contrat, montant_du_loyer, encaissement_du_depot_de_garantie, chemin_d_accee) VALUES(16, 18, NULL, 2, '2019-04-01', '2019-06-30', 337.00  , TRUE, '0');-- id 16 : type de public: sociale--
INSERT INTO Contrat(locataire, studio, garant, type_de_contrat, date_de_debut_du_contrat, date_de_fin_du_contrat, montant_du_loyer, encaissement_du_depot_de_garantie, chemin_d_accee) VALUES(17, 19, NULL, 2, '2019-01-01', '2019-03-31', 337.00  , TRUE, '0');-- id 17 : type de public: sociale--
INSERT INTO Contrat(locataire, studio, garant, type_de_contrat, date_de_debut_du_contrat, date_de_fin_du_contrat, montant_du_loyer, encaissement_du_depot_de_garantie, chemin_d_accee) VALUES(18, 20, NULL, 2, '2019-04-01', '2019-06-30', 337.00  , TRUE, '0');-- id 18 : type de public: sociale--
INSERT INTO Contrat(locataire, studio, garant, type_de_contrat, date_de_debut_du_contrat, date_de_fin_du_contrat, montant_du_loyer, encaissement_du_depot_de_garantie, chemin_d_accee) VALUES(19, 21, NULL, 2, '2019-04-01', '2019-06-30', 337.00  , TRUE, '0');-- id 19 : type de public: sociale--
INSERT INTO Contrat(locataire, studio, garant, type_de_contrat, date_de_debut_du_contrat, date_de_fin_du_contrat, montant_du_loyer, encaissement_du_depot_de_garantie, chemin_d_accee) VALUES(20, 23, NULL, 2, '2019-01-01', '2019-03-31', 337.00  , TRUE, '0');-- id 20 : type de public: sociale--
INSERT INTO Contrat(locataire, studio, garant, type_de_contrat, date_de_debut_du_contrat, date_de_fin_du_contrat, montant_du_loyer, encaissement_du_depot_de_garantie, chemin_d_accee) VALUES(21, 24, NULL, 2, '2019-01-01', '2019-03-31', 337.00  , TRUE, '0');-- id 21 : type de public: sociale--

-- 1er Etage --
INSERT INTO Contrat(locataire, studio, garant, type_de_contrat, date_de_debut_du_contrat, date_de_fin_du_contrat, montant_du_loyer, encaissement_du_depot_de_garantie, chemin_d_accee) VALUES(22, 25, NULL, 2, '2019-01-01', '2019-03-31', 337.00  , TRUE, '0');-- id 22 : type de public: ZAMIRE sociale--
INSERT INTO Contrat(locataire, studio, garant, type_de_contrat, date_de_debut_du_contrat, date_de_fin_du_contrat, montant_du_loyer, encaissement_du_depot_de_garantie, chemin_d_accee) VALUES(23, 26, NULL, 1, '2019-04-11', '2030-01-01', 360.00  , TRUE, '0');-- id 23 : type de public: BAMBAautre--
INSERT INTO Contrat(locataire, studio, garant, type_de_contrat, date_de_debut_du_contrat, date_de_fin_du_contrat, montant_du_loyer, encaissement_du_depot_de_garantie, chemin_d_accee) VALUES(24, 27, NULL, 1, '2019-04-11', '2030-01-01', 360.00  , TRUE, '0');-- id 24 : type de public: DEVISSER autre--
INSERT INTO Contrat(locataire, studio, garant, type_de_contrat, date_de_debut_du_contrat, date_de_fin_du_contrat, montant_du_loyer, encaissement_du_depot_de_garantie, chemin_d_accee) VALUES(25, 28, NULL, 2, '2019-02-01', '2019-04-30', 360.00  , TRUE, '0');-- id 25 : type de public: JEAN JACQUESsociale--
INSERT INTO Contrat(locataire, studio, garant, type_de_contrat, date_de_debut_du_contrat, date_de_fin_du_contrat, montant_du_loyer, encaissement_du_depot_de_garantie, chemin_d_accee) VALUES(26, 29, NULL, 2, '2019-03-01', '2019-05-31', 378.00  , FALSE, '0');-- id 26 : type de public: mlj--
INSERT INTO Contrat(locataire, studio, garant, type_de_contrat, date_de_debut_du_contrat, date_de_fin_du_contrat, montant_du_loyer, encaissement_du_depot_de_garantie, chemin_d_accee) VALUES(27, 30, NULL, 1, '2019-04-11', '2030-01-01', 360.00  , TRUE, '0');-- id 27 : type de public: autre--
INSERT INTO Contrat(locataire, studio, garant, type_de_contrat, date_de_debut_du_contrat, date_de_fin_du_contrat, montant_du_loyer, encaissement_du_depot_de_garantie, chemin_d_accee) VALUES(28, 31, NULL, 2, '2019-03-01', '2019-05-31', 378.00  , FALSE, '0');-- id 28 : type de public: mlj--
INSERT INTO Contrat(locataire, studio, garant, type_de_contrat, date_de_debut_du_contrat, date_de_fin_du_contrat, montant_du_loyer, encaissement_du_depot_de_garantie, chemin_d_accee) VALUES(29, 32, NULL, 1, '2019-04-11', '2030-01-01', 360.00  , TRUE, '0');-- id 29 : type de public: autre--
INSERT INTO Contrat(locataire, studio, garant, type_de_contrat, date_de_debut_du_contrat, date_de_fin_du_contrat, montant_du_loyer, encaissement_du_depot_de_garantie, chemin_d_accee) VALUES(30, 33, NULL, 2, '2019-01-01', '2019-03-31', 337.00  , TRUE, '0');-- id 30 : type de public: sociale--
INSERT INTO Contrat(locataire, studio, garant, type_de_contrat, date_de_debut_du_contrat, date_de_fin_du_contrat, montant_du_loyer, encaissement_du_depot_de_garantie, chemin_d_accee) VALUES(31, 34, NULL, 2, '2019-02-01', '2019-04-30', 337.00  , TRUE, '0');-- id 31 : type de public: sociale--
INSERT INTO Contrat(locataire, studio, garant, type_de_contrat, date_de_debut_du_contrat, date_de_fin_du_contrat, montant_du_loyer, encaissement_du_depot_de_garantie, chemin_d_accee) VALUES(32, 35, NULL, 1, '2019-04-11', '2030-01-01', 360.00  , TRUE, '0');-- id 32 : type de public: autre--
INSERT INTO Contrat(locataire, studio, garant, type_de_contrat, date_de_debut_du_contrat, date_de_fin_du_contrat, montant_du_loyer, encaissement_du_depot_de_garantie, chemin_d_accee) VALUES(33, 36, NULL, 2, '2018-12-01', '2019-02-28', 337.00  , TRUE, '0');-- id 33 : type de public: sociale--
INSERT INTO Contrat(locataire, studio, garant, type_de_contrat, date_de_debut_du_contrat, date_de_fin_du_contrat, montant_du_loyer, encaissement_du_depot_de_garantie, chemin_d_accee) VALUES(34, 37, 2, 3, '2018-01-09', '2020-12-31', 395.00  , TRUE, '0');-- id 34 : type de public: etudiant--
INSERT INTO Contrat(locataire, studio, garant, type_de_contrat, date_de_debut_du_contrat, date_de_fin_du_contrat, montant_du_loyer, encaissement_du_depot_de_garantie, chemin_d_accee) VALUES(35, 38, 3, 3, '2018-09-13', '2021-08-31', 395.00  , TRUE, '0');-- id 35 : type de public: etudiant--
INSERT INTO Contrat(locataire, studio, garant, type_de_contrat, date_de_debut_du_contrat, date_de_fin_du_contrat, montant_du_loyer, encaissement_du_depot_de_garantie, chemin_d_accee) VALUES(36, 39, NULL, 2, '2019-02-27', '2019-04-30', 378.00  , FALSE, '0');-- id 36 : type de public: mlj--
INSERT INTO Contrat(locataire, studio, garant, type_de_contrat, date_de_debut_du_contrat, date_de_fin_du_contrat, montant_du_loyer, encaissement_du_depot_de_garantie, chemin_d_accee) VALUES(37, 40, NULL, 2, '2019-02-01', '2019-04-30', 337.00  , TRUE, '0');-- id 37 : type de public: sociale--
INSERT INTO Contrat(locataire, studio, garant, type_de_contrat, date_de_debut_du_contrat, date_de_fin_du_contrat, montant_du_loyer, encaissement_du_depot_de_garantie, chemin_d_accee) VALUES(38, 41, NULL, 2, '1900-01-01', '1900-01-01', 337.00  , TRUE, '0');-- id 38 : type de public: sociale--
INSERT INTO Contrat(locataire, studio, garant, type_de_contrat, date_de_debut_du_contrat, date_de_fin_du_contrat, montant_du_loyer, encaissement_du_depot_de_garantie, chemin_d_accee) VALUES(39, 42, NULL, 2, '2019-03-01', '2019-05-31', 337.00  , TRUE, '0');-- id 39 : type de public: sociale--
INSERT INTO Contrat(locataire, studio, garant, type_de_contrat, date_de_debut_du_contrat, date_de_fin_du_contrat, montant_du_loyer, encaissement_du_depot_de_garantie, chemin_d_accee) VALUES(40, 43, NULL, 2, '2019-01-01', '2019-03-31', 337.00  , TRUE, '0');-- id 40 : type de public: sociale--
INSERT INTO Contrat(locataire, studio, garant, type_de_contrat, date_de_debut_du_contrat, date_de_fin_du_contrat, montant_du_loyer, encaissement_du_depot_de_garantie, chemin_d_accee) VALUES(41, 44, NULL, 1, '2019-03-08', '2019-05-31', 337.00  , TRUE, '0');-- id 41 : type de public: sociale--
INSERT INTO Contrat(locataire, studio, garant, type_de_contrat, date_de_debut_du_contrat, date_de_fin_du_contrat, montant_du_loyer, encaissement_du_depot_de_garantie, chemin_d_accee) VALUES(42, 45, NULL, 2, '2019-02-01', '2019-04-30', 337.00  , TRUE, '0');-- id 42 : type de public: sociale--
INSERT INTO Contrat(locataire, studio, garant, type_de_contrat, date_de_debut_du_contrat, date_de_fin_du_contrat, montant_du_loyer, encaissement_du_depot_de_garantie, chemin_d_accee) VALUES(43, 46, NULL, 2, '2019-03-01', '2019-05-31', 337.00  , TRUE, '0');-- id 43 : type de public: sociale--
INSERT INTO Contrat(locataire, studio, garant, type_de_contrat, date_de_debut_du_contrat, date_de_fin_du_contrat, montant_du_loyer, encaissement_du_depot_de_garantie, chemin_d_accee) VALUES(44, 47, NULL, 2, '1900-01-01', '1900-01-01', 337.00  , TRUE, '0');-- id 44 : type de public: sociale--
INSERT INTO Contrat(locataire, studio, garant, type_de_contrat, date_de_debut_du_contrat, date_de_fin_du_contrat, montant_du_loyer, encaissement_du_depot_de_garantie, chemin_d_accee) VALUES(45, 48, NULL, 2, '2019-02-01', '2019-04-30', 337.00  , TRUE, '0');-- id 45 : type de public: sociale--
INSERT INTO Contrat(locataire, studio, garant, type_de_contrat, date_de_debut_du_contrat, date_de_fin_du_contrat, montant_du_loyer, encaissement_du_depot_de_garantie, chemin_d_accee) VALUES(46, 49, NULL, 2, '2019-03-01', '2019-05-31', 378.00  , FALSE, '0');-- id 46 : type de public: mlj--

-- 2nd Etage --
INSERT INTO Contrat(locataire, studio, garant, type_de_contrat, date_de_debut_du_contrat, date_de_fin_du_contrat, montant_du_loyer, encaissement_du_depot_de_garantie, chemin_d_accee) VALUES(47, 51, 4, 3, '2018-09-14', '2021-08-31', 395.00  , TRUE, '0');-- id 47 : type de public: etudiant--
INSERT INTO Contrat(locataire, studio, garant, type_de_contrat, date_de_debut_du_contrat, date_de_fin_du_contrat, montant_du_loyer, encaissement_du_depot_de_garantie, chemin_d_accee) VALUES(48, 52, 5, 3, '2018-09-01', '2021-08-31', 395.00  , TRUE, '0');-- id 48 : type de public: etudiant--
INSERT INTO Contrat(locataire, studio, garant, type_de_contrat, date_de_debut_du_contrat, date_de_fin_du_contrat, montant_du_loyer, encaissement_du_depot_de_garantie, chemin_d_accee) VALUES(49, 54, 6, 3, '2018-09-15', '2021-08-31', 395.00  , TRUE, '0');-- id 49 : type de public: etudiant--
INSERT INTO Contrat(locataire, studio, garant, type_de_contrat, date_de_debut_du_contrat, date_de_fin_du_contrat, montant_du_loyer, encaissement_du_depot_de_garantie, chemin_d_accee) VALUES(50, 55, 7, 3, '2019-01-02', '2021-12-31', 395.00  , TRUE, '0');-- id 50 : type de public: etudiant--
INSERT INTO Contrat(locataire, studio, garant, type_de_contrat, date_de_debut_du_contrat, date_de_fin_du_contrat, montant_du_loyer, encaissement_du_depot_de_garantie, chemin_d_accee) VALUES(51, 57, NULL, 3, '2016-10-17', '2019-09-30', 395.00  , TRUE, '0');-- id 51 : type de public: etudiant--
INSERT INTO Contrat(locataire, studio, garant, type_de_contrat, date_de_debut_du_contrat, date_de_fin_du_contrat, montant_du_loyer, encaissement_du_depot_de_garantie, chemin_d_accee) VALUES(52, 58, NULL, 1, '2019-05-06', '2019-07-31', 449.00  , FALSE, '0');-- id 52 : type de public: autre--
INSERT INTO Contrat(locataire, studio, garant, type_de_contrat, date_de_debut_du_contrat, date_de_fin_du_contrat, montant_du_loyer, encaissement_du_depot_de_garantie, chemin_d_accee) VALUES(53, 59, NULL, 3, '2018-10-19', '2021-09-30', 395.00  , TRUE, '0');-- id 53 : type de public: etudiant--
INSERT INTO Contrat(locataire, studio, garant, type_de_contrat, date_de_debut_du_contrat, date_de_fin_du_contrat, montant_du_loyer, encaissement_du_depot_de_garantie, chemin_d_accee) VALUES(54, 60, NULL, 2, '2019-03-01', '2019-05-31', 347.00  , TRUE, '0');-- id 54 : type de public: social--
INSERT INTO Contrat(locataire, studio, garant, type_de_contrat, date_de_debut_du_contrat, date_de_fin_du_contrat, montant_du_loyer, encaissement_du_depot_de_garantie, chemin_d_accee) VALUES(55, 61, NULL, 2, '2019-01-01', '2019-03-31', 459.00  , FALSE, '0');-- id 55 : type de public: autre--
INSERT INTO Contrat(locataire, studio, garant, type_de_contrat, date_de_debut_du_contrat, date_de_fin_du_contrat, montant_du_loyer, encaissement_du_depot_de_garantie, chemin_d_accee) VALUES(56, 63, NULL, 2, '2019-06-30', '2019-08-31', 449.00  , FALSE, '0');-- id 56 : type de public: autre--
INSERT INTO Contrat(locataire, studio, garant, type_de_contrat, date_de_debut_du_contrat, date_de_fin_du_contrat, montant_du_loyer, encaissement_du_depot_de_garantie, chemin_d_accee) VALUES(57, 64, NULL, 3, '2018-09-01', '2021-08-31', 395.00  , TRUE, '0');-- id 57 : type de public: etudiant--
INSERT INTO Contrat(locataire, studio, garant, type_de_contrat, date_de_debut_du_contrat, date_de_fin_du_contrat, montant_du_loyer, encaissement_du_depot_de_garantie, chemin_d_accee) VALUES(58, 65, 8, 3, '2018-05-17', '2021-04-30', 395.00  , TRUE, '0');-- id 58 : type de public: etudiant--
INSERT INTO Contrat(locataire, studio, garant, type_de_contrat, date_de_debut_du_contrat, date_de_fin_du_contrat, montant_du_loyer, encaissement_du_depot_de_garantie, chemin_d_accee) VALUES(59, 67, 9, 3, '2018-09-01', '2021-08-31', 395.00  , TRUE, '0');-- id 59 : type de public: etudiant--
INSERT INTO Contrat(locataire, studio, garant, type_de_contrat, date_de_debut_du_contrat, date_de_fin_du_contrat, montant_du_loyer, encaissement_du_depot_de_garantie, chemin_d_accee) VALUES(60, 72, 10, 3, '2016-08-20', '2019-07-31', 395.00  , TRUE, '0');-- id 60 : type de public: etudiant--
INSERT INTO Contrat(locataire, studio, garant, type_de_contrat, date_de_debut_du_contrat, date_de_fin_du_contrat, montant_du_loyer, encaissement_du_depot_de_garantie, chemin_d_accee) VALUES(61, 73, NULL, 2, '2019-01-25', '2019-03-31', 449.00  , FALSE, '0');-- id 61 : type de public: autre--
INSERT INTO Contrat(locataire, studio, garant, type_de_contrat, date_de_debut_du_contrat, date_de_fin_du_contrat, montant_du_loyer, encaissement_du_depot_de_garantie, chemin_d_accee) VALUES(62, 75, NULL, 1, '2019-02-01', '2019-04-30', 449.00  , FALSE, '0');-- id 62 : type de public: autre--

-- 3eme Etage --
INSERT INTO Contrat(locataire, studio, garant, type_de_contrat, date_de_debut_du_contrat, date_de_fin_du_contrat, montant_du_loyer, encaissement_du_depot_de_garantie, chemin_d_accee) VALUES(63, 78, NULL, 3, '2018-08-29', '2021-07-31', 395.00  , TRUE, '0');-- id 63 : type de public: etudiant--
INSERT INTO Contrat(locataire, studio, garant, type_de_contrat, date_de_debut_du_contrat, date_de_fin_du_contrat, montant_du_loyer, encaissement_du_depot_de_garantie, chemin_d_accee) VALUES(64, 79, 11, 3, '2018-09-07', '2021-08-31', 395.00  , TRUE, '0');-- id 64 : type de public: etudiant--
INSERT INTO Contrat(locataire, studio, garant, type_de_contrat, date_de_debut_du_contrat, date_de_fin_du_contrat, montant_du_loyer, encaissement_du_depot_de_garantie, chemin_d_accee) VALUES(65, 80, 12, 3, '2016-08-31', '2019-07-31', 395.00  , TRUE, '0');-- id 65 : type de public: etudiant--
INSERT INTO Contrat(locataire, studio, garant, type_de_contrat, date_de_debut_du_contrat, date_de_fin_du_contrat, montant_du_loyer, encaissement_du_depot_de_garantie, chemin_d_accee) VALUES(66, 81, 13, 3, '2018-09-17', '2021-08-31', 395.00  , TRUE, '0');-- id 66 : type de public: etudiant--
INSERT INTO Contrat(locataire, studio, garant, type_de_contrat, date_de_debut_du_contrat, date_de_fin_du_contrat, montant_du_loyer, encaissement_du_depot_de_garantie, chemin_d_accee) VALUES(67, 84, NULL, 3, '2018-08-25', '2021-07-31', 395.00  , TRUE, '0');-- id 67 : type de public: etudiant--
INSERT INTO Contrat(locataire, studio, garant, type_de_contrat, date_de_debut_du_contrat, date_de_fin_du_contrat, montant_du_loyer, encaissement_du_depot_de_garantie, chemin_d_accee) VALUES(68, 86, 14, 3, '2018-07-17', '2021-06-30', 395.00  , TRUE, '0');-- id 68 : type de public: etudiant--
INSERT INTO Contrat(locataire, studio, garant, type_de_contrat, date_de_debut_du_contrat, date_de_fin_du_contrat, montant_du_loyer, encaissement_du_depot_de_garantie, chemin_d_accee) VALUES(69, 88, 15, 3, '2016-08-29', '2019-07-31', 395.00  , TRUE, '0');-- id 69 : type de public: etudiant--
INSERT INTO Contrat(locataire, studio, garant, type_de_contrat, date_de_debut_du_contrat, date_de_fin_du_contrat, montant_du_loyer, encaissement_du_depot_de_garantie, chemin_d_accee) VALUES(70, 98, 16, 3, '2018-09-03', '2021-08-31', 395.00  , TRUE, '0');-- id 70 : type de public: etudiant--
INSERT INTO Contrat(locataire, studio, garant, type_de_contrat, date_de_debut_du_contrat, date_de_fin_du_contrat, montant_du_loyer, encaissement_du_depot_de_garantie, chemin_d_accee) VALUES(71, 100, 17,  3, '2016-09-12', '2019-08-31', 395.00  , TRUE, '0');-- id 71 : type de public: etudiant--














