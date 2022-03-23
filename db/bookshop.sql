CREATE TABLE books (
	id int(11) NOT NULL AUTO_INCREMENT,
	categoryId int(11) NOT NULL,
	title varchar(255) NOT NULL,
	author varchar(255) NOT NULL,
	isbn varchar(255) NOT NULL,
	price decimal(10,2) NOT NULL,
	PRIMARY KEY (id),
	KEY categoryId (categoryId)
) ENGINE=InnoDB AUTO_INCREMENT=1 CHARSET=utf8;;

CREATE TABLE categories (
	id int(11) NOT NULL AUTO_INCREMENT,
	name varchar(255) NOT NULL,
	PRIMARY KEY (id)
) ENGINE=InnoDB AUTO_INCREMENT=1 CHARSET=utf8;;

CREATE TABLE orderedbooks (
	id int(11) NOT NULL AUTO_INCREMENT,
	orderId int(11) NOT NULL,
	bookId int(11) NOT NULL,
	PRIMARY KEY (id),
	KEY orderId (orderId),
	KEY bookId (bookId)
) ENGINE=InnoDB AUTO_INCREMENT=1 CHARSET=utf8;;

CREATE TABLE orders (
	id int(11) NOT NULL AUTO_INCREMENT,
	userId int(11) NOT NULL,
	creditCardNumber char(16) NOT NULL,
	creditCardHolder varchar(255) NOT NULL,
	PRIMARY KEY (id),
	KEY userId (userId)
) ENGINE=InnoDB AUTO_INCREMENT=1 CHARSET=utf8;;

CREATE TABLE users (
	id int(11) NOT NULL AUTO_INCREMENT,
	userName varchar(255) NOT NULL,
	passwordHash char(40) NOT NULL,
	PRIMARY KEY (id),
	UNIQUE KEY userName (userName)
) ENGINE=InnoDB AUTO_INCREMENT=1 CHARSET=utf8;;

ALTER TABLE books
ADD CONSTRAINT books_ibfk_1 FOREIGN KEY (categoryId) REFERENCES categories (id) ON DELETE CASCADE ON UPDATE CASCADE;

ALTER TABLE orderedbooks
ADD CONSTRAINT orderedbooks_ibfk_2 FOREIGN KEY (bookId) REFERENCES books (id) ON DELETE CASCADE ON UPDATE CASCADE,

ADD CONSTRAINT orderedBooks_ibfk_1 FOREIGN KEY (orderid) REFERENCES orders (id) ON DELETE CASCADE ON UPDATE CASCADE;

ALTER TABLE orders
ADD CONSTRAINT orders_ibfk_1 FOREIGN KEY (userId) REFERENCES users (id) ON DELETE CASCADE ON UPDATE CASCADE;

INSERT INTO categories VALUES (1, 'Mobile & Wireless Computing');
INSERT INTO categories VALUES (2, 'Functional Programming');
INSERT INTO categories VALUES (3, 'C / C++');
INSERT INTO categories VALUES (4, '<< New Publications >>');

INSERT INTO books VALUES (1, 1, 'Hello, Android: Introducing Google''s Mobile Development Platform', 'Ed Burnette', '9781934356562', 19.97);
INSERT INTO books VALUES (2, 1, 'Android Wireless Application Development', 'Shane Conder, Lauren Darcey', '0321743016', 31.22);
INSERT INTO books VALUES (5, 1, 'Professional Flash Mobile Development', 'Richard Wagner', '0470620072', 19.90);
INSERT INTO books VALUES (7, 1, 'Mobile Web Design For Dummies', 'Janine Warner, David LaFontaine', '9780470560969', 16.32);
INSERT INTO books VALUES (11, 2, 'Introduction to Functional Programming using Haskell', 'Richard Bird', '9780134843469', 74.75);
INSERT INTO books VALUES (12, 2, 'Scripting (Attacks) for Beginners - <script type="text/javascript">alert(''All your base are belong to us!'');</script>', 'John Doe', '1234567890', 9.99);
INSERT INTO books VALUES (14, 2, 'Expert F# (Expert''s Voice in .NET)', 'Antonio Cisternino, Adam Granicz, Don Syme', '9781590598504', 47.64);
INSERT INTO books VALUES (16, 3, 'C Programming Language (2nd Edition)', 'Brian W. Kernighan, Dennis M. Ritchie', '0131103628', 48.36);
INSERT INTO books VALUES (27, 3, 'C++ Primer Plus (5th Edition)', 'Stephan Prata', ' 9780672326974', 36.94);
INSERT INTO books VALUES (29, 3, 'The C++ Programming Language', 'Bjarne Stroustrup', '0201700735', 67.49);
	
INSERT INTO users VALUES (1, 'scm4', 'a8af855d47d091f0376664fe588207f334cdad22');