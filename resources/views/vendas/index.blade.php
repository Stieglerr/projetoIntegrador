<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Vendas</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.1.3/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h1 class="mb-4">Lista de Vendas</h1>
        
        <table class="table table-bordered">
            <thead class="table-dark">
                <tr>
                    <th>Cliente</th>
                    <th>Produto</th>
                    <th>Data da Venda</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($vendas as $venda)
                    <tr>
                        <td>{{ $venda->cliente->nome }}</td>
                        <td>{{ $venda->produto->nome }}</td>
                        <td>{{ $venda->created_at->format('d/m/Y H:i') }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        
        <a href="{{ route('vendas.create') }}" class="btn btn-primary mt-4">Adicionar Nova Venda</a>
    </div>
</body>
</html>
