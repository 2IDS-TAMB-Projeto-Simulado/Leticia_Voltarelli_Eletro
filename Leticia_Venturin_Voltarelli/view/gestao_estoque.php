<?php
require_once "../controller/controller_eletrodomestico.php";
if(!isset($_SESSION['usuario'])){
    header("Location: login.php");
    exit();
}

$eletrodomestico = new Eletrodomestico();
if (isset($_POST['botao_pesquisar'])) {
    $resultados = $eletrodomestico->filtrar_eletrodomestico($_POST['pesquisar']);
} 
else {
    $resultados = $eletrodomestico->listar_eletrodomestico();
}
?>
<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Gestão de Estoque</title>
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
                padding: 40px 20px;
            }
            .container {
                max-width: 1400px;
                margin: 0 auto;
            }
            .header {
                background: white;
                border-radius: 15px;
                box-shadow: 0 5px 15px rgba(0,0,0,0.1);
                padding: 30px;
                margin-bottom: 30px;
                text-align: center;
            }
            h1 {
                color: #333;
                margin-bottom: 20px;
                font-size: 2.5em;
            }
            .search-form {
                display: flex;
                gap: 15px;
                justify-content: center;
                margin-bottom: 20px;
            }
            .search-form input[type="search"] {
                padding: 12px 20px;
                border: 2px solid #e1e1e1;
                border-radius: 8px;
                font-size: 16px;
                width: 300px;
            }
            .btn {
                padding: 12px 25px;
                border: none;
                border-radius: 8px;
                font-size: 16px;
                font-weight: 600;
                cursor: pointer;
                transition: all 0.3s ease;
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
            .table-container {
                background: white;
                border-radius: 15px;
                box-shadow: 0 10px 30px rgba(0,0,0,0.1);
                padding: 30px;
                overflow-x: auto;
            }
            table {
                width: 100%;
                border-collapse: collapse;
                min-width: 1200px;
            }
            th, td {
                padding: 15px;
                text-align: left;
                border-bottom: 1px solid #e1e1e1;
            }
            th {
                background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
                color: white;
                font-weight: 600;
                position: sticky;
                top: 0;
            }
            tr:hover {
                background-color: #f8f9fa;
            }
            input[type="number"], select {
                width: 100%;
                padding: 8px 12px;
                border: 2px solid #e1e1e1;
                border-radius: 6px;
                font-size: 14px;
            }
            input[type="number"]:focus, select:focus {
                outline: none;
                border-color: #667eea;
            }
            .action-buttons {
                display: flex;
                gap: 15px;
                justify-content: center;
                margin-top: 30px;
            }
            .empty-message {
                text-align: center;
                padding: 40px;
                color: #666;
                font-size: 18px;
            }
            .stock-form {
                margin: 0;
            }
            .stock-form input[type="submit"] {
                background: #28a745;
                color: white;
                border: none;
                padding: 8px 16px;
                border-radius: 6px;
                cursor: pointer;
                transition: background 0.3s ease;
            }
            .stock-form input[type="submit"]:hover {
                background: #218838;
            }
        </style>
    </head>
    <body>
        <div class="container">
            <div class="header">
                <h1>Gestão de Estoque</h1>
                <form method="POST" class="search-form">
                    <input type="search" id="pesquisar" name="pesquisar" placeholder="Pesquisar por categoria...">
                    <input type="submit" class="btn btn-primary" id="botao_pesquisar" name="botao_pesquisar" value="Filtrar">
                </form>
            </div>

            <div class="table-container">
                <table>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Categoria</th>
                            <th>Fornecedor</th>
                            <th>Prioridade Reposição</th>
                            <th>Potência</th>
                            <th>Consumo Energético</th>
                            <th>Garantia</th>
                            <th>Quantidade no Estoque</th>
                            <th>Ação</th>
                            <th>Quantidade</th>
                            <th>Atualizar Estoque</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if(count($resultados) > 0): ?>
                            <?php foreach($resultados as $r): ?>
                                <form method='POST' action='../controller/controller_estoque.php' class="stock-form">
                                <tr>  
                                    <td><input type='number' name='eletrodomestico_id' value='<?php echo $r["ELETRO_ID"]; ?>' readonly style="width: 60px; background: #f8f9fa;"></td>
                                    <td><?php echo $r["ELETRO_CATEGORIA"]; ?></td>
                                    <td><?php echo $r["ELETRO_FORNECEDOR"]; ?></td>
                                    <td><?php echo $r["ELETRO_PRIORIDADE_REPOSICAO"]; ?></td>
                                    <td><?php echo $r["ELETRO_POTENCIA"]; ?></td>
                                    <td><?php echo $r["ELETRO_CONSUMO_ENERGETICO"]; ?></td>
                                    <td><?php echo $r["ELETRO_GARANTIA"]; ?></td>
                                    <td><input type='number' name='estoque_qtd' value='<?php echo $r["ESTOQUE_QUANTIDADE"]; ?>' readonly style="width: 80px; background: #f8f9fa;"></td>
                                    <td>
                                        <select id='acao_estoque' name='acao_estoque' required>
                                            <option value=''>Selecione...</option>
                                            <option value='entrada'>Entrada no Estoque</option>
                                            <option value='saida'>Saída do Estoque</option>
                                        </select>
                                    </td>
                                    <td>
                                        <input type='number' id='qtd_aumentar_diminuir' name='qtd_aumentar_diminuir' min='0' required style="width: 100px;">
                                    </td>
                                    <td><input type='submit' id='botao_atualizar' name='botao_atualizar' value='Atualizar'></td>
                                </tr>    
                                </form>                        
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>  
                                <td colspan="11" class="empty-message">Nenhum eletrodoméstico cadastrado!</td>
                            </tr>       
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>

            <div class="action-buttons">
                <a href="inicial.php" class="btn btn-secondary">Voltar</a>
            </div>
        </div>
    </body>
</html>