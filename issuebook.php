<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "bookdb";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect data from the form
    $userId = $_POST["userId"];
    $bookId = $_POST["bookId"];
    $bookName = $_POST["bookname"];
    $issueDate = $_POST["issueDate"];
    $returnDate = $_POST["returnDate"];

    // Insert data into the database
    $sql = "INSERT INTO issued_books (user_id, book_id, book_name, issue_date, return_date) 
            VALUES ('$userId', '$bookId', '$bookName', '$issueDate', '$returnDate')";

    if ($conn->query($sql) === TRUE) {
        echo "Book issued successfully.";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Close connection
$conn->close();
?>






<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Library Management System</title>
    <link rel="stylesheet" href="css\adduser.css">
    

</head>
<body>
    <form action="issuebook.php" method="post">
        
        <input type="submit" value="Add">
    </form>
    

    <div class="navigation">
        <a href="bookreport.php">Book Report</a>
        <a href="addbook.php" >Add Book</a>
        <!-- <a href="">Book Reservation</a> -->
        <a href="adduser.php">Add Users</a>
        <a href="deleteuser.php">User Report</a>
        <a href=""class="active">Issue Book</a>
        <a href="issuebookreport.php">Issue Report</a>
        <a href="">Book Orders</a>
        <a href="addauthor.php">Add Author</a>
        <a href="authorrecord.php">Author Record</a>
    </div>

  
    <div id="add-user-container" class="container">
        <h2>Issue Book</h2>
        <form action="/add-User" method="post">
            
            <label for="readerid">User Id:</label>
            <input type="text" id="fullname" name="Username" required><br>

            <label for="readerid">Book Id :</label>
            <input type="text" id="fullname" name="Username" required><br>

            <label for="bookname">Book Name :</label>
            <input type="text" id="bookname" name="bookname" required><br>


            <label for="issueDate">Issue Date:</label>
            <input type="date" id="issueDate" name="issueDate" required><br>

            <label for="returnDate">Return Date:</label>
            <input type="date" id="returnDate" name="returnDate" required><br>

        
            <input type="submit" value="Add">
        
        </form>
    </div>

</body>
</html>