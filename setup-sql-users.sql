CREATE DATABASE reader_translator;

CREATE TABLE words (
    WordID int NOT NULL AUTO_INCREMENT,
    originWord varchar(255),
    originLanguage varchar(255),
    destinationWord varchar(255),
    destinationLanguage varchar(255),
    PRIMARY KEY (WordID)
);

INSERT INTO words (originWord, originLanguage, destinationWord, destinationLanguage) VALUES ("las", "espanol", "the", "english");

CREATE USER 'reader_translator'@'localhost' IDENTIFIED BY 'password';

GRANT ALL PRIVILEGES ON reader_translator.* TO 'reader_translator'@'localhost' WITH GRANT OPTION;