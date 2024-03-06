
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blacklist</title>
</head>
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
    width: 80%;
    border-collapse: collapse;
    margin: 10px;
    margin-left: auto;
    margin-right: auto;

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
<body>
<div class="navigation">
        <a href="bookreport.php" >Book Report</a>
        <a href="addbook.php">Add Book</a>
        <!-- <a href="bookreservation.php">Book Reservation</a> -->
        <a href="adduser.php">Add Users</a>
        <a href="deleteuser.php" >User Report</a>
        <a href="issuebook.php">Issue Book</a>
        <a href="issuebookreport.php">Issue Report</a>
        <!-- <a href="">Book Orders</a> -->
        <a href="addauthor.php">Add Author</a>
        <a href="authorrecord.php">Author Record</a>
        <a href="blacklist.php" class="active">BlackList</a>
    </div>
    <table>
    <?php

    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "bookdb";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }


    // Query to fetch data from the blacklist table
    $query = "SELECT user_id, blacklisted_date FROM blacklist";
    $result = mysqli_query($conn, $query);
    echo "<tr> <th>User ID </td> <th>User Name </td> <th>BlackListed Date </td></tr>";
    // Check if the query was successful
    if ($result) {
        // Check if there are any rows returned
        if (mysqli_num_rows($result) > 0) {
            // Loop through each row and display the data
            while ($row = mysqli_fetch_assoc($result)) {
                $userid = $row['user_id'];
                $queryUser = "SELECT username FROM usersignup where userid = $userid"; 
                $resultUser = mysqli_query($conn, $queryUser);
                if ($resultUser) {
                    $rowUser = mysqli_fetch_assoc($resultUser);
                    $username = $rowUser['username'];
                } else {
                    echo "<tr><td colspan='2'>Error executing the query: " . mysqli_error($connection) . "</td></tr>";
                }
                $blacklisteddate = $row['blacklisted_date'];

                // Display the data in a table row
                echo "<tr><td>$userid</td> <td>  $username</td><td>$blacklisteddate</td></tr>";
            }
        } else {
            echo "<tr><td colspan='2'>No data found in the blacklist table.</td></tr>";
        }
    } else {
        echo "<tr><td colspan='2'>Error executing the query: " . mysqli_error($connection) . "</td></tr>";
    }

    

    ?>
    </table>


</body>
</html>