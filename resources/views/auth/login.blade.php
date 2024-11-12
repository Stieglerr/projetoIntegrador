<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
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

        input[type="email"],
        input[type="password"] {
            padding: 10px;
            border: 1px solid #003366;
            border-radius: 4px;
            font-size: 1em;
            width: 100%;
            max-width: 600px;
        }

        button {
            background-color: #003366;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 4px;
            cursor: pointer;
            font-size: 1em;
            transition: background-color 0.3s ease;
        }

        button:hover {
            background-color: #005599;
        }

        .btn-submit-container {
            display: flex;
            justify-content: center;
            width: 100%;
            margin-top: 30px;
        }

        .btn-submit-container button {
            width: auto;
            margin-top: 10px;
        }

        .error-messages {
            color: red;
            margin-top: 15px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Login</h1>

        <form action="{{ route('login') }}" method="POST">
            @csrf
            <label for="email">Email:</label>
            <input type="email" name="email" required>

            <label for="password">Senha:</label>
            <input type="password" name="password" required>

            <div class="btn-submit-container">
                <button type="submit">Entrar</button>
            </div>
        </form>

        @if ($errors->any())
            <div class="error-messages">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
    </div>
</body>
</html>
