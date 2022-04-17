<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: POST");
    header("Access-Control-Max-Age: 3600");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

    include_once '../config/database.php';
    include_once '../class/peoples.php';

    $database = new Database();
    $db = $database->getConnection();
    $item = new People($db);

    $data = json_decode(file_get_contents("php://input"));

    $item->Name = $data->Name;
    $item->BirthDate = $data->BirthDate;
    $item->Salary = $data->Salary;
    
    if($item->createPeople()){
        echo 'People created successfully.';
    } else{
        echo 'People could not be created.';
    }
?>