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
    $item->Id = isset($_GET['Id']) ? $_GET['Id'] : die();
  
    $item->getSinglePeople();

    if($item->Name != null){
        // create array
        $emp_arr = array(
            "Id" =>  $item->Id,
            "Name" => $item->Name,
            "BirthDate" => $item->BirthDate,
            "Salary" => $item->Salary,
        );
      
        http_response_code(200);
        echo json_encode($emp_arr);
    }
      
    else{
        http_response_code(404);
        echo json_encode("People not found.");
    }
?>