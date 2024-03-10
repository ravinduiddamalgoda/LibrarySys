<?php
session_start();

//Connect to the Database
$db = new mysqli("localhost", "root", "", "bookdb");
if ($db->connect_error) {
    die("Connection failed: " . $db->connect_error);
}

$error_message = "";


//Form Submission Handling
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $username = $_POST["username"];
  $password = $_POST["password"];

  if (empty($username) || empty($password)) {
      $error_message = "Both username and password are required.";
  } else {
      $stmt = $db->prepare("SELECT userid, password FROM usersignup WHERE username = ?");
      $stmt->bind_param("s", $username);
      $stmt->execute();
      $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();

            if (password_verify($password, $row["password"])) {
                // Set session variables
                $_SESSION["user_id"] = $row["userid"];

                // Redirect to the dashboard or profile page
                header("Location: userprofile.php");
                exit();
            } else {
                $error_message = "Invalid username or password";
            }
        } else {
            $error_message = "User not found";
        }

        $stmt->close();
    }
}

$db->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
<style>
  body {
    margin: 0;
    padding: 0;
    background: url('image/back2.jpg') no-repeat center center fixed;
    background-size: cover;
    font-family: Arial, sans-serif;
  }
  .login-container {
    width: 300px;
    background: rgba(255, 255, 255, 0.8);
    padding: 50px;
    border-radius: 10px;
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    text-align: center;
  }
  .login-container img {
    max-width: 100px;
    margin-bottom: 20px;
  }
  .login-input {
    width: 100%;
    padding: 10px;
    margin: 10px 0;
    border: 1px solid #ccc;
    border-radius: 5px;
    outline: none;
  }
  .login-button {
    width: 100%;
    padding: 10px;
    background-color: #5ea1e9;
    border: none;
    color: #fff;
    border-radius: 5px;
    cursor: pointer;
  }
  .forgot-password {
    margin-top: 40px;
    text-align: center;
  }
</style><!-- Add your head content here, if any -->
</head>
<body>
    <div class="login-container">
        <img src="image/user.png" alt="Logo">

        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">

            <input type="text" name="username" class="login-input" placeholder="Username" required>
            <input type="password" name="password" class="login-input" placeholder="Password" required>

            <button type="submit" class="login-button">Login</button>
            
            <div class="forgot-password">
                <a href="adminlogin.php">Are u an Admin? </a>
            </div>

            <div class="forgot-password">
                <a href="forgot_password.php">Forgot Password?</a>
            </div>

            <?php
            if (!empty($error_message)) {
                echo '<p style="color: red;">' . htmlspecialchars($error_message) . '</p>';
            }
            ?>
        </form>
        <p>Don't have an account? <a href="registration.php">Register here</a>.</p>
    </div>
</body>
</html>
