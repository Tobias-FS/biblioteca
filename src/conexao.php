<?php

function criarConexao() {
    return new PDO( 
        'mysql:dbname=biblioteca;host=127.0.0.1;charset=utf8',
        'root',
        '',
        [ PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC ] );
}