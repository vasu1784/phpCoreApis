<?php

include_once "../../../Config/config.php";
include_once "../../../DB/database.php";
include_once "../../../Model/User.php";
include_once "../../../Validation/User/UserRequest.php";

header("Content-Type:application/json");
$data = [];
    if( !empty($_GET['user_id']) ){
        if( !empty(allUsers($conn)) ){
            echo json_encode( userById($conn, $_GET['user_id']) );
            http_response_code(200);
            return ;
        }
        $data = [
            'status' => 'success',
            'message' => 'No Data'
        ];
        http_response_code(200);
        echo json_encode($data);
        return ;
    }
    $data = [
        'status' => 'error',
        'message' => 'User id is required'
    ];
echo json_encode($data);
http_response_code(400);
return ;
