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
$search_query = isset($_GET['search_query']) ? $_GET['search_query'] : '';

if ($search_query) {
    $query = "SELECT * FROM book_entry WHERE (Category = '$category_filter' OR Bookname LIKE '%$search_query%') ORDER BY Bookid DESC";
} else if ($category_filter) {
    $query = "SELECT * FROM book_entry WHERE Category = '$category_filter' ORDER BY Bookid DESC";
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
    <!-- Include Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
  
        body {
            background-color: #f5f5f5;
        }

        .header-image {
            background-image: url('image/background.jpg'); /* Replace 'your-image-url.jpg' with your image URL */
            background-size: cover;
            background-position: center;
            height: 400px; /* Adjust the height as needed */
            display: flex;
            filter: grayscale(90px);
            justify-content: center;
            align-items: top;
            color: #ffffff;
            text-align: center;
            font-style: italic;
        }

        .welcome-text {
            font-size: 54px;
        }

        .main-content {
            display: flex;
            flex-direction: row;
        }

        .sidebar {
            
            height: 100%;
            width: 200px;
            background-color: #3b4140;
            color: #fff;
            padding-top: 20px;
        }

        .sidebar-heading {
            font-size: 24px;
            text-align: center;
            margin-bottom: 20px;
        }

        .nav-link {
            color: #fff;
            padding: 10px;
            text-align: center;
        }

        .nav-link:hover {
            background-color: #f1f1f1;
        }

        .content {
            flex: 1;
            padding: 20px;
        }

        .search-bar {
            margin-bottom: 20px;
        }

        .book-category,
        .language-select {
            display: inline-block;
            margin-right: 20px;
        }

        .book {
            background-color: #ececec;
            border: 1px solid #ccc;
            padding: 20px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            margin-bottom: 30px;
            display: flex;
            align-items: center;
        }

        .book img {
            max-width: 200px;
            height: auto;
            margin-right: 20px;
            
        }

        .book-details {
            flex: 1;
            padding: 50px;
        }

        .book-title {
            font-weight: bold;
            margin-top: 10px;
        }

        .book-author,
        .Category {
            color: #777;
        }

        .like-comment-section {
            display: flex;
            align-items: left;
            justify-content: space-between;
            margin-top: 20px;
        }

        .like-form,
        .comment-form {
            display: flex;
            align-items: center;
        }

        .comment-form textarea {
            resize: none;
        }

        .btnfail {
            background-color: red;
            color: white;
            border: none;
            padding: 8px 16px;
            cursor: pointer;
            border-radius: 4px;
        }

        .btnfail:hover {
            background-color: darkred;
        }
        /* side bar */
        .sidebar {
    background-color: #333;
    color: #fff;
    padding: 20px;
}

.sidebar-heading {
    font-size: 1.5rem;
    margin-bottom: 20px;
}

.dropdown-btn {
    background-color: #555;
    color: #fff;
    padding: 10px 15px;
    border: none;
    cursor: pointer;
    width: 100%;
    text-align: left;
}

.dropdown-content {
    display: none;
    position: absolute;
    background-color: #444;
    min-width: 160px;
    z-index: 1;
}

.dropdown-content a {
    color: #fff;
    padding: 12px 16px;
    text-decoration: none;
    display: block;
}

.dropdown-content a:hover {
    background-color: #666;
}

.dropdown:hover .dropdown-content {
    display: block;
}
    </style>

    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

</head>

<body>
    <div class="header-image">
        <div class="welcome-text">
            Welcome to Gnanapradeepa <br> Library
        </div>
    </div>

    <div class="main-content">
        <nav class="sidebar">
            <div class="sidebar-heading">Library Dashboard</div>
            <div class="dropdown">
                <button class="dropdown-btn">Menu</button>
                <div class="dropdown-content">
                    <a href="userprofile.html">User Profile</a>
                    <a href="dashboard.php">Book Tab</a>
                    <a href="bookreservation.php">Book Reservation</a>
                    <a href="index.php">Log out</a>
                </div>
            </div>
        </nav>

        <div class="content">
        <div class="search-bar">
    <form id="searchForm" method="get" action="">
        <div class="input-group">
            <input type="text" class="form-control" placeholder="Search books..." name="search_query">
            <div class="header_search search search_open <?php echo $class?>">
                                        <a href="#"><i class="icon-magnifier icons"></i></a>
                                    </div>
        </div>
    </form>
    
</div>

            <div class="d-flex justify-content-between">
                <div class="book-category">
                    <label for="category">Select Book Category:</label>
                    <select id="category" class="form-control">
                        <option value="All">All</option>
                        <option value="Adventure stories">Adventure stories</option>
            <option value="Education">Education</option>
            <option value="Crime">Crime</option>
            <option value="Historical fiction">Historical fiction</option>
            <option value="Horror">Horror</option>
            <option value="Literary fiction">Literary fiction</option>
            <option value="Mystery">Mystery</option>
           
            <option value="Romance">Romance</option>
            <option value="Science fiction">Science fiction</option>
            <option value="pdf">PDF </option>
                    </select>
                </div>

                <div class="language-select">
                    <label for="language">Change Language:</label>
                    <select id="language" class="form-control">
                        <option value="english">English</option>
                        <option value="sinhala">Sinhala </option>
                       
                    </select>
                </div>
            </div>
              <br>

            <div class="book-list">
                <?php foreach ($rows as $row) : ?>
                    <div class="book">
                        <img src="Newfolder/<?php echo $row["Image"]; ?>" alt="Book Image"> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        <div class="book-details">
                            <div class="book-id">Id : <?php echo $row["Bookid"]; ?></div>
                            <div class="book-title">Book name : <?php echo $row["Bookname"]; ?></div><br>
                            <div class="book-author">Author name : <?php echo $row["Authorname"]; ?></div><br>
                            <div class="Category">Category : <?php echo $row["Category"]; ?></div><br>

                            <form class="reservation-form" action="book_reservation_handler.php" method = "POST">
                                <input type="hidden" name="book_id" value="<?php echo $row["Bookid"]; ?>">
                                <input type="hidden" name="book_Name" value="<?php echo $row["Bookname"]; ?>">
                                <?php if($row["reservation"]==1){ ?>
                                <button type="button" class="btnfail" name="reserve" onclick="customAlert()" >Book Reservation</button>
                                <?php } ?>

                                <?php if($row["reservation"]==0){ ?>
                                <button type="submit" class="btn btn-success" name="reserve" onclick='reserveBook(<?php $row["Bookid"]; ?> )'>Book Reservation</button>
                                <?php } ?>
                            </form>
                            <br>
                            <form action="addcomment.php" method = "POST">    
                                    
                            </form>
                            <div class="comment-form">
                <textarea id="commentText_<?php echo $row["Bookid"]; ?>" placeholder="Add your comment"></textarea>
&nbsp;&nbsp;&nbsp;
                
                <button onclick='addComment(<?php echo $row["Bookid"]; ?>)'>Submit</button>


            </div>
            
            <div class="user-comments" id="commentsContainer_<?php echo $row["Bookid"]; ?>">
        <h6>User Comments:</h6>
        <?php
        // Fetch and display comments for the current book
        $bookId = $row["Bookid"];
        $commentsQuery = "SELECT * FROM comments WHERE Bookid = '$bookId'";
        $commentsResult = mysqli_query($conn, $commentsQuery);

        while ($comment = mysqli_fetch_assoc($commentsResult)) {
            echo "<div class='comment'>";
            echo "<strong>User:</strong> " . $comment['user_id'] . "<br>";
            echo "<strong>Comment:</strong> " . $comment['comment_text'];
            echo "</div>";
        }
        ?>
    </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
    <script>
    function reserveBook(bookId , bookName) {
        alert("reservation");
        var form = document.getElementById('reservationForm_' + bookId);
        var button = form.getElementsByTagName('button')[0];
        
       // Assuming you use jQuery for easier AJAX
        $.ajax({
            type: 'POST',
            url: 'book_reservation_handler.php',
            data: {
                "book_Id": bookID,
                "book_Name" : bookName
            },
            success: function(response) {
                var result = JSON.parse(response);

                if (result.status === 'success') {
                    alert(result.message);
                    button.style.backgroundColor = 'red'; // Change the button color to red for success
                } else if (result.status === 'unavailable') {
                    alert(result.message);
                    button.style.backgroundColor = 'red'; // Change the button color to red for unavailable
                } else {
                    alert(result.message);
                }
            },
            error: function() {
                alert('Error in AJAX request');
            }
        });
    }
    </script>
   <script type="text/javascript" src="https://translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>


   <script>
   function addComment(bookId) {
    var commentText = document.getElementById('commentText_' + bookId).value;
    var commentContainer = document.getElementById('commentsContainer_' + bookId);

    $.ajax({
        type: 'POST',
        url: 'comments.php', // Update the URL to your comment handler script
        data: {
            book_id: bookId,
            comment: commentText
        },
        success: function(response) {
            var result = JSON.parse(response);

            if (result.status === 'success') {
                // Assuming you want to display the comment immediately
                var commentElement = document.createElement('div');
                commentElement.className = 'comment';
                commentElement.innerHTML = "<strong>User:</strong> You<br><strong>Comment:</strong> " + commentText;
                commentContainer.appendChild(commentElement);

                // Clear the input field
                document.getElementById('commentText_' + bookId).value = '';
            } else {
                alert(result.message);
            }
        },
        error: function(xhr, status, error) {
            console.error('AJAX Error: ' + status + ' - ' + error);
            alert('Error in AJAX request');
        }
    });
}

function customAlert() {
    alert("Book does't axist!");
}

</script>

</body>

</html>

