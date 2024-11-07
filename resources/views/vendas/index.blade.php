<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Vendas</title>
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
            transition: background-color 0.3s ease;
            text-decoration: none;
        }

        .btn:hover {
            background-color: #005599;
        }

        .btn-return {
            display: inline-block;
            margin-bottom: 20px;
        }

        .total {
            font-weight: bold;
            margin-top: 20px;
            font-size: 1.2em;
            text-align: right; /* Alinha a soma à direita */
        }
    </style>
</head>
<body>
    <div class="container">
        <a href="{{ route('home') }}" class="btn btn-return">Voltar para Home</a>

        <h1>Lista de Vendas</h1>

        <!-- Cabeçalho das vendas -->
        <div class="header">
            <span style="flex: 2;">Cliente</span>
            <span style="flex: 1;">Data da Venda</span>
            <span style="flex: 1;">Valor Total</span>
            <span style="flex: 1;">Ações</span>
        </div>

        <ul>
            @foreach ($vendas as $venda)
                <li>
                    <span style="flex: 2;">{{ $venda->cliente->nome }}</span>
                    <span style="flex: 1;">{{ $venda->created_at->format('d/m/Y H:i') }}</span>
                    <span style="flex: 1;">R$ {{ number_format($venda->valor_total, 2, ',', '.') }}</span>
                    <span style="flex: 1;">
                        <a href="{{ route('venda.show', $venda->id) }}" class="btn">Ver Detalhes</a>
                    </span>
                </li>
            @endforeach
        </ul>

        <!-- Exibir a soma total das vendas -->
        <div class="total">
            Total de Vendas: R$ {{ number_format($somaTotal, 2, ',', '.') }}
        </div>

        <a href="{{ route('vendas.create') }}" class="btn">Adicionar Nova Venda</a>
    </div>
</body>
</html>
