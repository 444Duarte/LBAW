INSERT INTO users (username, email, password, type) VALUES ('David','david@gmail.com','e5WoRjd','InventoryManager');
INSERT INTO users (username, email, password, type) VALUES ('Duarte','duarte@gmail.com','BuvZbpEf','InventoryManager');
INSERT INTO users (username, email, password, type) VALUES ('Flavio','flavio@gmail.com','JvuqfHd','InventoryManager');
INSERT INTO users (username, email, password, type) VALUES ('Pedro','pedro@gmail.com','WJPzNbv36flrVz','SystemManager');
INSERT INTO users (username, email, password, type) VALUES ('Baiao','baiao@gmail.com','WOalrMha','Client');
INSERT INTO users (username, email, password, type) VALUES ('pinto','pinto@gmail.com','MxyhMHA9','Client');
INSERT INTO users (username, email, password, type) VALUES ('couto','couto@sapo.pt','xs7hliWyCeF','Client');
INSERT INTO users (username, email, password, type) VALUES ('Castro','castro@hotmail.com','lHFpmonDsBGcXGY0','Client');
INSERT INTO users (username, email, password, type) VALUES ('Bino','bino@yahoo.com','nYiyl0GG','Client');
INSERT INTO users (username, email, password, type) VALUES ('Moises','moises@sapo.pt','HnezYhMebZYHt6v','Client');

INSERT INTO blocked_users (id, date, note) VALUES (9, '2016-03-01 12:00:00', 'Generic note about the block');
INSERT INTO blocked_users (id, date, note) VALUES (10, '2016-03-27 00:00:00', 'Didnt like his name');

INSERT INTO clients (id, id_card, address, phone_number, picture) VALUES (5, 1, 'Paranhos', '912345678', 'http://imgur.com/XRXgIJm');
INSERT INTO clients (id, id_card, address, phone_number, picture) VALUES (6, 2, 'Foz do Douro', '933222555', 'http://imgur.com/XRXgIJm');
INSERT INTO clients (id, id_card, address, phone_number, picture) VALUES (7, 3, 'Coimbra', '922555666', 'http://imgur.com/XRXgIJm');
INSERT INTO clients (id, id_card, address, phone_number, picture) VALUES (8, 4, 'Lisboa', '966543210', 'http://imgur.com/XRXgIJm');
INSERT INTO clients (id, id_card, address, phone_number, picture) VALUES (9, 5, 'Vila Real', '919191919', 'http://imgur.com/XRXgIJm');
INSERT INTO clients (id, id_card, address, phone_number, picture) VALUES (10, 6, 'Bragança', '920123456', 'http://imgur.com/XRXgIJm');

INSERT INTO categories (name) VALUES ('Tool');
INSERT INTO categories (name) VALUES ('Eletronic');
INSERT INTO categories (name) VALUES ('Movie');

INSERT INTO subcategories (name, id_category) VALUES ('Build', 1);
INSERT INTO subcategories (name, id_category) VALUES ('Kitchen', 1);
INSERT INTO subcategories (name, id_category) VALUES ('Energy', 2);
INSERT INTO subcategories (name, id_category) VALUES ('Sound and Image', 2);
INSERT INTO subcategories (name, id_category) VALUES ('IT', 2);
INSERT INTO subcategories (name, id_category) VALUES ('Drama', 3);
INSERT INTO subcategories (name, id_category) VALUES ('Comedy', 3);
INSERT INTO subcategories (name, id_category) VALUES ('History', 3);

INSERT INTO items (name, id_subcategory, description, picture) VALUES ('saw', 1, 'item to cut something in pieces', 'http://image.made-in-china.com/43f34j00gKIQRGioJPkO/Hand-Saw-Handsaw-Garden-Saw-Pruning-Saw-Hand-Tool-Hardware-Tool-WTHS6001-.jpg');
INSERT INTO items (name, id_subcategory, description, picture) VALUES ('hammer', 1, 'SMASHHHHHHHHHHHHHHHHHHHHHHHH!', 'http://www.pjtool.com/images/products/detail/rip_hammer.jpg');
INSERT INTO items (name, id_subcategory, description, picture) VALUES ('fork', 2, 'Item used to help people eat', 'http://www.planet-science.com/umbraco/ImageGen.ashx?image=/media/114029/fork_87623698.jpg&width=600&constrain=true');
INSERT INTO items (name, id_subcategory, description, picture) VALUES ('knife', 2, 'Item used to cut something', 'http://vignette3.wikia.nocookie.net/zombie/images/6/6d/Chef_Knife.jpg/revision/latest?cb=20150729022338');
INSERT INTO items (name, id_subcategory, description, picture) VALUES ('extension cord', 3, 'Extend the energy. We need more of this in FEUP', 'http://www.sencor.eu/getattachment/17ff8439-0a92-4106-b673-fed272964263/SPC-4-Outlets-with-switch.aspx');
INSERT INTO items (name, id_subcategory, description, picture) VALUES ('Speakers', 4, 'Sound speakers to get a louder sound', 'https://images-na.ssl-images-amazon.com/images/G/01/aplus/detail-page/B00EZ9XKCM_Z200_BLK_FOB_lg.jpg');
INSERT INTO items (name, id_subcategory, description, picture) VALUES ('Projector', 4, 'Projector description', 'http://www.gadgetreview.com/wp-content/uploads/2014/08/LCD-projector-reviews.jpg');
INSERT INTO items (name, id_subcategory, description, picture) VALUES ('Laptop', 5, 'Samsung s5 series laptop', 'http://cdni.wired.co.uk/620x413/s_v/Samsung-laptop2.jpg');
INSERT INTO items (name, id_subcategory, description, picture) VALUES ('The Revenant', 6, 'DiCaprio got the oscar', 'http://filmspot.com.pt/images/filmes/posters/big/281957_pt.jpg');
INSERT INTO items (name, id_subcategory, description, picture) VALUES ('Deadpool', 7, 'R-Rated movie about a badass anti-hero', 'https://upload.wikimedia.org/wikipedia/en/4/46/Deadpool_poster.jpg');
INSERT INTO items (name, id_subcategory, description, picture) VALUES ('The Martian', 7, 'Apparently this is a comedy', 'http://blogs-images.forbes.com/scottmendelson/files/2015/09/THE-MARTIAN-movie-poster2.jpg');
INSERT INTO items (name, id_subcategory, description, picture) VALUES ('Spotlight', 8, 'The true story of how the Boston Globe uncovered the massive scandal of child molestation and cover-up within the local Catholic Archdiocese, shaking the entire Catholic Church to its core.', 'https://resizing.flixster.com/4rw9KO8kcuVMGfCXwobUbExCzgo=/800x1183/v1.bTsxMTIwMTU1ODtqOzE3MDI3OzIwNDg7MTg5MzsyODAw');
INSERT INTO items (name, id_subcategory, description, picture) VALUES ('Bridge of Spies', 8, 'During the Cold War, an American lawyer is recruited to defend an arrested Soviet spy in court, and then help the CIA facilitate an exchange of the spy for the Soviet captured American U2 spy plane pilot, Francis Gary Powers.', 'http://ia.media-imdb.com/images/M/MV5BMjIxOTI0MjU5NV5BMl5BanBnXkFtZTgwNzM4OTk4NTE@._V1_UX182_CR0,0,182,268_AL_.jpg');
INSERT INTO items (name, id_subcategory, description, picture) VALUES ('American Sniper', 8, 'Navy S.E.A.L. sniper Chris Kyles pinpoint accuracy saves countless lives on the battlefield and turns him into a legend. Back home to his wife and kids after four tours of duty, however, Chris finds that it is the war he cant leave behind.', 'http://ia.media-imdb.com/images/M/MV5BMTkxNzI3ODI4Nl5BMl5BanBnXkFtZTgwMjkwMjY4MjE@._V1_UX182_CR0,0,182,268_AL_.jpg');

INSERT INTO item_instances (id_item, condition) VALUES (1, '5');
INSERT INTO item_instances (id_item, condition) VALUES (1, '4');
INSERT INTO item_instances (id_item, condition) VALUES (2, '5');
INSERT INTO item_instances (id_item, condition) VALUES (2, '3');
INSERT INTO item_instances (id_item, condition) VALUES (3, '5');
INSERT INTO item_instances (id_item, condition) VALUES (3, '5');
INSERT INTO item_instances (id_item, condition) VALUES (3, '2');
INSERT INTO item_instances (id_item, condition) VALUES (4, '5');
INSERT INTO item_instances (id_item, condition) VALUES (4, '1');
INSERT INTO item_instances (id_item, condition) VALUES (4, '5');
INSERT INTO item_instances (id_item, condition) VALUES (5, '5');
INSERT INTO item_instances (id_item, condition) VALUES (5, '4');
INSERT INTO item_instances (id_item, condition) VALUES (6, '5');
INSERT INTO item_instances (id_item, condition) VALUES (7, '5');
INSERT INTO item_instances (id_item, condition) VALUES (8, '3');
INSERT INTO item_instances (id_item, condition) VALUES (8, '5');
INSERT INTO item_instances (id_item, condition) VALUES (8, '5');
INSERT INTO item_instances (id_item, condition) VALUES (9, '4');
INSERT INTO item_instances (id_item, condition) VALUES (10, '5');
INSERT INTO item_instances (id_item, condition) VALUES (11, '5');
INSERT INTO item_instances (id_item, condition) VALUES (12, '4');
INSERT INTO item_instances (id_item, condition) VALUES (13, '5');
INSERT INTO item_instances (id_item, condition) VALUES (14, '5');

INSERT INTO reservations (start_time, end_time, id_client, id_item_instance, fulfilled) VALUES ('2016-04-09 09:00:00', '2016-04-09 19:00:00', 5, 14, true);
INSERT INTO reservations (start_time, end_time, id_client, id_item_instance, fulfilled) VALUES ('2016-04-09 10:00:00', '2016-04-09 19:00:00', 6, 11, false);
INSERT INTO reservations (start_time, end_time, id_client, id_item_instance, fulfilled) VALUES ('2016-04-09 12:00:00', '2016-04-13 19:00:00', 5, 1, false);
INSERT INTO reservations (start_time, end_time, id_client, id_item_instance, fulfilled) VALUES ('2016-04-10 09:00:00', '2016-04-11 19:00:00', 7, 3, false);
INSERT INTO reservations (start_time, end_time, id_client, id_item_instance, fulfilled) VALUES ('2016-04-10 10:00:00', '2016-04-12 19:00:00', 10, 2, false);

INSERT INTO item_history_records (date, id_item_instance, id_inventory_manager, type) VALUES ('2016-04-08 00:00:00', 1, 1, 'Add');
INSERT INTO item_history_records (date, id_item_instance, id_inventory_manager, type) VALUES ('2016-04-08 00:00:00', 2, 1, 'Add');
INSERT INTO item_history_records (date, id_item_instance, id_inventory_manager, type) VALUES ('2016-04-08 00:00:00', 3, 1, 'Add');
INSERT INTO item_history_records (date, id_item_instance, id_inventory_manager, type) VALUES ('2016-04-08 00:00:00', 4, 1, 'Add');
INSERT INTO item_history_records (date, id_item_instance, id_inventory_manager, type) VALUES ('2016-04-08 00:00:00', 5, 1, 'Add');
INSERT INTO item_history_records (date, id_item_instance, id_inventory_manager, type) VALUES ('2016-04-08 00:00:00', 6, 1, 'Add');
INSERT INTO item_history_records (date, id_item_instance, id_inventory_manager, type) VALUES ('2016-04-08 00:00:00', 7, 1, 'Add');
INSERT INTO item_history_records (date, id_item_instance, id_inventory_manager, type) VALUES ('2016-04-08 00:00:00', 8, 1, 'Add');
INSERT INTO item_history_records (date, id_item_instance, id_inventory_manager, type) VALUES ('2016-04-08 00:00:00', 9, 1, 'Add');
INSERT INTO item_history_records (date, id_item_instance, id_inventory_manager, type) VALUES ('2016-04-08 00:00:00', 10, 1, 'Add');
INSERT INTO item_history_records (date, id_item_instance, id_inventory_manager, type) VALUES ('2016-04-08 00:00:00', 11, 1, 'Add');
INSERT INTO item_history_records (date, id_item_instance, id_inventory_manager, type) VALUES ('2016-04-08 00:00:00', 12, 1, 'Add');
INSERT INTO item_history_records (date, id_item_instance, id_inventory_manager, type) VALUES ('2016-04-08 00:00:00', 13, 1, 'Add');
INSERT INTO item_history_records (date, id_item_instance, id_inventory_manager, type) VALUES ('2016-04-08 00:00:00', 14, 1, 'Add');
INSERT INTO item_history_records (date, id_item_instance, id_inventory_manager, type) VALUES ('2016-04-08 00:00:00', 15, 1, 'Add');
INSERT INTO item_history_records (date, id_item_instance, id_inventory_manager, type) VALUES ('2016-04-08 00:00:00', 16, 1, 'Add');
INSERT INTO item_history_records (date, id_item_instance, id_inventory_manager, type) VALUES ('2016-04-08 00:00:00', 17, 1, 'Add');
INSERT INTO item_history_records (date, id_item_instance, id_inventory_manager, type) VALUES ('2016-04-08 00:00:00', 18, 1, 'Add');
INSERT INTO item_history_records (date, id_item_instance, id_inventory_manager, type) VALUES ('2016-04-08 00:00:00', 19, 1, 'Add');
INSERT INTO item_history_records (date, id_item_instance, id_inventory_manager, type) VALUES ('2016-04-08 00:00:00', 20, 1, 'Add');
INSERT INTO item_history_records (date, id_item_instance, id_inventory_manager, type) VALUES ('2016-04-08 00:00:00', 21, 1, 'Add');
INSERT INTO item_history_records (date, id_item_instance, id_inventory_manager, type) VALUES ('2016-04-08 00:00:00', 22, 1, 'Add');
INSERT INTO item_history_records (date, id_item_instance, id_inventory_manager, type) VALUES ('2016-04-08 00:00:00', 23, 1, 'Add');

INSERT INTO item_history_records (date, id_item_instance, id_inventory_manager, type) VALUES ('2016-04-09 09:00:00', 14, 2, 'Lend');
INSERT INTO item_history_records (date, id_item_instance, id_inventory_manager, type) VALUES ('2016-04-09 10:00:00', 11, 2, 'Lend');
INSERT INTO item_history_records (date, id_item_instance, id_inventory_manager, type) VALUES ('2016-04-09 12:00:00', 1, 2, 'Lend');
INSERT INTO item_history_records (date, id_item_instance, id_inventory_manager, type) VALUES ('2016-04-10 09:00:00', 3, 3, 'Lend');
INSERT INTO item_history_records (date, id_item_instance, id_inventory_manager, type) VALUES ('2016-04-10 10:00:00', 2, 3, 'Lend');

INSERT INTO item_history_records (date, id_item_instance, id_inventory_manager, type) VALUES ('2016-04-09 19:00:00', 14, 2, 'Return');

INSERT INTO item_history_records (date, id_item_instance, id_inventory_manager, type) VALUES ('2016-04-09 20:01:00', 14, 2, 'Maintenance');
INSERT INTO item_history_records (date, id_item_instance, id_inventory_manager, type) VALUES ('2016-04-10 12:00:00', 14, 3, 'Repaired');

INSERT INTO lend_records (id, id_client) VALUES (24, 5);
INSERT INTO lend_records (id, id_client) VALUES (25, 6);
INSERT INTO lend_records (id, id_client) VALUES (26, 5);
INSERT INTO lend_records (id, id_client) VALUES (27, 7);
INSERT INTO lend_records (id, id_client) VALUES (28, 10);

INSERT INTO return_records (id, id_client) VALUES (29, 5);

INSERT INTO maintenance_records (id, repairer, expected_end) VALUES (30, 'Repairer Bino & friends, Lda.', '2016-04-10');