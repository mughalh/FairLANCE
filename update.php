<?php
include "connection.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['id'])) {
        $id = ($_POST['id']); 

        $sql = "SELECT order_name, order_type, price, date_due, detail FROM orders WHERE order_id = $id";
        $result = $connection->query($sql);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();

            if (isset($_POST['name']) && isset($_POST['category']) && isset($_POST['price']) && isset($_POST['dueDate']) && isset($_POST['description'])) {
            
                $name = trim($_POST['name']);
                $category = trim($_POST['category']);
                $price = trim($_POST['price']);
                $dueDate = trim($_POST['dueDate']);
                $description = trim($_POST['description']);

                $updateSql = "UPDATE orders SET 
                                order_name = '$name', 
                                order_type = '$category', 
                                price = '$price', 
                                date_due = '$dueDate', 
                                detail = '$description' 
                              WHERE order_id = $id";

                if ($connection->query($updateSql) === TRUE) {
                    header("Location: projects.php");
                    exit();
                } else {
                    echo "Error updating record: " . $connection->error;
                }
            }
        } else {
            echo "No records found.";
        }
    } else {
        echo "Invalid request.";
    }

    $connection->close();
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>FairLANCE Order Change</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="navbar">
        <h1 class="title">FairLANCE</h1>
        <a href="index.html"><strong>Home</strong></a>
    </div>

    <div class="body-log">
        <h2>Order Form</h2>
        
        <?php if (isset($row)): ?>
            <form method="post" action="" name="change">
                <input type="hidden" name="id" value="<?php echo ($id); ?>">
                <input type="text" id="name" name="name" placeholder="Order Name" value="<?php echo ($row['order_name']); ?>" required>
                
                <select id="category" name="category" type="category" required>
                    <option value="web_development" <?php echo $row['order_type'] == 'web_development'; ?>>Web Development</option>
                    <option value="graphic_design" <?php echo $row['order_type'] == 'graphic_design' ; ?>>Graphic Design</option>
                    <option value="content_writing" <?php echo $row['order_type'] == 'content_writing'; ?>>Content Writing</option>
                    <option value="digital_marketing" <?php echo $row['order_type'] == 'digital_marketing'; ?>>Digital Marketing</option>
                    <option value="video_editing" <?php echo $row['order_type'] == 'video_editing'; ?>>Video Editing</option>
                    <option value="other" <?php echo $row['order_type'] == 'other'; ?>>Other</option>
                </select>

                <input type="number" id="price" name="price" placeholder="Price (PKR)" value="<?php echo ($row['price']); ?>" required>
                
                <input type="date" id="dueDate" name="dueDate" placeholder="Due Date" value="<?php echo ($row['date_due']); ?>" required>
                
                <textarea type="description" id="description" name="description" placeholder="Description" rows="4" required> <?php echo ($row['detail']); ?></textarea>

                <input type="submit" value="Submit Order">
            </form>
    </div>

    <div class="footer">
        <a href="more.html"><strong>About</strong></a>
    </div>
</body>
</html>
