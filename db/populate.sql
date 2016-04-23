INSERT INTO users VALUES ('David','david@gmail.com','e5WoRjd','InventoryManager');
INSERT INTO users VALUES ('Duarte','duarte@gmail.com','BuvZbpEf','InventoryManager');
INSERT INTO users VALUES ('Flavio','flavio@gmail.com','JvuqfHd','InventoryManager');
INSERT INTO users VALUES ('Pedro','pedro@gmail.com','WJPzNbv36flrVz','SystemManager');
INSERT INTO users VALUES ('Baiao','baiao@gmail.com','WOalrMha','Client');
INSERT INTO users VALUES ('pinto','pinto@gmail.com','MxyhMHA9','Client');
INSERT INTO users VALUES ('couto','couto@sapo.pt','xs7hliWyCeF','Client');
INSERT INTO users VALUES ('Castro','castro@hotmail.com','lHFpmonDsBGcXGY0','Client');
INSERT INTO users VALUES ('Bino','bino@yahoo.com','nYiyl0GG','Client');
INSERT INTO users VALUES ('Moises','moises@sapo.pt','HnezYhMebZYHt6v','Client');

INSERT INTO blocked_users VALUES (8, '2016-03-01 12:00:00', 'Generic note about the block');
INSERT INTO blocked_users VALUES (9, '2016-03-27 00:00:00', 'Didnt like his name');

INSERT INTO clients VALUES (4, 0, 'Paranhos', '912345678', 'http://imgur.com/XRXgIJm');
INSERT INTO clients VALUES (5, 1, 'Foz do Douro', '933222555', 'http://imgur.com/XRXgIJm');
INSERT INTO clients VALUES (6, 2, 'Coimbra', '922555666', 'http://imgur.com/XRXgIJm');
INSERT INTO clients VALUES (7, 3, 'Lisboa', '966543210', 'http://imgur.com/XRXgIJm');
INSERT INTO clients VALUES (8, 4, 'Vila Real', '919191919', 'http://imgur.com/XRXgIJm');
INSERT INTO clients VALUES (9, 5, 'Bragança', '920123456', 'http://imgur.com/XRXgIJm');

INSERT INTO categories VALUES ('Tool');
INSERT INTO categories VALUES ('Eletronic');
INSERT INTO categories VALUES ('Movie');

INSERT INTO subcategories VALUES ('Build', 0);
INSERT INTO subcategories VALUES ('Kitchen', 0);
INSERT INTO subcategories VALUES ('Energy', 1);
INSERT INTO subcategories VALUES ('Sound and Image', 1);
INSERT INTO subcategories VALUES ('IT', 1);
INSERT INTO subcategories VALUES ('Drama', 2);
INSERT INTO subcategories VALUES ('Comedy', 2);
INSERT INTO subcategories VALUES ('History', 2);

INSERT INTO items VALUES ('saw', 0, 'item to cut something in pieces', 'http://image.made-in-china.com/43f34j00gKIQRGioJPkO/Hand-Saw-Handsaw-Garden-Saw-Pruning-Saw-Hand-Tool-Hardware-Tool-WTHS6001-.jpg');
INSERT INTO items VALUES ('hammer', 0, 'SMASHHHHHHHHHHHHHHHHHHHHHHHH!', 'http://www.pjtool.com/images/products/detail/rip_hammer.jpg');
INSERT INTO items VALUES ('fork', 1, 'Item used to help people eat', 'http://www.planet-science.com/umbraco/ImageGen.ashx?image=/media/114029/fork_87623698.jpg&width=600&constrain=true');
INSERT INTO items VALUES ('knife', 1, 'Item used to cut something', 'http://vignette3.wikia.nocookie.net/zombie/images/6/6d/Chef_Knife.jpg/revision/latest?cb=20150729022338');
INSERT INTO items VALUES ('extension cord', 2, 'Extend the energy. We need more of this in FEUP', 'http://www.sencor.eu/getattachment/17ff8439-0a92-4106-b673-fed272964263/SPC-4-Outlets-with-switch.aspx');
INSERT INTO items VALUES ('Speakers', 3, 'Sound speakers to get a louder sound', 'https://images-na.ssl-images-amazon.com/images/G/01/aplus/detail-page/B00EZ9XKCM_Z200_BLK_FOB_lg.jpg');
INSERT INTO items VALUES ('Projector', 3, 'Projector description', 'http://www.gadgetreview.com/wp-content/uploads/2014/08/LCD-projector-reviews.jpg');
INSERT INTO items VALUES ('Laptop', 4, 'Samsung s5 series laptop', 'http://cdni.wired.co.uk/620x413/s_v/Samsung-laptop2.jpg');
INSERT INTO items VALUES ('The Revenant', 5, 'DiCaprio got the oscar', 'http://filmspot.com.pt/images/filmes/posters/big/281957_pt.jpg');
INSERT INTO items VALUES ('Deadpool', 6, 'R-Rated movie about a badass anti-hero', 'https://upload.wikimedia.org/wikipedia/en/4/46/Deadpool_poster.jpg');
INSERT INTO items VALUES ('The Martian', 6, 'Apparently this is a comedy', 'http://blogs-images.forbes.com/scottmendelson/files/2015/09/THE-MARTIAN-movie-poster2.jpg');
INSERT INTO items VALUES ('Spotlight', 7, 'The true story of how the Boston Globe uncovered the massive scandal of child molestation and cover-up within the local Catholic Archdiocese, shaking the entire Catholic Church to its core.', 'https://resizing.flixster.com/4rw9KO8kcuVMGfCXwobUbExCzgo=/800x1183/v1.bTsxMTIwMTU1ODtqOzE3MDI3OzIwNDg7MTg5MzsyODAw');
INSERT INTO items VALUES ('Bridge of Spies', 7, 'During the Cold War, an American lawyer is recruited to defend an arrested Soviet spy in court, and then help the CIA facilitate an exchange of the spy for the Soviet captured American U2 spy plane pilot, Francis Gary Powers.', 'http://ia.media-imdb.com/images/M/MV5BMjIxOTI0MjU5NV5BMl5BanBnXkFtZTgwNzM4OTk4NTE@._V1_UX182_CR0,0,182,268_AL_.jpg');
INSERT INTO items VALUES ('American Sniper', 7, 'Navy S.E.A.L. sniper Chris Kyles pinpoint accuracy saves countless lives on the battlefield and turns him into a legend. Back home to his wife and kids after four tours of duty, however, Chris finds that it is the war he cant leave behind.', 'http://ia.media-imdb.com/images/M/MV5BMTkxNzI3ODI4Nl5BMl5BanBnXkFtZTgwMjkwMjY4MjE@._V1_UX182_CR0,0,182,268_AL_.jpg');

INSERT INTO item_instances VALUES (0, '5');
INSERT INTO item_instances VALUES (0, '4');
INSERT INTO item_instances VALUES (1, '5');
INSERT INTO item_instances VALUES (1, '3');
INSERT INTO item_instances VALUES (2, '5');
INSERT INTO item_instances VALUES (2, '5');
INSERT INTO item_instances VALUES (2, '2');
INSERT INTO item_instances VALUES (3, '5');
INSERT INTO item_instances VALUES (3, '1');
INSERT INTO item_instances VALUES (3, '5');
INSERT INTO item_instances VALUES (4, '5');
INSERT INTO item_instances VALUES (4, '4');
INSERT INTO item_instances VALUES (5, '5');
INSERT INTO item_instances VALUES (6, '5');
INSERT INTO item_instances VALUES (7, '3');
INSERT INTO item_instances VALUES (7, '5');
INSERT INTO item_instances VALUES (7, '5');
INSERT INTO item_instances VALUES (8, '4');
INSERT INTO item_instances VALUES (9, '5');
INSERT INTO item_instances VALUES (10, '5');
INSERT INTO item_instances VALUES (11, '4');
INSERT INTO item_instances VALUES (12, '5');
INSERT INTO item_instances VALUES (13, '5');

INSERT INTO reservations VALUES ('2016-04-09 09:00:00', '2016-04-09 19:00:00', 4, 13, true);
INSERT INTO reservations VALUES ('2016-04-09 10:00:00', '2016-04-09 19:00:00', 5, 10, false);
INSERT INTO reservations VALUES ('2016-04-09 12:00:00', '2016-04-13 19:00:00', 4, 0, false);
INSERT INTO reservations VALUES ('2016-04-10 09:00:00', '2016-04-11 19:00:00', 6, 2, false);
INSERT INTO reservations VALUES ('2016-04-10 10:00:00', '2016-04-12 19:00:00', 9, 1, false);

INSERT INTO item_history_records VALUES ('2016-04-08 00:00:00', 0, 0, 'Add');
INSERT INTO item_history_records VALUES ('2016-04-08 00:00:00', 1, 0, 'Add');
INSERT INTO item_history_records VALUES ('2016-04-08 00:00:00', 2, 0, 'Add');
INSERT INTO item_history_records VALUES ('2016-04-08 00:00:00', 3, 0, 'Add');
INSERT INTO item_history_records VALUES ('2016-04-08 00:00:00', 4, 0, 'Add');
INSERT INTO item_history_records VALUES ('2016-04-08 00:00:00', 5, 0, 'Add');
INSERT INTO item_history_records VALUES ('2016-04-08 00:00:00', 6, 0, 'Add');
INSERT INTO item_history_records VALUES ('2016-04-08 00:00:00', 7, 0, 'Add');
INSERT INTO item_history_records VALUES ('2016-04-08 00:00:00', 8, 0, 'Add');
INSERT INTO item_history_records VALUES ('2016-04-08 00:00:00', 9, 0, 'Add');
INSERT INTO item_history_records VALUES ('2016-04-08 00:00:00', 10, 0, 'Add');
INSERT INTO item_history_records VALUES ('2016-04-08 00:00:00', 11, 0, 'Add');
INSERT INTO item_history_records VALUES ('2016-04-08 00:00:00', 12, 0, 'Add');
INSERT INTO item_history_records VALUES ('2016-04-08 00:00:00', 13, 0, 'Add');
INSERT INTO item_history_records VALUES ('2016-04-08 00:00:00', 14, 0, 'Add');
INSERT INTO item_history_records VALUES ('2016-04-08 00:00:00', 15, 0, 'Add');
INSERT INTO item_history_records VALUES ('2016-04-08 00:00:00', 16, 0, 'Add');
INSERT INTO item_history_records VALUES ('2016-04-08 00:00:00', 17, 0, 'Add');
INSERT INTO item_history_records VALUES ('2016-04-08 00:00:00', 18, 0, 'Add');
INSERT INTO item_history_records VALUES ('2016-04-08 00:00:00', 19, 0, 'Add');
INSERT INTO item_history_records VALUES ('2016-04-08 00:00:00', 20, 0, 'Add');
INSERT INTO item_history_records VALUES ('2016-04-08 00:00:00', 21, 0, 'Add');
INSERT INTO item_history_records VALUES ('2016-04-08 00:00:00', 22, 0, 'Add');

INSERT INTO item_history_records VALUES ('2016-04-09 09:00:00', 13, 1, 'Lend');
INSERT INTO item_history_records VALUES ('2016-04-09 10:00:00', 10, 1, 'Lend');
INSERT INTO item_history_records VALUES ('2016-04-09 12:00:00', 0, 1, 'Lend');
INSERT INTO item_history_records VALUES ('2016-04-10 09:00:00', 2, 2, 'Lend');
INSERT INTO item_history_records VALUES ('2016-04-10 10:00:00', 1, 2, 'Lend');

INSERT INTO item_history_records VALUES ('2016-04-09 19:00:00', 13, 1, 'Return');

INSERT INTO item_history_records VALUES ('2016-04-09 20:01:00', 13, 1, 'Maintenance');
INSERT INTO item_history_records VALUES ('2016-04-10 12:00:00', 13, 2, 'Repaired');

INSERT INTO lend_records VALUES (23, 4);
INSERT INTO lend_records VALUES (24, 5);
INSERT INTO lend_records VALUES (25, 4);
INSERT INTO lend_records VALUES (26, 6);
INSERT INTO lend_records VALUES (27, 9);

INSERT INTO return_records VALUES (28, 4);

INSERT INTO maintenance_records VALUES (29, 'Repairer Bino & friends, Lda.', '2016-04-10');