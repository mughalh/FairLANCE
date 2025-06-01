<?php
include "connection.php";

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['name']) && isset($_POST['category']) && isset($_POST['price']) && isset($_POST['dueDate']) && isset($_POST['description'])) {


    $name = trim($_POST['name']);
    $category = trim($_POST['category']);
    $price = trim($_POST['price']);
    $dueDate = trim($_POST['dueDate']);
    $description = trim($_POST['description']);
    $user_id = 1; 

    $sql = "INSERT INTO orders (user_id, date_due, detail, order_name, order_type, price)
            VALUES ('$user_id', '$dueDate', '$description', '$name', '$category', '$price')";

    if ($connection->query($sql) === TRUE) {
    
        echo "Data inserted successfully<br>";
        header("Location: projects.php");
        exit();
    } else {
        echo "Error: " . $connection->error . "<br>";
    }
} else {
    echo "Form not submitted correctly.<br>";
}
$connection->close();
?>