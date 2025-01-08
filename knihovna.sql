CREATE DATABASE knihovna;

USE knihovna;

CREATE TABLE uzivatele (
    id INT AUTO_INCREMENT PRIMARY KEY,
    jmeno VARCHAR(100) NOT NULL,
    prijmeni VARCHAR(100) NOT NULL,
    email VARCHAR(100) UNIQUE NOT NULL,
    adresa VARCHAR(255) NOT NULL,
    uzivatelske_jmeno VARCHAR(50) UNIQUE NOT NULL,
    heslo VARCHAR(255) NOT NULL
);


CREATE TABLE knihy (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nazev VARCHAR(200) NOT NULL,
    autor VARCHAR(100) NOT NULL,
    datum_vydani DATE NOT NULL,
    pocet_stran INT NOT NULL,
    nakladatelstvi VARCHAR(200) NOT NULL,
    pocet_kusu INT DEFAULT 5,
    dostupnost BOOLEAN DEFAULT TRUE
);


CREATE TABLE vypujcky (
    id INT AUTO_INCREMENT PRIMARY KEY,
    id_knihy INT NOT NULL,
    id_uzivatele INT NOT NULL,
    datum_vypujceni DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    datum_vraceni DATETIME,
    FOREIGN KEY (id_knihy) REFERENCES knihy(id),
    FOREIGN KEY (id_uzivatele) REFERENCES uzivatele(id)
);


CREATE TABLE rezervace (
    id INT AUTO_INCREMENT PRIMARY KEY,
    id_knihy INT NOT NULL,
    id_uzivatele INT NOT NULL,
    datum_rezervace DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    platnost_do DATETIME NOT NULL,
    FOREIGN KEY (id_knihy) REFERENCES knihy(id),
    FOREIGN KEY (id_uzivatele) REFERENCES uzivatele(id)
);


INSERT INTO knihy (nazev, autor, datum_vydani, pocet_stran, nakladatelstvi, pocet_kusu) VALUES
('Kniha 1', 'Autor 1', '2020-01-01', 300, 'Nakladatelství 1', 5),
('Kniha 2', 'Autor 2', '2019-06-15', 200, 'Nakladatelství 2', 5),
('Kniha 3', 'Autor 3', '2018-11-10', 400, 'Nakladatelství 3', 5),
('Kniha 4', 'Autor 4', '2021-03-20', 150, 'Nakladatelství 4', 5),
('Kniha 5', 'Autor 5', '2022-08-25', 250, 'Nakladatelství 5', 5);