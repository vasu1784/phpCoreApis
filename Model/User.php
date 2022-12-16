<?php

/**
 * User SignUp
 * @param $conn
 * @param $userData
 */

$tableUser = 'users';

function createUser($conn, array $userData)
{
    global $tableUser;
    $query = "INSERT INTO `$tableUser` (`firstname`, `lastname`, `email`, `password`) VALUES (:firstname, :lastname, :email, md5(:password));";
    $stmt = $conn->prepare($query);
    $stmt->execute($userData);
    if ($stmt) {
        return true;
    }
    return false;
}

/**
 * Check Email
 * @param $conn
 * @param $email
 */

function isEmailExist($conn, String $email)
{
    global $tableUser;
    $query = "SELECT * FROM `$tableUser` WHERE `email` = :email";
    $stmt = $conn->prepare($query);
    $stmt->execute([':email' => $email]);
    if ($stmt->rowCount() > 0) {
        return true;
    }
    return false;
}

/**
 * List All users
 * @param $conn
 */

function allUsers($conn)
{
    global $tableUser;
    $query = "SELECT * FROM `$tableUser`";
    $stmt = $conn->query($query);
    if ($stmt->rowCount() > 0) {
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    return [];
}

/**
 * Show User By Id
 * @param $conn
 * @param $userId
 */

function userById($conn, int $userId)
{
    global $tableUser;
    $query = "SELECT * FROM `$tableUser` WHERE id = ? LIMIT 1";
    $stmt = $conn->prepare($query);
    $stmt->execute([$userId]);
    if ($stmt->rowCount() > 0) {
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    return [];
}

/**
 * User Login
 * @param $conn
 * @param $userData
 */

function userLogin($conn, array $userData)
{
    global $tableUser;
    $query = "SELECT * FROM `$tableUser` WHERE email = :email and password = :password LIMIT 1;";
    $stmt = $conn->prepare($query);
    $stmt->execute($userData);
    if ($stmt->rowCount() > 0) {
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        
        $userData = [
            'token' => $s = substr(str_shuffle(str_repeat("0123456789abcdefghijklmnopqrstuvwxyz", 50)), 0, 50),
            'id' => $result['id']
        ];

        generateToken($conn, $userData);

        $result['token'] = $userData['token'];
        return $result;
    } else {
        return [];
    }
}

/**
 * Generate Token
 * @param $conn
 * @param $userId
 */

function generateToken($conn, array $userData)
{
    global $tableUser;
    $query = "UPDATE `$tableUser` SET token=:token WHERE id=:id;";
    $stmt = $conn->prepare($query)->execute($userData);
    if($stmt){
        return true;
    }
    return false;
}


/**
 * Token Verify
 * @param $conn
 * @param $token
 */

 function tokenVerify($conn, String $token) {
    global $tableUser;
	$query = "select * from `$tableUser` where token=:token LIMIT 1";
	$stmt = $conn->prepare($query);
	$stmt->execute([":token"=>$token]);
	$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
	if($result == true && $stmt->rowCount() > 0){
        return $stmt->fetch(PDO::FETCH_ASSOC);
	}
    return false;
 }

 function userDetail($conn, $id){
    global $tableUser;
	$query = "select * from `$tableUser` where id=:id LIMIT 1";
	$stmt = $conn->prepare($query);
	$stmt->execute([":id"=>$id]);
	$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
	if($result == true){
		while($row = $stmt->fetch()){
			return $row;
		}
	}
}