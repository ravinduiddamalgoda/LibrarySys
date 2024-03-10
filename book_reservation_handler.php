<?php
require 'mailfunc.php';

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "bookdb";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

session_start();

if (isset($_SESSION['user_id'])) {
    $userId = $_SESSION['user_id'];
} else {
    echo "User ID not found in session.";
}

$bookId = $_POST['book_id'];
$bookName = $_POST['book_Name'];

$reserveDate = date('Y-m-d'); // Current date
$availablePeriod = 7; // Default available period in days
$endDate = date('Y-m-d', strtotime($reserveDate . ' + ' . $availablePeriod . ' days'));

// Prepare the SQL query to insert the reservation details into the database
$sql = "INSERT INTO bookreservation (userid, bookid, bookname, reservedate, availableperiod) VALUES ('$userId', '$bookId', '$bookName', '$reserveDate', '$availablePeriod')";
$sql1 = "INSERT INTO issuebook (userid, bookid, bookname, Issuedate, Returndate , Fine) VALUES ('$userId', '$bookId', '$bookName', '$reserveDate', '$endDate' , 0)";
$sql2 = "UPDATE book_entry SET reservation = 1 WHERE bookID = '$bookId'";

// Execute the SQL queries
if ($conn->query($sql) === TRUE && $conn->query($sql1) === TRUE && $conn->query($sql2) === TRUE) {
    $response = array(
        'status' => 'success',
        'message' => 'Book reserved successfully.'
    );
    echo json_encode($response);
    header("Location: dashboard.php");
} else {
    $response = array(
        'status' => 'error',
        'message' => 'Error in reserving the book: ' . $conn->error
    );
    echo json_encode($response);
}

// Close the database connection
$conn->close();

?>
