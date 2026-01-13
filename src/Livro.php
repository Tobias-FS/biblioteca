<?php

class Livro {
    public function __construct(
        public $id = 0,
        public $codigo = 0,
        public $titulo = '',
        public $autor = '',
        public $anoPublicacao = '',
        public $genero = '',
        public $numeroDePaginas = 0,
        public $quantidade = 0,
        public $dataCadastro = ''
    ) {
    }

    public function validar() {
        $problemas = [];

        if ( trim( $this->titulo ) === '' ) {
            $problemas []= 'O título é obrigatório.';
        }

        if ( trim( $this->autor ) === '' ) {
            $problemas []= 'O autor é obrigatório.';
        }

        if ( trim( $this->anoPublicacao ) === '' ) {
            $problemas[]= 'O ano de publicação é obrigatório.';
        }

        if ( trim( ( string ) $this->numeroDePaginas ) === '') {
            $problemas []= 'O número de páginas é obrigatório.';
        }

        if ( trim( ( string ) $this->quantidade ) === '') {
            $problemas []= 'A quantidade de exemplares é obrigatória.';
        }

        return $problemas;
    }
}