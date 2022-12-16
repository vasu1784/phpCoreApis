<?php

function validateUser($request)
{
    switch($request){
        // firstname is empty 


        case empty($request['email']):
            $data = [
                'status' => 'error',
                'message' => 'Email Field Is Required'
            ];
            return $data;


            case isset($request['email']) && !filter_var($request['email'], FILTER_VALIDATE_EMAIL):
                $data = [
                    'status' => 'error',
                    'message' => 'Please Enter Valid Email Address'
                ];
                return $data;


                case empty($request['password']):
                    $data = [
                        'status' => 'error',
                        'message' => 'Password Field Is Required'
                    ];
                    return $data;


                    case empty($request['confirm_password']):
                        $data = [
                            'status' => 'error',
                            'message' => 'Confirm Password Field Is Required'
                        ];
                        return $data;
                        

        case empty($request['firstname']):
            $data = [
                'status' => 'error',
                'message' => 'First Name Field Is Required'
            ];
            return $data; 
            // return json_encode($data); 

        // if lastname is empty 
        case empty($request['lastname']):
            $data = [
                'status' => 'error',
                'message' => 'Lastname Field Is Required'
            ];
            return $data;

          
            // return json_encode($data); 
        
        // if email is empty
       
            // return json_encode($data);
        
        // if email is valid
        
            // return json_encode($data);
        
        // if email address already exist
        // case isEmailExist($conn, $request['email']):
        //     $data = [
        //         'status' => 'error',
        //         'message' => 'Email address is already exists'
        //     ];
        //     return json_encode($data);
        // if password is empty 
      
            // return json_encode($data);

        // if comfirm_password is empty
      
            // return json_encode($data);
        
        // password and confirm_password not matched
        case $request['password'] !== $request['confirm_password']:
            $data = [
                'status' => 'error',
                'message' => 'Password Did Not Match'
            ];
            return $data;
            // return json_encode($data);
        default:
            return [];           
    }
}
