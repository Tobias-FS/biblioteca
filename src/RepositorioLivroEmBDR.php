<?php

class RepositorioLivroEmBDR implements RepositorioLivro {

    private $pdo = null;

    public function __construct( PDO $pdo ) {
        $this->pdo = $pdo;
    }

    public function listar() {
        try {
            $sql = 'SELECT * FROM livro';
            $ps = $this->pdo->prepare( $sql );
            $ps->execute();
            $pesquisa = $ps->fetchAll();

            $livros = [];

            foreach( $pesquisa as $p ) {
                $livros []= new Livro(
                    $p[ 'id' ],
                    $p[ 'codigo' ],
                    $p[ 'titulo' ],
                    $p[ 'autor' ],
                    $p[ 'genero' ],
                    $p[ 'ano_publicacao' ],
                    $p[ 'numero_de_paginas' ],
                    $p[ 'quantidade' ],
                    $p[ 'cadastrado_em' ],
                );
            }

            return $livros;
        } catch ( PDOException $e ) {
            throw new RepositorioException( 'Erro ao listar livros', 500 );
        }
    }

    public function listarPeloID( $id ) {
        try {
            $sql = 'SELECT * FROM livro WHERE id = :id';
            $ps = $this->pdo->prepare( $sql );
            $ps->execute( [ 'id' => $id ] );
            $pesquisa = $ps->fetch();

            if ( ! $pesquisa ) {
                throw new RepositorioException( "Livro com id $id não econtrado.", 404 );
            }

            $livro = new Livro(
                $pesquisa[ 'id' ],
                $pesquisa[ 'codigo' ],
                $pesquisa[ 'titulo' ],
                $pesquisa[ 'autor' ],
                $pesquisa[ 'genero' ],
                $pesquisa[ 'ano_publicacao' ],
                $pesquisa[ 'numero_de_paginas' ],
                $pesquisa[ 'quantidade' ],
                $pesquisa[ 'cadastrado_em' ],
            );

            return $livro;
        } catch ( PDOException $e ) {
            throw new RepositorioException( "Erro ao listar livro com id $id", 500 );
        }
    }

    public function existeComId( $id ) {
        try {
            $sql = 'SELECT id FROM livro WHERE id = :id';
            $ps = $this->pdo->prepare( $sql );
            $ps->execute( [ 'id' => $id ] );
            $resultado = $ps->fetch();

            if ( ! $resultado ) {
                throw new RepositorioException( "Livro com id $id não econtrado.", 404 );
            }
        } catch ( PDOException $e ) {
            throw new RepositorioException( "Erro ao listar licro com id $id", 500 );
        }
    }

    public function salvar( Livro $livro ) {
        try {
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
            throw new RepositorioException( 'Erro ao cadastrar livro. ', 500 );
        }
    }

    public function alterar( $id, Livro $livro ) {

        try {
            $sql = 'UPDATE livro 
                        SET codigo = :codigo, titulo = :titulo, autor = :autor, ano_publicacao = :ano_publicacao, 
                            genero = :genero, numero_de_paginas = :numero_de_paginas, quantidade = :quantidade 
                        WHERE id = :id';
            $ps = $this->pdo->prepare( $sql );
            $ps->execute( [
                'codigo' => $livro->codigo,
                'titulo' => $livro->titulo, 
                'autor' => $livro->autor,
                'ano_publicacao' => $livro->anoPublicacao, 
                'genero' => $livro->genero,
                'numero_de_paginas' => $livro->numeroDePaginas,
                'quantidade' => $livro->quantidade,
                'id' => $id               
            ] );
        } catch ( PDOException $e ) {
            throw new RepositorioException( "Erro ao atualizar livro com id $id", 500 );
        }
    }

    public function remover( $id ) {
        try {
            $sql = 'DELETE FROM livro WHERE id = :id';
            $ps = $this->pdo->prepare( $sql );
            $ps->execute( [ 'id' => $id ] );
        } catch ( PDOException $e ) {
            throw new RepositorioException( "Erro ao remover livro com id $id", 500 );
        }
    }
}