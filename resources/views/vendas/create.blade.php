    <!DOCTYPE html>
    <html lang="pt-BR">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Cadastrar Venda</title>
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

            select,
            input[type="text"],
            input[type="number"],
            button[type="submit"] {
                padding: 10px;
                border: 1px solid #003366;
                border-radius: 4px;
                font-size: 1em;
                width: 100%;
            }

            input[type="text"]:focus,
            select:focus,
            input[type="number"]:focus {
                border-color: #005599;
            }

            button[type="submit"] {
                background-color: #003366;
                color: white;
                cursor: pointer;
                transition: background-color 0.3s ease;
            }

            button[type="submit"]:hover {
                background-color: #005599;
            }

            .btn-container {
                display: flex;
                justify-content: space-between;
                margin-top: 20px;
            }

            .btn-cancel {
                background-color: #777;
                color: white;
                padding: 10px 20px;
                border-radius: 4px;
                cursor: pointer;
                text-decoration: none;
            }

            .btn-cancel:hover {
                background-color: #555;
            }

            .btn-add-product {
                background-color: #28a745;
                color: white;
                padding: 10px;
                border: none;
                border-radius: 4px;
                cursor: pointer;
                font-size: 1em;
                margin-top: 10px;
                transition: background-color 0.3s ease;
            }

            .btn-add-product:hover {
                background-color: #218838;
            }

            .product-group {
                margin-top: 15px;
                padding: 10px;
                border: 1px solid #cfcfcf;
                border-radius: 4px;
                display: flex;
                gap: 10px;
                align-items: center;
            }

            .search-product {
                margin-bottom: 10px;
            }

            .product-group input[type="number"] {
                width: 100px;
            }
        </style>
    </head>
    <body>
        <div class="container">
            <h1>Cadastrar Nova Venda</h1>

            <form action="{{ route('vendas.store') }}" method="POST">
                @csrf
                <label for="searchCliente">Buscar Cliente:</label>
                <input type="text" id="searchCliente" placeholder="Digite para buscar um cliente">

                <label for="cliente_id">Cliente:</label>
                <select name="cliente_id" id="cliente_id" required>
                    <option value="">Selecione um cliente</option>
                    @foreach ($clientes as $cliente)
                        <option value="{{ $cliente->id }}">{{ $cliente->nome }}</option>
                    @endforeach
                </select>

                <div id="products-container">
                    <label>Produtos:</label>
                    <div class="product-group">
                        <input type="text" class="search-product" placeholder="Buscar Produto">
                        <select name="produto_id[]" class="produto-select" required>
                            <option value="">Selecione um produto</option>
                            @foreach ($produtos as $produto)
                                <option value="{{ $produto->id }}" data-preco="{{ $produto->preco }}">{{ $produto->nome }}</option>
                            @endforeach
                        </select>
                        <input type="number" name="quantidade[]" min="1" value="1" required>
                    </div>
                </div>
                <button type="button" class="btn-add-product" onclick="addProductField()">Adicionar Produto</button>

                <div class="btn-container">
                    <button type="submit">Cadastrar Venda</button>
                    <a href="{{ route('vendas.index') }}" class="btn-cancel">Cancelar</a>
                </div>
            </form>
        </div>

        <script>
            const clienteSearchInput = document.getElementById('searchCliente');
            const clienteSelect = document.getElementById('cliente_id');

            clienteSearchInput.addEventListener('input', () => {
                const searchValue = clienteSearchInput.value.toLowerCase();
                Array.from(clienteSelect.options).forEach(option => {
                    const optionText = option.textContent.toLowerCase();
                    option.style.display = optionText.includes(searchValue) || option.value === "" ? '' : 'none';
                });
            });

            function addProductField() {
                const container = document.getElementById('products-container');
                const newProductGroup = document.createElement('div');
                newProductGroup.classList.add('product-group');
                
                newProductGroup.innerHTML = `
                    <input type="text" class="search-product" placeholder="Buscar Produto" style="margin-bottom: 10px;">
                    <select name="produto_id[]" class="produto-select" required>
                        <option value="">Selecione um produto</option>
                        @foreach ($produtos as $produto)
                            <option value="{{ $produto->id }}" data-preco="{{ $produto->preco }}">{{ $produto->nome }}</option>
                        @endforeach
                    </select>
                    <input type="number" name="quantidade[]" min="1" value="1" required>
                `;
                
                container.appendChild(newProductGroup);

                const searchProductInput = newProductGroup.querySelector('.search-product');
                const produtoSelect = newProductGroup.querySelector('.produto-select');
                const quantidadeInput = newProductGroup.querySelector('input[type="number"]');

                searchProductInput.addEventListener('input', () => {
                    const searchValue = searchProductInput.value.toLowerCase();
                    Array.from(produtoSelect.options).forEach(option => {
                        const optionText = option.textContent.toLowerCase();
                        option.style.display = optionText.includes(searchValue) || option.value === "" ? '' : 'none';
                    });
                });

                produtoSelect.addEventListener('change', () => {
                    const selectedOption = produtoSelect.options[produtoSelect.selectedIndex];
                    const preco = selectedOption.getAttribute('data-preco');
                });
            }
        </script>
    </body>
    </html>
