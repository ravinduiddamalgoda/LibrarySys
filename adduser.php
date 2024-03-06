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
    $username = $_POST["username"];
    $address = $_POST["address"];
    $mobilenumber = $_POST["mobilenumber"];
    $email = $_POST["email"];

    
    $sql = "INSERT INTO user(username, address, email, mobilenumber ) 
            VALUES ('$username', '$address', '$email', '$mobilenumber')";

if (mysqli_query($conn, $sql)) {
    echo '<script>alert("User added successfully!");</script>';
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
    <link rel="stylesheet" href="css\adduser.css">
    

</head>
<body>
    <!-- <form action="userreport.php" method="post">
        
        <input type="submit" value="Add">
    </form>
     -->

    <div class="navigation">
        <a href="bookreport.php">Book Report</a>
        <a href="addbook.php" >Add Book</a>
        <!-- <a href="bookreservation.php">Book Reservation</a> -->
        <a href="" class="active">Add Users</a>
        <a href="deleteuser.php">User Report</a>
        <a href="issuebook.php">Issue Book</a>
        <a href="issuebookreport.php">Issue Report</a>
        <!-- <a href="">Book Orders</a> -->
        <a href="addauthor.php">Add Author</a>
        <a href="authorrecord.php">Author Record</a>
        <a href="blacklist.php">BlackList</a>
    </div>

  
    <div id="add-user-container" class="container">
        <h2>Add User</h2>
        <form action="/add-User" method="post">
            <label for="Fullname">Full Name:</label>
            <input type="text" id="fullname" name="Username" required><br>


            <label for="address">Address:</label>
            <input type="text" id="address" name="address" required><br>

            <label for="email">Email:</label>
            <input type="text" id="email" name="email" required><br>

            <label for="mobilenumber">Mobile Number:</label>
            <input type="number" id="mobilenumer" name="mobilenumber" required><br>

            
            <input type="submit" value="Add">
        
        </form>
    </div>

</body>
</html>