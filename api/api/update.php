<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: PUT");
    header("Access-Control-Max-Age: 3600");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
    
    include_once '../config/database.php';
    include_once '../class/peoples.php';
    
    $database = new Database();
    $db = $database->getConnection();
    
    $item = new People($db);
    
    $data = json_decode(file_get_contents("php://input"));
    
    $item->Id = $data->Id;
    
    // employee values
    $item->Name = $data->Name;
    $item->BirthDate = $data->BirthDate;
    $item->Salary = $data->Salary;
    
    if($item->updatePeople()){
        echo json_encode("People data updated.");
    } else{
        echo json_encode("Data could not be deleted");
    }
?>