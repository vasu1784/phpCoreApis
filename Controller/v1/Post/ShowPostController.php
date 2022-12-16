<?php

include_once "../../../Config/config.php";
include_once "../../../DB/database.php";
include_once "../../../Model/Post.php";
include_once "../../../Model/User.php";
include_once "../../../Validation/Post/PostRequest.php";

header("Content-Type:application/json");
$data = [];

if (empty(validateShowPost($_POST))) {
    $userToken = tokenVerify($conn, $_POST['token']);
    if($userToken){
        $userPost = showPost($conn, $userToken['id']);
        $data = [
            'status' => 'sussess',
            'message' => 'Post fetched successfully',
            'data' => [
                'user' => $userToken,
                'posts' => $userPost
            ]
        ];
        echo json_encode($data);
        return ;
    }else{
        $data = [
            'status' => 'error',
            'message' => 'Invalid token'
        ];
        echo json_encode($data);
        return ;
    }
}

http_response_code(400);
echo json_encode(validateShowPost($_POST));
return;
