<?php
require 'bd.php';

$id = $_GET['id'] ?? null;

if (!$id) {
  die('ID da aposta não informado.');
}

$aposta = $colecao_apostas->findOne(['_id' => new MongoDB\BSON\ObjectId($id)]);

if (!$aposta) {
  die('Aposta não encontrada.');
}

$numeros = implode(',', $aposta['numeros_apostados']->getArrayCopy());
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <title>Editar Aposta</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
</head>
<body class="p-5">
  <h3>Editar Aposta</h3>
  <form action="salvar_edicao.php" method="post">
    <input type="hidden" name="id" value="<?= $id ?>">

    <div class="form-group">
      <label>Nome do Apostador:</label>
      <input type="text" name="nome_apostador" class="form-control" value="<?= htmlspecialchars($aposta['nome_apostador']) ?>">
    </div>

    <div class="form-group">
      <label>Tipo da Aposta:</label>
      <select name="tipo_aposta" class="form-control">
        <option value="simples" <?= $aposta['tipo_aposta'] == 'simples' ? 'selected' : '' ?>>Simples</option>
        <option value="multipla_6" <?= $aposta['tipo_aposta'] == 'multipla_6' ? 'selected' : '' ?>>Múltipla 6 números</option>
        <option value="multipla_7" <?= $aposta['tipo_aposta'] == 'multipla_7' ? 'selected' : '' ?>>Múltipla 7 números</option>
        <option value="multipla_8" <?= $aposta['tipo_aposta'] == 'multipla_8' ? 'selected' : '' ?>>Múltipla 8 números</option>
        <option value="multipla_9" <?= $aposta['tipo_aposta'] == 'multipla_9' ? 'selected' : '' ?>>Múltipla 9 números</option>
        <option value="multipla_10" <?= $aposta['tipo_aposta'] == 'multipla_10' ? 'selected' : '' ?>>Múltipla 10 números</option>
        <option value="multipla_11" <?= $aposta['tipo_aposta'] == 'multipla_11' ? 'selected' : '' ?>>Múltipla 11 números</option>
        <option value="multipla_12" <?= $aposta['tipo_aposta'] == 'multipla_12' ? 'selected' : '' ?>>Múltipla 12 números</option>
        <option value="multipla_13" <?= $aposta['tipo_aposta'] == 'multipla_13' ? 'selected' : '' ?>>Múltipla 13 números</option>
        <option value="multipla_14" <?= $aposta['tipo_aposta'] == 'multipla_14' ? 'selected' : '' ?>>Múltipla 14 números</option>
        <option value="multipla_15" <?= $aposta['tipo_aposta'] == 'multipla_15' ? 'selected' : '' ?>>Múltipla 15 números</option>
      </select>
    </div>

    <div class="form-group">
      <label>Números apostados (separados por vírgula):</label>
      <input type="text" name="numeros_apostados" class="form-control" value="<?= htmlspecialchars($numeros) ?>">
    </div>

    <div class="form-group">
      <label>Concurso:</label>
      <input type="number" name="concurso_numero" class="form-control" value="<?= $aposta['concurso_numero'] ?>">
    </div>

    <button type="submit" class="btn btn-primary">Salvar Alterações</button>
  </form>
</body>
</html>
