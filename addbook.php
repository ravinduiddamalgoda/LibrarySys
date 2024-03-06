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

    // Using prepared statements for SQL queries
    $sql = "INSERT INTO book_entry (BookName, AuthorName, Category, Quantity, Image) VALUES (?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);

    // Bind parameters
    $stmt->bind_param("sssss", $bookName, $authorName, $category, $quantity, $newFilename);

    // File upload handling
    if (isset($_FILES["bookImage"]) && $_FILES["bookImage"]["error"] == 0) {
        $allowedTypes = ["image/jpeg", "image/png", "image/jpg"];
        $maxFileSize = 1048576; // 1 MB

        if (in_array($_FILES["bookImage"]["type"], $allowedTypes) && $_FILES["bookImage"]["size"] <= $maxFileSize) {
            $targetDirectory = "C:/xampp/htdocs/library/Newfolder/";

            if (!file_exists($targetDirectory) && !mkdir($targetDirectory, 0775, true)) {
                echo '<script>alert("Failed to create uploads directory. Please check permissions.");</script>';
            }

            $temp = explode(".", $_FILES["bookImage"]["name"]);
            $newFilename = round(microtime(true)) . '.' . end($temp);
            $targetFile = $targetDirectory . $newFilename;

            if (move_uploaded_file($_FILES["bookImage"]["tmp_name"], $targetFile)) {
                // Execute the prepared statement
                if ($stmt->execute()) {
                    echo '<script>alert("Book added successfully!");</script>';
                } else {
                    echo '<script>alert("Error: ' . $stmt->error . '");</script>';
                }
            } else {
                echo '<script>alert("Error uploading the file.");</script>';
            }
        } else {
            echo '<script>alert("Invalid file type or file size exceeds the maximum limit of 1 MB.");</script>';
        }
    } else {
        echo '<script>alert("No file uploaded or an error occurred.");</script>';
    }

    // Close the prepared statement
    $stmt->close();
}

// Close the database connection
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Library Management System</title>
    <link rel="stylesheet" href="css/addbook.css"> 
</head>
<body>
    <div class="navigation">
        <a href="bookreport.php" >Book Report</a>
        <a href="addbook.php" class="active">Add Book</a>
        <!-- <a href="bookreservation.html">Book Reservation</a> -->
        <a href="adduser.php">Add Users</a>
        <a href="deleteuser.php">User Report</a>
        <a href="issuebook.php">Issue Book</a>
        <a href="issuebookreport.php">Issue Report</a>
        <!-- <a href="">Book Orders</a> -->
        <a href="addauthor.php">Add Author</a>
        <a href="authorrecord.php">Author Record</a>
        <a href="blacklist.php">BlackList</a>
    </div>

    <div id="add-book-container" class="container">
        <h2>Add Book</h2>
        <form action="addbook.php" method="post" enctype="multipart/form-data">
            <label for="bookName">Book Name:</label>
            <input type="text" id="bookName" name="bookName" required><br>

            <label for="bookImage">Image:</label>
            <input type="file" id="bookImage" name="bookImage" accept="image/*"><br>

            <label for="authorName">Author Name:</label>
            <input type="text" id="authorName" name="authorName" required><br>

            <label for="category">Category:</label>
            <select id="category" name="category" required>
                <option value="Adventure stories">Adventure stories</option>
                <option value="Novel">Novel</option>
                <option value="Education">Education</option>
                <option value="Horror">Horror</option>
                <option value="Mystery">Mystery</option>
                <option value="Romance">Romance</option>
                <option value="Science fiction">Science fiction</option>
                <option value="pdf">PDF </option>
            </select><br>

            <label for="quantity">Quantity:</label>
            <input type="number" id="quantity" name="quantity" required><br>

            <input type="submit" value="Add Book">
        </form>
    </div>
</body>
</html>
