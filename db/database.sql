
CREATE TYPE CONDITION AS ENUM
	('1','2','3','4','5');
	
CREATE TABLE User(
	id	INTEGER 		NOT NULL,
	username 	TEXT 	UNIQUE	NOT NULL,
	email 	TEXT 		UNIQUE 	NOT NULL,
	password 	TEXT 	NOT NULL,
	blocked BOOLEAN		DEFAULT FALSE,

	PRIMARY KEY (id)
	--TODO ADD CONSTRAINTS
);

CREATE TABLE Client(
	id INTEGER 			NOT NULL,
	idCard INTEGER 		UNIQUE NOT NULL,
	address TEXT 		NOT NULL,
	phoneNumber TEXT 	NOT NULL,
	picture 	TEXT,
	
	PRIMARY KEY (id),
	FOREIGN KEY (id) 	REFERENCES User(id)
);

CREATE TABLE InventoryManager(
	id 	INTEGER 		NOT NULL,
	
	PRIMARY KEY (id),
	FOREIGN KEY (id) 	REFERENCES User(id)	
);

CREATE TABLE SystemManager(
	id 	INTEGER NOT NULL,
	
	PRIMARY KEY (id),
	FOREIGN KEY (id) 	REFERENCES User(id)	
);


CREATE TABLE Category(
	id 	INTEGER NOT NULL,
	name 	TEXT 	NOT NULL,
	
	PRIMARY KEY (id)
);

CREATE TABLE SubCategory(
	id 	INTEGER 				NOT NULL,
	name 	TEXT 				NOT NULL,
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
	FOREIGN KEY (idSubCategory)	REFERENCES SubCategory(id)
);

CREATE TABLE ItemInstance(
	id 	INTEGER 			NOT NULL,
	idItem INTEGER			NOT NULL,
	condition 	CONDITION 	NOT NULL,
	
	PRIMARY KEY (id),
	FOREIGN KEY (idItem)	REFERENCES Item(id)
);

CREATE TABLE Reservation(
	id 	INTEGER 			NOT NULL,
	start 	DATE 			NOT NULL,
	end 	DATE 			NOT NULL,
	idClient	INTEGER 	NOT NULL,
	idItemInstance 	INTEGER	NOT NULL,
	fulfilled 	BOOLEAN 	DEFAULT FALSE,
	
	PRIMARY KEY (id),
	FOREIGN KEY (idClient)	REFERENCES Client(id),
	FOREIGN KEY (idItem)	REFERENCES ItemInstance(id)
);

CREATE TABLE ItemHistoryRecord(
	id 	INTEGER 				NOT NULL,
	date 	DATE 				NOT NULL,
	idClient	INTEGER 		NOT NULL,
	idItem 	INTEGER				NOT NULL,
	idInventoryManager 	INTEGER	NOT NULL,
	
	PRIMARY KEY (id),
	FOREIGN KEY (idClient)				REFERENCES Client(id),
	FOREIGN KEY (idItem)				REFERENCES ItemInstance(id),
	FOREIGN KEY (idInventoryManager)	REFERENCES InventoryManager(id)
);

CREATE TABLE AddRecord(
	id 	INTEGER 		NOT NULL,
	
	PRIMARY KEY (id),
	FOREIGN KEY (id)	REFERENCES ItemHistoryRecord(id),
);

CREATE TABLE RemoveRecord(
	id 	INTEGER 		NOT NULL,
	
	PRIMARY KEY (id),
	FOREIGN KEY (id)	REFERENCES ItemHistoryRecord(id),
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
	
	PRIMARY KEY (id),
	FOREIGN KEY (id)	REFERENCES ItemHistoryRecord(id),
);

CREATE TABLE Repaired(
	id 	INTEGER 		NOT NULL,
	
	PRIMARY KEY (id),
	FOREIGN KEY (id)	REFERENCES ItemHistoryRecord(id),
);



