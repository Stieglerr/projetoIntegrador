<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastrar Produto</title>
</head>
<body>
    <h1>Cadastrar Produto</h1>
    <form action="{{ route('produtos.store') }}" method="POST">
        @csrf
        <label for="nome">Nome:</label>
        <input type="text" name="nome" required>
        <label for="preco">Preço:</label>
        <input type="number" name="preco" step="0.01" required>
        <label for="quantidade">Quantidade:</label>
        <input type="number" name="quantidade" required>
        <label for="marca">Marca:</label>
        <input type="text" name="marca" required>
        <button type="submit">Salvar</button>
    </form>
</body>
</html>
