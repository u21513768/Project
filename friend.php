<?php
/*Quintin d'Hotman de Villiers u21513768*/
// See all errors and warnings
error_reporting(E_ALL);
ini_set('error_reporting', E_ALL);

$mysqli = mysqli_connect("localhost:3306", "u21513768", "yobsxklz", "u21513768");

if (isset($_GET['user_id']) && isset($_GET['friend_id'])) {
    $user_id = $_GET['user_id'];
    $friend_id = $_GET['friend_id'];
    $query = "SELECT * FROM tbusers WHERE user_id = '$user_id'";

    $res = mysqli_query($mysqli, $query);

    $row = mysqli_fetch_array($res);

    if ($row == null) {
        header("Location: index.php");
        exit;
    }

    $email = $row["email"];
    $pass = $row["password"];

    $friendQuery = "SELECT * FROM tbusers WHERE user_id = '$friend_id'";
    $friendResult = mysqli_query($mysqli, $friendQuery);
    $friendRow = mysqli_fetch_array($friendResult);

    $friendshipQuery = "SELECT * FROM tbfriends WHERE user_id = '$user_id' AND follow_id = '$friend_id'";
    $friendshipResult = mysqli_query($mysqli, $friendshipQuery);

    if ($friendshipRow = mysqli_fetch_array($friendshipResult)) {
        $areFriends = true;
        $followStatus = "Unfollow";
    } else {
        $areFriends = false;
        $followStatus = "Follow";
    }

    $friendsQuery = "SELECT tbusers.* FROM tbusers
    INNER JOIN tbfriends ON tbusers.user_id = tbfriends.user_id
    WHERE tbfriends.user_id = '$friend_id'";
    $friendsResult = mysqli_query($mysqli, $friendsQuery);

    if ($friendsResult) {
        $friends = mysqli_fetch_all($friendsResult, MYSQLI_ASSOC);
    } else {
        // Handle the query error
        echo "Error: " . mysqli_error($mysqli);
    }

    $followsQuery = "SELECT tbusers.* FROM tbusers
    INNER JOIN tbfriends ON tbusers.user_id = tbfriends.user_id
    WHERE tbfriends.follow_id = '$friend_id'";
    $followsResult = mysqli_query($mysqli, $followsQuery);

    if ($followsResult) {
        $follows = mysqli_fetch_all($followsResult, MYSQLI_ASSOC);
    } else {
        // Handle the query error
        echo "Error: " . mysqli_error($mysqli);
    }

} else {
    // Handle the case where article_id or user_id is not set in the URL
    echo "User ID is not set.";
}

$submit = isset($_POST['return']);
if ($submit) {
    session_start();

    $_SESSION["email"] = $_POST['email'];
    $_SESSION["pass"] = $_POST['pass'];
    header("Location: articles.php");
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
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway:700,900|Open+Sans">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <meta charset="utf-8" />
    <meta name="author" content="Name Surname">
    <!-- Quintin d'Hotman de Villiers u21513768 -->

</head>

<body>
    <div class='container'>
        <div class='sideSection'>
            <?php
            echo "<a class='btn btn-primary' href='users.php?user_id=$user_id'>Return</a><br>";
            ?>
            <br>
            <!-- Add a Follow button with an id for JavaScript -->
            <button id="followBtn" class="btn btn-primary">Follow</button>
            <br><br>
            <!-- Send Message button -->
            <button id="sendMessageBtn" class="btn btn-primary">Send Message</button>

            <div>
                <?php
                if ($friendRow) {
                    $friendName = $friendRow["name"];
                    $friendSurname = $friendRow["surname"];
                    $friendEmail = $friendRow["email"];
                    $friendBirthday = $friendRow["birthday"];

                    // Display friend user details
                    echo "Friend Name: " . $friendName . "<br>";
                    echo "Friend Surname: " . $friendSurname . "<br>";
                    echo "Friend Email: " . $friendEmail . "<br>";
                    echo "Friend Birthday: " . $friendBirthday . "<br>";
                } else {
                    echo "Friend user not found.";
                }
                ?>
            </div>
            <hr/>
            <div class="col-6">
                <?php if ($areFriends): ?>
                    <h5>Users followed by
                        <?php echo $friendName; ?>
                    </h5><br />
                    <?php if (!empty($friends)): ?>
                        <ul>
                            <?php foreach ($friends as $friend): ?>
                                <li>
                                    <?php echo $friend['username']; ?>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    <?php else: ?>
                        <p>This user isn't followed by anyone.</p>
                    <?php endif; ?>
                <?php else: ?>
                    <p>You are not following this user, so you cannot see the users they follow.</p>
                <?php endif; ?>
            </div>

            <div class="col-6">
                <?php if ($areFriends): ?>
                    <h5>Users following
                        <?php echo $friendName; ?>
                    </h5><br />
                    <?php if (!empty($follows)): ?>
                        <ul>
                            <?php foreach ($follows as $follow): ?>
                                <li>
                                    <?php echo $follow['username']; ?>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    <?php else: ?>
                        <p>This user follows no one.</p>
                    <?php endif; ?>
                <?php else: ?>
                    <p>This user isn't following anyone.</p>
                <?php endif; ?>
            </div>


            <hr />
            <h5>Articles created by
                <?php echo $friendName; ?>
            </h5><br />
            <div id="articleCarousel" class="carousel slide" data-bs-ride="carousel">
                <div class="carousel-inner">
                    <?php
                    $articlesQuery = "SELECT * FROM tbarticles WHERE user_id = '$friend_id'";
                    $articlesResult = mysqli_query($mysqli, $articlesQuery);

                    if ($articlesResult) {
                        $articles = mysqli_fetch_all($articlesResult, MYSQLI_ASSOC);

                        // Split the articles into pairs
                        $articlePairs = array_chunk($articles, 3);

                        // Iterate through pairs and create carousel items
                        foreach ($articlePairs as $index => $pair) {
                            echo '<div class="carousel-item ' . ($index === 0 ? 'active' : '') . '">
                            <div class="row">';

                            // Display two items in each carousel item
                            foreach ($pair as $article) {
                                $article_id = $article["article_id"];
                                $title = $article["title"];
                                $description = $article["description"];
                                $author = $article["author"];
                                $date = $article["date"];

                                // Card structure for each article
                                echo '<div class="col-md-4 mb-3">
                                    <div class="card mx-2">
                                        <div class="card-body">
                                            <h5 class="card-title">
                                                <a href="article-details.php?article_id=' . $article_id . '&user_id=' . $user_id . '">' . $title . '</a>
                                            </h5>
                                            <p class="card-text">' . $description . '</p>
                                            <p class="card-text"><small class="text-muted">' . $author . ' - ' . $date . '</small></p>
                                        </div>
                                    </div>
                                </div>';
                            }

                            echo '</div></div>';
                        }
                    } else {
                        echo "Error: " . mysqli_error($mysqli);
                    }
                    ?>
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#articleCarousel"
                    data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#articleCarousel"
                    data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>
        </div>
    </div>
    <!-- Message Modal -->
    <div class="modal fade" id="messageModal" tabindex="-1" aria-labelledby="messageModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="messageModalLabel">Send Message to
                        <?php echo $friendName; ?>
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- Message input form -->
                    <form id="messageForm">
                        <div class="mb-3">
                            <label for="messageContent" class="form-label">Message:</label>
                            <textarea class="form-control" id="messageContent" rows="3" required></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">Send</button>
                    </form>
                </div>
            </div>
        </div>
    </div>


    <script>
        document.getElementById("followBtn").addEventListener("click", function () {
            var user_id = <?php echo $user_id; ?>;
            var friend_id = <?php echo $friend_id; ?>;

            // Send user_id and friend_id to PHP using AJAX
            var xhr = new XMLHttpRequest();
            xhr.open("POST", "follow.php", true);
            xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            xhr.onreadystatechange = function () {
                if (xhr.readyState == 4 && xhr.status == 200) {
                    // Parse the response JSON
                    var response = JSON.parse(xhr.responseText);
                    if (response.success) {
                        // If successful, display the alert
                        alert("Your friendship has been changed.");
                    } else {
                        // Handle errors if any
                        alert("Failed to follow. Please try again later.");
                    }
                }
            };
            xhr.send("user_id=" + user_id + "&friend_id=" + friend_id);
        });

        // Open message modal when the "Send Message" button is clicked
        document.getElementById("sendMessageBtn").addEventListener("click", function () {
            $('#messageModal').modal('show');
        });

        // Handle form submission for sending messages
        document.getElementById("messageForm").addEventListener("submit", function (event) {
            event.preventDefault();

            var messageContent = document.getElementById("messageContent").value;
            var recipient_id = <?php echo $friend_id; ?>;

            // Send message content and recipient_id to PHP using AJAX
            var xhr = new XMLHttpRequest();
            xhr.open("POST", "message.php", true);
            xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            xhr.onreadystatechange = function () {
                if (xhr.readyState == 4 && xhr.status == 200) {
                    var response = JSON.parse(xhr.responseText);
                    if (response.success) {
                        // If successful, close the modal and display a success message
                        $('#messageModal').modal('hide');
                        alert("Message sent successfully!");
                    } else {
                        // Handle errors if any
                        alert("Failed to send message. Please try again later.");
                    }
                }
            };
            xhr.send("messageContent=" + messageContent + "&recipient_id=" + recipient_id);
        });

        var sendMessageBtn = document.getElementById("sendMessageBtn");
        if (<?php echo $areFriends ? 'true' : 'false'; ?>) {
            sendMessageBtn.style.display = 'block';
        } else {
            sendMessageBtn.style.display = 'none';
        }

        var followBtn = document.getElementById("followBtn");

        if (<?php echo $areFriends ? 'true' : 'false'; ?>) {
            followBtn.innerText = "Unfollow";
        } else {
            followBtn.innerText = "Follow";
        }

    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>