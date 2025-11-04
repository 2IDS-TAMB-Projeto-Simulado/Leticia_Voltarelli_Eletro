<?php
session_start();
if(!isset($_SESSION['usuario'])){
    header("Location: login.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Página Inicial</title>
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
                flex-direction: column;
                align-items: center;
                justify-content: center;
                padding: 40px 20px;
            }
            .container {
                background: white;
                border-radius: 20px;
                box-shadow: 0 15px 35px rgba(0,0,0,0.2);
                padding: 50px;
                text-align: center;
                max-width: 600px;
                width: 100%;
            }
            h1 {
                color: #333;
                margin-bottom: 15px;
                font-size: 2.8em;
                font-weight: 700;
            }
            h2 {
                color: #667eea;
                margin-bottom: 30px;
                font-size: 1.8em;
                font-weight: 500;
            }
            h3 {
                color: #666;
                margin-bottom: 40px;
                font-size: 1.4em;
                font-weight: 400;
            }
            .welcome-text {
                color: #764ba2;
                font-weight: 600;
            }
            .button-grid {
                display: grid;
                grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
                gap: 20px;
                margin: 40px 0;
            }
            .btn {
                padding: 15px 25px;
                border: none;
                border-radius: 12px;
                font-size: 16px;
                font-weight: 600;
                cursor: pointer;
                transition: all 0.3s ease;
                text-decoration: none;
                display: flex;
                align-items: center;
                justify-content: center;
                gap: 10px;
            }
            .btn-primary {
                background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
                color: white;
            }
            .btn-primary:hover {
                transform: translateY(-5px);
                box-shadow: 0 10px 25px rgba(102, 126, 234, 0.4);
            }
            .btn-secondary {
                background: #6c757d;
                color: white;
            }
            .btn-secondary:hover {
                background: #5a6268;
                transform: translateY(-3px);
            }
            .btn-logout {
                background: #dc3545;
                color: white;
            }
            .btn-logout:hover {
                background: #c82333;
                transform: translateY(-3px);
            }
            .icon {
                font-size: 20px;
            }
        </style>
    </head>
    <body>
        <div class="container">
            <h1>Página Inicial</h1>
            <h2>Sistema de Eletrodomésticos</h2>
            <h3>Bem vindo, <span class="welcome-text"><?php echo $_SESSION['usuario']['USU_NOME']; ?></span>!</h3>
            
            <div class="button-grid">
                <a href="cadastro_eletrodomestico.php" class="btn btn-primary">
                    <span class="icon">➕</span>
                    Cadastrar Eletrodoméstico
                </a>
                <a href="gestao_estoque.php" class="btn btn-primary">
                    <span class="icon">📊</span>
                    Gestão de Estoque
                </a>
                <a href="listar_eletrodomestico.php" class="btn btn-primary">
                    <span class="icon">📋</span>
                    Listar Eletrodomésticos
                </a>
            </div>
            
            <a href="login.php?logout=true" class="btn btn-logout">
                <span class="icon">🚪</span>
                Sair do Sistema
            </a>
        </div>
    </body>
</html>