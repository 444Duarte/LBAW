-------------------- TYPES --------------------

DROP TYPE IF EXISTS condition;
CREATE TYPE condition AS ENUM (
    '1',
    '2',
    '3',
    '4',
    '5'
);

DROP TYPE IF EXISTS record_type;
CREATE TYPE record_type AS ENUM (
    'Add',
    'Remove',
    'Lend',
    'Return',
    'Maintenance',
    'Repaired'
);

DROP TYPE IF EXISTS user_type;
CREATE TYPE user_type AS ENUM (
    'Client',
    'InventoryManager',
    'SystemManager'
);


-------------------- TABLES --------------------

DROP TABLE IF EXISTS blocked_users;
CREATE TABLE blocked_users (
    id integer NOT NULL,
    date timestamp without time zone DEFAULT now() NOT NULL,
    note text
);	

DROP TABLE IF EXISTS categories;
CREATE TABLE categories (
    id serial NOT NULL,
    name text NOT NULL
);

DROP TABLE IF EXISTS clients;
CREATE TABLE clients (
    id integer NOT NULL,
    id_card text NOT NULL,
    address text NOT NULL,
    phone_number text NOT NULL,
    picture text,
	CONSTRAINT phone_number_length_check CHECK ((char_length(phone_number) = 9))
);
	
DROP TABLE IF EXISTS item_history_records;
CREATE TABLE item_history_records (
    id serial NOT NULL,
    date timestamp without time zone DEFAULT now() NOT NULL,
    id_item_instance integer NOT NULL,
    id_inventory_manager integer NOT NULL,
    type record_type NOT NULL
);	

DROP TABLE IF EXISTS item_instances;
CREATE TABLE item_instances (
    id serial NOT NULL,
    id_item integer NOT NULL,
    condition condition NOT NULL
);
	
DROP TABLE IF EXISTS items;
CREATE TABLE items (
    id serial NOT NULL,
    name text NOT NULL,
    id_subcategory integer NOT NULL,
    description text NOT NULL,
    picture text,
	CONSTRAINT description_length_check CHECK ((char_length(description) > 20))
);

DROP TABLE IF EXISTS lend_records;
CREATE TABLE lend_records (
    id integer NOT NULL,
    id_client integer NOT NULL
);

DROP TABLE IF EXISTS maintenance_records;
CREATE TABLE maintenance_records (
    id integer NOT NULL,
    repairer text NOT NULL,
    expected_end timestamp without time zone NOT NULL
);

DROP TABLE IF EXISTS reservations;
CREATE TABLE reservations (
    id serial NOT NULL,
    start_time timestamp without time zone NOT NULL,
    end_time timestamp without time zone NOT NULL,
    id_client integer NOT NULL,
    id_item_instance integer NOT NULL,
    fulfilled boolean DEFAULT false NOT NULL,
	CONSTRAINT time_interval_check CHECK ((start_time < end_time))
);

DROP TABLE IF EXISTS return_records;
CREATE TABLE return_records (
    id integer NOT NULL,
    id_client integer NOT NULL
);
	
DROP TABLE IF EXISTS subcategories;
CREATE TABLE subcategories (
    id serial NOT NULL,
    name text NOT NULL,
    id_category integer NOT NULL
);

DROP TABLE IF EXISTS users;
CREATE TABLE users (
    id serial NOT NULL,
    username text NOT NULL,
    email text NOT NULL,
    password text NOT NULL,
    type user_type NOT NULL,
	CONSTRAINT password_length_check CHECK ((char_length(password) > 6))
);

-------------------- KEYS --------------------

ALTER TABLE ONLY blocked_users
    ADD CONSTRAINT blocked_users_pkey PRIMARY KEY (id);

ALTER TABLE ONLY categories
    ADD CONSTRAINT categories_pkey PRIMARY KEY (id);
ALTER TABLE ONLY categories
    ADD CONSTRAINT categories_name_key UNIQUE (name);	
	
ALTER TABLE ONLY clients
    ADD CONSTRAINT clients_pkey PRIMARY KEY (id);
ALTER TABLE ONLY clients
    ADD CONSTRAINT clients_id_card_key UNIQUE (id_card);
	
ALTER TABLE ONLY item_history_records
    ADD CONSTRAINT item_history_records_pkey PRIMARY KEY (id);
	
ALTER TABLE ONLY item_instances
    ADD CONSTRAINT item_instances_pkey PRIMARY KEY (id);

ALTER TABLE ONLY items
    ADD CONSTRAINT items_pkey PRIMARY KEY (id);
ALTER TABLE ONLY items
    ADD CONSTRAINT uk_name_subcategory UNIQUE (name, id_subcategory);
	
ALTER TABLE ONLY lend_records
    ADD CONSTRAINT lend_records_pkey PRIMARY KEY (id);
	
ALTER TABLE ONLY maintenance_records
    ADD CONSTRAINT maintenance_records_pkey PRIMARY KEY (id);
	
ALTER TABLE ONLY reservations
    ADD CONSTRAINT reservations_pkey PRIMARY KEY (id);

ALTER TABLE ONLY return_records
    ADD CONSTRAINT return_records_pkey PRIMARY KEY (id);
	
ALTER TABLE ONLY subcategories
	ADD CONSTRAINT subcategories_pkey PRIMARY KEY (id);
ALTER TABLE ONLY subcategories
	ADD CONSTRAINT subcategories_name_id_category_key UNIQUE (name, id_category);
	
ALTER TABLE ONLY users
    ADD CONSTRAINT users_pkey PRIMARY KEY (id);
ALTER TABLE ONLY users
    ADD CONSTRAINT users_email_key UNIQUE (email);
ALTER TABLE ONLY users
    ADD CONSTRAINT users_username_key UNIQUE (username);
	

-------------------- FOREIGN KEYS --------------------

ALTER TABLE ONLY blocked_users
    ADD CONSTRAINT blocked_users_id_fkey FOREIGN KEY (id) REFERENCES users(id);
	
ALTER TABLE ONLY clients
    ADD CONSTRAINT clients_id_fkey FOREIGN KEY (id) REFERENCES users(id);
	
ALTER TABLE ONLY item_history_records
    ADD CONSTRAINT item_history_records_id_inventory_manager_fkey FOREIGN KEY (id_inventory_manager) REFERENCES users(id);
ALTER TABLE ONLY item_history_records
    ADD CONSTRAINT item_history_records_id_item_instance_fkey FOREIGN KEY (id_item_instance) REFERENCES item_instances(id);

ALTER TABLE ONLY item_instances
    ADD CONSTRAINT item_instances_id_item_fkey FOREIGN KEY (id_item) REFERENCES items(id);
	
ALTER TABLE ONLY items
    ADD CONSTRAINT items_id_subcategory_fkey FOREIGN KEY (id_subcategory) REFERENCES subcategories(id);
	
ALTER TABLE ONLY lend_records
    ADD CONSTRAINT lend_records_id_client_fkey FOREIGN KEY (id_client) REFERENCES clients(id);
ALTER TABLE ONLY lend_records
    ADD CONSTRAINT lend_records_id_fkey FOREIGN KEY (id) REFERENCES item_history_records(id);
	
ALTER TABLE ONLY maintenance_records
    ADD CONSTRAINT maintenance_records_id_fkey FOREIGN KEY (id) REFERENCES item_history_records(id);
	
ALTER TABLE ONLY reservations
    ADD CONSTRAINT reservations_id_client_fkey FOREIGN KEY (id_client) REFERENCES clients(id);
ALTER TABLE ONLY reservations
    ADD CONSTRAINT reservations_id_item_instance_fkey FOREIGN KEY (id_item_instance) REFERENCES item_instances(id);
	
ALTER TABLE ONLY return_records
    ADD CONSTRAINT return_records_id_client_fkey FOREIGN KEY (id_client) REFERENCES clients(id);
ALTER TABLE ONLY return_records
    ADD CONSTRAINT return_records_id_fkey FOREIGN KEY (id) REFERENCES item_history_records(id);
	
ALTER TABLE ONLY subcategories
	ADD CONSTRAINT subcategories_id_category_fkey FOREIGN KEY (id_category) REFERENCES categories(id);