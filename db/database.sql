
CREATE TYPE CONDITION AS ENUM
	('1','2','3','4','5');
CREATE TYPE RECORD_TYPE AS ENUM
	('Add','Remove','Lend','Return','Maintenance','Repaired');
CREATE TYPE USER_TYPE AS ENUM
	('Client','InventoryManager', 'SystemManager');

	
CREATE TABLE User(
	id			INTEGER 	NOT NULL,
	username 	TEXT 		UNIQUE	NOT NULL,
	email 		TEXT 		UNIQUE 	NOT NULL,
	password 	TEXT 		NOT NULL,
	type 		USER_TYPE 	NOT NULL,

	PRIMARY KEY (id),
	CHECK (LEN(password) >6)
);

CREATE TABLE UserBlocked(
	id 		INTEGER 	NOT NULL,
	date 	TIMESTAMP 	NOT NULL DEFAULT NOW,
	note 	TEXT,

	PRIMARY KEY (id),
	FOREIGN KEY (id) 	REFERENCES User(id)
);

CREATE TABLE Client(
	id INTEGER 			NOT NULL,
	idCard INTEGER 		UNIQUE NOT NULL,
	address TEXT 		NOT NULL,
	phoneNumber TEXT 	NOT NULL,
	picture 	TEXT,
	
	PRIMARY KEY (id),
	FOREIGN KEY (id) 	REFERENCES User(id),
	CHECK (LEN(phoneNumber) = 9)
);

CREATE TABLE Category(
	id 	INTEGER NOT NULL,
	name 	TEXT 	NOT NULL,
	
	PRIMARY KEY (id)
);

CREATE TABLE SubCategory(
	id 			INTEGER 		NOT NULL,
	name 		TEXT			NOT NULL,
	idCategory	INTEGER 		NOT NULL,
	
	PRIMARY KEY (id),
	FOREIGN KEY (idCategory) 	REFERENCES Category(id),
	UNIQUE (name, idCategory)
);

CREATE TABLE Item(
	id 	INTEGER 				NOT NULL,
	name 	TEXT 				NOT NULL,
	idSubCategory INTEGER		NOT NULL,
	description TEXT 			NOT NULL,
	picture 	TEXT,
	
	PRIMARY KEY (id),
	FOREIGN KEY (idSubCategory)	REFERENCES SubCategory(id),
	CHECK (LEN(description) > 20)
);

CREATE TABLE ItemInstance(
	id 	INTEGER 			NOT NULL,
	idItem INTEGER			NOT NULL,
	condition 	CONDITION 	NOT NULL,
	
	PRIMARY KEY (id),
	FOREIGN KEY (idItem)	REFERENCES Item(id)
);

CREATE TABLE Reservation(
	id 				INTEGER 	NOT NULL,
	start 			TIMESTAMP 	NOT NULL,
	end 			TIMESTAMP 	NOT NULL,
	idClient		INTEGER 	NOT NULL,
	idItemInstance 	INTEGER		NOT NULL,
	fulfilled 		BOOLEAN 	DEFAULT FALSE,
	
	PRIMARY KEY (id),
	FOREIGN KEY (idClient)	REFERENCES Client(id),
	FOREIGN KEY (idItem)	REFERENCES ItemInstance(id),
	CHECK(end > start)
);

CREATE TABLE ItemHistoryRecord(
	id 					INTEGER 	NOT NULL,
	date 				TIMESTAMP 	NOT NULL DEFAULT NOW,
	idItem 				INTEGER		NOT NULL,
	idInventoryManager 	INTEGER		NOT NULL,
	type 				RECORD_TYPE	NOT NULL,	
	
	PRIMARY KEY (id),
	FOREIGN KEY (idItem)				REFERENCES ItemInstance(id),
	FOREIGN KEY (idInventoryManager)	REFERENCES InventoryManager(id)
);

CREATE TABLE LendRecord(
	id 	INTEGER 			NOT NULL,
	idClient	INTEGER 	NOT NULL,
	
	PRIMARY KEY (id),
	FOREIGN KEY (id)		REFERENCES ItemHistoryRecord(id),
	FOREIGN KEY (idClient)	REFERENCES Client(id)
);

CREATE TABLE ReturnRecord(
	id 	INTEGER 			NOT NULL,
	idClient 	INTEGER		NOT NULL,
	
	PRIMARY KEY (id),
	FOREIGN KEY (id)		REFERENCES ItemHistoryRecord(id),
	FOREIGN KEY (idClient)	REFERENCES Client(id)
);

CREATE TABLE Maintenance(
	id 	INTEGER 		NOT NULL,
	repairer	TEXT	NOT NULL,
	expectedEnd DATE 	NOT NULL,
	
	PRIMARY KEY (id),
	FOREIGN KEY (id)	REFERENCES ItemHistoryRecord(id),
);