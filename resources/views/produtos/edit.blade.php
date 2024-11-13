<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Produto</title>
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
            width: 1200px;
            max-width: 100%;
            background-color: #ffffff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 16px rgba(0, 0, 51, 0.2);
            text-align: center;
            position: relative;
        }

        h1 {
            color: #003366;
            margin-bottom: 20px;
            font-size: 2em;
        }

        form {
            display: flex;
            flex-direction: column;
            gap: 15px;
            align-items: center;
        }

        label {
            color: #003366;
            font-weight: bold;
            text-align: left;
            width: 100%;
            max-width: 600px;
        }

        input[type="text"],
        input[type="number"] {
            padding: 10px;
            border: 1px solid #003366;
            border-radius: 4px;
            font-size: 1em;
            width: 100%;
            max-width: 600px;
        }

        .btn {
            background-color: #003366;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 4px;
            cursor: pointer;
            font-size: 1em;
            transition: background-color 0.3s ease;
            text-decoration: none;
        }

        .btn:hover {
            background-color: #005599;
        }

        .btn-container {
            display: flex;
            justify-content: space-between;
            position: absolute;
            top: 20px;
            left: 20px;
            right: 20px;
            width: calc(100% - 40px);
        }

        .btn-return, .btn-produtos {
            background-color: #003366;
            color: white;
            padding: 10px 15px;
            text-decoration: none;
            border-radius: 4px;
            transition: background-color 0.3s ease;
        }

        .btn-return:hover, .btn-produtos:hover {
            background-color: #005599;
        }

        .btn-submit-container {
            display: flex;
            justify-content: center;
            width: 100%;
            margin-top: 30px;
        }

        .btn-submit-container .btn {
            width: auto;
            margin-top: 10px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Editar Produto</h1>

        <div class="btn-container">
            <a href="{{ route('home') }}" class="btn-return">Voltar para Home</a>
            <a href="{{ route('produtos.index') }}" class="btn-produtos">Ver Produtos</a>
        </div>

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

            <div class="btn-submit-container">
                <button type="submit" class="btn">Atualizar Produto</button>
            </div>
        </form>
    </div>
</body>
</html>
