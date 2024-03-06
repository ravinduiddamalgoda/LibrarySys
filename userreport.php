<?php

$servername = "localhost"; 
$username = "root"; 
$password = ""; 
$dbname = "bookdb";


$conn = new mysqli($servername, $username, $password, $dbname);


if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>


<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Report</title>
    <style>

    body {
    margin: 0;
    padding: 0;
    font-family: Arial, sans-serif;
    background-color: #f2f2f2;
}

/* Style the navigation tabs */
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

/* Center the container */
.container {
    margin: 0 auto;
    max-width: 900px;
    padding: 20px;
    background-color: #fff;
    border: 1px solid #ccc;
    border-radius: 4px;
}

h2 {
    margin-bottom: 20px;
    color: #333;
}

/* Style the search container */
.search-container {
    margin-bottom: 20px;
}

#search {
    width: 20%;
    padding: 8px;
    font-size: 16px;
    border: 1px solid #ccc;
    border-radius: 4px;
}

/* Style the book report table */
table {

    width: 100px;
    border-collapse: collapse;
  
}

th, td {
    padding: 25px;
    text-align: left;
    border-bottom: 1px solid #ddd;
}

th {
    background-color: #f2f2f2;
    font-weight: bold;
}

/* Style the buttons */
button {
    padding: 8px 16px;
    border: none;
    border-radius: 4px;
    cursor: pointer;
}

.delete-btn {
    background-color: #dc3545;
    color: #fff;
    margin-right: 5px;
}


    </style>
    

</head>
<body>
    <form action="registration.php" method="post"> </form>

    <div class="navigation">
    <a href=""  >Book Report</a>
        <a href="addbook.php" >Add Book</a>
        <a href="">Book Reservation</a>
        <a href="adduser.php">Add Users</a>
        <a href="userreport.php" class="active">User Report</a>
        <a href="issuebook.php">.Issue Book</a>
        <a href="issuebookreport.php">Issue Report</a>
        <a href="">Book Orders</a>
        <a href="addauthor.php">Add Author</a>
        <a href="authorrecord.php">Author Record</a>
        <a href="blacklist.php">BlackList</a>
    </div>

    
    <div class="search-container">
    <form id="search-form">
        <input type="text" id="search-text" class="search-field" placeholder="Search for users...">
        <span class="search-filters-container">
            </span>
        <button type="submit" class="search-button">Search</button>
    </form>
    </div>

   
    <div class="container">
        <h2>Users</h2>
        
        <table>
            <tr>
                <th>User ID</th>
                <th>Full Name</th>
                <th>User Name</th>
                <th>Email</th>
                
                <th>Address</th>
                <th>Mobile Number</th>
                
            </tr>
            <?php 
        $rows =mysqli_query($conn,"SELECT * FROM usersignup order by userid desc" );
        ?>
        <?php foreach ($rows as $row): 
        ?>
            <tr>
                <td><?php echo $row["userid"]; ?></td>
                <td><?php echo $row["fullname"]; ?></td>
                <td><?php echo $row["username"]; ?></td>
                <td><?php echo $row["email"]; ?></td>
                
                <td><?php echo $row["address"]; ?></td>
                <td><?php echo $row["mobilenumber"]; ?></td>
                <td>
                    <button class="delete-btn">Delete</button>
                    
                </td>
            </tr>
            <?php endforeach ; ?>
        </table>
        
    </div>
    
</body>
</html>