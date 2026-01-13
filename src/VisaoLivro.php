<?php

class VisaoLivro {
    
    public function dados() {
        $dadosRequisicao = json_decode( file_get_contents( 'php://input' ), true );
        error_log( print_r( $dadosRequisicao, true ) );
        return $dadosRequisicao;
    }

    public function exibirCadatradoComSucesso() {
        header( 'Content-Type: application/json' );
        http_response_code( 201 );
        echo json_encode( [ 'mensagem' => 'Cadastrado com sucesso.', 'codigo' => 201 ] );
    }

    public function exibirMensagem( $mensagem, $codigo ) {
        header( 'Content-Type: applicaton/json' );
        http_response_code( $codigo );
        echo json_encode( [ 'mensagem' => $mensagem, 'codigo' => $codigo ] );
    }
}