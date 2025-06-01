<?php
include "connection.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $firstname = trim($_POST['name']);
    $username = trim($_POST['username']);
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);
    $passworda = trim($_POST['passworda']);

    if (empty($firstname)) {
        echo "Name cannot be empty<br>";
    }
    if (empty($username)) {
        echo "Username cannot be empty<br>";
    }
    if (empty($email)) {
        echo "Email cannot be empty<br>";
    }
    if (empty($password) || empty($passworda)) {
        echo "Please create a password<br>";
    }
    if ($password !== $passworda) {
        echo "Passwords don't match<br>";
    }
    if (!empty($firstname) && !empty($username) && !empty($email) && !empty($password) && $password === $passworda) {
        $sql = "INSERT INTO users (name, username, email, password) VALUES ('$firstname', '$username', '$email', '$password')";

        if ($connection->query($sql) === TRUE) {
            header("Location: success.html");
            exit(); 
        } else {
            echo "Data not created: " . $connection->error;
        }
    }
}
$connection->close();
?>
