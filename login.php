<?php
include "connection.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
 
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    if (empty($username)) {
        echo "Please enter username<br>";
    } elseif (empty($password)) {
        echo "Please enter password<br>";
    } else {
        
        $query = "SELECT username, password FROM users WHERE username='$username' AND password='$password'";
        $result = mysqli_query($connection, $query);

        if ($result && mysqli_num_rows($result) > 0) {
         
            header("Location: welcome.html");
            exit();
        } else {
            echo "Invalid username or password";
        }
    }
}
$connection->close();
?>
