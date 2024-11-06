<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Produto</title>
</head>
<body>
    <h1>Editar Produto</h1>
    <form action="{{ route('produtos.update', $produto->id) }}" method="POST">
        @csrf
        @method('PUT')
        <label for="nome">Nome:</label>
        <input type="text" name="nome" value="{{ $produto->nome }}" required>
        <label for="preco">Preço:</label>
        <input type="number" name="preco" step="0.01" value="{{ $produto->preco }}" required>
        <label for="quantidade">Quantidade:</label>
        <input type="number" name="quantidade" value="{{ $produto->quantidade }}" required>
        <label for="marca">Marca:</label>
        <input type="text" name="marca" value="{{ $produto->marca }}" required>
        <button type="submit">Atualizar</button>
    </form>
</body>
</html>
