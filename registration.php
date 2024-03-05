<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "bookdb"; // bookdb

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$error_message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $fullname = $_POST["fullname"];
    $username = $_POST["username"];
    $email = $_POST["email"];
    $raw_password = $_POST["password"];
    $password = password_hash($raw_password, PASSWORD_DEFAULT);
    $address = $_POST["address"];
    $mobilenumber = $_POST["mobilenumber"];

    $sql = "INSERT INTO usersignup (fullname, username, email, password, address, mobilenumber)
        VALUES ('$fullname', '$username', '$email', '$password', '$address', '$mobilenumber')";



    if (mysqli_query($conn, $sql)) {
        
        $userId = mysqli_insert_id($conn);

      
        $to = $email;
        $subject = "Registration Confirmation";
        $message = "Dear $fullname,\n\nThank you for registering with us!\n\nYour User ID is: $userId\n\nBest regards";
        $headers = "From: gnanapradeepalibrary@gmail.com";

        if (mail($to, $subject, $message, $headers)) {
            echo '<script>alert("Signup successfully! Confirmation email sent."); window.location.href = "userprofile.html";</script>';
        } else {
            echo '<script>alert("Signup successful, but confirmation email could not be sent. Please contact support."); window.location.href = "userprofile.html";</script>';
        }
    } else {
        echo '<script>alert("Error: ' . mysqli_error($conn) . '");</script>';
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Sign Up</title>
<style>
  body {
    margin: 50px;
    padding: 0px;
    font-family: Arial, sans-serif;
    background-image: url('image/signupback.jpg'); /* Replace with your background image URL */
    background-size: cover;
    background-position: center;
  }

  .signup-container {
    display: flex;
    height: 100vh;
    
  }

  .background-image {
    flex: 1;
  }

  .signup-content {
    flex: 1;
    display: flex;
    align-items: center;
    justify-content: center;
    background-color: #f5f5f5;
  }

  .signup-content img {
    max-width: 100%;
    height: auto;
    margin-right: 20px;
  }

  .signup-form {
    max-width: 400px;
    padding: 100px;
    background-color: #fff;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
  }

  h2 {
    font-size: 24px;
    margin-bottom: 20px;
  }

  input {
    display: block;
    width: 100%;
    padding: 10px;
    margin-bottom: 15px;
    border: 1px solid #ccc;
    border-radius: 5px;
  }

  button {
    display: inline-block;
    background-color: #333;
    color: #fff;
    padding: 10px 20px;
    cursor: pointer;
    border: none;
    border-radius: 5px;
    transition: background-color 0.3s;
  }

  button:hover {
    background-color: #555;
  }
</style>
</head>
<body>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <section class="signup-container">
            <div class="image/login.jpg"></div>
            <div class="signup-content">
                <img src="image/signupside.jpg" alt="Left Image" width="400px" height="400px">
                
                <div class="signup-form">
                    <h2>Create an Account</h2>

                    <input type="text" name="fullname" placeholder="Full Name"  title="Please enter your full name with only letters and spaces." autofocus>
                    <input type="text" name="username" placeholder="User Name"  title="Enter the Username ">
                    <input type="email" name="email" placeholder="Email" required pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$" title="Please enter a valid email address.">
                    <input type="password" name="password" placeholder="Password" >
                    <input type="text" name="address" placeholder="Address"  title="Please enter your valid address.">
                    <input type="tel" name="mobilenumber" placeholder="Mobile Number" required pattern="\d{10}" title="Please enter a 10-digit mobile number.">

                    <button type="submit">Sign Up</button>
                </div>
            </div>
        </section>
    </form>
</body>
</html>
