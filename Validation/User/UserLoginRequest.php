<?php

function validateLoginUser($request)
{
    switch($request){
        // if email is empty
        case empty($request['email']):
            $data = [
                'status' => 'error',
                'message' => 'Email field is required'
            ];
            return $data;
            
        case empty($request['password']):
            $data = [
                'status' => 'error',
                'message' => 'Password field is required'
            ];
        return $data;

        default:
            return [];           
    }
}
