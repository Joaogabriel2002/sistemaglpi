<?php
require_once 'Conexao.php';

class Itens extends Conexao {
    private $id;
    private $nome;
    private $tipo;

    public function setId($id) {
        $this->id = $id;
    }

    public function getId() {
        return $this->id;
    }

    public function setNome($nome) {
        $this->nome = $nome;
    }

    public function getNome() {
        return $this->nome;
    }

    public function setTipo($tipo) {
        $this->tipo = $tipo;
    }

    public function getTipo() {
        return $this->tipo;
    }


    public function listarItens() {
        $sql = "SELECT * FROM itens ORDER by nome";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        
             $resultados = $stmt->fetchAll(PDO::FETCH_ASSOC);

             return $resultados;
        }
    
    public function cadastrarItens(){
        $sql = "INSERT INTO itens (nome,tipo) VALUES (:nome,:tipo)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':nome',$this->nome);
        $stmt->bindParam(':tipo',$this->tipo);
        if ($stmt->execute()){
                return $this->conn->lastInsertId();
            }else{
                return false;
            }
    }

   public function listarEstoque() {
    $sql = "
        SELECT 
            i.id,
            i.nome,
            i.tipo,
            COALESCE(SUM(CASE WHEN e.tipo_movimentacao = 'ENTRADA' THEN e.quantidade ELSE 0 END), 0) -
            COALESCE(SUM(CASE WHEN e.tipo_movimentacao = 'SAIDA' THEN e.quantidade ELSE 0 END), 0) AS saldo
        FROM itens i
        LEFT JOIN estoque e ON i.id = e.item_id
        GROUP BY i.id, i.nome, i.tipo
        ORDER BY i.nome
    ";
    $stmt = $this->conn->prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}


}
?>
