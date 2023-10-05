<?php
/*Quintin d'Hotman de Villiers u21513768*/
// See all errors and warnings
error_reporting(E_ALL);
ini_set('error_reporting', E_ALL);

$mysqli = mysqli_connect("localhost:3306", "u21513768", "yobsxklz", "u21513768");

session_start();
$email = isset($_POST["email"]) ? $_POST["email"] : $_SESSION["email"];
$pass = isset($_POST["pass"]) ? $_POST["pass"] : $_SESSION["pass"];
//echo "email: " . $email . "\npassword: " . $pass;
if ($email == null || $email == "" || $pass == null || $pass == "") {
    header("Location: index.php");
}

$query = "SELECT * FROM tbusers WHERE email = '$email' AND password = '$pass'";

$res = mysqli_query($mysqli, $query);

$row = mysqli_fetch_array($res);

if ($row == null) {
    header("Location: index.php");
    exit;
}

$userid = $row["user_id"];
$name = $row["name"];
$username = $row["username"];

$submit = isset($_POST['add-form']);
if ($submit) {
    session_start();

    $_SESSION["email"] = $email;
    $_SESSION["pass"] = $pass;
    header("Location: article-form.php");
    exit; // Make sure to exit after redirecting
}

?>

<!DOCTYPE html>
<html>

<head>
    <title>IMY 220 - Assignment 2</title>
    <meta charset="utf-8" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css"
        integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous">
    <!--<link rel="stylesheet" type="text/css" href="style.css" />-->
    <link rel="stylesheet" href="articles.css">
    <link rel="stylesheet" href="https://cdn.lineicons.com/4.0/lineicons.css" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway:700,900|Open+Sans|Titillium+Web">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <meta charset="utf-8" />
    <meta name="author" content="Name Surname">
    <!-- Quintin d'Hotman de Villiers u21513768 -->

</head>

<body>
    <div class='header-info'>
        <nav class='navbar navbar-expand-lg navbar-dark px-3'>
            <a class='navbar-brand' id='modal-click' href="profile.php?user_id=<?php echo $userid; ?>"><i
                    class='lni lni-user'></i></a>
            <a class='navbar-brand h1 active' href="profile.php?user_id=<?php echo $userid; ?>">
                <?php echo $username; ?>
            </a>
            <a class='navbar-brand h1 active' href="users.php?user_id=<?php echo $userid; ?>">
                Users
            </a>
            <div class='collapse navbar-collapse' id='navbarNavAltMarkup'>
                <div class='navbar-nav px-2'>
                    <a class='nav-item nav-link' href='index.php'>Log Out</a>
                </div>
                <form id="redirectForm" action="article-form.php" method="POST">
                    <input type="hidden" name="email" value="<?php echo htmlspecialchars($email); ?>" />
                    <input type="hidden" name="pass" value="<?php echo htmlspecialchars($pass); ?>" />
                    <input type="submit" id="add-article" class="nav-item nav-link btn" value="Add article"
                        name="add-form">
                </form>
            </div>
        </nav>
    </div>
    <div class='container'>
        <div class='sideSection'>
            <input type="text" class="form-control" value="Search by Hashtag" name="search-hashtag">
            <label for="categories">Select Category:</label>
            <select id="categories" name="categories" class="form-control">
                <option value="category1">Category 1</option>
                <option value="category2">Category 2</option>
                <option value="category3">Category 3</option>
            </select>
            <br/>
            <div class="row articleGalleryContainer">
                <h1>Latest Global Articles</h1>
                <hr />
                <div class="articleGallery">
                    <?php
                    $query2 = "SELECT * FROM tbarticles ORDER BY date DESC"; //WHERE user_id = '$userid'";
                    $res2 = $mysqli->query($query2);

                    while ($row2 = mysqli_fetch_array($res2)) {
                        $article_id = $row2['article_id'];
                        $image_query = "SELECT * FROM tbgallery WHERE article_id = '$article_id'";
                        $image_res = mysqli_query($mysqli, $image_query);

                        if ($image_res) {
                            $image_row = mysqli_fetch_array($image_res);
                            if ($image_row) {
                                // If image data is found, use the image from the database
                                $image_src = $image_row['image_name'];
                            } else {
                                // If no image data is found, set a default image source
                                $image_src = "default.jpg";
                            }
                        } else {
                            // If the query fails, set a default image source
                            $image_src = "default.jpg";
                        }

                        echo '
					<div >
						<div class="card">
						<div id="logo"  class="card-img-top"><img src="./gallery/' . ($image_src ?? 'default.jpg') . '"  class="card-img-top" alt="Article Image"></div>
							<div class="card-body">
                            <button class="btn add-to-list-btn" data-article-id="' . $article_id . '"><i class="lni lni-more"></i></button>
                                <h5 class="card-title">
                                    <a href="article-details.php?article_id=' . $article_id . '&user_id=' . $userid . '">' . $row2['title'] . '</a>
                                </h5>
								<p class="card-text">' . $row2['description'] . '</p>
								<p class="card-text"><small class="text-muted">' . $row2['author'] . ' - ' . $row2['date'] . '</small></p>
							</div>
						</div>
					</div><hr/>';
                    }
                    ?>
                </div>
                <div class="scroll">
                    <p>Scroll<i class="lni lni-arrow-right arrow-icon"></i></p>
                </div>
            </div>
            <br />
            <div class="row articleGalleryContainer">
                <h1>Your Articles</h1>
                <hr />
                <div class="articleGallery">
                    <?php
                    $query2 = "SELECT * FROM tbarticles WHERE user_id = '$userid' ORDER BY date DESC"; //WHERE user_id = '$userid'";
                    $res2 = $mysqli->query($query2);

                    while ($row2 = mysqli_fetch_array($res2)) {
                        $article_id = $row2['article_id'];
                        $image_query = "SELECT * FROM tbgallery WHERE article_id = '$article_id'";
                        $image_res = mysqli_query($mysqli, $image_query);

                        if ($image_res) {
                            $image_row = mysqli_fetch_array($image_res);
                            if ($image_row) {
                                // If image data is found, use the image from the database
                                $image_src = $image_row['image_name'];
                            } else {
                                // If no image data is found, set a default image source
                                $image_src = "default.jpg";
                            }
                        } else {
                            // If the query fails, set a default image source
                            $image_src = "default.jpg";
                        }


                        echo '
					<div >
						<div class="card">
						<div id="logo"  class="card-img-top"><img src="./gallery/' . ($image_src ?? 'default.jpg') . '"  class="card-img-top" alt="Article Image"></div>
							<div class="card-body">
                            <button class="btn add-to-list-btn" data-article-id="' . $article_id . '"><i class="lni lni-more"></i></button>
                            <h5 class="card-title">
                            <a href="article-details.php?article_id=' . $article_id . '&user_id=' . $userid . '">' . $row2['title'] . '</a>
                        </h5>
								<p class="card-text">' . $row2['description'] . '</p>
								<p class="card-text"><small class="text-muted">' . $row2['author'] . ' - ' . $row2['date'] . '</small></p>
							</div>
						</div>
					</div><hr/>';
                    }
                    ?>
                </div>
                <div class="scroll">
                    <p>Scroll<i class="lni lni-arrow-right arrow-icon"></i></p>
                </div>
            </div>
            <br />
            <div class="row articleGalleryContainer">
                <h1>Friend Articles</h1>
                <hr />
                <div class="articleGallery">
                    <?php
                    // Your existing code...
                    
                    // Fetch follow_ids from tbfriends where user_id is equal to $userid
                    $followIdsQuery = "SELECT follow_id FROM tbfriends WHERE user_id = '$userid'";
                    $followIdsResult = mysqli_query($mysqli, $followIdsQuery);

                    if ($followIdsResult) {
                        // Extract follow_ids from the result set
                        $followIds = [];
                        while ($row = mysqli_fetch_assoc($followIdsResult)) {
                            $followIds[] = $row['follow_id'];
                        }

                        // Use the follow_ids to fetch articles from tbarticles
                        $followIdsString = implode(',', $followIds);
                        $friendArticlesQuery = "SELECT * FROM tbarticles WHERE user_id IN ($followIdsString) ORDER BY date DESC";
                        $friendArticlesResult = mysqli_query($mysqli, $friendArticlesQuery);

                        if ($friendArticlesResult) {
                            // Fetch and display articles written by friends
                            while ($row2 = mysqli_fetch_array($friendArticlesResult)) {
                                $article_id = $row2['article_id'];
                                $image_query = "SELECT * FROM tbgallery WHERE article_id = '$article_id'";
                                $image_res = mysqli_query($mysqli, $image_query);

                                if ($image_res) {
                                    $image_row = mysqli_fetch_array($image_res);
                                    if ($image_row) {
                                        // If image data is found, use the image from the database
                                        $image_src = $image_row['image_name'];
                                    } else {
                                        // If no image data is found, set a default image source
                                        $image_src = "default.jpg";
                                    }
                                } else {
                                    // If the query fails, set a default image source
                                    $image_src = "default.jpg";
                                }


                                echo '
                                <div >
                                    <div class="card">
                                    <div id="logo"  class="card-img-top"><img src="./gallery/' . ($image_src ?? 'default.jpg') . '"  class="card-img-top" alt="Article Image"></div>
                                        <div class="card-body">
                                        <button class="btn add-to-list-btn" data-article-id="' . $article_id . '"><i class="lni lni-more"></i></button>
                                        <h5 class="card-title">
                                        <a href="article-details.php?article_id=' . $article_id . '&user_id=' . $userid . '">' . $row2['title'] . '</a>
                                    </h5>
                                            <p class="card-text">' . $row2['description'] . '</p>
                                            <p class="card-text"><small class="text-muted">' . $row2['author'] . ' - ' . $row2['date'] . '</small></p>
                                        </div>
                                    </div>
                                </div><hr/>';
                            }
                        } else {
                            echo "Error: " . mysqli_error($mysqli);
                        }
                    } else {
                        echo "Error: " . mysqli_error($mysqli);
                    }

                    ?>
                </div>
                <div class="scroll">
                    <p>Scroll<i class="lni lni-arrow-right arrow-icon"></i></p>
                </div>
            </div>
            <?php
            // Your existing code...
            
            // Fetch list_ids from tblist where user_id is equal to $userid
            $listIdsQuery = "SELECT list_id, name FROM tblist WHERE user_id = '$userid'";
            $listIdsResult = mysqli_query($mysqli, $listIdsQuery);

            if ($listIdsResult) {
                // Extract list_ids and list_names from the result set
                while ($listRow = mysqli_fetch_assoc($listIdsResult)) {
                    $listId = $listRow['list_id'];
                    $listName = $listRow['name'];

                    // Output the list name
                    echo '<div class="row articleGalleryContainer">';
                    echo '<h1>' . $listName . '</h1>';
                    echo '<hr />';
                    echo '<div class="articleGallery">';

                    // Use the list_id to fetch corresponding article_ids from tblisttable
                    $articleIdsQuery = "SELECT article_id FROM tblisttable WHERE list_id = '$listId'";
                    $articleIdsResult = mysqli_query($mysqli, $articleIdsQuery);

                    if ($articleIdsResult) {
                        // Extract article_ids from the result set and display articles
                        while ($articleRow = mysqli_fetch_assoc($articleIdsResult)) {
                            $articleId = $articleRow['article_id'];

                            // Fetch article details and image from tbarticles and tbgallery based on $articleId
                            $articleDetailsQuery = "SELECT * FROM tbarticles WHERE article_id = '$articleId'";
                            $articleDetailsResult = mysqli_query($mysqli, $articleDetailsQuery);

                            $imageQuery = "SELECT * FROM tbgallery WHERE article_id = '$articleId'";
                            $imageResult = mysqli_query($mysqli, $imageQuery);

                            if ($articleDetailsResult && $imageResult) {
                                // Display article details and image
                                while ($articleDetailsRow = mysqli_fetch_assoc($articleDetailsResult)) {
                                    $title = $articleDetailsRow['title'];
                                    $description = $articleDetailsRow['description'];
                                    $author = $articleDetailsRow['author'];
                                    $date = $articleDetailsRow['date'];

                                    // Fetch image source
                                    $imageRow = mysqli_fetch_assoc($imageResult);
                                    $image_src = ($imageRow && $imageRow['image_name']) ? $imageRow['image_name'] : 'default.jpg';

                                    // Output the article details and image
                                    echo '<div class="card">';
                                    echo '<div id="logo" class="card-img-top"><img src="./gallery/' . $image_src . '" class="card-img-top" alt="Article Image"></div>';
                                    echo '<div class="card-body">';
                                    echo ' <button class="btn add-to-list-btn" data-article-id="' . $articleId . '"><i class="lni lni-more"></i></button>
                                        <h5 class="card-title">
                                            <a href="article-details.php?article_id=' . $articleId . '&user_id=' . $userid . '">' . $title . '</a>
                                        </h5>';
                                    echo '<p class="card-text">' . $description . '</p>';
                                    echo '<p class="card-text"><small class="text-muted">' . $author . ' - ' . $date . '</small></p>';
                                    echo '</div>';
                                    echo '</div>';
                                }
                            } else {
                                echo "Error: " . mysqli_error($mysqli);
                            }
                        }

                    } else {
                        echo "Error: " . mysqli_error($mysqli);
                    }

                    echo '</div>';
                    echo '</div><br/>';
                }
            } else {
                echo "Error: " . mysqli_error($mysqli);
            }

            ?>


        </div>
    </div>

    <!-- Modal for adding to list -->
    <div class="modal fade" id="listModal" tabindex="-1" role="dialog" aria-labelledby="listModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="listModalLabel">Add to List</h5>
                    <button type="button" class="close" id="close-modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="listForm">
                        <div class="form-group">
                            <label for="existingLists">Choose Existing List:</label>
                            <select class="form-control" id="existingLists" name="existingList">
                                <!-- Options for existing lists will be populated here using PHP -->
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="newListName">Or Create New List:</label>
                            <input type="text" class="form-control" id="newListName" name="newListName">
                        </div>
                        <!-- Add more form fields if needed -->
                        <input type="hidden" id="userIdInput" name="userId">
                        <input type="hidden" id="articleIdInput" name="articleId">
                        <button type="submit" class="btn btn-primary">Add to List</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        // JavaScript code to handle button click event and form submission
        $('.add-to-list-btn').click(function () {
            var articleId = $(this).data('article-id');
            $('#articleIdInput').val(articleId);
            $('#userIdInput').val(<?php echo $userid; ?>);


            $.ajax({
                type: 'GET',
                url: 'get-lists.php', // PHP script to fetch existing lists
                success: function (response) {
                    $('#existingLists').html(response); // Populate existing lists in the dropdown
                }
            });

            $('#listModal').modal('show');
        });

        $('#close-modal').click(function () {
            $('#listModal').modal('hide');
        });

        $('#listForm').submit(function (event) {
            event.preventDefault();
            var formData = $(this).serialize();
            $.ajax({
                type: 'POST',
                url: 'add-to-list.php', // PHP script to process the form data
                data: formData,
                success: function (response) {
                    // Handle the response, e.g., show success message or reload the page
                    console.log(response);
                    alert(response);
                }
            });
            $('#listModal').modal('hide'); // Close the modal after form submission
        });
    </script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>