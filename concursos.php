<?php
require 'bd.php';

$mensagem = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $concurso_numero = intval($_POST['concurso_numero'] ?? 0);
    $data_sorteio = $_POST['data_sorteio'] ?? '';
    $numeros_str = $_POST['numeros_sorteados'] ?? '';
    $premiacao = $_POST['premiacao'] ?? '';

    if ($concurso_numero > 0 && $data_sorteio && $numeros_str && $premiacao) {
        $numeros = array_filter(array_map('intval', explode(',', $numeros_str)));

        try {
            $colecao_concursos->insertOne([
                'concurso_numero' => $concurso_numero,
                'data_sorteio' => new MongoDB\BSON\UTCDateTime(strtotime($data_sorteio) * 1000),
                'numeros_sorteados' => $numeros,
                'premiacao' => $premiacao
            ]);
            $mensagem = "✅ Concurso registrado com sucesso!";
        } catch (Exception $e) {
            $mensagem = "Erro ao salvar concurso: " . $e->getMessage();
        }
    } else {
        $mensagem = "Por favor, preencha todos os campos corretamente.";
    }
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Cadastro de Concurso - Quina</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
    <style>
        body {
            padding: 30px;
            background-color: #f8f9fa;
        }
        h2 {
            color: rgb(90, 43, 201);
        }
    </style>
</head>
<body>

<h2>Cadastro de Concurso - Quina</h2>

<?php if ($mensagem): ?>
    <div class="alert <?= strpos($mensagem, 'sucesso') !== false ? 'alert-success' : 'alert-danger' ?>">
        <?= $mensagem ?>
    </div>
<?php endif; ?>

<form method="POST">
    <div class="form-group">
        <label>Número do Concurso:</label>
        <input type="number" name="concurso_numero" class="form-control" required>
    </div>

    <div class="form-group">
        <label>Data do Sorteio:</label>
        <input type="date" name="data_sorteio" class="form-control" required>
    </div>

    <div class="form-group">
        <label>Números Sorteados (separados por vírgula):</label>
        <input type="text" name="numeros_sorteados" class="form-control" placeholder="Ex: 05,12,34,55,70" required>
    </div>

    <div class="form-group">
        <label>Premiação:</label>
        <input type="text" name="premiacao" class="form-control" placeholder="Ex: R$ 1.000.000,00" required>
    </div>

    <button type="submit" class="btn btn-primary">Salvar Concurso</button>
</form>

<a href="home.php" class="btn btn-secondary mt-3">Voltar</a>

</body>
</html>
