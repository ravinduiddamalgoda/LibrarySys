<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "bookdb";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$rows = mysqli_query($conn, "SELECT * FROM author ORDER BY authorid DESC");
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Author Records</title>
<style>
  body {
    font-family: Arial, sans-serif;
  }
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
  .author-records {
    max-width: 800px;
    margin: 0 auto;
    padding: 50px;
    background-color: #f7f7f7;
    border-radius: 5px;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
  }
  #search {
    width: 20%;
    padding: 8px;
    font-size: 16px;
    border: 1px solid #ccc;
    border-radius: 4px;
}
  table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 40px;
  }
  th, td {
    padding: 10px;
    border-bottom: 1px solid #080808;
    text-align: left;
  }
  th {
    background-color: #f2f2f2;
  }
</style>
</head>
<body>
<div class="navigation">
        <a href="bookreport.php">Book Report</a>
        <a href="addbook.php" >Add Book</a>
        <a href="deleteuser.php">User Report</a>
        <a href="issuebook.php">Issue Book</a>
        <a href="issuebookreport.php">Issue Report</a>
        <a href="addauthor.php">Add Author</a>
        <a href="authorrecord.php" class="active">Author Record</a>
        <a href="blacklist.php">BlackList</a>
        
    </div>

    <div class="search-container">
        <input type="text" id="search" placeholder="Search for books...">
        <div class="header_search search search_open <?php echo $class?>">
                                        <a href="#"><i class="icon-magnifier icons"></i></a>
                                    </div>
    </div>

    <div class="author-records">
        <h2>Author Records</h2>
        <table>
            <tr>
                <th>Author ID</th>
                <th>Author Name</th>
                <th>Book IDs</th>
            </tr>

            <?php foreach ($rows as $row): ?>
                <tr>
                    <td><?php echo $row["authorid"]; ?></td>
                    <td><?php echo $row["authorname"]; ?></td>
                    <td><?php echo $row["bookid"]; ?></td>
                </tr>
            <?php endforeach; ?>
        </table>
    </div>
</body>
</html>

<?php $conn->close(); ?>
