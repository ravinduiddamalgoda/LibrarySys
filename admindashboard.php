<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Admin Dashboard</title>
<style>
  /* Reset some default styles */
  body, ul {
    margin: 0;
    padding: 0;
    list-style: none;
  }
  
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
  
  /* Sidebar styles */
  /* .sidebar {
    width: 250px;
    background-color: #0b83bb;
    color: #fff;
    height: 100vh;
    position: fixed;
    top: 0;
    left: 0;
  }
  .sidebar ul {
    padding: 20px;
  }
  .sidebar li {
    padding: 10px 0;
  }
  .sidebar a {
    color: #fff;
    text-decoration: none;
    display: block;
    padding: 5px 10px;
  }
  .dropdown-content {
    display: none;
    background-color: #05165e;
    padding: 5px 0;
  }
  .dropdown-content a {
    padding: 5px 20px;
  }
  .sidebar li:hover .dropdown-content {
    display: block;
  } */
  .sidebar {
    width: 250px;
    background-color: #0b83bb;
    color: #fff;
    height: 100vh;
    position: fixed;
    top: 0;
    left: 0;
}

.sidebar ul {
  list-style-type: none;
  padding: 0;
}

.sidebar ul li {
  margin-bottom: 10px;
}

.sidebar ul li a {
  color: #fff;
  text-decoration: none;
  display: block;
  padding: 10px;
}

.sidebar ul li a:hover {
  background-color: #1B5299;
}

.dropdown-content {
  display: none;
  background-color: #0b83bb;
  padding: 10px;
}

.dropdown-content a {
  color: #fff;
  text-decoration: none;
  display: block;
  padding: 5px 0;
}

.dropdown-content a:hover {
  background-color: #1B5299;
}

.dropdown:hover .dropdown-content {
  display: block;
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
</style>
</head>
<body>
<div class="header">
  <img src="logo-image.png" alt="Logo">
  <a href="adminlogin.php">Logout</a>
</div>
<!-- <div class="sidebar">
  <ul>
    <li><h1>Admin DashBoard</h1></li>
    <li><a href="#">Book</a>
      <div class="dropdown-content">
        <a href="addbook.php">Add Book</a>
        <a href="bookreport.php">Book Records</a>
      </div>
    </li>
    <li><a href="#">Author</a>
      <div class="dropdown-content">
        <a href="addauthor.php">Add Author</a>
        <a href="authorrecord.php">Author Records</a>
      </div>
    </li>
    <li><a href="#">User</a>
      <div class="dropdown-content">
        <a href="adduser.php">Add User</a>
        <a href="userreport.php">User Report</a>
      </div>
    </li>
    <li><a href="#">Issue Book</a>
      <div class="dropdown-content">
        <a href="issuebook.php">Issue Book</a>
        <a href="issuebookreport.php">Issue Report</a>
      </div>
    </li>
    <li><a href="#">Book Order</a></li>
    <li><a href="#">Book Reservation</a></li>
  </ul>
  
</div> -->
<div class="sidebar">
  <ul>
    <li><h1>Admin DashBoard</h1></li>
    <li class="dropdown">
      <a href="#">Book</a>
      <div class="dropdown-content">
        <a href="addbook.php">Add Book</a>
        <a href="bookreport.php">Book Records</a>
      </div>
    </li>
    <li class="dropdown">
      <a href="#">Author</a>
      <div class="dropdown-content">
        <a href="addauthor.php">Add Author</a>
        <a href="authorrecord.php">Author Records</a>
      </div>
    </li>
    <li class="dropdown">
      <a href="#">User</a>
      <div class="dropdown-content">
        <a href="adduser.php">Add User</a>
        <a href="userreport.php">User Report</a>
        <a href="deleteuser.php">Delete User</a>
      </div>
    </li>
    <li class="dropdown">
      <a href="#">Issue Book</a>
      <div class="dropdown-content">
        <a href="issuebook.php">Issue Book</a>
        <a href="issuebookreport.php">Issue Report</a>
      </div>
    </li>
    <li><a href="#">Book Order</a></li>
    <li><a href="#">Book Reservation</a></li>
  </ul>
</div>

<div class="main-content">
  <div class="info-box">
    <img src="image/book.jpg" alt="Books Icon" width="100px" height="100px">
    <p>Total Books: 500</p>
  </div>
  <div class="info-box">
    <img src="image/userad.jpg" alt="Users Icon" width="100px" height="100px">
    <p>Total Users: 1000</p>
  </div>
</div>
</body>
</html>

    

   