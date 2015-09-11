
CREATE TABLE taquillas (
	id serial PRIMARY KEY,
	num_taquilla integer,
	campus smallint,
	edificio smallint NOT NULL,
	planta smallint NOT NULL,
	zona char(2) NOT NULL,
	tipo varchar(20) NOT NULL,
	estado smallint DEFAULT 1,
	user_id integer,
	fecha date,
	UNIQUE (num_taquilla, campus, edificio)
);

CREATE TABLE taquillas2013_2014 (
	id serial PRIMARY KEY,
	num_taquilla integer,
	campus smallint NOT NULL,
	edificio smallint NOT NULL,
	planta smallint NOT NULL,
	zona char(2) NOT NULL,
	tipo varchar(20) NOT NULL,
	estado smallint DEFAULT 1,
	user_id integer,
	fecha date,
	UNIQUE (num_taquilla, campus, edificio)
);

CREATE TABLE sanciones (
	user_id integer PRIMARY KEY,
	fecha_sancion date NOT NULL,
	taquilla_id integer NOT NULL 
);
