<?php
require 'bd.php';

try {
    $concursos = $colecao_concursos->find([], ['sort' => ['concurso_numero' => -1]]);
} catch (Exception $e) {
    die('Erro ao buscar concursos: ' . $e->getMessage());
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Lista de Concursos - Quina</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
    <style>
        body {
            padding: 30px;
            background-color: #f8f9fa;
        }
        h2 {
            color: rgb(90, 43, 201);
        }
        .card {
            margin-bottom: 15px;
        }
    </style>
</head>
<body>

<h2>Concursos Cadastrados</h2>

<?php foreach ($concursos as $concurso): ?>
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Concurso Nº <?= $concurso['concurso_numero'] ?></h5>
            <p class="card-text">
                <strong>Data do Sorteio:</strong>
                <?= $concurso['data_sorteio']->toDateTime()->format('d/m/Y') ?><br>

                <strong>Números Sorteados:</strong>
                <?= implode(', ', $concurso['numeros_sorteados']) ?><br>

                <strong>Premiação:</strong>
                <?= htmlspecialchars($concurso['premiacao']) ?>
            </p>
        </div>
    </div>
<?php endforeach; ?>

<a href="home.php" class="btn btn-secondary mt-3">Voltar</a>

</body>
</html>
