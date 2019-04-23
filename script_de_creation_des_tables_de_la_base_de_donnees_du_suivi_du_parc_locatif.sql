-- CREATION DE L'UTTILISATEUR residence_locative --
CREATE USER 'residence_locative'@'localhost' IDENTIFIED BY 'mot_de_passe_de_l_uttilisateur_residence_locative';

-- ACCORD DE TOUS LES PRIVILEGES A L'UTTILISATEUR residence_locative SUR LA TABLE gestion_de_parc_locatif --
GRANT ALL PRIVILEGES ON gestion_de_parc_locatif.* TO 'residence_locative'@'localhost';

-- CREATION DE TOUTES LES TABLES NECESSAIRES DANS LE MODELE --

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

-- TABLE Preavis --
CREATE TABLE IF NOT EXISTS Preavis(
    id INTEGER NOT NULL AUTO_INCREMENT,
    date_du_jour DATE NOT NULL,
    chemin_d_accee VARCHAR(100) NOT NULL,
    contrat INTEGER  NOT NULL,
    FOREIGN KEY (contrat) REFERENCES Contrat(id),
    PRIMARY KEY(id)
);

-- TABLE Expiration_de_contrat_de_location --
CREATE TABLE IF NOT EXISTS Expiration_de_contrat_de_location (
    id INTEGER NOT NULL AUTO_INCREMENT,
    date_du_jour DATE NOT NULL,
    chemin_d_accee VARCHAR(100) NOT NULL,
    contrat INTEGER  NOT NULL,
    FOREIGN KEY (contrat) REFERENCES Contrat(id),
    PRIMARY KEY(id)
);

-- TABLE Relance_loyer_impaye --
CREATE TABLE IF NOT EXISTS Relance_loyer_impaye (
    id INTEGER NOT NULL AUTO_INCREMENT,
    date_du_jour DATE NOT NULL,
    chemin_d_accee VARCHAR(100) NOT NULL,
    montant_du INTEGER NOT NULL,
    contrat INTEGER  NOT NULL,
    FOREIGN KEY (contrat) REFERENCES Contrat(id),
    PRIMARY KEY(id)
);

-- TABLE Etat_des_lieux --
CREATE TABLE IF NOT EXISTS Etat_des_lieux(
    id INTEGER NOT NULL AUTO_INCREMENT,
    date_du_jour DATE NOT NULL,
    date_et_heure_programmees DATETIME NOT NULL,
    chemin_d_accee VARCHAR(100) NOT NULL,
    contrat INTEGER  NOT NULL,
    FOREIGN KEY (contrat) REFERENCES Contrat(id),
    PRIMARY KEY(id)
);

-- INSERTION DES UTTILISATEURS ET DE LEURS MOTS DE PASSE RESPECTIFS DANS LA TABLE Table_de_connexion_a_la_base_de_gestion_de_parc_locatif --
INSERT INTO Table_de_connexion_a_la_base_de_gestion_de_parc_locatif(username, password, nom, prenom, date_et_heure_de_derniere_connexion, est_connecte, adresse_mail) VALUES('elaravel', SHA1('123'), 'Laravel', 'Eric', NOW(), FALSE, 'elaravel@nom_de_domaine.com');
INSERT INTO Table_de_connexion_a_la_base_de_gestion_de_parc_locatif(username, password, nom, prenom, date_et_heure_de_derniere_connexion, est_connecte, adresse_mail) VALUES('msymfony', SHA1('abc'), 'Symfony', 'Marie', NOW(), FALSE, 'msymfony@nom_de_domaine.com');

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