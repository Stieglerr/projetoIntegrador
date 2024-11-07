<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Clientes</title>
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
        }

        h1 {
            color: #003366;
            margin-bottom: 20px;
            font-size: 2em;
        }

        ul {
            list-style-type: none;
            padding: 0;
            margin: 0;
        }

        .header {
            font-weight: bold;
            display: flex;
            justify-content: space-between;
            background-color: #003366;
            color: white;
            padding: 15px;
            border-radius: 5px;
            margin-bottom: 10px;
        }

        li {
            background-color: #e0f0ff;
            margin: 10px 0;
            padding: 10px;
            border-radius: 5px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            font-size: 1em;
        }

        .btn {
            background-color: #003366;
            color: white;
            border: none;
            padding: 8px 16px;
            border-radius: 4px;
            cursor: pointer;
            font-size: 0.9em;
            transition: background-color 0.4s ease;
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

        .btn-return {
            display: inline-block;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    <div class="container">
        <a href="{{ route('home') }}" class="btn btn-return">Voltar para Home</a>

        <h1>Lista de Clientes</h1>

        <!-- Cabeçalho dos clientes -->
        <div class="header">
            <span style="flex: 2;">Nome</span>
            <span style="flex: 1;">CPF</span>
            <span style="flex: 1;">Telefone</span>
            <span style="flex: 2;">Endereço</span>
            <span style="flex: 2;">Email</span>  <!-- Nova coluna de Email -->
            <span style="flex: 1;">Ações</span>
        </div>

        <ul>
            @foreach ($clientes as $cliente)
                <li>
                    <span style="flex: 2;">{{ $cliente->nome }}</span>
                    <span style="flex: 1;">{{ $cliente->cpf }}</span>
                    <span style="flex: 1;">{{ $cliente->telefone }}</span>
                    <span style="flex: 2;">{{ $cliente->endereco }}</span>
                    <span style="flex: 2;">{{ $cliente->email }}</span>  <!-- Exibindo o Email -->
                    <div style="flex: 1; display: flex; justify-content: space-around;">
                        <!-- Botão Editar -->
                        <a href="{{ route('clientes.edit', $cliente->id) }}" class="btn">Editar</a>

                        <!-- Botão Remover -->
                        <form action="{{ route('clientes.destroy', $cliente->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-delete" onclick="return confirm('Tem certeza que deseja remover este cliente?')">Remover</button>
                        </form>
                    </div>
                </li>
            @endforeach
        </ul>

        <a href="{{ route('clientes.create') }}" class="btn">Cadastrar Novo Cliente</a>
    </div>
</body>
</html>
