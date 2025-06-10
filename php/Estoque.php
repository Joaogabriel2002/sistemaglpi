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


    public function incluirEstoque(){
        $sql= "INSERT INTO estoque (item_id, nota_fiscal, fornecedor, quantidade, tipo_movimentacao,motivo)
               VALUES (:item_id, :nota_fiscal, :fornecedor, :quantidade, :tipo_movimentacao,:motivo)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':item_id', $this->item_id);
        $stmt->bindParam(':nota_fiscal', $this->nota_fiscal);
        $stmt->bindParam(':fornecedor', $this->fornecedor);
        $stmt->bindParam(':quantidade', $this->quantidade);
        $stmt->bindParam(':tipo_movimentacao', $this->tipo_movimentacao);
        $stmt->bindParam(':motivo', $this->motivo);

        $success = $stmt->execute();

        if ($success) {
            // Retorna o último ID inserido
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

}
