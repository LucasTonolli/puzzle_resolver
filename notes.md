# Tarefas

[ ] - Checar com o professor se o "gerador" é basicamente o _Puzzle_
[ X ] - Mover Lógica do index.php para classe de busca em amplitude

- Removi o uso do $visited

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

| Gerado no Gemini Prop

## Puzzle 3X3

### Wrong pieces: 4

$initialState = [
[1, 2, 3],
[5, 0, 6],
[4, 7, 8]
];

$goalState = [
[1, 2, 3],
[4, 5, 6],
[7, 8, 0]
];

## Puzzle 4X4

### Wrong pieces: 15

$initialState = [
[1, 6, 2, 4],
[9, 5, 3, 8],
[0, 10, 7, 11],
[13, 14, 15, 12]
];

$goalState = [
[1, 2, 3, 4],
[5, 6, 7, 8],
[9, 10, 11, 12],
[13, 14, 15, 0]
];

### Wrong pieces: 12 - but closer

$initialState = [
[2, 1, 4, 3],
[5, 6, 0, 7],
[10, 9, 12, 8],
[13, 14, 15, 11]
];

$goalState = [
[1, 2, 3, 4],
[5, 6, 7, 8],
[9, 10, 11, 12],
[13, 14, 15, 0]
];

---
