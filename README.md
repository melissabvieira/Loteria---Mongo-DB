### 📌Loteria escolhida: Quina

A Quina é um jogo de loteria da Caixa Econômica Federal, no qual o apostador escolhe de 5 a 15 números, dentre os 80 disponíveis (numerados de 1 a 80).

Regras básicas:
Números sorteados por concurso: Sempre 5 números.

Ganha quem acertar:

2 acertos: Duque

3 acertos: Terno

4 acertos: Quadra

5 acertos ou mais: Quina

Se um apostador acertar mais de 5 números, ainda assim ele é considerado como ganhador da faixa máxima (Quina).

### Processo de apuração (Verificação de ganhadores)
Como identificar os vencedores:
Para cada aposta, compara os números apostados com os números sorteados do concurso correspondente.
Verifica quantos números da aposta existem dentro do array de números sorteados.

### Classificação da premiação por faixa:

function verificarFaixaPremio($acertos) {
    switch ($acertos) {
        case 2: return "Duque";
        case 3: return "Terno";
        case 4: return "Quadra";
        case 5:
        default: return "Quina";
    }
}

###📌Exemplo de documento de aposta:

{
  
_id
685200fd25adfba701088c36
nome_apostador
"Melissa"
data_aposta
2025-06-17T23:57:49.163+00:00
tipo_aposta
"simples"

numeros_apostados
Array (5)
preco
2.5
concurso_numero
2
}

###📌Exemplo de documento do concurso:

{
 _id
6854663241d2a0d3f8000a45
concurso_numero
2
data_sorteio
2025-06-18T22:00:00.000+00:00

numeros_sorteados
Array (5)
premiacao
"R$1.500,000,00"
}

