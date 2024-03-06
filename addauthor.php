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
    $authorName = $_POST["authorName"];
    $bookId = $_POST["bookId"];

    $sql = "INSERT INTO author (authorname, bookid) 
            VALUES ('$authorName', '$bookId')";

    if (mysqli_query($conn, $sql)) {
        echo '<script>alert("Author added successfully!");</script>';
    } else {
        echo '<script>alert("Error: ' . mysqli_error($conn) . '");</script>';
    }
}


/////////////////////////
$conn->close();
?>




<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Add Author</title>
<style>
  body {
    font-family: Arial, sans-serif;
  }
  .navigation {
    background-color: #007bff;
    display: flex;
    justify-content: space-around;
    padding: 10px;
}

.navigation a {
    color: #fff;
    text-decoration: none;
    padding: 8px 16px;
}

.navigation a.active {
    background-color: #0056b3;
    border-radius: 4px;
}
  .add-author-form {
    max-width: 400px;
    margin: 0 auto;
    padding: 60px;
    padding-top: 50px;
    background-color: #f7f7f7;
    border-radius: 5px;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
  }
  .form-group {
    margin-bottom: 15px;
  }
  label {
    display: block;
    font-weight: bold;
    margin-bottom: 5px;
  }
  input[type="text"] {
    width: 100%;
    padding: 10px;
    border: 1px solid #ccc;
    border-radius: 5px;
    outline: none;
  }
  .submit-button {
    background-color: #007bff;
    color: #fff;
    padding: 10px 20px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
  }
</style>
</head>
<body>
     <form action="authorrecord.php" method="post">
        
       
    </form>

  <div class="navigation">
    <a href="bookreport.php">Book Report</a>
    <a href="addbook.php" >Add Book</a>
    <!-- <a href="bookreservation.php">Book Reservation</a> -->
    <a href="adduser.php">Add Users</a>
    <a href="deleteuser.php">User Report</a>
    <a href="issuebook.php">Issue Book</a>
    <a href="issuebookreport.php">Issue Report</a>
    <!-- <a href="">Book Orders</a> -->
    <a href="" class="active">Add Author</a>
    <a href="authorrecord.php">Author Record</a>
    <a href="blacklist.php">BlackList</a>
</div>

<div class="add-author-form">
  <h2>Add Author</h2>
  <form action="" method="post">

    <div class="form-group">
      <label for="authorName">Author Name</label>

      <input type="text" id="authorName" name="authorName" required>

    </div>
    
    <div class="form-group">

    <label for="bookId">Book ID</label>

<input type="text" id="bookId" name="bookId" required>

    </div>
    <input type="submit" value="Submit" >
  </form>
</div>
</body>
</html>



