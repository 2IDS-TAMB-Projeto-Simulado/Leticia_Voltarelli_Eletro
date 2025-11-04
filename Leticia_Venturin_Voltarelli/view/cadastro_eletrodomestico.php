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
        <title>Cadastro de Eletrodomésticos</title>
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
                padding: 40px 20px;
            }
            .container {
                background: white;
                border-radius: 15px;
                box-shadow: 0 10px 30px rgba(0,0,0,0.2);
                padding: 40px;
                width: 100%;
                max-width: 600px;
            }
            h1 {
                color: #333;
                text-align: center;
                margin-bottom: 30px;
                font-size: 2.2em;
                font-weight: 600;
            }
            .form-group {
                margin-bottom: 20px;
            }
            label {
                display: block;
                margin-bottom: 8px;
                font-weight: 500;
                color: #555;
            }
            input[type="text"],
            input[type="date"],
            input[type="number"] {
                width: 100%;
                padding: 12px 15px;
                border: 2px solid #e1e1e1;
                border-radius: 8px;
                font-size: 16px;
                transition: all 0.3s ease;
            }
            input[type="text"]:focus,
            input[type="date"]:focus,
            input[type="number"]:focus {
                outline: none;
                border-color: #667eea;
                box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
            }
            .btn {
                padding: 12px 30px;
                border: none;
                border-radius: 8px;
                font-size: 16px;
                font-weight: 600;
                cursor: pointer;
                transition: all 0.3s ease;
                text-decoration: none;
                display: inline-block;
                text-align: center;
            }
            .btn-primary {
                background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
                color: white;
            }
            .btn-primary:hover {
                transform: translateY(-2px);
                box-shadow: 0 5px 15px rgba(102, 126, 234, 0.4);
            }
            .btn-secondary {
                background: #6c757d;
                color: white;
            }
            .btn-secondary:hover {
                background: #5a6268;
            }
            .button-group {
                display: flex;
                gap: 15px;
                justify-content: center;
                margin-top: 30px;
            }
        </style>
    </head>
    <body>
        <div class="container">
            <h1>Cadastro de Eletrodomésticos</h1>
            <form action="../controller/controller_eletrodomestico.php" method="POST">
                <div class="form-group">
                    <label for="ELETRO_CATEGORIA">Categoria:</label>
                    <input type="text" id="ELETRO_CATEGORIA" name="ELETRO_CATEGORIA" placeholder="Ex: Geladeira, Micro-ondas..." required>
                </div>

                <div class="form-group">
                    <label for="ELETRO_FORNECEDOR">Fornecedor:</label>
                    <input type="text" id="ELETRO_FORNECEDOR" name="ELETRO_FORNECEDOR" placeholder="Nome do fornecedor..." required>
                </div>

                <div class="form-group">
                    <label for="ELETRO_PRIORIDADE_REPOSICAO">Prioridade de Reposição:</label>
                    <input type="text" id="ELETRO_PRIORIDADE_REPOSICAO" name="ELETRO_PRIORIDADE_REPOSICAO" placeholder="Ex: Alta, Média, Baixa..." required>
                </div>

                <div class="form-group">
                    <label for="ELETRO_POTENCIA">Potência:</label>
                    <input type="text" id="ELETRO_POTENCIA" name="ELETRO_POTENCIA" placeholder="Ex: 220V, 110V..." required>
                </div>

                <div class="form-group">
                    <label for="ELETRO_CONSUMO_ENERGETICO">Consumo Energético:</label>
                    <input type="text" id="ELETRO_CONSUMO_ENERGETICO" name="ELETRO_CONSUMO_ENERGETICO" placeholder="Ex: 45.6 kWh..." required>
                </div>

                <div class="form-group">
                    <label for="ELETRO_GARANTIA">Garantia:</label>
                    <input type="date" id="ELETRO_GARANTIA" name="ELETRO_GARANTIA" required>
                </div>

                <div class="button-group">
                    <input type="submit" class="btn btn-primary" id="cadastrar_eletrodomestico" name="cadastrar_eletrodomestico" value="Cadastrar">
                    <a href="inicial.php" class="btn btn-secondary">Voltar</a>
                </div>
            </form>
        </div>
    </body>
</html>