CREATE DATABASE knihovna;


USE knihovna;


CREATE TABLE IF NOT EXISTS uzivatele (
    id INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
    jmeno VARCHAR(100) NOT NULL,
    prijmeni VARCHAR(100) NOT NULL,
    email VARCHAR(100) UNIQUE NOT NULL,
    adresa VARCHAR(255) NOT NULL,
    uzivatelske_jmeno VARCHAR(50) UNIQUE NOT NULL,
    heslo VARCHAR(100) NOT NULL,
    role ENUM('customer','admin') DEFAULT 'customer' NOT NULL
)
ENGINE = InnoDB;


CREATE TABLE knihy (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nazev VARCHAR(200) NOT NULL,
    autor VARCHAR(100) NOT NULL,
    datum_vydani DATE NOT NULL,
    pocet_stran INT NOT NULL,
    nakladatelstvi VARCHAR(200) NOT NULL,
    pocet_kusu INT DEFAULT 5,
    dostupnost BOOLEAN DEFAULT TRUE
)
ENGINE = InnoDB;


CREATE TABLE vypujcky (
    id INT AUTO_INCREMENT PRIMARY KEY,
    id_knihy INT NOT NULL,
    id_uzivatele INT NOT NULL,
    datum_vypujceni DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    datum_vraceni DATETIME,
    FOREIGN KEY (id_knihy) REFERENCES knihy(id),
    FOREIGN KEY (id_uzivatele) REFERENCES uzivatele(id)
)
ENGINE = InnoDB;


CREATE TABLE rezervace (
    id INT AUTO_INCREMENT PRIMARY KEY NOT NULL,
    id_knihy INT NOT NULL,
    id_uzivatele INT NOT NULL,
    datum_rezervace DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    platnost_do DATETIME NOT NULL,
    FOREIGN KEY (id_knihy) REFERENCES knihy(id),
    FOREIGN KEY (id_uzivatele) REFERENCES uzivatele(id)
)
ENGINE = InnoDB;



INSERT INTO knihy (nazev, autor, datum_vydani, pocet_stran, nakladatelstvi, pocet_kusu) VALUES
('1984', 'George Orwell', '1949', '328', 'Secker & Warburg', 5),
('Malý princ', 'Antoine de Saint-Exupéry', '1943', '96', 'Reynal & Hitchcock', 5),
('Sto roků samoty', 'Gabriel García Márquez', '1967', '417', 'Editorial Sudamericana', 5),
('Sapiens: Úchvatný i úděsný příběh lidstva', 'Yuval Noah Harari', '2011', '443', 'Harvill Secker', 5),
('Pýcha a předsudek', 'Jane Austen', '1813', '432', 'T. Egerton', 5);

INSERT INTO uzivatele (jmeno, prijmeni, email, heslo, role)
VALUES ('Radim', 'Micanek', 'micanekradim@seznam.cz', '12345', 'admin');

