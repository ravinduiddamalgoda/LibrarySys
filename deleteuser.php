<?php
// Database connection details
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

// Check if the form is submitted and the user ID is provided
if (isset($_POST['userId'])) {
    $userId = $_POST['userId'];
    $sql_delete = "DELETE FROM usersignup WHERE userid = $userId";
    if ($conn->query($sql_delete) === TRUE) {
        echo "<script>alert('User deleted successfully');</script>";
    } else {
        echo "<script>alert('Error deleting user: " . $conn->error . "');</script>";
    }
}

?>

<!DOCTYPE html>
<html lang="en">
    <style>
    /* Background image and styles */
  body {
    background: url('background-image.jpg') no-repeat center center fixed;
    background-size: cover;
    font-family: Arial, sans-serif;
  }
  
  /* Header styles */
  .header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 20px;
    background-color: #6beeee;
    color: #fff;
  }
  .header img {
    max-height: 50px;
  }



  
  /* Main content styles */
  .main-content {
    margin-left: 250px;
    padding: 20px;
  }
  
  /* Info boxes styles */
  .info-box {
    background-color: #fff;
    padding: 20px;
    border-radius: 5px;
    margin-bottom: 20px;
    box-shadow: 0 2px 5px rgba(179, 177, 177, 0.2);
  }
/* table css */
.container {
    width: 80%;
    margin: 0 auto;
    padding-top: 20px;
}
h2 {
    text-align: center;
}
table {
    width: 100%;
    border-collapse: collapse;
    margin: 10px;
}
th, td {
    border: 1px solid #ddd;
    padding: 8px;
    text-align: left;
}
th {
    background-color: #f2f2f2;
}
tr:nth-child(even) {
    background-color: #f2f2f2;
}
.delete-btn {
    background-color: #f44336;
    color: white;
    padding: 6px 10px;
    border: none;
    border-radius: 4px;
    cursor: pointer;
}
.delete-btn:hover {
    background-color: #d32f2f;
}


/* navbar */
       
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

     
        .container {
            margin: 0 auto;
            max-width: 1300px;
            padding: 20px;
            background-color: #fff;
            border: 1px solid #ccc;
            border-radius: 4px;
        }


</style>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete User</title>
    <script>
        function deleteuser(userId) {
            if (confirm('Are you sure you want to delete this user?')) {
                document.getElementById('deleteForm_' + userId).submit();
            }
        }
    </script>
</head>
<body>
<div class="navigation">
        <a href="bookreport.php" >Book Report</a>
        <a href="addbook.php">Add Book</a>
        <!-- <a href="bookreservation.php">Book Reservation</a> -->
        <a href="adduser.php">Add Users</a>
        <a href="deleteuser.php" class="active">User Report</a>
        <a href="issuebook.php">Issue Book</a>
        <a href="issuebookreport.php">Issue Report</a>
        <!-- <a href="">Book Orders</a> -->
        <a href="addauthor.php">Add Author</a>
        <a href="authorrecord.php">Author Record</a>
        <a href="blacklist.php">BlackList</a>
    </div>


<div class="container">
    <!-- <h2>Users</h2> -->
        
    <table>
        <tr>
            <th>User ID</th>
            <th>Full Name</th>
            <th>User Name</th>
            <th>Email</th>
            <th>Address</th>
            <th>Mobile Number</th>
            <th>Action</th>
        </tr>
    <?php 
    // Fetch data from the database
    $result = $conn->query("SELECT * FROM usersignup ORDER BY userid DESC");
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            ?>
            <tr>
                <td><?php echo $row["userid"]; ?></td>
                <td><?php echo $row["fullname"]; ?></td>
                <td><?php echo $row["username"]; ?></td>
                <td><?php echo $row["email"]; ?></td>
                <td><?php echo $row["address"]; ?></td>
                <td><?php echo $row["mobilenumber"]; ?></td>
                <td>
                    <button class="delete-btn" onclick="deleteuser(<?php echo $row['userid']; ?>)">Delete</button>
                    <form id="deleteForm_<?php echo $row['userid']; ?>" method="post" action="">
                        <input type="hidden" name="userId" value="<?php echo $row['userid']; ?>">
                    </form>
                </td>
            </tr>
            <?php
        }
    } else {
        echo "<tr><td colspan='7'>No users found</td></tr>";
    }
    ?>
    </table>
</div>
</body>
</html>
