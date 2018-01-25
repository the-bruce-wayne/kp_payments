-- TODO 
-- mapping users/profiles to accounts 

-- accounts sections
DROP TABLE IF EXISTS account_limits CASCADE;
CREATE TABLE account_limits(
	id SERIAL PRIMARY KEY NOT NULL,
	name CHARACTER VARYING(20) NOT NULL,
	description CHARACTER VARYING(225) NOT NULL,
	amount_limit MONEY NULL,
	total_limit SMALLINT NULL,
	period INTERVAL NOT NULL
);

DROP TABLE IF EXISTS transaction_statuses CASCADE;
CREATE TABLE transaction_statuses(
	id SERIAL PRIMARY KEY NOT NULL,
	name CHARACTER VARYING(20) NOT NULL,
	description CHARACTER VARYING(225) NOT NULL
);

DROP TABLE IF EXISTS transaction_types CASCADE;
CREATE TABLE transaction_types(
	id SERIAL PRIMARY KEY NOT NULL,
	name CHARACTER VARYING(20) NOT NULL,
	description CHARACTER VARYING(225) NOT NULL
);

DROP TABLE IF EXISTS invoice_statuses CASCADE;
CREATE TABLE invoice_statuses(
	id SERIAL PRIMARY KEY NOT NULL,
	name CHARACTER VARYING(20) NOT NULL,
	description CHARACTER VARYING(225) NOT NULL
);


DROP TABLE IF EXISTS order_statuses CASCADE;
CREATE TABLE order_statuses(
	id SERIAL PRIMARY KEY NOT NULL,
	name CHARACTER VARYING(20) NOT NULL,
	description CHARACTER VARYING(225) NOT NULL
);

DROP TABLE IF EXISTS account_types CASCADE;
CREATE TABLE account_types(
	id SERIAL PRIMARY KEY NOT NULL,
	name CHARACTER VARYING(20) NOT NULL,
	description CHARACTER VARYING(225) NOT NULL
);

DROP TABLE IF EXISTS payment_statuses CASCADE;
CREATE TABLE payment_statuses(
	id SERIAL PRIMARY KEY NOT NULL,
	name CHARACTER VARYING(20) NOT NULL,
	description CHARACTER VARYING(225) NOT NULL
);

DROP TABLE IF EXISTS payment_methodes CASCADE;
CREATE TABLE payment_methodes(
	id SERIAL PRIMARY KEY NOT NULL,
	name CHARACTER VARYING(20) NOT NULL
);


DROP TABLE IF EXISTS accounts CASCADE;
CREATE TABLE accounts(
	id SERIAL PRIMARY KEY NOT NULL,
	balance MONEY NOT NULL DEFAULT 0::money CHECK (balance >= 0::money),
	account_type_id SERIAL NOT NULL REFERENCES account_types(id),
	date_created TIMESTAMP NOT NULL DEFAULT current_timestamp
);

-- payments section
DROP TABLE IF EXISTS payments CASCADE;
CREATE TABLE payments(
	id SERIAL PRIMARY KEY NOT NULL,
	amount MONEY NOT NULL CHECK (amount > 0::money),
	description CHARACTER VARYING(225) NOT NULL,
	date_created TIMESTAMP NOT NULL DEFAULT current_timestamp,
	date_acknowledged TIMESTAMP NULL,
	account INT NOT NULL REFERENCES accounts(id),
	status SMALLINT NOT NULL REFERENCES payment_statuses(id),
	method SMALLINT NOT NULL REFERENCES payment_methodes(id)
);

-- transactions
DROP TABLE IF EXISTS transactions CASCADE;
CREATE TABLE transactions(
	id SERIAL PRIMARY KEY NOT NULL,
	amount MONEY NOT NULL CHECK (amount > 0::money),
	source_account SERIAL NOT NULL REFERENCES accounts(id) CHECK(source_account != destination_account),
	destination_account SERIAL NOT NULL REFERENCES accounts(id),
	date_created TIMESTAMP NOT NULL DEFAULT current_timestamp,
	status SERIAL NOT NULL REFERENCES transaction_statuses(id),
	type SERIAL NOT NULL REFERENCES transaction_types(id)
);


DROP TABLE IF EXISTS orders CASCADE;
CREATE TABLE orders(
	id SERIAL PRIMARY KEY NOT NULL,
	user_id SERIAL NOT NULL REFERENCES "user"(id),
	total_amount MONEY NOT NULL CHECK (total_amount > 0::money),
	total_fee MONEY NOT NULL CHECK (total_fee >= 0::money),
	account_id SERIAL NOT NULL REFERENCES accounts(id),
	date_created TIMESTAMP NOT NULL DEFAULT current_timestamp,
	status SERIAL NOT NULL REFERENCES order_statuses(id)
);

--review this
DROP TABLE IF EXISTS invoices CASCADE;
CREATE TABLE invoices(
	id SERIAL PRIMARY KEY NOT NULL,
	order_id SERIAL NOT NULL REFERENCES orders(id),
	total_amount_due MONEY NOT NULL CHECK (total_amount_due > 0::money),
	total_fee MONEY NOT NULL CHECK (total_fee >= 0::money),
	tax MONEY NOT NULL CHECK (tax >= 0::money),
	date_created TIMESTAMP NOT NULL DEFAULT current_timestamp,
	date_closed TIMESTAMP NOT NULL DEFAULT current_timestamp,
	status SERIAL NOT NULL REFERENCES invoice_statuses(id)
);

DROP TABLE IF EXISTS orders_line_items CASCADE;
CREATE TABLE orders_line_items(
	id BIGSERIAL PRIMARY KEY NOT NULL,
	order_id SERIAL NOT NULL REFERENCES orders(id),
	fee MONEY NOT NULL CHECK(fee >= 0::money),
	amount MONEY NOT NULL CHECK(amount > 0::money),
	recipient_name CHARACTER VARYING(50) NULL,
	recipient_reference CHARACTER VARYING(50) NULL,
	recipient_account CHARACTER VARYING(15) NOT NULL,
	date_created TIMESTAMP NOT NULL DEFAULT current_timestamp,
	status SERIAL NOT NULL REFERENCES order_statuses(id)
);

DROP TABLE IF EXISTS account_limit_mappings CASCADE;
CREATE TABLE account_limit_mappings(
	account_type_id SERIAL NOT NULL REFERENCES account_type(id),
	account_limits_id SERIAL NOT NULL REFERENCES account_limits(id),
	PRIMARY KEY(account_type_id, account_limits_id)
);

DROP TABLE IF EXISTS regular_accounts CASCADE;
CREATE TABLE regular_accounts(
	account_id SERIAL REFERENCES accounts(id),
	user_id SERIAL REFERENCES "user"(id),
	PRIMARY KEY(account_id, user_id)
);

DROP TABLE IF EXISTS address CASCADE;
CREATE TABLE address(
	id SERIAL NOT NULL PRIMARY KEY,
	line_1_building CHARACTER VARYING(50) NULL,
	line_2_street CHARACTER VARYING(50) NOT NULL,
	line_3_area_locality CHARACTER VARYING(50) NULL,
	town_city CHARACTER VARYING(50) NULL,
	state_provice CHARACTER VARYING(50) NOT NULL,
	country CHARACTER VARYING(50) NULL
);

DROP TABLE IF EXISTS companies CASCADE;
CREATE TABLE companies(
	id SERIAL NOT NULL PRIMARY KEY,
	name CHARACTER VARYING(50) NOT NULL,
	address_id SERIAL REFERENCES address(id),
	user_id SERIAL REFERENCES "user"(id)
);

DROP TABLE IF EXISTS corporate_accounts CASCADE;
CREATE TABLE corporate_accounts(
	account_id SERIAL REFERENCES accounts(id),
	user_id SERIAL REFERENCES "user"(id),
	company_id SERIAL REFERENCES companies(id),
	PRIMARY KEY(account_id, user_id)
);


