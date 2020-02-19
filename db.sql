CREATE DATABASE testy;
USE testy;
CREATE TABLE person (id INT NOT NULL AUTO_INCREMENT , first VARCHAR(40), last VARCHAR(40), PRIMARY KEY(id));
DESCRIBE person;
INSERT INTO person (first, last) VALUES ('Brad','Dayley');
INSERT INTO person (first, last) VALUES ('Caleb','Dayley');
