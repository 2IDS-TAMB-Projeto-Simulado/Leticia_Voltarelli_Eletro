<?php
require_once "../config/db.php";
require_once "model_estoque.php";
require_once "model_logs.php";

class Eletrodomestico {

    // Cadastrar novo eletrodoméstico
    public function cadastrar_eletrodomestico($eletro_categoria, $eletro_fornecedor, $eletro_prioridade_reposicao, $eletro_potencia, $eletro_consumo_energetico, $eletro_garantia, $fk_usu_id) {
        $conn = Database::getConnection();
        $insert = $conn->prepare("INSERT INTO ELETRODOMESTICO (ELETRO_CATEGORIA, ELETRO_FORNECEDOR, ELETRO_PRIORIDADE_REPOSICAO, ELETRO_POTENCIA, ELETRO_CONSUMO_ENERGETICO, ELETRO_GARANTIA, FK_USU_ID) VALUES (?, ?, ?, ?, ?, ?, ?)");
        $insert->bind_param("ssssssi", $eletro_categoria, $eletro_fornecedor, $eletro_prioridade_reposicao, $eletro_potencia, $eletro_consumo_energetico, $eletro_garantia, $fk_usu_id);
        $success = $insert->execute();

        if ($success) {
            $eletrodomestico_id = $conn->insert_id;

            // Adiciona o eletrodoméstico ao estoque com quantidade inicial 0
            $estoque = new Estoque();
            $estoque->adicionar_estoque(0, $eletrodomestico_id);

            // Registrar log
            $logs = new Logs();
            $logs->cadastrar_logs("ELETRODOMESTICO <br> ID: ".$eletrodomestico_id." <br> CATEGORIA: ".$eletro_categoria." <br> AÇÃO: Cadastrado! <br> ID USUÁRIO: ".$fk_usu_id);
        }

        $insert->close();
        return $success;
    }

    // Listar todos os eletrodomésticos
    public function listar_eletrodomestico() {
        $conn = Database::getConnection();
        $sql = "SELECT 
                    ED.ELETRO_ID,
                    ED.ELETRO_CATEGORIA, 
                    ED.ELETRO_FORNECEDOR, 
                    ED.ELETRO_PRIORIDADE_REPOSICAO, 
                    ED.ELETRO_POTENCIA, 
                    ED.ELETRO_CONSUMO_ENERGETICO, 
                    ED.ELETRO_GARANTIA,
                    E.ESTOQUE_QUANTIDADE,
                    U.USU_NOME,
                    U.USU_EMAIL
                FROM ELETRODOMESTICO ED
                JOIN USUARIO U ON ED.FK_USU_ID = U.USU_ID
                JOIN ESTOQUE E ON ED.ELETRO_ID = E.FK_ELETRODOMESTICO_ID
                ORDER BY ED.ELETRO_CATEGORIA";
        $result = $conn->query($sql);
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    // Excluir eletrodoméstico
    public function excluir_eletrodomestico($eletro_id, $fk_usu_id) {
        $conn = Database::getConnection();

        // Excluir estoque vinculado
        $deleteEstoque = $conn->prepare("DELETE FROM ESTOQUE WHERE FK_ELETRODOMESTICO_ID = ?");
        $deleteEstoque->bind_param("i", $eletro_id);
        $deleteEstoque->execute();
        $deleteEstoque->close();

        // Excluir eletrodoméstico
        $delete = $conn->prepare("DELETE FROM ELETRODOMESTICO WHERE ELETRO_ID = ?");
        $delete->bind_param("i", $eletro_id);

        $logs = new Logs();
        $logs->cadastrar_logs("ELETRODOMESTICO <br> ID: ".$eletro_id." <br> AÇÃO: Excluído! <br> ID USUÁRIO: ".$fk_usu_id);

        $success = $delete->execute();
        $delete->close();

        return $success;
    }

    // Buscar eletrodoméstico pelo ID
    public function buscar_eletrodomestico_pelo_id($id) {
        $conn = Database::getConnection();
        $select = $conn->prepare("SELECT 
                                    ED.ELETRO_ID,
                                    ED.ELETRO_CATEGORIA,
                                    ED.ELETRO_FORNECEDOR,
                                    ED.ELETRO_PRIORIDADE_REPOSICAO,
                                    ED.ELETRO_POTENCIA,
                                    ED.ELETRO_CONSUMO_ENERGETICO,
                                    ED.ELETRO_GARANTIA,
                                    E.ESTOQUE_QUANTIDADE,
                                    U.USU_NOME,
                                    U.USU_EMAIL
                                FROM ELETRODOMESTICO ED
                                JOIN USUARIO U ON ED.FK_USU_ID = U.USU_ID
                                JOIN ESTOQUE E ON ED.ELETRO_ID = E.FK_ELETRODOMESTICO_ID
                                WHERE ED.ELETRO_ID = ?
                                ORDER BY ED.ELETRO_CATEGORIA");
        $select->bind_param("i", $id);
        $select->execute();
        $result = $select->get_result();
        $eletrodomestico = $result->fetch_all(MYSQLI_ASSOC);
        $select->close();
        return $eletrodomestico;
    }

    // Editar eletrodoméstico
    public function editar_eletrodomestico($categoria, $fornecedor, $prioridade_reposicao, $potencia, $consumo_energetico, $garantia, $eletro_id, $fk_usu_id) {
        $conn = Database::getConnection();
        $update = $conn->prepare("UPDATE ELETRODOMESTICO SET ELETRO_CATEGORIA = ?, ELETRO_FORNECEDOR = ?, ELETRO_PRIORIDADE_REPOSICAO = ?, ELETRO_POTENCIA = ?, ELETRO_CONSUMO_ENERGETICO = ?, ELETRO_GARANTIA = ? WHERE ELETRO_ID = ?");
        $update->bind_param("ssssssi", $categoria, $fornecedor, $prioridade_reposicao, $potencia, $consumo_energetico, $garantia, $eletro_id);
        $success = $update->execute();

        if ($success) {
            $logs = new Logs();
            $logs->cadastrar_logs("ELETRODOMESTICO <br> ID: ".$eletro_id." <br> CATEGORIA: ".$categoria." <br> AÇÃO: Editado! <br> ID USUÁRIO: ".$fk_usu_id);
        }

        $update->close();
        return $success;
    }

    // Filtrar eletrodomésticos por categoria
    public function filtrar_eletrodomestico($campo) {
        $conn = Database::getConnection();
        $select = $conn->prepare("SELECT 
                                    ED.ELETRO_ID,
                                    ED.ELETRO_CATEGORIA,
                                    ED.ELETRO_FORNECEDOR,
                                    ED.ELETRO_PRIORIDADE_REPOSICAO,
                                    ED.ELETRO_POTENCIA,
                                    ED.ELETRO_CONSUMO_ENERGETICO,
                                    ED.ELETRO_GARANTIA,
                                    E.ESTOQUE_QUANTIDADE,
                                    U.USU_NOME,
                                    U.USU_EMAIL
                                FROM ELETRODOMESTICO ED
                                JOIN USUARIO U ON ED.FK_USU_ID = U.USU_ID
                                JOIN ESTOQUE E ON ED.ELETRO_ID = E.FK_ELETRODOMESTICO_ID
                                WHERE ED.ELETRO_CATEGORIA LIKE ?
                                ORDER BY ED.ELETRO_CATEGORIA");
        $termo = "%" . $campo . "%";
        $select->bind_param("s", $termo);
        $select->execute();
        $result = $select->get_result();
        $eletrodomesticos = $result->fetch_all(MYSQLI_ASSOC);
        $select->close();
        return $eletrodomesticos;
    }
}
?>