<?php

class VisaoLivro {
    
    public function obterDados() {
        $dadosRequisicao = json_decode( file_get_contents( 'php://input' ), true );
        return $dadosRequisicao;
    }

    public function exibirMensagem( $mensagem, $codigo ) {
        header('Content-Type: application/json');
        http_response_code( $codigo );
        echo json_encode( [ 'mensagem' => $mensagem, 'codigo' => $codigo ] );
    }

    public function exibirCadatradoComSucesso() {
        header('Content-Type: application/json');
        http_response_code( 201 );
        echo json_encode( [ 'mensagem' => 'Cadastrado com sucesso.', 'codigo' => 201 ] );
    }

    public function exibirAtualizadoComSucesso () {
        header('Content-Type: application/json');
        http_response_code( 200 );
        echo json_encode( [ 'mensagem' => 'Atualizado com sucesso.' ] );
    }

    public function exibirLivro( $livro ) {
        header('Content-Type: application/json');
        echo json_encode( [ 'livros' => $livro ] );
    }
}