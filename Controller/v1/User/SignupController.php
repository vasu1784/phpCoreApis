<?php

include_once "../../../Config/config.php";
include_once "../../../DB/database.php";
include_once "../../../Model/User.php";
include_once "../../../Validation/User/UserRequest.php";

header("Content-Type:application/json");
$data = [];
if (empty(validateUser($_POST))) {
    if ( isEmailExist($conn, $_POST['email']) ) {
        $data = [
            'status' => 'error',
            'message' => 'Email address is already exists'
        ];
        http_response_code(400);
        echo json_encode($data);
        return ;
    }else{
        // exit;
        unset($_POST['confirm_password']);
        $test = createUser($conn, $_POST);
        $data = [
            'status' => 'success',
            'message' => 'User registered successfully'
        ];
        http_response_code(201);
        echo json_encode($data);
        return ;
    }
} else {
    echo json_encode(validateUser($_POST));
}
http_response_code(200);