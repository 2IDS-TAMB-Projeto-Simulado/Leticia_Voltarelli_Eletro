<?php
    require_once "../model/model_eletrodomestico.php";
    session_start();

    // CADASTRAR ELETRODOMESTICOS
    if (isset($_POST["cadastrar_eletrodomestico"])) {
        $eletrodomestico = new Eletrodomestico();
        $resultado = $eletrodomestico->cadastrar_eletrodomestico(
            $_POST["ELETRO_CATEGORIA"],
            $_POST["ELETRO_FORNECEDOR"],
            $_POST["ELETRO_PRIORIDADE_REPOSICAO"],
            $_POST["ELETRO_POTENCIA"],
            $_POST["ELETRO_CONSUMO_ENERGETICO"],
            $_POST["ELETRO_GARANTIA"],
            $_SESSION['usuario']["USU_ID"]
        );

        if ($resultado) {
            echo "<script>
                    alert('Eletrodomestico cadastrado com sucesso!');
                    window.location.href='../view/listar_eletrodomestico.php';
                </script>";
        } else {
            echo "<script>
                    alert('Erro ao cadastrar eletrodomestico!');
                    window.location.href='../view/listar_eletrodomestico.php';
                </script>";
        }
        exit();
    }

    // BUSCAR DADOS PARA EDITAR ELETRODOMESTICO
    else if (isset($_GET["acao"]) && $_GET["acao"] == "editar_eletrodomestico") {
        $eletrodomestico = new Eletrodomestico();
        $resultados = $eletrodomestico->buscar_eletrodomestico_pelo_id($_GET["id"]);

        if (!empty($resultados)) {
            $eletrodomestico_editar = $resultados[0];
        } else {
            echo "<script>
                    alert('Eletrodomestico não encontrado!');
                    window.location.href='listar_eletrodomestico.php';
                </script>";
            exit();
        }
    }

    // EDITAR ELETRODOMESTICO
    if (isset($_POST["editar_eletrodomestico"])) {
        $eletrodomestico = new Eletrodomestico();
        $resultado = $eletrodomestico->editar_eletrodomestico(
            $_POST["ELETRO_CATEGORIA"],
            $_POST["ELETRO_FORNECEDOR"],
            $_POST["ELETRO_PRIORIDADE_REPOSICAO"],
            $_POST["ELETRO_POTENCIA"],
            $_POST["ELETRO_CONSUMO_ENERGETICO"],
            $_POST["ELETRO_GARANTIA"],
            $_POST["ELETRO_ID"], // ID do eletrodoméstico a ser editado
            $_SESSION['usuario']["USU_ID"]
        );

        if ($resultado) {
            echo "<script>
                    alert('Eletrodomestico atualizado com sucesso!');
                    window.location.href='../view/listar_eletrodomestico.php';
                </script>";
        } else {
            echo "<script>
                    alert('Erro ao atualizar eletrodomestico!');
                    window.location.href='../view/listar_eletrodomestico.php';
                </script>";
        }
        exit();
    }

    // EXCLUIR ELETRODOMESTICO
    else if (isset($_GET["acao"]) && $_GET["acao"] == "excluir_eletrodomestico") {
        $eletrodomestico = new Eletrodomestico();
        $resultado = $eletrodomestico->excluir_eletrodomestico($_GET["id"], $_SESSION['usuario']['USU_ID']);

        if ($resultado) {
            echo "<script>
                    alert('Eletrodomestico excluído com sucesso!');
                    window.location.href='../view/listar_eletrodomestico.php';
                </script>";
        } else {
            echo "<script>
                    alert('Erro ao excluir eletrodomestico!');
                    window.location.href='../view/listar_eletrodomestico.php';
                </script>";
        }
        exit();
    }

    // FILTRAR ELETRODOMESTICOS
    else if (isset($_POST["filtrar_eletrodomestico"])) {
        $eletrodomestico = new Eletrodomestico();
        $resultados = $eletrodomestico->filtrar_eletrodomestico($_POST["campo_busca"]);
        
        // Armazena os resultados filtrados na sessão para exibir na view
        $_SESSION['eletrodomesticos_filtrados'] = $resultados;
        header("Location: ../view/listar_eletrodomestico.php");
        exit();
    }

    // LISTAR TODOS OS ELETRODOMESTICOS (carregamento inicial)
    else {
        $eletrodomestico = new Eletrodomestico();
        $eletrodomesticos = $eletrodomestico->listar_eletrodomestico();
    }
?>