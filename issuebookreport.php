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

// Assuming you have a table named 'issued_books' with columns 'UserID', 'Bookid', 'Bookname', 'Issuedate', 'Returndate'
$sql = "SELECT * FROM issuebooks";
$result = $conn->query($sql);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Issue Book Report</title>
    <link rel="stylesheet" href="css\issuereport.css">
</head>
<body>
    <form action="issuebook.php" method="post"></form>

    <div class="navigation">
        
   

    <div class="container">
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

                echo "<tr>";
                echo "<td>{$row["UserID"]}</td>";
                echo "<td>{$row["Bookid"]}</td>";
                echo "<td>{$row["Bookname"]}</td>";
                echo "<td>{$row["Issuedate"]}</td>";
                echo "<td>{$row["Returndate"]}</td>";
                echo "<td>{$fine}</td>";
                echo "<td><input type='checkbox' disabled></td>";
                echo "</tr>";
            }
            ?>

        </table>

    </div>
    </div>
</body>
</html>

<?php
// Close connection
$conn->close();
?>

