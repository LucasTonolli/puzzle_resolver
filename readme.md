# Guide

Este é um método rápido para visualizar seu projeto em um navegador, ideal para testes locais.

### Passo 1: Verificar se o PHP está instalado

Abra seu terminal (Prompt de Comando, PowerShell, etc.) e execute o seguinte comando:

`php -v `

### Passo 2: Inicar o servidor local

1. Pelo terminal, navegue até a pasta onde está o repositório
2. Execute o comando `php -S localhost:8080`

### Passo 3: Verificar o resultado

1.Abra qualquer navegador de internet (Chrome, Firefox, etc.).

2.Acesse o seguinte endereço: http://localhost:8080

## Original

### Wrong pieces: 11

`
$initialState = [
[5, 1, 3, 4],
[9, 0, 6, 8],
[13, 2, 7, 12],
[14, 10, 11, 15]
];

$goalState = [
[1, 2, 3, 4],
[5, 6, 7, 8],
[9, 10, 11, 12],
[13, 14, 15, 0]
];

`

# Testes

| Gerado no Gemini Pro

## Puzzle 3X3

### Wrong pieces: 1

$initialState = [
[1, 2, 3],
[4, 5, 0],
[7, 8, 6]
];

$goalState = [
[1, 2, 3],
[4, 5, 6],
[7, 8, 0]
];

### Wrong pieces: 6

$initialState = [
[4, 1, 3],
[7, 2, 5],
[0, 8, 6]
];

$goalState = [
[1, 2, 3],
[4, 5, 6],
[7, 8, 0]
];

## Puzzle 4X4

### Wrong pieces: 4

$initialState = [
[1, 0, 3, 4],
[5, 6, 7, 8],
[9, 10, 11, 12],
[13, 15, 2, 14]
];

$goalState = [
[1, 2, 3, 4],
[5, 6, 7, 8],
[9, 10, 11, 12],
[13, 14, 15, 0]
];

### Wrong Pieces: 8

$initialState = [
[1, 2, 7, 3],
[5, 6, 11, 4],
[0, 9, 10, 8],
[13, 14, 15, 12]
];

$goalState = [
[1, 2, 3, 4],
[5, 6, 7, 8],
[9, 10, 11, 12],
[13, 14, 15, 0]
];

---

```

```

```

```
