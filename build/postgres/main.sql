CREATE TYPE public.status AS ENUM (
    'Customer', 'Ex-Customer', 'Broker', 'Subbroker'
);

CREATE TABLE public.main (
    id integer GENERATED ALWAYS AS IDENTITY PRIMARY KEY,
    firstname varchar(255),
    surname varchar(255),
    company varchar(255),
    status public.status NOT NULL,
    is_broker integer GENERATED ALWAYS AS (CASE WHEN status IN ('Broker', 'Subbroker') THEN 1 ELSE 2 END) STORED
);