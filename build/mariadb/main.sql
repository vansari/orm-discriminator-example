CREATE TABLE public.main (
    id INTEGER UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    firstname varchar(255),
    surname varchar(255),
    company varchar(255),
    status ENUM ('Customer', 'Ex-Customer', 'Broker', 'Subbroker'),
    is_broker bool GENERATED ALWAYS AS (status IN ('Broker', 'Subbroker')) STORED
) ENGINE = InnoDB;