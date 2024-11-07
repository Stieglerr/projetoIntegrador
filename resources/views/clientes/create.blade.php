<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastrar Cliente</title>
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
        input[type="email"] {
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
            <a href="{{ route('clientes.index') }}" class="btn-back-products">Voltar para Clientes</a>
        </div>

        <h1>Cadastrar Cliente</h1>

        <form action="{{ route('clientes.store') }}" method="POST">
            @csrf

            <label for="nome">Nome:</label>
            <input type="text" name="nome" required>

            <label for="cpf">CPF:</label>
            <input type="text" name="cpf" required>

            <label for="telefone">Telefone:</label>
            <input type="text" name="telefone" required>

            <label for="endereco">Endereço:</label>
            <input type="text" name="endereco" required>

            <label for="email">Email:</label>
            <input type="email" name="email" required>

            <button type="submit">Cadastrar</button>
        </form>
    </div>
</body>
</html>
