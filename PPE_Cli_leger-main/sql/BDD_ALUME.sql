drop database if exists ALUME;
create database ALUME;
use ALUME;

CREATE TABLE client (
    idclient INT(5) NOT NULL AUTO_INCREMENT, 
    nom VARCHAR(50), 
    ville VARCHAR(100),
    codepostal CHAR(5),
    rue VARCHAR(50),
    numrue INT(3), 
    email VARCHAR(50) UNIQUE, 
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
	nomcat varchar(20),
	constraint pk_cat primary key (codecat)
);

create table produit(
	idproduit int(6) not null AUTO_INCREMENT,
	nomproduit varchar(50),
	prix_unit decimal(8,2),
	categorie varchar(50),
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

create table technicien(
	idtechnicien int(5) not null auto_increment,
	nom varchar(50), 
	prenom varchar(50), 
	specialite enum ("Services", "Ateliers", "Autres"), 
	email varchar(50) unique, 
	mdp varchar (50),
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

create table administrateur(
    idadmin int(5) not null auto_increment,
    nom varchar(50),
    prenom varchar(50),
    email varchar(50) unique,
    mdp varchar(255),
    constraint pk_admin primary key (idadmin)
);

insert into technicien values (null, "Gedeon", "Allan","Ateliers", "a@gmail.com", "123"); 
