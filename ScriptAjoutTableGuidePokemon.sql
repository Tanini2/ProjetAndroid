USE pokedex
GO

CREATE TABLE IF NOT EXISTS tblzoneattrape (
	noZone				int				NOT NULL	AUTO_INCREMENT,
	nom					varchar(100)	NOT NULL,
	PRIMARY KEY(noZone)
) ENGINE=INNODB;

CREATE TABLE IF NOT EXISTS tbltypeattrape (
	noType				int				NOT NULL	AUTO_INCREMENT,
	nom					varchar(100)	NOT NULL,
	PRIMARY KEY(noType)
) ENGINE=INNODB;

CREATE TABLE IF NOT EXISTS tbltypeendroit (
	noTypeEndroit		int				NOT NULL	AUTO_INCREMENT,
	nom					varchar(50)		NOT NULL,
	PRIMARY KEY(noTypeEndroit)
) ENGINE=INNODB;

CREATE TABLE IF NOT EXISTS tblregion (
	noRegion			int				NOT NULL	AUTO_INCREMENT,
	nomRegion			varchar(50)		NOT NULL,
	PRIMARY KEY(noRegion)
) ENGINE=INNODB;

CREATE TABLE IF NOT EXISTS tblregionjeu (
	noRegion			int				NOT NULL,
	noJeu				int				NOT NULL,
	PRIMARY KEY(noRegion, noJeu),
	FOREIGN KEY(noRegion) REFERENCES tblregion(noRegion),
	FOREIGN KEY(noJeu) REFERENCES tbljeu(noJeu)
) ENGINE=INNODB;

CREATE TABLE IF NOT EXISTS tblendroit (
	noEndroit			int				NOT NULL	AUTO_INCREMENT,
	nom					varchar(50)		NOT NULL,
	typeEndroit			int				NOT NULL,
	noRegion			int				NOT NULL,
	pokeMart			tinyint(1)		NOT NULL,
	pokeCenter			tinyint(1)		NOT NULL,
	PRIMARY KEY(noEndroit),
	FOREIGN KEY(typeEndroit) REFERENCES tbltypeendroit(noTypeEndroit),
	FOREIGN KEY(noRegion) REFERENCES tblregion(noRegion)
) ENGINE=INNODB;
	

CREATE TABLE IF NOT EXISTS tblgym (
	noGym				int				NOT NULL	AUTO_INCREMENT,
	nomGym				varchar(100)	NOT NULL,
	noEndroit			int				NOT NULL,
	badge				varchar(50)		NOT NULL,
	PRIMARY KEY(noGym),
	FOREIGN KEY(noEndroit) REFERENCES tblendroit(noEndroit)
) ENGINE=INNODB;

CREATE TABLE IF NOT EXISTS tblgymleader (
	noGymLeader			int				NOT NULL	AUTO_INCREMENT,
	nom					varchar(35)		NOT NULL,
	typePok				int				NOT NULL,
	noGym				int				NOT NULL,
	PRIMARY KEY(noGymLeader),
	FOREIGN KEY(typePok) REFERENCES tbltype(noType),
	FOREIGN KEY(noGym) REFERENCES tblgym(noGym)
) ENGINE=INNODB;

CREATE TABLE IF NOT EXISTS tbldescription (
	noDescription		int				NOT NULL	AUTO_INCREMENT,
	noEndroit			int				NOT NULL,
	description			text			DEFAULT 'None',
	PRIMARY KEY(noDescription),
	FOREIGN KEY(noEndroit) REFERENCES tblendroit(noEndroit)
) ENGINE=INNODB;

CREATE TABLE IF NOT EXISTS tblpokemonendroit (
	noEndroit			int				NOT NULL,
	noPokemon			int				NOT NULL,
	versions			varchar(50)		NOT NULL,
	zoneAttrape			int				NOT NULL,
	typeAttrape			int				NOT NULL,
	noGeneration		int				NOT NULL,
	pourcentageMatin	varchar(50)		NOT NULL,
	pourcentageJour		varchar(50)		NOT NULL,
	pourcentageNuit		varchar(50)		NOT NULL,
	PRIMARY KEY(noEndroit, noPokemon, versions, zoneAttrape),
	FOREIGN KEY(noEndroit) REFERENCES tblendroit(noEndroit),
	FOREIGN KEY(noPokemon) REFERENCES tblpokemon(noPokemon),
	FOREIGN KEY(zoneAttrape) REFERENCES tblzoneattrape(noZone)
) ENGINE=INNODB;

CREATE TABLE IF NOT EXISTS tblplaceinterest(
	noPlaceInterest		int				NOT NULL	AUTO_INCREMENT,
	nom					varchar(100)	NOT NULL,
	PRIMARY KEY (noPlaceInterest)
) ENGINE=INNODB;

CREATE TABLE IF NOT EXISTS tblendroitplaceinterest (
	noPlaceInterest		int				NOT NULL,
	noEndroit			int				NOT NULL,
	PRIMARY KEY(noPlaceOfInterest, noEndroit),
	FOREIGN KEY(noPlaceOfInterest) REFERENCES tblplaceinterest(noPlaceInterest),
	FOREIGN KEY(noEndroit) REFERENCES tblendroit(noEndroit)
) ENGINE=INNODB;

CREATE TABLE IF NOT EXISTS tblconnect (
	noEndroit			int				NOT NULL,
	noConnect			int				NOT NULL,
	description			text			DEFAULT 'None',
	PRIMARY KEY(noEndroit, noConnect),
	FOREIGN KEY(noEndroit) REFERENCES tblendroit(noEndroit),
	FOREIGN KEY(noConnect) REFERENCES tblendroit(noEndroit)
) ENGINE=INNODB;

CREATE TABLE IF NOT EXISTS tblitem (
	noItem				int				NOT NULL	AUTO_INCREMENT,
	nom					varchar(75)		NOT NULL,
	description			text			NOT NULL,
	PRIMARY KEY(noItem)
) ENGINE = INNODB;

CREATE TABLE IF NOT EXISTS tblzonetrouve (
	noZone				int				NOT NULL	AUTO_INCREMENT,
	nom					varchar(100)	NOT NULL,
	PRIMARY KEY(noZone)
) ENGINE = INNODB;

CREATE TABLE IF NOT EXISTS tblitemendroit (
	noEndroit			int				NOT NULL,
	noItem				int				NOT NULL,
	versions			varchar(50)		NOT NULL,
	zoneTrouve			int				NOT NULL,
	location			text			NOT NULL,
	nomSpecifique		varchar(75),
	quantite			varchar(25)		DEFAULT 1,
	PRIMARY KEY(noEndroit, noItem, versions, zoneTrouve),
	FOREIGN KEY(noEndroit) REFERENCES tblendroit(noEndroit),
	FOREIGN KEY(noItem) REFERENCES tblitem(noItem),
	FOREIGN KEY(zoneTrouve) REFERENCES tblzonetrouve(noZone)
) ENGINE=INNODB;