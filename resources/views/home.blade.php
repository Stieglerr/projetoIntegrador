<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Página Inicial</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
            background-color: #f8f9fa;
        }
        .container {
            text-align: center;
            padding: 20px;
            border-radius: 10px;
            background-color: #ffffff;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }
        .btn {
            width: 200px;
            margin: 10px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Bem-vindo ao Sistema de Autopeças</h1>
        <p>Escolha uma das opções abaixo para gerenciar:</p>
        <a href="{{ route('produtos.index') }}" class="btn btn-primary">Produtos</a>
        <a href="{{ route('clientes.index') }}" class="btn btn-success">Clientes</a>
        <a href="{{ route('vendas.index') }}" class="btn btn-info">Vendas</a> <!-- Botão para acessar vendas -->
    </div>
</body>
</html>
