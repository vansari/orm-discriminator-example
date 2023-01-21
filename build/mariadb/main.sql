CREATE TABLE public.main (
    id INTEGER UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    firstname varchar(255),
    surname varchar(255),
    company varchar(255),
    status ENUM ('Customer', 'Ex-Customer', 'Broker', 'Subbroker'),
    is_broker INTEGER GENERATED ALWAYS AS (IF(status IN ('Broker', 'Subbroker'), 1, 2)) STORED
) ENGINE = InnoDB;