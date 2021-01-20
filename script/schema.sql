CREATE TABLE Menu(
    id int auto_increment primary key,
    Date date not null
);

CREATE TABLE Categorie(
    id int auto_increment primary key,
    nom varchar(20)
);

CREATE TABLE Plat(
    id int auto_increment primary key,
    intitule varchar(20),
    code char(4),
    prix decimal(10,2),
    idCategorie int not null,
    foreign key(idCategorie) references Categorie(id)
);

CREATE TABLE MenuPlat(
    idMenu int not null,
    idPlat int not null,
    primary key (idMenu, idPlat),
    foreign key(idMenu) references Menu(id),
    foreign key(idPlat) references Plat(id)
);

INSERT INTO Categorie(nom) values("Riz");
INSERT INTO Categorie(nom) values("Pate");
INSERT INTO Categorie(nom) values("Boisson");

INSERT INTO Menu(Date) values("2021-01-07");
INSERT INTO Menu(Date) values("2021-01-08");
INSERT INTO Menu(Date) values("2021-01-09");

INSERT INTO Plat(intitule,prix,code,idCategorie) values("Henakisoa", 4500, "1001", 1);
INSERT INTO Plat(intitule,prix,code,idCategorie) values("Poulet sauce", 5000, "1002", 1);
INSERT INTO Plat(intitule,prix,code,idCategorie) values("Soupe de crabe", 10000, "2001", 2);
INSERT INTO Plat(intitule,prix,code,idCategorie) values("Mine-sao", 6000, "2002", 2);
INSERT INTO Plat(intitule,prix,code,idCategorie) values("Jus naturel", 1000, "3001", 3);
INSERT INTO Plat(intitule,prix,code,idCategorie) values("Milk shake", 5000, "3002", 3);

INSERT INTO MenuPlat VALUES(1,1);
INSERT INTO MenuPlat VALUES(1,3);
INSERT INTO MenuPlat VALUES(1,6);
INSERT INTO MenuPlat VALUES(2,1);
INSERT INTO MenuPlat VALUES(2,2);
INSERT INTO MenuPlat VALUES(2,4);
INSERT INTO MenuPlat VALUES(3,5);
INSERT INTO MenuPlat VALUES(3,6);
INSERT INTO MenuPlat VALUES(3,2);


CREATE TABLE Etudiant(
    id int auto_increment primary key,
    numEtu varchar(10) unique,
    pwd varchar(50),
    nom varchar(50),
    naissance date,
    token varchar(50)
);

insert into Etudiant(numEtu, pwd, nom, naissance, token) values("ETU000917",sha1("123456"),"RAKOTONAIVO Rado","2001-04-23", sha1("ETU000914"));

CREATE TABLE Connexion(
    token varchar(50)
);

CREATE TABLE Commande(
    id int auto_increment primary key,
    idEtudiant int not null,
    idPlat int not null,
    idMenu int not null,
    foreign key(idEtudiant) references Etudiant(id),
    foreign key(idMenu, idPlat) references MenuPlat(idMenu,idPlat),
    quantite int unsigned not null
);

insert into Commande(idEtudiant,idPlat,idMenu,quantite) values(1,3,1,2);
insert into Commande(idEtudiant,idPlat,idMenu,quantite) values(1,1,1,1);
Create table Favoris(
	idEtudiant int not null,
	idPlat int not null,
	primary key (idEtudiant,idPlat),
	foreign key (idEtudiant) references Etudiant (id),
	foreign key (idPlat) references Plat (id)
);
insert into Favoris(idEtudiant,idPlat) values(1,2);