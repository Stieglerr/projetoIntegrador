<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Produtos</title>
</head>
<body>
    <h1>Lista de Produtos</h1>
    <ul>
        @foreach ($produtos as $produto)
            <li>{{ $produto->nome }} - {{ $produto->preco }} - {{ $produto->quantidade }} - {{ $produto->marca }}</li>
        @endforeach
    </ul>
    <a href="{{ route('produtos.create') }}">Cadastrar Novo Produto</a>
</body>
</html>
