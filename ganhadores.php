<?php
require 'vendor/autoload.php';
require 'bd.php';

$concurso_numero = isset($_GET['concurso']) ? intval($_GET['concurso']) : 0;

if ($concurso_numero <= 0) {
    die("Número do concurso inválido.");
}


$concurso = $colecao_concursos->findOne(['concurso_numero' => $concurso_numero]);
if (!$concurso) {
    die("Concurso não encontrado.");
}


$numeros_sorteados = [];
if (isset($concurso['numeros_sorteados'])) {
    if ($concurso['numeros_sorteados'] instanceof MongoDB\Model\BSONArray) {
        $numeros_sorteados = $concurso['numeros_sorteados']->getArrayCopy();
    } elseif (is_array($concurso['numeros_sorteados'])) {
        $numeros_sorteados = $concurso['numeros_sorteados'];
    }
}

$apostas_cursor = $colecao_apostas->find(['concurso_numero' => $concurso_numero]);

function calcularTipoGanho($acertos) {
    switch ($acertos) {
        case 2: return "Duque";
        case 3: return "Terno";
        case 4: return "Quadra";
        case 5: return "Quina";
        
        default: return "Sem premiação";
    }
}

?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8" />
    <title>Ganhadores Concurso <?= $concurso_numero ?></title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" />
    <style>
        body { padding: 20px; font-family: Arial, sans-serif; background-color: #f8f9fa; }
        h2 { color: rgb(90, 43, 201); }
        .ganhador-card { background: white; padding: 15px; margin-bottom: 15px; border-radius: 6px; box-shadow: 0 2px 6px rgba(0,0,0,0.1); }
        .sem-premio { color: gray; font-style: italic; }
    </style>
</head>
<body>

<h2>Ganhadores do Concurso Nº <?= $concurso_numero ?></h2>
<p><strong>Data do Sorteio:</strong> 
<?= isset($concurso['data_sorteio']) && $concurso['data_sorteio'] instanceof MongoDB\BSON\UTCDateTime 
    ? $concurso['data_sorteio']->toDateTime()->format('d/m/Y') : 'Indefinida' ?></p>

<p><strong>Números Sorteados:</strong> <?= implode(', ', $numeros_sorteados) ?></p>

<?php
$ganhadores_encontrados = false;

foreach ($apostas_cursor as $aposta) {
    if (isset($aposta['numeros_apostados'])) {
        if ($aposta['numeros_apostados'] instanceof MongoDB\Model\BSONArray) {
            $numeros_apostados = $aposta['numeros_apostados']->getArrayCopy();
        } elseif (is_array($aposta['numeros_apostados'])) {
            $numeros_apostados = $aposta['numeros_apostados'];
        } else {
            $numeros_apostados = [];
        }

        $acertos = count(array_intersect($numeros_apostados, $numeros_sorteados));
        $tipo_ganho = calcularTipoGanho($acertos);

        if ($acertos >= 2) {
            $ganhadores_encontrados = true;
            ?>
            <div class="ganhador-card">
                <strong><?= htmlspecialchars($aposta['nome_apostador'] ?? 'Anônimo') ?></strong><br>
                Números apostados: <?= implode(', ', $numeros_apostados) ?><br>
                Acertos: <strong><?= $acertos ?></strong> (<?= $tipo_ganho ?>)<br>
                Tipo de aposta: <?= htmlspecialchars($aposta['tipo_aposta'] ?? '-') ?><br>
                Data da aposta: <?= isset($aposta['data_aposta']) && $aposta['data_aposta'] instanceof MongoDB\BSON\UTCDateTime
                    ? $aposta['data_aposta']->toDateTime()->format('d/m/Y') : 'Indefinida' ?>
            </div>
            <?php
        }
    }
}

if (!$ganhadores_encontrados) {
    echo '<p class="sem-premio">Nenhum ganhador com pelo menos 2 acertos neste concurso.</p>';
}
?>

<a href="home.php" class="btn btn-secondary mt-3">Voltar</a>

</body>
</html>
