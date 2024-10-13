<?php
$conn = pg_connect("host=localhost dbname=my_databas user=my_userr password=my_password");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $query = "UPDATE my_table SET column_name = '$name' WHERE id = $id";
    pg_query($conn, $query);
    echo "<p>Record updated successfully!</p>";
}

// Fetch existing record for editing
$id = $_GET['id'];
$result = pg_query($conn, "SELECT * FROM my_table WHERE id = $id");
$row = pg_fetch_assoc($result);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Record</title>
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
            max-width: 400px;
            margin: 0 auto;
        }
        h1 {
            color: #333;
            text-align: center;
        }
        input[type="text"], input[type="submit"] {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        input[type="submit"] {
            background-color: #4CAF50;
            color: white;
            border: none;
            cursor: pointer;
            transition: background-color 0.3s;
        }
        input[type="submit"]:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Edit Record</h1>
        <form method="post">
            <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
            Name: <input type="text" name="name" value="<?php echo $row['column_name']; ?>" required>
            <input type="submit" value="Update">
        </form>
    </div>
</body>
</html>

