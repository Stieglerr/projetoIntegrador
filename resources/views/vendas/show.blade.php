<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalhes da Venda</title>
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

        .details {
            text-align: left;
            margin-bottom: 20px;
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

        ul {
            list-style-type: none;
            padding: 0;
        }

        li {
            margin: 8px 0;
            font-size: 1em;
        }
    </style>
</head>
<body>
    <div class="container">
        <a href="{{ route('vendas.index') }}" class="btn">Voltar para Lista de Vendas</a>

        <h1>Detalhes da Venda</h1>

        <div class="details">
            <p><strong>Cliente:</strong> {{ $venda->cliente->nome }}</p>
            <p><strong>Data da Venda:</strong> {{ $venda->created_at->format('d/m/Y H:i') }}</p>

            <!-- Calcular e exibir o valor total da venda -->
            <p><strong>Valor Total:</strong> 
                R$ {{ number_format($venda->produtos->sum(function($produto) {
                    return $produto->preco * $produto->pivot->quantidade;
                }), 2, ',', '.') }}
            </p>

            <h3>Produtos:</h3>
            <ul>
                @foreach ($venda->produtos as $produto)
                    <?php 
                        // Calcula o preço total por produto (preço * quantidade)
                        $precoTotal = $produto->preco * $produto->pivot->quantidade;
                    ?>
                    <li>
                        {{ $produto->nome }} - 
                        R$ {{ number_format($produto->preco, 2, ',', '.') }} 
                        (Quantidade: {{ $produto->pivot->quantidade }}) 
                        - Total: R$ {{ number_format($precoTotal, 2, ',', '.') }}
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
</body>
</html>
