<?php
/*Quintin d'Hotman de Villiers u21513768*/
// See all errors and warnings
error_reporting(E_ALL);
ini_set('error_reporting', E_ALL);

$mysqli = mysqli_connect("localhost:3306", "u21513768", "yobsxklz", "u21513768");

if (isset($_GET['user_id'])) {
    // Retrieve article_id and user_id from the URL

    $user_id = $_GET['user_id'];

    $query = "SELECT * FROM tbusers WHERE user_id = '$user_id'";

    $res = mysqli_query($mysqli, $query);

    $row = mysqli_fetch_array($res);

    if ($row == null) {
        header("Location: index.php");
        exit;
    }

    $username = $row["username"];
    $email = $row["email"];
    $pass = $row["password"];
    $name = $row["name"];
    $surname = $row["surname"];
    $birthday = $row["birthday"];

    $friendsQuery = "SELECT tbusers.* FROM tbusers
    INNER JOIN tbfriends ON tbusers.user_id = tbfriends.user_id
    WHERE tbfriends.user_id = '$user_id'";
    $friendsResult = mysqli_query($mysqli, $friendsQuery);

    if ($friendsResult) {
        $friends = mysqli_fetch_all($friendsResult, MYSQLI_ASSOC);
    } else {
        // Handle the query error
        echo "Error: " . mysqli_error($mysqli);
    }

    $followsQuery = "SELECT tbusers.* FROM tbusers
    INNER JOIN tbfriends ON tbusers.user_id = tbfriends.user_id
    WHERE tbfriends.follow_id = '$user_id'";
    $followsResult = mysqli_query($mysqli, $followsQuery);

    if ($followsResult) {
        $follows = mysqli_fetch_all($followsResult, MYSQLI_ASSOC);
    } else {
        // Handle the query error
        echo "Error: " . mysqli_error($mysqli);
    }
} else {
    // Handle the case where article_id or user_id is not set in the URL
    echo "Article ID or User ID is not set.";
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
    <div class='header-info'>
        <nav class='navbar navbar-expand-lg navbar-dark px-3'>
            <a class='navbar-brand' id='modal-click' href="profile.php?user_id=<?php echo $user_id; ?>"><i
                    class='lni lni-user'></i></a>
            <a class='navbar-brand h1 active' href="profile.php?user_id=<?php echo $user_id; ?>">
                <?php echo $name; ?>
            </a>
            <a class='navbar-brand h1 active' href="my-messages.php?user_id=<?php echo $user_id; ?>">
                Messages
            </a>
            <div class='collapse navbar-collapse' id='navbarNavAltMarkup'>
                <div class='navbar-nav px-2'>
                    <a class='nav-item nav-link' href='index.php'>Log Out</a>
                </div>
            </div>
        </nav>
    </div>
    <div class='container'>
        <div class='sideSection'>

            <form id="redirectForm" action="article-details.php" method="POST">
                <input type="hidden" class="form-control" name="email" value="<?php echo $email; ?>" />
                <input type="hidden" class="form-control" name="pass" value="<?php echo $pass; ?>" />
                <input type="submit" class="btn btn-primary" value="Return" name="return">
            </form>
            <h4>
                <?php echo $username; ?>
            </h4>
            <h4>
                <?php echo $name; ?>
            </h4>
            <h4>
                <?php echo $surname; ?>
            </h4>
            <h4>
                <?php echo $email; ?>
            </h4>
            <h4>
                <?php echo $birthday; ?>
            </h4>
            <hr/>
            <div class="col-6">
                <h5>Users followed by You
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
                    <p>You aren't followed by anyone.</p>
                <?php endif; ?>
            </div>

            <div class="col-6">
                <h5>Users following You
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
                    <p>You follow no one.</p>
                <?php endif; ?>
            </div>


            <hr />
            <h5>Articles created by You</h5><br />
            <div id="articleCarousel" class="carousel slide" data-bs-ride="carousel">
                <div class="carousel-inner">
                    <?php
                    $articlesQuery = "SELECT * FROM tbarticles WHERE user_id = '$user_id'";
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
</body>

</html>