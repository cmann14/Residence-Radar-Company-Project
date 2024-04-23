<?php
    $firstName = $_POST['firstName'];
    $lastName = $_POST['lastName'];
    $email = $_POST['email'];
    $phoneNumber = $_POST['phoneNumber'];
    $userName = $_POST['userName'];
    $password = $_POST['password'];

    //Database connection//
$conn = new mysqli('localhost', 'root', '', 'connTest');
if($conn->connect_error){
    die('Connection Failed : '.$conn->connect_error);
}else {
    $stmt = $conn->prepare("insert into registration(firstName, lastName, email, phoneNumber, userName, password)
        values(?, ?, ?, ?, ?, ?) ");
    $stmt->bind_param("sssiss", $firstName, $lastName, $email, $phoneNumber, $userName, $password);
    $stmt->execute();
    echo "registered successfully";
    $stmt->close();
    $conn->close();

}
    


