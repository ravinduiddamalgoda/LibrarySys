<?php

require 'mailfunc.php';

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

// Assuming you have a table named 'issued_books' with columns 'UserID', 'Bookid', 'Bookname', 'Issuedate', 'Returndate'
$sql = "SELECT * FROM issuebook";
$result = $conn->query($sql);

?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Issue Book Report</title>
    <link rel="stylesheet" href="css\issuereport.css">

    <style>
        .containerone {
            margin: auto;
            padding:auto;
            width: 70%;
            
            
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
    </style>
</head>
<body>
    

        
    <div class="navigation">
        <a href="bookreport.php">Book Report</a>
        <a href="addbook.php" >Add Book</a>
        <!-- <a href="bookreservation.php">Book Reservation</a> -->
        <a href="adduser.php">Add Users</a>
        <a href="deleteuser.php">User Report</a>
        <a href="issuebook.php">Issue Book</a>
        <a href="issuebookreport.php" class="active">Issue Report</a>
        <!-- <a href="">Book Orders</a> -->
        <a href="addauthor.php">Add Author</a>
        <a href="authorrecord.php">Author Record</a>
        <a href="blacklist.php">BlackList</a>
    </div>

    <div class="containerone">
        <h2>Issued Books</h2>
        <table>
            <tr>
                <th>User ID</th>
                <th>Book Id</th>
                <th>Book Name</th>
                <th>Issue Date</th>
                <th>Return Date</th>
                <th>Fine</th>
                <th>Returned</th>
            </tr>
            
            <?php
            while ($row = $result->fetch_assoc()) {
                $issueDate = strtotime($row["Issuedate"]);
                $returnDate = strtotime($row["Returndate"]);
                $today = strtotime(date("Y-m-d"));

                // Calculate the difference in days
                $daysDifference = floor(($today - $returnDate) / (60 * 60 * 24));

                // Assuming a flat fine rate per day (adjust as needed)
                $fine = $daysDifference > 0 ? $daysDifference * 5 : 0;
                if ($fine > 0) {
                    $queryBlackListData = "SELECT * FROM blacklist WHERE user_id = '{$row["UserID"]}'";
                    $resultBlackListData = $conn->query($queryBlackListData);
                    if (!($resultBlackListData->num_rows > 0)) {
                        
                        $blackListInsert = "INSERT INTO blacklist (user_id) VALUES ('{$row["UserID"]}')";
                        if ($conn->query($blackListInsert) === TRUE) {
                            echo "<script>alert('User added to blacklist')</script>";
                        } else {
                            echo "<script>alert('Error adding user to blacklist: " . $conn->error . "')</script>";
                        }
                    }
                    $fine = "Rs." . $fine;
                } else {
                    $fine = "No fine";
                }

                echo "<tr>";
                echo "<td>{$row["UserID"]}</td>";
                echo "<td>{$row["Bookid"]}</td>";
                echo "<td>{$row["Bookname"]}</td>";
                echo "<td>{$row["Issuedate"]}</td>";
                echo "<td>{$row["Returndate"]}</td>";
                echo "<td>{$fine}</td>";
                echo "<form action='issuebookreport.php' method='post'>";
                echo "<input type='hidden' value= '{$row["UserID"]}'  name='UserID' >";
                echo "<input type='hidden' value= '{$row["Bookid"]}'  name='Bookid' >";
                echo "<td><input type='submit' value='returned'  name='submit_button' class='delete-btn' ></td>";
                echo "</form>";
                echo "</tr>";

                $dateToFUnc = $row["Returndate"];
                if (isWithinTwoDays($dateToFUnc) >= -2 ) {
                    $SqlEmail = "SELECT * FROM usersignup WHERE userid = '{$row["UserID"]}'";     
                    $resultEmail = $conn->query($SqlEmail);
                    if ($resultEmail->num_rows > 0) {
                        while ($rowEmail = $resultEmail->fetch_assoc()) {
                            $email = $rowEmail['email'];
                            $subject = "Book Return Reminder";
                            $message = "Dear User, \n\nThis is a reminder that the return date for the book '{$row["Bookname"]}' is approaching. Please return the book to the library as soon as possible to avoid any fines. \n\nThank you.";
                            sendEmail($rowEmail['fullname'] , $email, $subject, $message);
                        }
                    }               
                }
            }



            function isWithinTwoDays($givenDate) {
                $today = date("Y-m-d"); // Today's date
              
                
                $todayTimestamp = strtotime($today);
                $givenDateTimestamp = strtotime($givenDate);
              
                
                $dayDiff = (int)abs(($todayTimestamp - $givenDateTimestamp) / (60 * 60 * 24));
              
                return $dayDiff <= 2;
              }
              
            ?>

        </table>
        <!-- <form>
            <input type="submit" value="Update"> -->
            <?php 
                if(isset($_POST['submit_button'])) {
                    $userIDN = $_POST['UserID'];
                    $bookIDN = $_POST['Bookid']; 
            
                // Prepare a SQL statement
                $sqlDelete ="DELETE FROM issuebook WHERE UserID = '$userIDN' AND Bookid = '$bookIDN'";
                $sqlDeleteBlackList = "DELETE FROM blacklist WHERE user_id = '$userIDN'";


                // Execute the statement
                if ($conn->query($sqlDelete) == TRUE ){
                    echo "<script>alert('Record deleted successfully')</script>";
                } else {
                    echo "<script>alert('Error deleting record: " . $conn->error . "')</script>";

                }

                if($conn->query($sqlDeleteBlackList) == TRUE){
                    echo "<script>alert('Record deleted successfully')</script>";
                    header("Location: {$_SERVER['REQUEST_URI']}"); // Refresh the page
                } else {
                    echo "<script>alert('Error deleting record: " . $conn->error . "')</script>";
                }
                }
            ?>   
        
        
    </div>
    
</body>
</html>

<?php
// Close connection
$conn->close();
?>

