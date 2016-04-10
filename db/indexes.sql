CREATE UNIQUE INDEX user_idx on User(username);

CREATE INDEX item_instance_idx on ItemInstance(idItem);
CLUSTER ItemInstance USING item_instance_idx;

CREATE INDEX reservation_idx on Reservation(idClient);
CLUSTER Reservation USING reservation_idx;

CREATE INDEX item_history_idx on ItemHistoryRecord(idItemInstance);
CLUSTER ItemHistoryRecord USING idItemInstance;