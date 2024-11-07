<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Cliente</title>
    <style>
        /* Estilos semelhantes ao index de produtos */
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
            width: 600px;
            max-width: 100%;
            background-color: #ffffff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 16px rgba(0, 0, 51, 0.2);
            text-align: center;
        }

        h1 {
            color: #003366;
            margin-bottom: 20px;
            font-size: 1.8em;
        }

        label {
            display: block;
            margin-top: 10px;
            color: #003366;
            font-weight: bold;
        }

        input[type="text"], input[type="email"], input[type="number"], input[type="tel"] {
            width: 100%;
            padding: 10px;
            margin-top: 5px;
            border: 1px solid #003366;
            border-radius: 4px;
            box-sizing: border-box;
        }

        .btn {
            background-color: #003366;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 4px;
            cursor: pointer;
            font-size: 0.9em;
            transition: background-color 0.3s ease;
            margin-top: 15px;
        }

        .btn:hover {
            background-color: #005599;
        }

        .btn-return {
            margin-top: 10px;
            display: inline-block;
        }
    </style>
</head>
<body>
    <div class="container">
        <a href="{{ route('clientes.index') }}" class="btn btn-return">Voltar para Clientes</a>
        
        <h1>Editar Cliente</h1>
        <form action="{{ route('clientes.update', $cliente->id) }}" method="POST">
            @csrf
            @method('PUT')

            <label for="nome">Nome:</label>
            <input type="text" name="nome" value="{{ $cliente->nome }}" required>

            <label for="email">Email:</label>
            <input type="email" name="email" value="{{ $cliente->email }}" required>

            <label for="cpf">CPF:</label>
            <input type="text" name="cpf" value="{{ $cliente->cpf }}" required>

            <label for="numero">Número:</label>
            <input type="number" name="numero" value="{{ $cliente->numero }}" required>

            <label for="endereco">Endereço:</label>
            <input type="text" name="endereco" value="{{ $cliente->endereco }}" required>

            <!-- Outros campos, se houver -->
            
            <button type="submit" class="btn">Atualizar</button>
        </form>
    </div>
</body>
</html>
