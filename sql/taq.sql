
CREATE TABLE taquillas (
	id serial PRIMARY KEY,
	num_taquilla integer,
	campus smallint,
	edificio smallint,
	planta smallint,
	zona char(2),
	tipo varchar(20) NOT NULL,
	estado smallint DEFAULT 1,
	user_id integer,
	fecha date,
	UNIQUE (num_taquilla, campus_id, edificio_id)
);

CREATE TABLE taquillas2013_2014 (
	id serial PRIMARY KEY,
        num_taquilla integer,
        campus smallint,
        edificio smallint,
        planta smallint,
        zona char(2),
        tipo varchar(20) NOT NULL,
        estado smallint DEFAULT 1,
        user_id integer,
        fecha date,
        UNIQUE (num_taquilla, campus_id, edificio_id)
);

CREATE TABLE sanciones (
	user_id integer PRIMARY KEY,
	fecha_sancion date,
	taquilla_id integer, 
);
