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


// session_start();

// if (isset($_SESSION['user_id'])) {
//     $userId = $_SESSION['user_id'];
// } else {
//     echo "User ID not found in session.";
// }


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect data from the form
    $userId = $_POST["uderid"];
    $bookId = $_POST["bookid"];
    $bookName = $_POST["bookname"];
    $issueDate = $_POST["issueDate"];
    $returnDate = $_POST["returnDate"];

    // Insert data into the database
    $sql = "INSERT INTO issuebook (UserID, BookID, BookName, Issuedate, Returndate) 
            VALUES ('$userId', '$bookId', '$bookName', '$issueDate', '$returnDate')";

    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('Book issued successfully.')<.script>";
        header("Location: {$_SERVER['REQUEST_URI']}"); // Refresh the page
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
    <!-- <form action="issuebook.php" method="post">
        
        <input type="submit" value="Add">
    </form>
     -->

    <div class="navigation">
        <a href="bookreport.php">Book Report</a>
        <a href="addbook.php" >Add Book</a>
        <!-- <a href="bookreservation.php">Book Reservation</a> -->
        <a href="adduser.php">Add Users</a>
        <a href="deleteuser.php">User Report</a>
        <a href="issuebook.php" class="active" >Issue Book</a>
        <a href="issuebookreport.php"  >Issue Report</a>
        <!-- <a href="">Book Orders</a> -->
        <a href="addauthor.php">Add Author</a>
        <a href="authorrecord.php">Author Record</a>
        <a href="blacklist.php">BlackList</a>
    </div>

  
    <div id="add-user-container" class="container">
        <h2>Issue Book</h2>
        <form action="issuebook.php" method="post">
            
            <label for="userid">User Id:</label>
            <input type="text" id="userid" name="uderid" required><br>

            <label for="bookid">Book Id :</label>
            <input type="text" id="bookid" name="bookid" required><br>

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