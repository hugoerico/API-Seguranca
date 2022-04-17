<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    
    include_once '../config/database.php';
    include_once '../class/peoples.php';
    
    $database = new Database();
    $db = $database->getConnection();
    $items = new People($db);
    $stmt = $items->getPeoples();
    $itemCount = $stmt->rowCount();
    
    if($itemCount > 0){
        
        $peopleArr = array();
        $peopleArr["peoples"] = array();

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            extract($row);
            $e = array(
                "Id" => $Id,
                "Name" => $Name,
                "BirthDate" => $BirthDate,
                "Salary" => $Salary
            );
            array_push($peopleArr["peoples"], $e);
        }
        echo json_encode($peopleArr);
    }
    else{
        http_response_code(404);
        echo json_encode(
            array("message" => "No record found.")
        );
    }
?>