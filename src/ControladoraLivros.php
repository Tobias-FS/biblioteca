<?php

class ControladoraLivros {

    private $repositorio;
    private $visao;

    public function __construct( PDO $pdo ) {
        $this->repositorio = new RepositorioLivroEmBDR( $pdo );
        $this->visao = new VisaoLivro();
    }

    public function obter() {
        try {
            $livros = $this->repositorio->listar();
            $this->visao->exibirLivro( $livros );
        } catch ( RepositorioException $e ) {
            $this->visao->exibirMensagem( $e->getMessage(), $e->getCode() );
        }

    }

    public function obterComId( $id ) {
        try {
            $livro = $this->repositorio->listarPeloID( $id );
            $this->visao->exibirLivro( $livro );
        } catch ( RepositorioException $e ) {
            $this->visao->exibirMensagem( $e->getMessage(), $e->getCode() );
        }
    }

    public function adicionar() {
        $dados = $this->visao->obterDados();
        
        try {
            $livro = $this->instanciarLivro( $dados );
            
            $id = $this->repositorio->salvar( $livro );
            if ( ! $id ) {
                $this->visao->exibirMensagem( 'Erro ao cadastrar livro', 400 );
            }
            $this->visao->exibirCadatradoComSucesso();
        } catch( RepositorioException $e ) {
            $this->visao->exibirMensagem( $e->getMessage(), $e->getCode() );
        }
    } 

    public function atualizar( $id ) {
        $dados = $this->visao->obterDados();
        
        try {
            $this->repositorio->existeComId( $id );

            $livro = $this->instanciarLivro( $dados );

            $this->repositorio->alterar( $id, $livro );
            $this->visao->exibirAtualizadoComSucesso();
        } catch ( RepositorioException $e ) {
            $this->visao->exibirMensagem( $e->getMessage(), $e->getCode() );
        } catch ( DominioException $e ) {
            $this->visao->exibirMensagem( $e->getMessage(), $e->getCode() );
        }
    }

    private function instanciarLivro( $dados ) {
        $livro = new Livro( 
            0,
            $dados[ 'codigo' ],
            $dados[ 'titulo' ],
            $dados[ 'autor' ],
            $dados[ 'anoPublicacao' ],
            $dados[ 'genero' ],
            (int) $dados[ 'numeroDePaginas' ],
            (int) $dados[ 'quantidade' ]
        );

        $problemas = $livro->validar();

        if ( $problemas ) {
            throw new DominioException( "$problemas", 400 );
            return;
        }

        return $livro;
    }
}