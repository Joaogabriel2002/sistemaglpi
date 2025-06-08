<?php
require_once 'Conexao.php';

class Fornecedor extends Conexao {
    private $id_fornecedor;
    private $nome;
    private $cnpj;
    private $telefone;
    private $email;
    private $endereco;

    public function setIdFornecedor($id_fornecedor) {
        $this->id_fornecedor = $id_fornecedor;
    }

    public function getIdFornecedor() {
        return $this->id_fornecedor;
    }

    public function setNome($nome) {
        $this->nome = $nome;
    }

    public function getNome() {
        return $this->nome;
    }

    public function setCnpj($cnpj) {
        $this->cnpj = $cnpj;
    }

    public function getCnpj() {
        return $this->cnpj;
    }

    public function setTelefone($telefone) {
        $this->telefone = $telefone;
    }

    public function getTelefone() {
        return $this->telefone;
    }

    public function setEmail($email) {
        $this->email = $email;
    }

    public function getEmail() {
        return $this->email;
    }

    public function setEndereco($endereco) {
        $this->endereco = $endereco;
    }

    public function getEndereco() {
        return $this->endereco;
    }

    public function listarFornecedores() {
        $sql = "SELECT * FROM fornecedor ORDER BY nome";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function listarFornecedoresPorId($id) {
        $sql = "SELECT * FROM fornecedor WHERE id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
        }

    public function cadastrarFornecedor() {
        $sql = "INSERT INTO fornecedor (nome, cnpj, telefone, email, endereco) 
                VALUES (:nome, :cnpj, :telefone, :email, :endereco)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':nome', $this->nome);
        $stmt->bindParam(':cnpj', $this->cnpj);
        $stmt->bindParam(':telefone', $this->telefone);
        $stmt->bindParam(':email', $this->email);
        $stmt->bindParam(':endereco', $this->endereco);

        if ($stmt->execute()) {
            return $this->conn->lastInsertId();
        } else {
            return false;
        }
    }

        public function atualizarFornecedor($id, $nome, $email, $telefone) {
        $sql = "UPDATE fornecedor SET nome = ?, email = ?, telefone = ? WHERE id = ?";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([$nome, $email, $telefone, $id]);
        }

        public function excluir(){
            $sql="DELETE FROM fornecedor WHERE id=:id_fornecedor";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':id_fornecedor',$this->id_fornecedor);
            return $stmt->execute();
        }
}
?>
