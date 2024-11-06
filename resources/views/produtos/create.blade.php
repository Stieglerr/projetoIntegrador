<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastrar Produto</title>
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
            width: 800px;
            background-color: #ffffff;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 51, 0.2);
            text-align: center;
        }

        h1 {
            color: #003366;
            margin-bottom: 20px;
        }

        form {
            display: flex;
            flex-direction: column;
            gap: 20px;
            margin-bottom: 20px;
        }

        label {
            text-align: left;
            font-size: 1.1em;
            color: #003366;
        }

        input[type="text"],
        input[type="number"] {
            padding: 10px;
            border: 1px solid #003366;
            border-radius: 4px;
            font-size: 1em;
            width: 100%;
        }

        button[type="submit"] {
            background-color: #003366;
            color: white;
            padding: 12px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 1.1em;
            transition: background-color 0.3s ease;
        }

        button[type="submit"]:hover {
            background-color: #005599;
        }

        .btn-container {
            display: flex;
            justify-content: space-between;
            margin-bottom: 20px;
        }

        .btn-return,
        .btn-back-products {
            display: inline-block;
            background-color: #003366;
            color: white;
            padding: 10px 20px;
            border-radius: 4px;
            cursor: pointer;
            text-decoration: none;
        }

        .btn-return:hover,
        .btn-back-products:hover {
            background-color: #005599;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="btn-container">
            <a href="{{ route('home') }}" class="btn-return">Voltar para Home</a>
            <a href="{{ route('produtos.index') }}" class="btn-back-products">Voltar para Produtos</a>
        </div>

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
    </div>
</body>
</html>
