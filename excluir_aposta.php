<?php
require 'bd.php';

$id = $_GET['id'] ?? null;

if (!$id) {
  die('ID da aposta não informado.');
}

try {
  $colecao_apostas->deleteOne(['_id' => new MongoDB\BSON\ObjectId($id)]);
} catch (Exception $e) {
  die('Erro ao excluir a aposta: ' . $e->getMessage());
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <title>Aposta Excluída</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
</head>
<body class="p-5">
  <div class="alert alert-success" role="alert">
    ✅ <strong>Aposta excluída com sucesso!</strong>
  </div>
</body>
</html>
