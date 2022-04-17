<?php
    class People{
        // Connection
        private $conn;
        // Table
        private $db_table = "people";
        // Columns
        public $Id;
        public $Name;
        public $BirthDate;
        public $Salary;

        // Db connection
        public function __construct($db){
            $this->conn = $db;
        }
        // GET ALL
        public function getPeoples(){
            $sqlQuery = "SELECT Id, Name, BirthDate, Salary FROM " . $this->db_table . "";
            $stmt = $this->conn->prepare($sqlQuery);
            $stmt->execute();
            return $stmt;
        }
        // CREATE
        public function createPeople(){
            $sqlQuery = "INSERT INTO
                        ". $this->db_table ."
                    SET
                        Name = :Name, 
                        BirthDate = :BirthDate, 
                        Salary = :Salary";
        
            $stmt = $this->conn->prepare($sqlQuery);
        
            // sanitize
            $this->Name=htmlspecialchars(strip_tags($this->Name));
            $this->BirthDate=htmlspecialchars(strip_tags($this->BirthDate));
            $this->Salary=htmlspecialchars(strip_tags($this->Salary));
        
            // bind data
            $stmt->bindParam(":Name", $this->Name);
            $stmt->bindParam(":BirthDate", $this->BirthDate);
            $stmt->bindParam(":Salary", $this->Salary);
        
            if($stmt->execute()){
               return true;
            }
            return false;
        }
        // READ single
        public function getSinglePeople(){
            $sqlQuery = "SELECT
                        Id, 
                        Name, 
                        BirthDate, 
                        Salary
                      FROM
                        ". $this->db_table ."
                    WHERE 
                       Id = ?
                    LIMIT 0,1";
            $stmt = $this->conn->prepare($sqlQuery);
            $stmt->bindParam(1, $this->Id);
            $stmt->execute();
            $dataRow = $stmt->fetch(PDO::FETCH_ASSOC);
            
            $this->Name = $dataRow['Name'];
            $this->BirthDate = $dataRow['BirthDate'];
            $this->Salary = $dataRow['Salary'];
        }        
        // UPDATE
        public function updatePeople(){
            $sqlQuery = "UPDATE
                        ". $this->db_table ."
                    SET
                        Name = :Name, 
                        BirthDate = :BirthDate, 
                        Salary = :Salary
                    WHERE 
                        Id = :Id";
        
            $stmt = $this->conn->prepare($sqlQuery);
        
            $this->Name=htmlspecialchars(strip_tags($this->Name));
            $this->BirthDate=htmlspecialchars(strip_tags($this->BirthDate));
            $this->Salary=htmlspecialchars(strip_tags($this->Salary));
            $this->Id=htmlspecialchars(strip_tags($this->Id));
        
            // bind data
            $stmt->bindParam(":Name", $this->Name);
            $stmt->bindParam(":BirthDate", $this->BirthDate);
            $stmt->bindParam(":Salary", $this->Salary);
            $stmt->bindParam(":Id", $this->Id);
        
            if($stmt->execute()){
               return true;
            }
            return false;
        }
        // DELETE
        function deletePeople(){
            $sqlQuery = "DELETE FROM " . $this->db_table . " WHERE Id = ?";
            $stmt = $this->conn->prepare($sqlQuery);
        
            $this->Id=htmlspecialchars(strip_tags($this->Id));
        
            $stmt->bindParam(1, $this->Id);
        
            if($stmt->execute()){
                return true;
            }
            return false;
        }
    }
?>