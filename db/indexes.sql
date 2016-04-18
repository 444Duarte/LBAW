CREATE INDEX user_idx on users USING hash(username);

CREATE INDEX item_instance_idx on item_instances(id_item);
CLUSTER item_instances USING item_instance_idx;

CREATE INDEX reservation_idx on reservations(id_client);
CLUSTER reservations USING reservation_idx;

CREATE INDEX item_history_idx on item_history_records(id_item_instance);
CLUSTER item_history_records USING item_history_idx;