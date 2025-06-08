<?php
require_once 'Conexao.php';

class Tonner extends Conexao {
   
    private $tonnerId;
    private $status;
    private $modeloTonner;
    private $corTonner;
    private $dtAbertura;
    private $dtFechamento;
    private $autorId;
    private $autorNome;
    private $autorEmail;
    private $autorSetor;
    private $situacao;
    private $tecnico;
    private $idAtualizacao;
    private $impressoraId;

    // Getters e setters
    public function setTonnerId($tonnerId) {
        $this->tonnerId = $tonnerId;
    }
    public function getTonnerId() {
        return $this->tonnerId;
    }

    public function setStatus($status) {
        $this->status = $status;
    }
    public function getStatus() {
        return $this->status;
    }

    public function setModeloTonner($modeloTonner) {
        $this->modeloTonner = $modeloTonner;
    }
    public function getModeloTonner() {
        return $this->modeloTonner;
    }

    public function setCorTonner($corTonner) {
        $this->corTonner = $corTonner;
    }
    public function getCorTonner() {
        return $this->corTonner;
    }

    public function setDtAbertura($dtAbertura) {
        $this->dtAbertura = $dtAbertura;
    }
    public function getDtAbertura() {
        return $this->dtAbertura;
    }

    public function setDtFechamento($dtFechamento) {
        $this->dtFechamento = $dtFechamento;
    }
    public function getDtFechamento() {
        return $this->dtFechamento;
    }

    public function setAutorId($autorId) {
        $this->autorId = $autorId;
    }
    public function getAutorId() {
        return $this->autorId;
    }

    public function setAutorNome($autorNome) {
        $this->autorNome = $autorNome;
    }
    public function getAutorNome() {
        return $this->autorNome;
    }

    public function setAutorEmail($autorEmail) {
        $this->autorEmail = $autorEmail;
    }
    public function getAutorEmail() {
        return $this->autorEmail;
    }

    public function setAutorSetor($autorSetor) {
        $this->autorSetor = $autorSetor;
    }
    public function getAutorSetor() {
        return $this->autorSetor;
    }

    public function setSituacao($situacao) {
        $this->situacao = $situacao;
    }
    public function getSituacao() {
        return $this->situacao;
    }

    public function setTecnico($tecnico) {
        $this->tecnico = $tecnico;
    }
    public function getTecnico() {
        return $this->tecnico;
    }

    public function setIdAtualizacao($idAtualizacao) {
        $this->idAtualizacao = $idAtualizacao;
    }
    public function getIdAtualizacao() {
        return $this->idAtualizacao;
    }

    public function setImpressoraId($id) {
        $this->impressoraId = $id;
    }
    public function getImpressoraId() {
        return $this->impressoraId;
    }

    // Métodos CRUD e outros

    public function solicitarTonner() {
        $sql = "INSERT INTO tonnerSolicitacao (status, corTonner, autorId, autorNome, autorEmail, autorSetor, impressoraId)
                VALUES (:status, :corTonner, :autorId, :autorNome, :autorEmail, :autorSetor, :impressoraId)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':status', $this->status);
        $stmt->bindParam(':corTonner', $this->corTonner);
        $stmt->bindParam(':autorId', $this->autorId);
        $stmt->bindParam(':autorNome', $this->autorNome);
        $stmt->bindParam(':autorEmail', $this->autorEmail);
        $stmt->bindParam(':autorSetor', $this->autorSetor);
        $stmt->bindParam(':impressoraId', $this->impressoraId);
        return $stmt->execute() ? $this->conn->lastInsertId() : false;
    }

    public function listarTodasSolicitacoes() {
        $sql = "SELECT * FROM tonnersolicitacao";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function listarTonnerPorId($idAtual) {
        $sql = "SELECT * FROM tonnerSolicitacao WHERE tonnerId = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':id', $idAtual, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function listarTonnerPorId2($status = '', $tonnerId = '') {
        $sql = "SELECT * FROM tonnersolicitacao WHERE 1=1"; 

        if (!empty($status) && $status !== 'Todos') {
            $sql .= " AND status = :status";
        } elseif (empty($status)) {
            $sql .= " AND (status = 'Aberto' OR status = 'Em andamento')";
        }

        if (!empty($tonnerId)) {
            $sql .= " AND tonnerId = :tonnerId";
        }

        $stmt = $this->conn->prepare($sql);

        if (!empty($status) && $status !== 'Todos') {
            $stmt->bindParam(':status', $status, PDO::PARAM_STR);
        }

        if (!empty($tonnerId)) {
            $stmt->bindParam(':tonnerId', $tonnerId, PDO::PARAM_INT);
        }

        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function listarTodosTonnerPorId($autorId, $status = '', $tonnerId = '') {
        $sql = "SELECT * FROM tonnersolicitacao WHERE autorId = :autorId";

        if (!empty($status) && $status !== 'Todos') {
            $sql .= " AND status = :status";
        } elseif (empty($status)) {
            $sql .= " AND (status = 'Aberto' OR status = 'Em andamento')";
        }

        if (!empty($tonnerId)) {
            $sql .= " AND tonnerId = :tonnerId";
        }

        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':autorId', $autorId, PDO::PARAM_INT);

        if (!empty($status) && $status !== 'Todos') {
            $stmt->bindParam(':status', $status, PDO::PARAM_STR);
        }

        if (!empty($tonnerId)) {
            $stmt->bindParam(':tonnerId', $tonnerId, PDO::PARAM_INT);
        }

        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function listarTonnerPorTicket($idFiltro) {
        $sql = "SELECT * FROM tonnersolicitacao WHERE tonnerId = :tonnerId";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':tonnerId', $idFiltro, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function listarTonnerPorTicket2($autorId, $idFiltro = '') {
        $sql = "SELECT * FROM tonnersolicitacao WHERE autorId = :autorId";

        if (!empty($idFiltro)) {
            $sql .= " AND tonnerId = :tonnerId";
        }

        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':autorId', $autorId, PDO::PARAM_INT);

        if (!empty($idFiltro)) {
            $stmt->bindParam(':tonnerId', $idFiltro, PDO::PARAM_INT);
        }

        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function atualizarSolicitacao($status, $situacao, $idAtual) {
        $sql = "UPDATE tonnerSolicitacao SET status = :status, situacao = :situacao WHERE tonnerId = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':status', $status, PDO::PARAM_STR);
        $stmt->bindParam(':situacao', $situacao, PDO::PARAM_STR);
        $stmt->bindParam(':id', $idAtual, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->rowCount();
    }

    public function adicionarAtualizacao() {
        $sql = "INSERT INTO tonneratualizacao (tonnerId, tecnico, situacao) VALUES (:tonnerId, :tecnico, :situacao)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':tonnerId', $this->tonnerId);
        $stmt->bindParam(':tecnico', $this->tecnico);
        $stmt->bindParam(':situacao', $this->situacao);
        return $stmt->execute();
    }

    public function listarAtualizacoesPorSolicitacao($tonnerId) {
        $sql = "SELECT id_atualizacao, dtAtualizacao, tecnico, situacao 
                FROM tonneratualizacao 
                WHERE tonnerId = :tonnerId";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':tonnerId', $tonnerId);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function excluirAtualizacao() {
        $sql = "DELETE FROM tonneratualizacao WHERE id_atualizacao = :idAtualizacao";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':idAtualizacao', $this->idAtualizacao);
        return $stmt->execute();
    }
}
