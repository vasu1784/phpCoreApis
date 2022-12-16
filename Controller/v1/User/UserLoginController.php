<?php

include_once "../../../Config/config.php";
include_once "../../../DB/database.php";
include_once "../../../Model/User.php";
include_once "../../../Validation/User/UserLoginRequest.php";

header("Content-Type:application/json");
if (empty(validateLoginUser($_POST))) {
    $user = userLogin($conn, $_POST);
    if(!empty($user)){
        $data = [
            'status' => 'success',
            'message' => 'Login successfully',
            'user' => $user
        ];
        http_response_code(200);
        echo json_encode($data);
        return ;
    }else{
        $data = [
            'status' => 'error',
            'message' => 'Invalid email or password'
        ];
        http_response_code(200);
        echo json_encode($data);
        return ;
    }
        
        
}else {
    // echo json_encode(validateUser($_POST));
     echo json_encode(validateLoginUser($_POST));

    return ;
}