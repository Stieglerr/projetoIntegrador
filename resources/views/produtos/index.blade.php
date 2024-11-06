<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Produtos</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f8ff;
            color: #003366;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }

        .container {
            width: 1200px; /* Definir uma largura fixa de 1200px */
            max-width: 100%; /* Permitir que o container se ajuste em telas menores */
            background-color: #ffffff;
            padding: 20px; /* Diminuir o padding para manter o layout mais compacto */
            border-radius: 8px;
            box-shadow: 0 4px 16px rgba(0, 0, 51, 0.2);
            text-align: center;
        }

        h1 {
            color: #003366;
            margin-bottom: 20px; /* Manter um espaço adequado abaixo do título */
            font-size: 2em; /* Diminuir o tamanho da fonte do título */
        }

        ul {
            list-style-type: none;
            padding: 0;
            margin: 0; /* Remover margens da lista */
        }

        .header {
            font-weight: bold;
            display: flex;
            justify-content: space-between;
            background-color: #003366;
            color: white;
            padding: 15px; /* Manter padding do cabeçalho em um valor razoável */
            border-radius: 5px;
            margin-bottom: 10px; /* Espaço abaixo do cabeçalho */
        }

        li {
            background-color: #e0f0ff;
            margin: 10px 0; /* Margem entre os itens */
            padding: 10px; /* Diminuir o padding dos itens */
            border-radius: 5px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            font-size: 1em; /* Diminuir o tamanho da fonte dos itens */
        }

        .btn {
            background-color: #003366;
            color: white;
            border: none;
            padding: 8px 16px; /* Ajustar o padding dos botões */
            border-radius: 4px;
            cursor: pointer;
            font-size: 0.9em; /* Diminuir o tamanho da fonte dos botões */
            transition: background-color 0.3s ease;
            text-decoration: none;
        }

        .btn:hover {
            background-color: #005599;
        }

        .btn-delete {
            background-color: #cc0000;
        }

        .btn-delete:hover {
            background-color: #ff0000;
        }

        .search-bar {
            margin-bottom: 20px; /* Manter um espaço razoável abaixo da barra de busca */
            display: flex;
            justify-content: center;
        }

        .search-input {
            padding: 8px; /* Ajustar o padding da barra de pesquisa */
            border: 1px solid #003366;
            border-radius: 4px;
            font-size: 1em; /* Tamanho da fonte da barra de pesquisa */
            width: 60%; /* Definir uma largura de 60% para a barra de pesquisa */
            margin-right: 10px; /* Espaço entre a barra e o botão */
        }

        .btn-return {
            display: inline-block;
            margin-bottom: 20px; /* Espaço abaixo do botão de retorno */
        }
    </style>
</head>
<body>
    <div class="container">
        <a href="{{ route('home') }}" class="btn btn-return">Voltar para Home</a>

        <h1>Lista de Produtos</h1>

        <div class="search-bar">
            <form action="{{ route('produtos.index') }}" method="GET" style="display: flex; width: 100%;">
                <input type="text" name="search" class="search-input" placeholder="Pesquisar produtos..." value="{{ request()->input('search') }}">
                <button type="submit" class="btn">Buscar</button>
            </form>
        </div>


        <!-- Cabeçalho dos produtos -->
        <div class="header">
            <span style="flex: 2;">Nome</span>
            <span style="flex: 1;">ID</span>
            <span style="flex: 1;">Preço</span>
            <span style="flex: 1;">Ações</span>
        </div>

        <ul>
            @foreach ($produtos as $produto)
                <li>
                    <span style="flex: 2;">{{ $produto->nome }}</span>
                    <span style="flex: 1;">{{ $produto->id }}</span>
                    <span style="flex: 1;">{{ $produto->preco }}</span>

                    <div style="flex: 1; display: flex; justify-content: space-around;">
                        <!-- Botão Editar -->
                        <a href="{{ route('produtos.edit', $produto->id) }}" class="btn">Editar</a>

                        <!-- Botão Remover -->
                        <form action="{{ route('produtos.destroy', $produto->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-delete" onclick="return confirm('Tem certeza que deseja remover este produto?')">Remover</button>
                        </form>
                    </div>
                </li>
            @endforeach
        </ul>

        <a href="{{ route('produtos.create') }}" class="btn">Cadastrar Novo Produto</a>
    </div>
</body>
</html>
