<?php
$conn = pg_connect("host=localhost dbname=my_databas user=my_userr password=my_password");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
    $query = "DELETE FROM my_table WHERE id = $id";
    pg_query($conn, $query);
    echo "<p>Record deleted successfully!</p>";
}

$result = pg_query($conn, "SELECT * FROM my_table");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Delete Record</title>
    <style>
        /* نسخ تصميم مشابه لتصميم add.php */
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 20px;
        }
        .container {
            border: 1px solid #ccc;
            border-radius: 5px;
            background-color: white;
            padding: 20px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            max-width: 600px;
            margin: 0 auto;
        }
        h1 {
            color: #333;
            text-align: center;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            border: 1px solid #ccc;
            padding: 10px;
            text-align: left;
        }
        th {
            background-color: #4CAF50;
            color: white;
        }
        .delete-btn {
            background-color: #e74c3c;
            color: white;
            padding: 5px 10px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
        }
        .delete-btn:hover {
            background-color: #c0392b;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Delete Record</h1>
        <p>Are you sure you want to delete a record?</p>

        <table>
            <tr>
                <th>ID</th>
                <th>Column Name</th>
                <th>Action</th>
            </tr>
            <?php while ($row = pg_fetch_assoc($result)) { ?>
                <tr>
                    <td><?php echo $row['id']; ?></td>
                    <td><?php echo $row['column_name']; ?></td>
                    <td>
                        <form method="post" style="display:inline;">
                            <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                            <input type="submit" class="delete-btn" value="Delete">
                        </form>
                    </td>
                </tr>
            <?php } ?>
        </table>
        <a href="your_list_page.php">Cancel</a>
    </div>
</body>
</html>

