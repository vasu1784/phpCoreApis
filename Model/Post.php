<?php

/**
 * Create New Post
 * @param $conn
 * @param $postData
 */

$tablePost = 'posts';

function createPost($conn, array $postData)
{
    global $tablePost; unset($postData['token']);

    $query = "INSERT INTO `$tablePost` (`title`, `description`, `image`, `user_id`) VALUES (:title, :description, :image, :user_id);";
    
    $conn->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING );  
    $stmt = $conn->prepare($query);
    $result = $stmt->execute([
        'title'       => $postData['title'],
        'description' => $postData['description'],
        'image'       => $postData['image'],
        'user_id'     => $postData['user_id'],
    ]);
    if ($result) {
        return true;
    }
    return false;
}

function showPost($conn, $user_id){
    global $tablePost;
    $query = "SELECT * FROM `$tablePost` WHERE user_id = :user_id";
    $stmt = $conn->prepare($query);
    $stmt->execute([
        ':user_id' => $user_id
    ]);
    $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
    if($result){
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    return false;
}