create table Users (
	id int NOT NULL AUTO_INCREMENT,
    username varchar (100) NOT NULL,
	email varchar(100) NOT NULL,
	password varchar(100) NOT NULL,
	PRIMARY KEY (ID)
	);


create table Posts (
	id int NOT NULL AUTO_INCREMENT,
    userID int NOT NULL,
	title varchar(100) NOT NULL,
	postText TEXT NOT NULL,
	postImg varchar(100),
	postDate TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
	editDate TIMESTAMP,
	PRIMARY KEY (postID),
	FOREIGN KEY (userID) REFERENCES Users(ID)
	);