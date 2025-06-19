<?php
require 'vendor/autoload.php';
require 'bd.php';

$concursos = $colecao_concursos->find([], ['sort' => ['numero_concurso' => -1], 'limit' => 3]);
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Registrar Aposta - Quina</title>

  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" />

  <style>
    body {
      font-family: Arial, sans-serif;
      margin: 0;
      padding-top: 80px;
      padding-bottom: 60px;
      background-color: #f8f9fa;
      overflow-y: auto;
    }

    header {
      background-color: rgb(90, 43, 201);
      color: white;
      padding: 20px 40px;
      position: fixed;
      top: 0;
      width: 100%;
      display: flex;
      justify-content: space-between;
      align-items: center;
      z-index: 1000;
    }

    .logo {
      font-weight: bold;
      font-size: 20px;
    }

    .acoes {
      display: flex;
      gap: 15px;
    }

    .acoes div {
      background-color: white;
      color: rgb(90, 43, 201);
      padding: 6px 12px;
      border-radius: 5px;
      font-weight: bold;
      cursor: pointer;
    }

    main {
      max-width: 700px;
      margin: 0 auto;
      background: white;
      padding: 30px;
      border-radius: 10px;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.05);
    }

    h2 {
      text-align: center;
      color: rgb(90, 43, 201);
      margin-bottom: 20px;
    }

    label {
      font-weight: bold;
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

    input[type="submit"] {
      background-color: rgb(90, 43, 201);
      color: white;
      border: none;
      padding: 10px 20px;
      margin-top: 20px;
      width: 100%;
      border-radius: 5px;
      font-size: 16px;
    }

    input[type="submit"]:hover {
      background-color: rgb(70, 30, 180);
    }

    .noticia-card {
      background-color: #ffffff;
      border-left: 6px solid rgb(90, 43, 201);
      padding: 15px;
      margin-bottom: 15px;
      box-shadow: 0 2px 6px rgba(0,0,0,0.1);
    }

    .noticia-card h5 {
      margin-top: 0;
      color: rgb(90, 43, 201);
    }
  </style>
</head>
<body>

<header>
  <div class="logo">QUINA</div>
  <div class="acoes">
    <a href="minhas_apostas.php"><div>Apostas</div></a>
    <a href="concursos.php"><div>Registrar concurso</div></a>
  </div>
</header>

<main>

  <section>
    <?php foreach ($concursos as $concurso): ?>
      <div class="noticia-card">
        <h5>Concurso <?= $concurso['numero_concurso'] ?? '' ?></h5>

        <p><strong>Data do Sorteio:</strong>
       <?php
        if (isset($concurso['data_sorteio']) && $concurso['data_sorteio'] instanceof MongoDB\BSON\UTCDateTime) {
       echo $concurso['data_sorteio']->toDateTime()->format('d/m/Y');
      } else {
       echo 'Data não informada';
      }
          ?>
        </p>

        <p><strong>Números Sorteados:</strong>
          <?php
          if (isset($concurso['numeros_sorteados']) && $concurso['numeros_sorteados'] instanceof MongoDB\Model\BSONArray) {
              echo implode(', ', $concurso['numeros_sorteados']->getArrayCopy());
          } elseif (isset($concurso['numeros_sorteados']) && is_array($concurso['numeros_sorteados'])) {
              echo implode(', ', $concurso['numeros_sorteados']);
          } else {
              echo 'Ainda não sorteado';
          }
          ?>
        </p>

        <p><strong>Premiação:</strong> <?= $concurso['premiacao'] ?? 'Não informada' ?></p>
      </div>
    <?php endforeach; ?>
  </section>

  <h2>Registrar Aposta - Quina</h2>
  <form action="salvar_aposta.php" method="POST">
    <div class="form-group">
      <label for="nome_apostador">Nome do Apostador</label>
      <input type="text" class="form-control" name="nome_apostador" required>
    </div>

    <div class="form-group">
      <label for="data_aposta">Data da Aposta</label>
      <input type="date" class="form-control" name="data_aposta" required>
    </div>

    <div class="form-group">
      <label for="tipo_aposta">Tipo de Aposta</label>
      <select class="form-control" name="tipo_aposta" required>
        <option value="" disabled selected>Selecione o tipo de aposta</option>
        <option value="simples">Simples - 5 números (R$ 2,50)</option>
        <option value="multipla_6">Múltipla - 6 números (R$ 15,00)</option>
        <option value="multipla_7">Múltipla - 7 números (R$ 52,50)</option>
        <option value="multipla_8">Múltipla - 8 números (R$ 140,00)</option>
        <option value="multipla_9">Múltipla - 9 números (R$ 315,00)</option>
        <option value="multipla_10">Múltipla - 10 números (R$ 630,00)</option>
        <option value="multipla_11">Múltipla - 11 números (R$ 1.155,00)</option>
        <option value="multipla_12">Múltipla - 12 números (R$ 1.980,00)</option>
        <option value="multipla_13">Múltipla - 13 números (R$ 3.217,50)</option>
        <option value="multipla_14">Múltipla - 14 números (R$ 4.872,00)</option>
        <option value="multipla_15">Múltipla - 15 números (R$ 7.507,50)</option>
      </select>
    </div>

    <div class="form-group">
      <label for="numeros_apostados">Números Apostados (5 a 15 números entre 1 e 80, separados por vírgula)</label>
      <input type="text" class="form-control" name="numeros_apostados" placeholder="Ex: 5,12,34,55,70" required>
    </div>

    <div class="form-group">
      <label for="concurso_numero">Número do Concurso</label>
      <input type="number" class="form-control" name="concurso_numero" required>
    </div>

    <input type="submit" value="Registrar Aposta">
  </form>

</main>

<footer>
  &copy; 2025 - Quina Loteria Digital
</footer>

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>

</body>
</html>
