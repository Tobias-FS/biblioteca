CREATE TABLE livro (
    id                  INT             NOT NULL    AUTO_INCREMENT,
    codigo              VARCHAR(6)      NOT NULL,
    titulo              VARCHAR(100)    NOT NULL,
    autor               VARCHAR(100),
    ano_publicacao      DATE,
    genero              VARCHAR(50),
    numero_de_paginas   INT             NOT NULL,
    quantidade          INT             NOT NULL,
    cadastrado_em       DATETIME        DEFAULT CURRENT_TIMESTAMP,

    CONSTRAINT `pk_livro`
        PRIMARY kEY ( id )
) Engine=Innodb;