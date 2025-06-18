<?php
require 'vendor/autoload.php';

try {
    $cliente = new MongoDB\Client("mongodb://localhost:27017");
    $banco = $cliente->loteria;
    $colecao_apostas = $banco->apostas;
} catch (Exception $e) {
    die("Erro ao conectar ao MongoDB: " . $e->getMessage());
}
?>
