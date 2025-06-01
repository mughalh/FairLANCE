<?php
include "connection.php";

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['id'])) {
    $id = $_POST['id'];

    $sql = "DELETE FROM orders WHERE order_id = $id";

    if ($connection->query($sql) === TRUE) {
        $connection->close();
        header("Location: projects.php");
        exit();
    } else {
        echo "Error deleting record: " . $connection->error;
    }
} else {
    echo "Invalid request.";
}
$connection->close();
?>
