<?php
require 'bd.php'; //Ele está importando a conexão
$cursor = $colecao_apostas->find([], ['sort' => ['data_aposta' => -1]]); //Buscando todas as apostas ordenadas da mais recente para a mais antiga
$apostas = iterator_to_array($cursor); //transformando o resultado num array PHP comum
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <title>Minhas Apostas</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
  <style>
    body {
      padding-top: 80px;
      background-color: #f9f9f9;
      font-family: Arial, sans-serif;
    }

    header {
      background-color: rgb(90, 43, 201);
      color: white;
      padding: 20px 42px;
      position: fixed;
      top: 0;
      width: 100%;
      display: flex;
      justify-content: space-between;
      align-items: center;
      z-index: 1000;
    }

    footer {
      background-color: rgb(90, 43, 201);
      color: white;
      padding: 15px 40px;
      text-align: center;
      position: fixed;
      bottom: 0;
      width: 100%;
    }

    .container {
      max-width: 800px;
      margin: auto;
    }

    .card {
      margin-bottom: 20px;
    }

    .acoes {
      margin-bottom: 30px;
    }

    .acoes div {
      background-color: white;
      color: rgb(90, 43, 201);
      padding: 6px 12px;
      border-radius: 5px;
      font-weight: bold;
      display: inline-block;
      cursor: pointer;
      text-align: center;
    }

    .acoes a {
      text-decoration: none;
    }
  </style>
</head>
<body>

<header>
  <h4>Apostas</h4>
  <div class="acoes">
  <a href="home.php"><div>Voltar</div></a>
</header>


  <?php if (count($apostas) === 0): ?>
    <div class="alert alert-info">Nenhuma aposta registrada.</div>
  <?php else: ?>
    <?php foreach ($apostas as $aposta): ?>
      <div class="card">
        <div class="card-body">
          <h5 class="card-title"><?= htmlspecialchars($aposta['nome_apostador']) ?></h5>
          <p class="card-text">
  <strong>Tipo:</strong> <?= htmlspecialchars($aposta['tipo_aposta']) ?><br>
  <strong>Concurso:</strong> <?= htmlspecialchars($aposta['concurso_numero']) ?><br>
  <strong>Números:</strong> <?= implode(', ', $aposta['numeros_apostados']->getArrayCopy()) ?><br>
  <strong>Data:</strong>
  <?= isset($aposta['data_aposta']) && $aposta['data_aposta'] instanceof MongoDB\BSON\UTCDateTime
      ? $aposta['data_aposta']->toDateTime()->format('d/m/Y') : 'Indefinida' ?>
  </p>
  <div>
  <a href="editar_aposta.php?id=<?= $aposta['_id'] ?>" class="btn btn-warning btn-sm">Editar</a>
  <a href="excluir_aposta.php?id=<?= $aposta['_id'] ?>" class="btn btn-danger btn-sm"
     onclick="return confirm('Tem certeza que deseja excluir esta aposta?');">Excluir</a>
      </div>
        </div>
      </div>
    <?php endforeach; ?>
  <?php endif; ?>
</main>

<footer>
  &copy; 2025 - Quina Loteria Digital
</footer>

</body>
</html>
