<?php
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
    }

    header {
      background-color:rgb(52, 223, 200);
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
      color:rgb(52, 223, 200);
      padding: 6px 12px;
      border-radius: 5px;
      font-weight: bold;
      cursor: pointer;
    }

    main {
      max-width: 600px;
      margin: 0 auto;
      background: white;
      padding: 30px;
      border-radius: 10px;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.05);
    }

    h2 {
      text-align: center;
      color:rgb(52, 223, 200);
      margin-bottom: 20px;
    }

    label {
      font-weight: bold;
    }

    footer {
      background-color:rgb(52, 223, 200);
      color: white;
      padding: 15px 40px;
      text-align: center;
      position: fixed;
      bottom: 0;
      width: 100%;
    }

    input[type="submit"] {
      background-color:rgb(52, 223, 200);
      color: white;
      border: none;
      padding: 10px 20px;
      margin-top: 20px;
      width: 100%;
      border-radius: 5px;
      font-size: 16px;
    }

    input[type="submit"]:hover {
      background-color:rgb(52, 223, 200);
    }
  </style>
</head>
<body>

<header>
  <div class="logo">QUINA</div>
  <div class="acoes">
    <a href="home.php"><div>Home</div></a>
    <a href="minhas_apostas.php"><div>Ver Apostas</div></a>
  </div>
</header>

<main>
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
  <label for="tipo_aposta">Tipo de aposta</label>
  <select class="form-control" name="tipo_aposta" id="tipo_aposta" required>
    <option value="" disabled selected>Selecione o tipo de aposta</option>
    <option value="simples">Simples - 5 números (R$ 2,50)</option>
    <option value="multipla_1">Múltipla - 6 números (R$ 15,00)</option>
    <option value="multipla_2">Múltipla - 8 números (R$ 90,00)</option>
  </select>
    </div>


    <div class="form-group">
      <label for="numeros_apostados">Números Apostados (5 a 8 números entre 1 e 80, separados por vírgula)</label>
      <input type="text" class="form-control" name="numeros_apostados" placeholder="Ex: 5,12,34,55,70" required>
    </div>

    <div class="form-group">
      <label for="concurso_numero">Número do Concurso</label>
      <input type="number" class="form-control" name="concurso_numero" required>
    </div>

    <input type="hidden" name="tipo_aposta" value="Quina">

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
