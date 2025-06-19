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

📌 ### Exemplo de documento de aposta:

{
  "_id": ObjectId("66af987c5e4c8c1234567890"),
  "nome_apostador": "Carlos Souza",
  "data_aposta": ISODate("2025-06-18T00:00:00Z"),
  "tipo_aposta": "simples",
  "concurso_numero": 123,
  "numeros_apostados": [10, 20, 30, 40, 50]
}

📌 ### Exemplo de documento do concurso:

{
  "_id": ObjectId("66af98855e4c8c1234567891"),
  "concurso_numero": 123,
  "data_sorteio": ISODate("2025-06-19T00:00:00Z"),
  "numeros_sorteados": [10, 20, 30, 40, 50],
  "premiacao": "R$ 500.000,00"
}

