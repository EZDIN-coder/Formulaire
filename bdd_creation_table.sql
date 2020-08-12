CREATE TABLE utilisateurs (
    id int NOT NULL AUTO_INCREMENT,
    nom varchar(255) NOT NULL,
    prenom varchar(255),
    ladate date,
    lieu varchar(255),
    adressepostale varchar(255),
    email varchar(255),
    site varchar(255),
    telephone int(25),
    semestre varchar(255),
    PRIMARY KEY (id)
);

CREATE TABLE connaissance (
    id int NOT NULL AUTO_INCREMENT,
    nom varchar(255) NOT NULL,
    PRIMARY KEY (id)
);

CREATE TABLE connaissance_utilisateurs (
    id int NOT NULL AUTO_INCREMENT,
	id_utilisateur int,
	connaisance_id int,
    FOREIGN KEY (id_utilisateur) REFERENCES utilisateurs(id),
	FOREIGN KEY (connaisance_id) REFERENCES connaissance(id),
    PRIMARY KEY (id)
);