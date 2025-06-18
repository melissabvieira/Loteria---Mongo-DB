<?php
require 'bd.php'; 

$tipo_aposta = $_POST['tipo_aposta'] ?? null;

$tipos = [
  'simples' => [
    'nome' => 'Simples',
    'qtd_numeros' => 5,
    'preco' => 2.50
  ],
  'multipla_1' => [
    'nome' => 'Múltipla',
    'qtd_numeros' => 6,
    'preco' => 15.00
  ],
  'multipla_2' => [
    'nome' => 'Múltipla',
    'qtd_numeros' => 8,
    'preco' => 90.00
  ]
];

$dados_tipo = $tipos[$tipo_aposta] ?? null;
if (!$dados_tipo) {
  die("Tipo de aposta inválido.");
}

$numeros_str = $_POST['numeros_apostados'] ?? '';
$numeros = array_filter(array_map('intval', explode(',', $numeros_str)));

if (count($numeros) != $dados_tipo['qtd_numeros']) {
  die("Erro: Para o tipo de aposta '{$dados_tipo['nome']}', você deve escolher exatamente {$dados_tipo['qtd_numeros']} números.");
}

$aposta = [
  'nome_apostador' => $_POST['nome_apostador'] ?? 'Anônimo',
  'data_aposta' => new MongoDB\BSON\UTCDateTime(),
  'tipo_aposta' => $tipo_aposta,
  'numeros_apostados' => $numeros,
  'preco' => $dados_tipo['preco'],
  'concurso_numero' => intval($_POST['concurso_numero'] ?? 0)
];

$colecao_apostas->insertOne($aposta);
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <title>Aposta Registrada</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
</head>
<body class="p-5">

<div class="alert alert-success" role="alert">
  ✅ <strong>Aposta registrada com sucesso!</strong>
</div>

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>

</body>
</html>
