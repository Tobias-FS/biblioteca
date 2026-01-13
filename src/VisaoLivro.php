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
        echo json_encode( [ 'mensagem' => 'Cadastrado com sucesso.' ] );
    }

    public function exibirAtualizadoComSucesso() {
        header('Content-Type: application/json');
        http_response_code( 200 );
        echo json_encode( [ 'mensagem' => 'Atualizado com sucesso.' ] );
    }

    public function exibirRemovidoComSucesso() {
        header('Content-Type: application/json');
        http_response_code( 200 );
        echo json_encode( [ 'mensagem' => 'Removido com sucesso.' ] );
    }

    public function exibirLivro( $livro ) {
        header('Content-Type: application/json');
        echo json_encode( [ 'livros' => $livro ] );
    }

    public function exibirErroRotaNaoEncontrada() {
        http_response_code(404);
        header('Content-Type: application/json');
        echo json_encode([
            'mensagem' => 'Rota não encontrada'
        ]);
    }
}