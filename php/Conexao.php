<?php

    class Conexao{

        private $dbname = "glpi_teste";
        private $user = "usuario";
        private $password ="senha";
        private $host = "172.20.90.69";
        protected $conn;
        
        
        public function __construct() {
            try {
                $this->conn = new PDO("mysql:host=$this->host;dbname=$this->dbname", $this->user, $this->password);
                $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch (PDOException $e) {
                echo "Erro de conexão: " . $e->getMessage();
            }
        }
    }


?>