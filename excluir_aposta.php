<?php
require 'bd.php';

$id = $_GET['id'] ?? null;

if (!$id) {
  die('ID da aposta não informado.');
}

try {
  $colecao_apostas->deleteOne(['_id' => new MongoDB\BSON\ObjectId($id)]);
  $mensagem = "✅ Aposta excluída com sucesso!";
} catch (Exception $e) {
  $mensagem = "❌ Erro ao excluir a aposta: " . $e->getMessage();
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <title>Excluir Aposta</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
</head>
<body class="p-5">

<div class="alert alert-info" role="alert">
  <?= $mensagem ?>
</div>

<?php if (strpos($mensagem, 'sucesso') !== false): ?>
  <a href="minhas_apostas.php" class="btn btn-success">Voltar para Apostas</a>
<?php endif; ?>

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>

</body>
</html>
