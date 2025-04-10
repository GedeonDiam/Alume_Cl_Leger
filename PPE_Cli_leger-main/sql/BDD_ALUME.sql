-- Active: 1684419091484@@127.0.0.1@3306@alume
drop database if exists ALUME;
create database ALUME;
use ALUME;
drop table if exists client;
CREATE TABLE client (
    idclient INT(5) NOT NULL AUTO_INCREMENT, 
    nom VARCHAR(50), 
    ville VARCHAR(100),
    codepostal CHAR(5),
    rue VARCHAR(50),
    numrue INT(3), 
    email VARCHAR(50) UNIQUE, 
	role VARCHAR(20) DEFAULT 'client',
    tel VARCHAR(20), 
    mdp VARCHAR(255) NOT NULL, 
    CONSTRAINT pk_cli PRIMARY KEY (idclient)
);

 
create table devis (
	iddevis int(5) not null AUTO_INCREMENT,
	datedevis date,
	etatdevis enum("acceptee", "annulee"),
	idclient int(5) not null,
	constraint pk_devis primary key (iddevis),
	constraint fk_cli foreign key (idclient) references client(idclient)
);

create table commande(
	idcommande int(10) not null AUTO_INCREMENT,
	etatcom enum("en attente", "annulee", "livree", "en preparation", "confirmee"),
	codedevis int(5) not null,
	constraint pk_com primary key (idcommande),
	constraint fk_com foreign key (codedevis) references devis(codedevis)
);

create table cat_produit(
	codecat int(4) not null,
	nomcat varchar(50),
	constraint pk_cat primary key (codecat)
);
drop table produit;
create table produit(
	idproduit int(6) not null AUTO_INCREMENT,
	nomproduit varchar(50),
	prix_unit decimal(8,2),
	categorie varchar(50),
	image varchar(255) DEFAULT 'default_product.jpg',
	description text,
	constraint pk_produit primary key (idproduit)
);

create table ligne_com(
	idproduit int(6) not null,
	codecom int(10) not null,
	quantite int default 0,
	constraint pk_lcom primary key (idproduit, codecom),
	constraint fk_prod foreign key (idproduit) references produit (idproduit),
	constraint fk_lcomm foreign key (codecom) references commande (codecom)
);
drop table if exists technicien;

create table technicien(
	idtechnicien int(5) not null auto_increment,
	nom varchar(50), 
	prenom varchar(50), 
	specialite enum ("Services", "Ateliers", "Autres"), 
	email varchar(50) unique, 
	mdp varchar (50),
	role VARCHAR(20) DEFAULT 'technicien',
	constraint pk_tech primary key (idtechnicien)
);

create table intervention(
	idtechnicien int(5) not null,
	codecom int(10) not null, 
	datehd datetime not null, 
	datehf datetime ,
	etat enum("en attente", "terminee", "annulee"),
	constraint pk_inter primary key (idtechnicien, codecom,datehd),
	constraint fk_tech foreign key (idtechnicien) references technicien(idtechnicien),
	constraint fk_com_inter foreign key (codecom) references commande(codecom)
);
drop table if exists administrateur;
create table administrateur(
    idadmin int(5) not null auto_increment,
    nom varchar(50),
    prenom varchar(50),
    email varchar(50) unique,
    mdp varchar(255),
	role enum("admin", "superadmin"),
    constraint pk_admin primary key (idadmin)
);

-- Table pour stocker les paniers des clients
create table panier (
    idpanier int(10) not null AUTO_INCREMENT,
    idclient int(5) not null,
    dateCreation datetime DEFAULT CURRENT_TIMESTAMP,
    statut enum('actif', 'validé', 'abandonné') DEFAULT 'actif',
    constraint pk_panier primary key (idpanier),
    constraint fk_panier_client foreign key (idclient) references client(idclient)
);

-- Table pour stocker les produits dans un panier
create table panier_produit (
    idpanier int(10) not null,
    idproduit int(6) not null,
    quantite int(5) not null DEFAULT 1,
    prixUnitaire decimal(8,2) not null,
    constraint pk_panier_produit primary key (idpanier, idproduit),
    constraint fk_panier_produit_panier foreign key (idpanier) references panier(idpanier) ON DELETE CASCADE,
    constraint fk_panier_produit_produit foreign key (idproduit) references produit(idproduit)
);

-- Insertion des catégories de produits
INSERT INTO cat_produit VALUES 
(1, 'Électricité'),
(2, 'Plomberie'),
(3, 'Outillage'),
(4, 'Quincaillerie'),
(5, 'Chauffage'),
(6, 'Éclairage');

-- Insertion des produits avec leurs catégories
INSERT INTO produit (nomproduit, prix_unit, categorie, description) VALUES 
('Disjoncteur différentiel', 39.99, 'Électricité', 'Disjoncteur différentiel pour tableau électrique'),
('Ampoule LED E27', 6.99, 'Éclairage', 'Ampoule LED basse consommation, culot E27'),
('Ensemble douche', 129.99, 'Plomberie', 'Ensemble complet pour douche avec colonne'),
('Perceuse visseuse', 89.99, 'Outillage', 'Perceuse visseuse 18V avec 2 batteries'),
('Radiateur électrique', 199.99, 'Chauffage', 'Radiateur électrique programmable 1500W'),
('Serrure 3 points', 79.99, 'Quincaillerie', 'Serrure haute sécurité 3 points A2P*'),
('Tube PER 16mm', 2.49, 'Plomberie', 'Tube PER pour eau froide et chaude'),
('Interrupteur va-et-vient', 8.99, 'Électricité', 'Interrupteur va-et-vient avec plaque'),
('Lustre 5 branches', 149.99, 'Éclairage', 'Lustre moderne 5 branches avec ampoules'),
('Ponceuse orbitale', 59.99, 'Outillage', 'Ponceuse orbitale 300W avec bac à poussière'),
('Robinet mitigeur cuisine', 69.99, 'Plomberie', 'Mitigeur pour évier de cuisine, finition chromée'),
('Thermostat connecté', 129.99, 'Chauffage', 'Thermostat intelligent contrôlable par smartphone');

-- Existantes
insert into technicien values (null, "Gedeon", "Allan","Ateliers", "a@gmail.com", "123");

-- Ajout d'un administrateur par défaut
INSERT INTO administrateur VALUES (null, 'Admin', 'System', 'admin@alume.fr', '123', 'admin');
