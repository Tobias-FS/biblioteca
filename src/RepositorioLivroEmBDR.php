<?php

class RepositorioLivroEmBDR implements RepositorioLivro {

    private $pdo = null;

    public function __construct( PDO $pdo ) {
        $this->pdo = $pdo;
    }

    public function salvar( Livro $livro ) {
        try {
            error_log( print_r( $livro, true ) );
            $sql = 'INSERT INTO livro ( codigo, titulo, autor, ano_publicacao , genero, numero_de_paginas, quantidade )
                        VALUES ( :codigo, :titulo, :autor, :ano_publicacao , :genero, :numero_de_paginas, :quantidade )';
            $ps = $this->pdo->prepare( $sql );
            $ps->execute( [
                'codigo' => $livro->codigo,
                'titulo' => $livro->titulo, 
                'autor' => $livro->autor,
                'ano_publicacao' => $livro->anoPublicacao, 
                'genero' => $livro->genero,
                'numero_de_paginas' => $livro->numeroDePaginas,
                'quantidade' => $livro->quantidade               
            ] );

            $id = $this->pdo->lastInsertId();

            return $id;
        } catch ( PDOException $e ) {
            throw new RepositorioException( 'Erro ao cadastrar livro. ' );
        }
    }
}