<?php

include_once "../../../Config/config.php";
include_once "../../../DB/database.php";
include_once "../../../Model/Post.php";
include_once "../../../Model/User.php";
include_once "../../../Validation/Post/PostRequest.php";
require_once "../../../vendor/autoload.php";

header("Content-Type:application/json");
$data = [];

function uploadImage($post_title){
    $file = new Bulletproof\Image($_FILES);
    $file->setName($post_title. '-' . uniqid()); 
    $file->setMime(array('jpg', 'png', 'jpeg'));
    $file->setLocation('../../../public/post/images');
    if ($file["image"]) {   
        $upload = $file->upload();
        if ($upload) {
            return $file->getName().'.'.$file->getMime();
        } else {
            $data = [
                'status'  => 'error',
                'message' => $file->getError()
            ];
            return false;
        }
    }

}

if( empty(validateCreatePost($_POST)) ){
    // print_r($_POST);exit;
    $userToken = tokenVerify($conn, $_POST['token']);
    if( $userToken ){
        $_POST['user_id'] = $userToken['id'];
        $_POST['image'] = '';

        $postImage = uploadImage($_POST['title']); 
        if($postImage){
            $_POST['image'] = $postImage;
        }

        if( createPost($conn, $_POST) ){
            $data = [
                'status' => 'success',
                'message' => 'Post created successfully'
            ];
            echo json_encode($data);
            http_response_code(201);
            return ;
        }else{
            $data = [
                'status' => 'error',
                'message' => 'Something went wrong'
            ];
            echo json_encode($data);
            http_response_code(500);
            return ;
        }
    }else{
        $data = [
            'status' => 'error',
            'message' => 'Invalid token'
        ];
        echo json_encode($data);
        http_response_code(400);
        return ;
    }
}
http_response_code(400);
echo json_encode(validateCreatePost($_POST));
return ;