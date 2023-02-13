create database telefoot;

create table users (
	id smallint primary key auto_increment,
	firstname varchar(50),
	lastname varchar(50),
	email varchar (100) not null,
	password varchar(255) not null
);

-- reset password table

create table password_reset (
	id smallint primary key auto_increment,
	email varchar (100) not null,
	token varchar(100) not null
);

insert into chaines (image, tv) values
("telefootstadium1.webp", "chaine"),
("telefootstadium2.webp", "chaine"),
("telefootstadium3.webp", "chaine"),
("telefootstadium4.webp", "chaine"),
("telefootstadium5.webp", "chaine"),
("telefootstadium6.webp", "chaine");

insert into chaines (image, tv) values
("matchs-champions-league.webp", "replay"),
("matchs-europa-league.webp", "replay"),
("matchs-ligue-1.webp", "replay"),
("matchs-ligue-2.webp", "replay");

insert into clubs (image, ligue) values
("ajaccio.png", 2),
("amiens.png", 2),
("angers.png", 2),
("asse.png", 2),
("auxerre.png", 2),
("bordeaux.png", 2),
("brest.png", 2),
("caen.png", 2),
("chambly.png", 2),
("chateauroux.png", 2),
("clermont.png", 2),
("dijon.png", 2),
("dunkerque.png", 2),
("grenoble.png", 2),
("guinguamp.png", 2),
("havre.png", 1),
("lens.png", 1),
("lorient.png", 1),
("losc.png", 1),
("metz.png", 1),
("monaco.png", 1),
("montpellier.png", 1),
("nancy.png", 1),
("nantes.png", 1),
("nice.png", 1),
("nimes.png", 1),
("niort.png", 1),
("ol.png", 1),
("om.png", 1),
("paris.png", 1);

