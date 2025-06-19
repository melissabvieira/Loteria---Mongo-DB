<?php
require 'vendor/autoload.php';

try {
    $cliente = new MongoDB\Client("mongodb://localhost:27017");
    $banco = $cliente->loteria;
    $colecao_apostas = $banco->apostas;
    $colecao_concursos = $banco->concursos;
} catch (Exception $e) {
    die("Erro ao conectar ao MongoDB: " . $e->getMessage());
}
?>
