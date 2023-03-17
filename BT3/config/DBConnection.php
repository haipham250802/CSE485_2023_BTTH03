<?php
    Class DBConnection{
        private $conn = null;

        public function __construct(){
            $options  = [                      
                PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                PDO::ATTR_EMULATE_PREPARES   => false,
            ]; 
            try{
                $this->conn = new PDO('mysql:host=localhost;dbname=btth01_cse485;post=3306','root','',$options);
            }catch(PDOException $e){
                echo $e->getMessage();
            }
        }
        public function getConnection(){
            return $this->conn;
        }
    }
