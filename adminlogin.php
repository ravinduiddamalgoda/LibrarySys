<?php
// Replace with your database connection details
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "bookdb";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_POST["login"])) {
    $username = $_POST['Username']; // corrected: use the correct form field name
    $password = $_POST['Password']; // corrected: use the correct form field name

    // Perform user authentication
    $sql = "SELECT * FROM adminlogin WHERE username='$username' AND password='$password'";
    $result = mysqli_query($conn, $sql);

    if ($result->num_rows > 0) {
        // Authentication successful
        session_start();
        $_SESSION['username'] = $username;
        header("Location: admindashboard.php"); // corrected: use the correct file name
        exit();
    } else {
        // Authentication failed
        $error_message = "Invalid username or password.";
    }
}

// Close the database connection
$conn->close();
?>

<html>
<head>
    <title>Admin Login</title>
    <link rel="stylesheet" href="css/adminlogin.css"> <!-- corrected: use correct path separator -->
</head>
<body>

<div id="login-container" style="text-align: center; margin-top: 100px;">
    <h1>Admin Login</h1>
    <form action="adminlogin.php" method="post"> 
        <label for="Username">Username:</label> 
        <input type="text" id="Username" name="Username" required><br><br>

        <label for="Password">Password:</label> <!-- corrected: use the correct form field name -->
        <input type="password" id="Password" name="Password" required><br><br>

        <input type="submit" value="Login" name="login"> <!-- corrected: add name attribute for submit button -->

        <br><br>

    </form>

    <?php
    // Display error message if set
    if (isset($error_message)) {
        echo "<p style='color: red;'>$error_message</p>";
    }
    ?>

</div>
</body>
</html>



