<?php
require 'vendor/autoload.php';

$cliente = new MongoDB\Client("mongodb://localhost:27017");
$colecao = $cliente->loteria->apostas;

$nome = $_POST['nome_apostador'];
$data = $_POST['data_aposta'];
$tipo = $_POST['tipo_aposta'];
$numeros = array_map('intval', explode(',', $_POST['numeros_apostados']));
$concurso = intval($_POST['concurso_numero']);

// Validação: 5 a 15 números entre 1 e 80
$validos = array_filter($numeros, fn($n) => $n >= 1 && $n <= 80);
if (count($validos) < 5 || count($validos) > 15) {
    die("Erro: Você deve apostar de 5 a 15 números entre 1 e 80.");
}

$documento = [
    "nome_apostador" => $nome,
    "data_aposta" => new MongoDB\BSON\UTCDateTime(strtotime($data) * 1000),
    "tipo_aposta" => $tipo,
    "numeros_apostados" => $validos,
    "concurso_numero" => $concurso
];

$colecao->insertOne($documento);

echo "<h3>Aposta registrada com sucesso!</h3>";
echo "<a href='registrar_aposta.php'>Voltar</a>";
?>
