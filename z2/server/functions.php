<?php
require __DIR__.'/config.php';

function addRecord($conn, $login, $type){
    
    $stmt = $conn->prepare("INSERT INTO action (login, type) VALUES (:login, :type)");
    $stmt->bindParam(':login', $login);
    $stmt->bindParam(':type', $type);
    if(!$stmt->execute())
        var_dump($stmt->errorInfo(),
                 "INSERT INTO action (login, type) VALUES (:login, :type)",
                $login,$type);
}
function addUser($conn, $login, $password, $email, $firstName, $lastName){
    $stmt = $conn->prepare("INSERT INTO user (login, password, email, first_name, last_name) VALUES (:login, :password, :email, :first_name, :last_name)");
    $stmt->bindParam(':login', $login);
    $stmt->bindParam(':password', $password);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':first_name', $firstName);
    $stmt->bindParam(':last_name', $lastName);
    $stmt->execute();
}
function fetchUser($conn, $login){
    $request = $conn->prepare(" SELECT login, password FROM user where login = :login");
    $request->setFetchMode(PDO::FETCH_ASSOC);
    return $request->execute(array(':login' => $login)) ? $request->fetch() : false;
}
function fetchHistory($conn){
    $request = $conn->prepare(" SELECT login, type, date_time FROM action");
    $request->setFetchMode(PDO::FETCH_ASSOC);
    return $request->execute() ? $request->fetchAll() : false;
}