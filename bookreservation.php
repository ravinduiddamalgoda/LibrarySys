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

// Start session
session_start();

// Check if user is logged in and retrieve their user ID from the session
if (isset($_SESSION['user_id'])) {
    $userId = $_SESSION['user_id'];
} else {
    echo "User ID not found in session.";
}

// Fetch user IDs from the database
$sql_users = "SELECT DISTINCT userid FROM bookreservation"; // Assuming 'bookreservation' is the table name
$result_users = $conn->query($sql_users);


?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book Report</title>
    <!-- Include Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        /* Custom styles */
        body {
            background-color: #f5f5f5;
        }

        .header-image {
            background-image: url('image/background.jpg'); /* Replace 'your-image-url.jpg' with your image URL */
            background-size: cover;
            background-position: center;
            height: 400px; /* Adjust the height as needed */
            display: flex;
            filter: grayscale(90px);
            justify-content: center;
            align-items: top;
            color: #ffffff;
            text-align: center;
            font-style: italic;
        }

        .welcome-text {
            font-size: 54px;
        }

        .main-content {
            display: flex;
            flex-direction: row;
        }

        .sidebar {
            
            height: 100%;
            width: 200px;
            background-color: #3b4140;
            color: #fff;
            padding-top: 20px;
        }

        .sidebar-heading {
            font-size: 24px;
            text-align: center;
            margin-bottom: 20px;
        }

        .nav-link {
            color: #fff;
            padding: 10px;
            text-align: center;
        }

        .nav-link:hover {
            background-color: #f1f1f1;
        }

        .content {
            flex: 1;
            padding: 20px;
        }

       /* side bar */
       .sidebar {
    background-color: #333;
    color: #fff;
    padding: 20px;
}

.sidebar-heading {
    font-size: 1.5rem;
    margin-bottom: 20px;
}

.dropdown-btn {
    background-color: #555;
    color: #fff;
    padding: 10px 15px;
    border: none;
    cursor: pointer;
    width: 100%;
    text-align: left;
}

.dropdown-content {
    display: none;
    position: absolute;
    background-color: #444;
    min-width: 160px;
    z-index: 1;
}

.dropdown-content a {
    color: #fff;
    padding: 12px 16px;
    text-decoration: none;
    display: block;
}

.dropdown-content a:hover {
    background-color: #666;
}

.dropdown:hover .dropdown-content {
    display: block;
}
    </style>
</head>
<body>
    <div class="header-image">
        <div class="welcome-text">
            Welcome to Gnanapradeepa <br> Library
        </div>
    </div>

    <div class="main-content">
        <nav class="sidebar">
            <div class="sidebar-heading">Library Dashboard</div>
            <div class="dropdown">
                <button class="dropdown-btn">Menu</button>
                <div class="dropdown-content">
                    <a href="userprofile.html">User Profile</a>
                    <a href="dashboard.php">Book Tab</a>
                    <a href="bookreservation.php">Book Reservation</a>
                    <a href="index.php">Log out</a>
                </div>
            </div>
        </nav>

        <div class="content">
            

            <div class="reservation-table">
                <h2>Book Reservations</h2>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Book ID</th>
                            <th>Book Name</th>
                            <th>Reservation Date</th>
                            <th>Available Time Period</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                      if ($result_users->num_rows > 0) {
                        while ($row_user = $result_users->fetch_assoc()) {
                            $user_id = $row_user['userid'];
                    

                            $sql_reservations = "SELECT * FROM bookreservation WHERE userid = '$user_id'";
                            $result_reservations = $conn->query($sql_reservations);
                    
                            echo "<h2>Reservations for User ID: $user_id</h2>";
 
                            while ($row_reservation = $result_reservations->fetch_assoc()) {
                                echo "<tr>";
                                echo "<td>" . $row_reservation["bookid"] . "</td>";
                                echo "<td>" . $row_reservation["bookname"] . "</td>";
                                echo "<td>" . $row_reservation["reservedate"] . "</td>";
                                echo "<td>" . $row_reservation["availableperiod"] . "</td>";
                                echo "</tr>";
                            }
                            echo "</table>";
                        }
                    } else {
                        echo "No users found.";
                    }
                    $conn->close();
                        ?>
                    </tbody>
                </table>
            </div>

</div>
  
        </div>
    </div>
</body>
</html>