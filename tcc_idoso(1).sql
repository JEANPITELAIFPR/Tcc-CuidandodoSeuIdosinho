/* tcc_idoso(1): */

CREATE TABLE Cad_idoso (
    ID_idoso SMALLINT AUTO_INCREMENT PRIMARY KEY,
    Nome VARCHAR(50) Not null,
    Datanascimento DATE Not null,
    Peso FLOAT,
    Tamanho FLOAT,
    Contatos_emergencia VARCHAR(50),
    FK_CRM_medico SMALLINT,
    FK_Cuidador SMALLINT
);

CREATE TABLE Cuidador (
    ID SMALLINT AUTO_INCREMENT PRIMARY KEY,
    Nome VARCHAR (50) Not null,
    Idade DATE,
    Formação VARCHAR(50),
    Senha VARCHAR(50)
);

CREATE TABLE Cadas_medicamento (
    ID SMALLINT AUTO_INCREMENT PRIMARY KEY,
    Nome VARCHAR(50),
    Quantidade NUMERIC
);

CREATE TABLE Cadas_medico (
    CRM SMALLINT PRIMARY KEY,
    Nome VARCHAR(50) Not null,
    Contato VARCHAR (25) Not null,
    Email VARCHAR (35) Not null
);

CREATE TABLE idoso_medicamento (
    ID SMALLINT AUTO_INCREMENT PRIMARY KEY,
    FK_ID_Medicamento SMALLINT,
    FK_ID_Idoso SMALLINT,
    Quantidade SMALLINT(50) Not null
);

CREATE TABLE Requisitos_Mate (
    ID SMALLINT AUTO_INCREMENT PRIMARY KEY,
    FK_ID_idoso SMALLINT,
    Requisitos VARCHAR(250)
);

CREATE TABLE Prontuario (
    ID SMALLINT AUTO_INCREMENT PRIMARY KEY,
    Data DATE,
    Hora TIME,
    Ocorrencias TEXT,
    FK_Idoso SMALLINT,
    FK_Cuidador SMALLINT
);
 
ALTER TABLE Cad_idoso ADD CONSTRAINT FK_Cad_idoso_2
    FOREIGN KEY (FK_CRM_medico)
    REFERENCES Cadas_medico (CRM);
 
ALTER TABLE Cad_idoso ADD CONSTRAINT FK_Cad_idoso_3
    FOREIGN KEY (FK_Cuidador)
    REFERENCES Cuidador (ID);
 
ALTER TABLE idoso_medicamento ADD CONSTRAINT FK_idoso_medicamento_2
    FOREIGN KEY (FK_ID_Medicamento)
    REFERENCES Cadas_medicamento (ID);
 
ALTER TABLE idoso_medicamento ADD CONSTRAINT FK_idoso_medicamento_3
    FOREIGN KEY (FK_ID_Idoso)
    REFERENCES Cad_idoso (ID_idoso);
 
ALTER TABLE Requisitos_Mate ADD CONSTRAINT FK_Requisitos_Mate_2
    FOREIGN KEY (FK_ID_idoso)
    REFERENCES Cad_idoso (ID_idoso);
 
ALTER TABLE Prontuario ADD CONSTRAINT FK_Prontuario_2
    FOREIGN KEY (FK_Idoso)
    REFERENCES Cad_idoso (ID_idoso);
 
ALTER TABLE Prontuario ADD CONSTRAINT FK_Prontuario_3
    FOREIGN KEY (FK_Cuidador)
    REFERENCES Cuidador (ID);