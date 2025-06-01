<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Projects</title>
    <link rel="stylesheet" href="style.css">
    <style>
        table {
            width: 70%;
            border-radius: 10px;
            overflow: hidden;
            border: 2px solid black; 
        }

        th, td {
            padding: 12px;
            text-align: left;
        }

        .btn {
            padding: 8px 12px;
            margin: 2px;
            border-radius: 5px;
            cursor: pointer;
            font-size: 14px;
            font-weight: bold;
            border: 2px solid black;
            background-color: white;
            color: black;
            transition: all 0.3s ease; 
        }

        .btn-update {
            border-color: black;
        }

        .btn-delete {
            border-color: black;
        }

        .btn:hover {
            background-color: black;
            color: white;
            transform: scale(1.1); 
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }
    </style>
</head>
<body>
    <div class="navbar">
        <h1 class="title">FairLANCE</h1>
        <a href="index.html"><strong>Home</strong></a>
    </div>

    <div class="body-log">
        <h2>Projects</h2>

        <?php
        include "connection.php";

        $sql = "SELECT order_id, order_name, order_type, price, date_due, detail FROM orders";
        $result = $connection->query($sql);

        if ($result->num_rows > 0) {
            echo "<table>";
            echo "<tr><th>Name</th><th>Category</th><th>Price</th><th>Due Date</th><th>Description</th><th>Actions</th></tr>";

            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row['order_name'] . "</td>";
                echo "<td>" . $row['order_type'] . "</td>";
                echo "<td>" . $row['price'] . "</td>";
                echo "<td>" . $row['date_due'] . "</td>";
                echo "<td>" . $row['detail'] . "</td>";
                echo "<td>";
                echo "<form method='post' action='update.php' style='display:inline;'>";
                echo "<input type='hidden' name='id' value='" . $row['order_id'] . "'>";
                echo "<button type='submit' class='btn btn-update'>Update</button>";
                echo "</form>";
                echo "<form method='post' action='delete.php' style='display:inline;'>";
                echo "<input type='hidden' name='id' value='" . $row['order_id'] . "'>";
                echo "<button type='submit' class='btn btn-delete'>Delete</button>";
                echo "</form>";
                echo "</td>";
                echo "</tr>";
            }
            echo "</table>";
        } else {
            echo "No projects found.";
        }
        $connection->close();
        ?>
    </div>
    <div class="footer">
        <a href="more.html"><strong>About</strong></a>
    </div>
</body>
</html>