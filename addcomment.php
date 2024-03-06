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

session_start();

if (isset($_SESSION['user_id'])) {
    $userId = $_SESSION['user_id'];
} else {
    echo "User ID not found in session.";
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Handle form submission
    $bookId = $_POST['bookID'];
    $comment = $_POST['comment'];
    $userID = $_POST['userID'];

    echo $bookId;
    echo $comment;
    echo $userID;
    
    $sql = "INSERT INTO comments (userid, Bookid, comment_text) VALUES ('$userID', '$bookId', '$comment')";

    if($result = $conn->query($sql)) {
        echo "Comment added successfully.";
        header("Location:dashboard.php"); // Refresh the page
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

?>