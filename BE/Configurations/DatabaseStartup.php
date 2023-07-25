<?php
    abstract class ConnectDatabase {
        protected $db_type;
        protected $db_host;
        protected $db_name;
        protected $user_name;
        protected $user_pass;
        protected $conn;
        public function __construct() {
            $this->db_type = 'mysql';
            $this->db_host = 'localhost';
            $this->db_name = 'test'; 
            $this->user_name = 'root'; 
            $this->user_pass = 'pwdpwd'; 
            $this->conn = $this->connect();
        }
        public function connect() {
            try {
                $conn = new PDO("$this->db_type:host=$this->db_host;dbname=$this->db_name", $this->user_name, $this->user_pass);
                $conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
                return $conn; 
            } catch (Exception $e) {
                die("ConnectDB failed: " . $e->getMessage());
            }
        }
        public function prepare($sql) {
            return $this->conn->prepare($sql);
        }     
    }
?>