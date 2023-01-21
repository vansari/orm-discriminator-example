CREATE SCHEMA public;

CREATE TYPE public.status AS ENUM (
    'Customer', 'Ex-Customer', 'Broker', 'Subbroker'
);

CREATE TABLE public.main (
    id INT GENERATED ALWAYS AS IDENTITY PRIMARY KEY,
    firstname varchar(255),
    surname varchar(255),
    company varchar(255),
    status public.status NOT NULL,
    is_broker bool GENERATED ALWAYS AS (status IN ('Broker', 'Subbroker')) STORED
);