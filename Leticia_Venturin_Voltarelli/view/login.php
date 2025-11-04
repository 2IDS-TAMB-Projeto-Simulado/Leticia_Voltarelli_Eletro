<?php
session_start();

// só destrói a sessão se for logout (não sempre que abrir a página)
if (isset($_GET['logout'])) {
    session_destroy();
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Sistema de Eletrodomésticos</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        body {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }
        .login-container {
            background: white;
            border-radius: 20px;
            box-shadow: 0 15px 35px rgba(0,0,0,0.2);
            padding: 50px;
            width: 100%;
            max-width: 450px;
            text-align: center;
        }
        h1 {
            color: #333;
            margin-bottom: 30px;
            font-size: 2.2em;
            font-weight: 600;
        }
        .logo {
            font-size: 3em;
            margin-bottom: 20px;
            color: #667eea;
        }
        .form-group {
            margin-bottom: 25px;
            text-align: left;
        }
        label {
            display: block;
            margin-bottom: 8px;
            font-weight: 500;
            color: #555;
        }
        input[type="email"],
        input[type="password"] {
            width: 100%;
            padding: 15px 20px;
            border: 2px solid #e1e1e1;
            border-radius: 10px;
            font-size: 16px;
            transition: all 0.3s ease;
        }
        input[type="email"]:focus,
        input[type="password"]:focus {
            outline: none;
            border-color: #667eea;
            box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
        }
        .btn-login {
            width: 100%;
            padding: 15px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            border: none;
            border-radius: 10px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            margin-top: 10px;
        }
        .btn-login:hover {
            transform: translateY(-3px);
            box-shadow: 0 10px 25px rgba(102, 126, 234, 0.4);
        }
        .system-info {
            margin-top: 30px;
            padding-top: 20px;
            border-top: 1px solid #e1e1e1;
            color: #666;
            font-size: 14px;
        }
    </style>
</head>
<body>
    <div class="login-container">
        <div class="logo">⚡</div>
        <h1>Sistema de Eletrodomésticos</h1>
        
        <form action="../controller/controller_usuario.php" method="POST">
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" placeholder="seu@email.com" required>
            </div>

            <div class="form-group">
                <label for="senha">Senha:</label>
                <input type="password" id="senha" name="senha" placeholder="Sua senha..." required>
            </div>

            <input type="submit" class="btn-login" id="login" name="login" value="Acessar Sistema">
        </form>

        <div class="system-info">
            <p>Gerencie seu estoque de eletrodomésticos de forma eficiente</p>
        </div>

        <?php
        // Exibe o alerta se houver erro de login
        if (isset($_SESSION['erro_login'])) {
            echo "<script>alert('" . $_SESSION['erro_login'] . "');</script>";
            unset($_SESSION['erro_login']); 
        }
        ?>
    </div>
</body>
</html>