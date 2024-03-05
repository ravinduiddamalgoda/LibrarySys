<?php

$servername = "localhost"; 
$username = "root"; 
$password = ""; 
$dbname = "bookdb";


$conn = new mysqli($servername, $username, $password, $dbname);


if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $bookName = $_POST["bookName"];
    $authorName = $_POST["authorName"];
    $category = $_POST["category"];
    $quantity = $_POST["quantity"];
    $targetFile = $targetDirectory . basename($_FILES["bookImage"]["name"]);

    
    $sql = "INSERT INTO book_entry (bookName, Authorname, Category, Quantity, ImagePath) 
            VALUES ('$bookName', '$authorName', '$category', '$quantity' , '$targetFile')";

if (mysqli_query($conn, $sql)) {
    echo '<script>alert("Book added successfully!");</script>';
} else {
    echo '<script>alert("Error: ' . mysqli_error($conn) . '");</script>';
}
}


$conn->close();
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Library Management System</title>
    <link rel="stylesheet" href="css\addbook.css">
</head>
<body>
    <div class="navigation">
        <a href="bookreport.php">Book Report</a>
        <a href="" class="active">Add Book</a>
        <a href="">Book Reservation</a>
        <a href="adduser.php">Add Users</a>
        <a href="userreport.php">User Report</a>
        <a href="issuebook.php">Issue Book</a>
        <a href="issuebookreport.php">Issue Report</a>
        <a href="">Book Orders</a>
        <a href="addauthor.php">Add Author</a>
        <a href="authorrecord.php">Author Record</a>
    </div>
    <form action="bookadd.php" method="post" enctype="multipart/form-data">
        <!-- Add enctype attribute for file uploads -->
        <div id="add-book-container" class="container">
            <h2>Add Book</h2>
            <form action="" method="post">
                <label for="bookName">Book Name:</label>
                <input type="text" id="bookName" name="bookName" required><br>

                <!-- Add a file input for the image -->
                <label for="bookImage">Book Image:</label>
                <input type="file" id="bookImage" name="bookImage" accept="image/*"><br>

                <label for="authorName">Author Name:</label>
                <input type="text" id="authorName" name="authorName" required><br>

                <label for="category">Category:</label>
                <input type="text" id="category" name="category" required><br>

                <label for="quantity">Quantity:</label>
                <input type="number" id="quantity" name="quantity" required><br>

                <input type="submit" value="Add Book">
            </form>
        </div>
    </form>
</body>
</html>

