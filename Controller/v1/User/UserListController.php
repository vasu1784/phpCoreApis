<?php

include_once "../../../Config/config.php";
include_once "../../../DB/database.php";
include_once "../../../Model/User.php";
include_once "../../../Validation/User/UserRequest.php";

header("Content-Type:application/json");
$data = [];
    if( !empty(allUsers($conn)) ){
        echo json_encode( allUsers($conn) );
        http_response_code(200);
        return ;
    }

    $data = [
        'status' => 'success',
        'message' => 'No Data'
    ];
http_response_code(200);