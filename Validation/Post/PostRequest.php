<?php

function validateCreatePost($request)
{
    $data = [];

    if( empty( $request['title'] ) ){
        array_push($data,[
            'status' => 'error',
            'message' => 'Title field is required'
        ]);
    }

    if( empty($request['description']) ){
        array_push($data,[
            'status' => 'error',
            'message' => 'Description field is required'
        ]);
    }

    if( empty($request['token']) ){
        array_push($data,[
            'status' => 'error',
            'message' => 'Token field is required'
        ]);
    }

    return $data;
}




function validateShowPost($request){
    $data = [];

    if(empty($request['token'])){
        $data = [
            'status' => 'error',
            'message' => 'Token is required'
        ];
    }
    
    return $data;
}