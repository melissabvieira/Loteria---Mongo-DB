<?php
require 'bd.php';

$id = $_POST['id'] ?? null;
if (!$id) {
  die("ID da aposta não informado.");
}

$tipo_aposta = $_POST['tipo_aposta'] ?? null;

$tipos = [
  'simples' => ['nome' => 'Simples', 'qtd_numeros' => 5, 'preco' => 2.50],
  'multipla_6' => ['nome' => 'Múltipla', 'qtd_numeros' => 6, 'preco' => 15.00],
  'multipla_7' => ['nome' => 'Múltipla', 'qtd_numeros' => 7, 'preco' => 52.50],
  'multipla_8' => ['nome' => 'Múltipla', 'qtd_numeros' => 8, 'preco' => 140.00],
  'multipla_9' => ['nome' => 'Múltipla', 'qtd_numeros' => 9, 'preco' => 315.00],
  'multipla_10' => ['nome' => 'Múltipla', 'qtd_numeros' => 10, 'preco' => 630.00],
  'multipla_11' => ['nome' => 'Múltipla', 'qtd_numeros' => 11, 'preco' => 1155.00],
  'multipla_12' => ['nome' => 'Múltipla', 'qtd_numeros' => 12, 'preco' => 1980.00],
  'multipla_13' => ['nome' => 'Múltipla', 'qtd_numeros' => 13, 'preco' => 3217.50],
  'multipla_14' => ['nome' => 'Múltipla', 'qtd_numeros' => 14, 'preco' => 4872.00],
  'multipla_15' => ['nome' => 'Múltipla', 'qtd_numeros' => 15, 'preco' => 7507.50],
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

$atualizacao = [
  'nome_apostador' => $_POST['nome_apostador'] ?? 'Anônimo',
  'data_aposta' => new MongoDB\BSON\UTCDateTime(),
  'tipo_aposta' => $tipo_aposta,
  'numeros_apostados' => $numeros,
  'preco' => $dados_tipo['preco'],
  'concurso_numero' => intval($_POST['concurso_numero'] ?? 0)
];

try {
  $colecao_apostas->updateOne(
    ['_id' => new MongoDB\BSON\ObjectId($id)],
    ['$set' => $atualizacao]
  );
  $mensagem = "✅ Aposta atualizada com sucesso!";
  $alertClass = "alert-success";
} catch (Exception $e) {
  $mensagem = " Erro ao atualizar aposta: " . $e->getMessage();
  $alertClass = "alert-danger";
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8" />
  <title>Editar Aposta</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" />
</head>
<body class="p-5">
  <div class="alert <?= $alertClass ?>" role="alert">
    <?= $mensagem ?>
  </div>

  <?php if (strpos($mensagem, 'sucesso') !== false): ?>
    <a href="minhas_apostas.php" class="btn btn-primary">Voltar para Minhas Apostas</a>
  <?php else: ?>
    <a href="editar_aposta.php?id=<?= htmlspecialchars($id) ?>" class="btn btn-warning">Voltar para edição</a>
  <?php endif; ?>
</body>
</html>
