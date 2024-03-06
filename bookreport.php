<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "bookdb";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$category_filter = isset($_GET['category']) ? $_GET['category'] : '';
$search_term = isset($_GET['search']) ? $_GET['search'] : '';

if ($category_filter && $search_term) {
    $query = "SELECT * FROM book_entry WHERE Category = '$category_filter' AND (Bookname LIKE '%$search_term%' OR Authorname LIKE 
    '%$search_term%' OR Bookid = '$search_term') ORDER BY Bookid DESC";
} elseif ($category_filter) {
    $query = "SELECT * FROM book_entry WHERE Category = '$category_filter' ORDER BY Bookid DESC";
} elseif ($search_term) {
    $query = "SELECT * FROM book_entry WHERE Bookname LIKE '%$search_term%' OR Authorname LIKE '%$search_term%' OR Bookid = '$search_term' ORDER BY Bookid DESC";
} else {
    $query = "SELECT * FROM book_entry ORDER BY Bookid DESC";
}

$rows = mysqli_query($conn, $query);

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book Report</title>

    <style>
     
        body {
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
            background-color: #f2f2f2;
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

     
        .container {
            margin: 0 auto;
            max-width: 1300px;
            padding: 20px;
            background-color: #fff;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        h2 {
            margin-bottom: 20px;
            color: #333;
        }

        
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
        #search-text {
            width: 20%;
            padding: 8px;
            font-size: 16px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        .book-category {
            display: inline-block;
            margin-right: 0px;
        }

    
        table {
            width: 100%; 
            border-collapse: collapse;
            margin-top: 20px; 
        }

        th, td {
            padding: 15px; 
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #f2f2f2;
            font-weight: bold;
        }

      
        .delete-btn {
            background-color: #dc3545;
            color: #fff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
    </style>

</head>

<body>
    
    <div class="navigation">
        <a href="" class="active">Book Report</a>
        <a href="addbook.php">Add Book</a>
        <!-- <a href="bookreservation.html">Book Reservation</a> -->
        <a href="adduser.php">Add Users</a>
        <a href="deleteuser.php">User Report</a>
        <a href="issuebook.php">Issue Book</a>
        <a href="issuebookreport.php">Issue Report</a>
        <!-- <a href="">Book Orders</a> -->
        <a href="addauthor.php">Add Author</a>
        <a href="authorrecord.php">Author Record</a>
        <a href="blacklist.php">BlackList</a>
    </div>
    <br>
    
    <form action="" method="GET">
    
<br>
<br>
    <div class="book-category">
        <label for="category">Select Book Category:</label>
        <select id="category" name="category" class="form-control">
            <option value="All">All</option>
            <option value="Adventure stories">Adventure stories</option>
            <option value="Novel">Novel</option>
            <option value="Education">Education</option>
            <option value="Horror">Horror</option>
            <option value="Mystery">Mystery</option>
            <option value="Romance">Romance</option>
            <option value="Science fiction">Science fiction</option>
            <option value="pdf">PDF </option>
        </select>
    </div>
</form>

    <br>
    <br>
    <div class="container">
        <h2>Book Report</h2>

        <table>
            <tr>
                <th>Book ID</th>
                <th>Book Name</th>
                <th>Image</th>
                <th>Author Name</th>
                <th>Category</th>
                <th>Quantity</th>
           
                
                <th>Action</th> 
            </tr>
            <?php
           
            if ($rows) {
                
                while ($row = mysqli_fetch_assoc($rows)) {
                   
                    echo '<tr>';
                    echo '<td>' . $row["Bookid"] . '</td>';
                    echo '<td>' . $row["Bookname"] . '</td>';
                    echo '<td><img src="Newfolder/' . $row["Image"] . '" width="100"></td>';
                    echo '<td>' . $row["Authorname"] . '</td>';
                    echo '<td>' . $row["Category"] . '</td>';
                    echo '<td>' . $row["Quantity"] . '</td>';
                    echo '<td>
                            <form method="post">
                                <input type="hidden" name="delete_book" value="' . $row["Bookid"] . '">
                                <button type="submit" class="delete-btn">Delete</button>
                            </form>
                          </td>';
                    echo '</tr>';
                }
            } else {
              
                echo '<tr><td colspan="7">Error executing query: ' . mysqli_error($conn) . '</td></tr>';
            }
            ?>

        </table>
    </div>

</body>
</html>
