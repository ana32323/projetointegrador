<?php
include_once "objetos/UsuarioController.php";

// Verifica se o formulário foi enviado
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $controller = new UsuarioController();

    if (isset($_POST['cadastrar']) && isset($_POST['usuario'])) {
        $controller->cadastrarUsuario($_POST['usuario']);
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Catálogo de Alimentos</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #fafafa;
            padding: 30px;
        }
        h1 {
            color: #333;
            text-align: center;
        }
        form {
            max-width: 400px;
            background: #fff;
            padding: 20px;
            border-radius: 12px;
            margin: 0 auto;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
        }
        label {
            display: block;
            margin-top: 15px;
            font-weight: bold;
        }
        input {
            width: 100%;
            padding: 8px;
            margin-top: 5px;
            border: 1px solid #ccc;
            border-radius: 6px;
        }
        button {
            margin-top: 20px;
            width: 100%;
            background-color: #4CAF50;
            color: white;
            padding: 10px;
            border: none;
            border-radius: 6px;
            cursor: pointer;
        }
        button:hover {
            background-color: #45a049;
        }
        .mensagem {
            text-align: center;
            margin-bottom: 15px;
            color: red;
        }
    </style>
</head>
<body>
    <h1>Cadastro de Usuário</h1>

    <?php if (isset($_GET['erro'])): ?>
        <div class="mensagem">
            ⚠️ Erro ao cadastrar: <?= htmlspecialchars($_GET['erro']) ?>
        </div>
    <?php elseif (isset($_GET['msg'])): ?>
        <div class="mensagem" style="color: green;">
            ✅ <?= htmlspecialchars($_GET['msg']) ?>
        </div>
    <?php endif; ?>

    <form action="cadastro.php" method="post" enctype="multipart/form-data">
        <label for="nome">Nome</label>
        <input type="text" name="usuario[nome]" id="nome" required>

        <label for="email">E-mail</label>
        <input type="email" name="usuario[email]" id="email" required>

        <label for="senha">Senha</label>
        <input type="password" name="usuario[senha]" id="senha" required>

        <label for="endereco">Endereço</label>
        <input type="text" name="usuario[endereco]" id="endereco">

        <label for="telefone">Telefone</label>
        <input type="text" name="usuario[telefone]" id="telefone">

        <button type="submit" name="cadastrar">Cadastrar</button>
    </form>
</body>
</html>
