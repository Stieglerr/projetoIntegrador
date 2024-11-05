<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalhes do Produto</title>
</head>
<body>
    <h1>Detalhes do Produto</h1>
    <p><strong>Nome:</strong> {{ $produto->nome }}</p>
    <p><strong>Preço:</strong> {{ $produto->preco }}</p>
    <p><strong>Quantidade:</strong> {{ $produto->quantidade }}</p>
    <p><strong>Marca:</strong> {{ $produto->marca }}</p>
    <a href="{{ route('produtos.edit', $produto->id) }}">Editar</a>
    <form action="{{ route('produtos.destroy', $produto->id) }}" method="POST" style="display:inline;">
        @csrf
        @method('DELETE')
        <button type="submit">Excluir</button>
    </form>
</body>
</html>
