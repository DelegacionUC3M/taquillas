
CREATE TABLE permisos (
	id integer PRIMARY KEY,
	app_id smallint NOT NULL,
	rol integer NOT NULL
);

CREATE TABLE personas (
	id serial PRIMARY KEY,
	nia integer NOT NULL
);

