CREATE TABLE public.status (
    id INTEGER UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    name varchar(255)
);

CREATE TABLE public.main (
    id INTEGER UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    firstname varchar(255),
    surname varchar(255),
    company varchar(255),
    status INTEGER UNSIGNED NOT NULL REFERENCES public.status (id),
    is_broker INTEGER GENERATED ALWAYS AS (IF(status IN (1, 2), 1, 0)) STORED
) ENGINE = InnoDB;

INSERT INTO public.status (id, name)
VALUES (1, 'Broker'), (2, 'Subbroker'), (3, 'Customer'), (4, 'Ex-Customer');