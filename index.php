<?php

require_once __DIR__ . '/vendor/autoload.php';

$url = $_SERVER[ 'REQUEST_URI' ];
$metodo = $_SERVER[ 'REQUEST_METHOD' ];

$pdo = null;
try {
    $pdo = criarConexao();
} catch( PDOException $e ) {
    http_response_code( 503 );
    echo json_encode( 
        [ 'mensagem' => 'Erro ao conetar ao banco de dados', 'codigo' => 503 ] );
}

$regexUrl = '/^\/livros\/?$/';
$regexID = '/^\/livros\/[0-9]+\/?$/';

$controladora = new ControladoraLivros( $pdo );

if ( $metodo == 'POST' && preg_match( $regexUrl, $url ) ) {
    $controladora->adicionar();
}