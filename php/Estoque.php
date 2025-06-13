<?php
require_once 'Conexao.php';

class Estoque extends Conexao {
    private $id;
    private $item_id;
    private $nota_fiscal;
    private $fornecedor;
    private $quantidade;
    private $tipo_movimentacao;
    private $data_movimentacao;
    private $motivo;
    private $usuarioId;

    public function setId($id){
        $this->id = $id;
    }

    public function getId(){
        return $this->id;
    }

    public function setItemId($item_id){
        $this->item_id = $item_id;
    }

    public function getItemId(){
        return $this->item_id;
    }

    public function setNotaFiscal($nota_fiscal){
        $this->nota_fiscal = $nota_fiscal;
    }

    public function getNotaFiscal(){
        return $this->nota_fiscal;
    }

    public function setFornecedor($fornecedor){
        $this->fornecedor = $fornecedor;
    }

    public function getFornecedor(){
        return $this->fornecedor;
    }

    public function setQuantidade($quantidade){
        $this->quantidade = $quantidade;
    }

    public function getQuantidade(){
        return $this->quantidade;
    }

    public function setTipo_Movimentacao($tipo_movimentacao){
        $this->tipo_movimentacao = $tipo_movimentacao;
    }

    public function getTipo_Movimentacao(){
        return $this->tipo_movimentacao;
    }

    public function setData_Movimentacao($data_movimentacao){
        $this->data_movimentacao = $data_movimentacao;
    }

    public function getData_Movimentacao(){
        return $this->data_movimentacao;
    }

     public function setMotivo($motivo){
        $this->motivo = $motivo;
    }

    public function getMotivo(){
        return $this->motivo;
    }

    public function setUsuarioId($usuarioId){
        $this->usuarioId = $usuarioId;
    }

    public function getUsuarioId(){
        return $this->usuarioId;
    }


   public function incluirEstoque(){
    $sql = "INSERT INTO estoque (item_id, nota_fiscal, fornecedor, quantidade, tipo_movimentacao, motivo, usuario_id)
            VALUES (:item_id, :nota_fiscal, :fornecedor, :quantidade, :tipo_movimentacao, :motivo, :usuario_id)";
    
    $stmt = $this->conn->prepare($sql);
    $stmt->bindParam(':item_id', $this->item_id);
    $stmt->bindParam(':nota_fiscal', $this->nota_fiscal);
    $stmt->bindParam(':fornecedor', $this->fornecedor);
    $stmt->bindParam(':quantidade', $this->quantidade);
    $stmt->bindParam(':tipo_movimentacao', $this->tipo_movimentacao);
    $stmt->bindParam(':motivo', $this->motivo);
    $stmt->bindParam(':usuario_id', $this->usuarioId);

    $success = $stmt->execute();

    if ($success) {
        return $this->conn->lastInsertId();
    } else {
        return false;
    }
}


    //para nao deixar
    public function consultarSaldo($item_id) {
    $sql = "SELECT 
                (SELECT COALESCE(SUM(quantidade), 0) FROM estoque WHERE item_id = :item_id AND tipo_movimentacao = 'ENTRADA') -
                (SELECT COALESCE(SUM(quantidade), 0) FROM estoque WHERE item_id = :item_id AND tipo_movimentacao = 'SAIDA') 
            AS saldo";
    
    $stmt = $this->conn->prepare($sql);
    $stmt->bindParam(':item_id', $item_id);
    $stmt->execute();
    $resultado = $stmt->fetch(PDO::FETCH_ASSOC);

    return $resultado ? $resultado['saldo'] : 0;
}


    public function listarMovimentacoes(){
    $sql = "SELECT
                e.id,
                e.nota_fiscal,
                e.fornecedor,
                e.quantidade,
                e.tipo_movimentacao,
                e.data_movimentacao,
                e.motivo,
                u.nome AS usuario,     -- nome do usuário, não o id
                i.nome AS nomeItem,
                e.item_id              -- se quiser manter o id do item também
            FROM estoque e
            LEFT JOIN usuarios u ON e.usuario_id = u.id
            LEFT JOIN itens i ON e.item_id = i.id";

    $stmt = $this->conn->prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}
    public function consultarMovimentacoesPorItemId($item_id){
    $sql = "SELECT
                e.id,
                e.nota_fiscal,
                e.fornecedor,
                e.quantidade,
                e.tipo_movimentacao,
                e.data_movimentacao,
                e.motivo,
                u.nome AS usuario,
                i.nome AS nomeItem,
                e.item_id
            FROM estoque e
            LEFT JOIN usuarios u ON e.usuario_id = u.id
            LEFT JOIN itens i ON e.item_id = i.id
            WHERE e.item_id = :item_id";

    $stmt = $this->conn->prepare($sql);
    $stmt->bindParam(':item_id', $item_id, PDO::PARAM_INT);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);

    }

public function buscarSaldo($nome, $cor) {
    $sql = "
        SELECT 
            COALESCE(SUM(CASE WHEN tipo_movimentacao = 'entrada' THEN quantidade ELSE 0 END), 0) -
            COALESCE(SUM(CASE WHEN tipo_movimentacao = 'saida' THEN quantidade ELSE 0 END), 0) AS saldo
        FROM movimentacoes
        WHERE nome = :nome AND cor = :cor
    ";

    $stmt = $this->conn->prepare($sql);
    $stmt->bindParam(':nome', $nome);
    $stmt->bindParam(':cor', $cor);
    $stmt->execute();

    $resultado = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($resultado) {
        return (int)$resultado['saldo'];
    } else {
        return 0;
    }
}



}
