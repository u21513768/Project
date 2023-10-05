<?php
/*Quintin d'Hotman de Villiers u21513768*/
// See all errors and warnings
error_reporting(E_ALL);
ini_set('error_reporting', E_ALL);

$mysqli = mysqli_connect("localhost:3306", "u21513768", "yobsxklz", "u21513768");

if (isset($_GET['article_id']) && isset($_GET['user_id'])) {
    $article_id = $_GET['article_id'];
    $user_id = $_GET['user_id'];

    $query = "SELECT * FROM tbusers WHERE user_id = '$user_id'";

    $res = mysqli_query($mysqli, $query);

    $row = mysqli_fetch_array($res);

    if ($row == null) {
        header("Location: index.php");
        exit;
    }

    $email = $row["email"];
    $pass = $row["password"];

    $reviewsQuery = "SELECT tbreviews.review, tbusers.username 
                FROM tbreviews 
                INNER JOIN tbusers ON tbreviews.user_id = tbusers.user_id 
                WHERE tbreviews.article_id = '$article_id'";
    $reviewsResult = mysqli_query($mysqli, $reviewsQuery);
    $reviews = mysqli_fetch_all($reviewsResult, MYSQLI_ASSOC);


} else {
    echo "Article ID or User ID is not set.";
}

$submit = isset($_POST['return']);
if ($submit) {
    session_start();

    $_SESSION["email"] = $_POST['email'];
    $_SESSION["pass"] = $_POST['pass'];
    header("Location: articles.php");
    exit; 
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
    <div class='container'>
        <div class='sideSection'>

            <form id="redirectForm" action="article-details.php" method="POST">
                <input type="hidden" class="form-control" name="email" value="<?php echo $email; ?>" />
                <input type="hidden" class="form-control" name="pass" value="<?php echo $pass; ?>" />
                <input type="submit" class="btn btn-primary" value="Return" name="return">
            </form>
            <?php
            $totalReviewsQuery = "SELECT COUNT(*) AS total_reviews FROM tbratings WHERE article_id = '$article_id'";
            $totalReviewsResult = mysqli_query($mysqli, $totalReviewsQuery);
            $totalReviewsRow = mysqli_fetch_assoc($totalReviewsResult);
            $totalReviews = $totalReviewsRow['total_reviews'];

            $positiveReviewsQuery = "SELECT COUNT(*) AS positive_reviews FROM tbratings WHERE article_id = '$article_id' AND rating = 1";
            $positiveReviewsResult = mysqli_query($mysqli, $positiveReviewsQuery);
            $positiveReviewsRow = mysqli_fetch_assoc($positiveReviewsResult);
            $positiveReviews = $positiveReviewsRow['positive_reviews'];

            echo "<hr/><p>$positiveReviews out of $totalReviews people liked this article</p><hr/>";
            ?>

            <div class="articleGallery">
                <?php
                $articleQuery = "SELECT * FROM tbarticles WHERE article_id = '$article_id'";
                $articleResult = mysqli_query($mysqli, $articleQuery);

                if ($articleResult) {
                    $article = mysqli_fetch_assoc($articleResult);

                    if ($article) {
                        echo '<div >
                                    <div class="card-body">
                                        <h5 class="card-title">' . $article['title'] . '</h5>
                                        <p class="card-text article-desc">' . $article['description'] . '</p>
                                        <div class="alert alert-info mt-3" id="likeStatusAlert1" style="display: none;"></div>
                                        <p class="card-text article-text">' . $article['article_text'] . '</p>
                                        <p class="card-text"><small class="text-muted">' . $article['author'] . ' - ' . $article['date'] . '</small></p><hr/>
                                        <p>Did you enjoy this article?</p>
                                        <div class="form-check" data-correct="true">
                                            <input class="form-check-input" type="radio" name="articleLike1" id="articleLiked1">
                                            <label class="form-check-label" for="articleLiked1">
                                                Yes
                                            </label>
                                        </div>  
                                        <div class="form-check" data-correct="false">
                                            <input class="form-check-input" type="radio" name="articleLike1" id="articleLiked2">
                                            <label class="form-check-label" for="articleLiked2">
                                                No
                                            </label>
                                        </div>
                                    </div>
                                    <hr/>
                                    <h5>Write a review</h5>
                                    <textarea class="form-control" rows="5" id="reviewText"></textarea>
                                    <br/>
                                    <button id="submitButton" class="btn btn-primary">Submit Review</button>
                                </div>';
                    } else {
                        echo "Article not found.";
                    }
                } else {
                    echo "Error fetching article.";
                }
                ?>
            </div>
                <hr/>
            <h2>Reviews</h2>
            <div id="carousel" class="carousel slide" data-bs-ride="carousel">
                <div class="carousel-inner">
                    <?php
                    // Split the reviews into chunks of 3 items
                    $reviewsChunks = array_chunk($reviews, 3);

                    // Iterate through chunks and create carousel items
                    foreach ($reviewsChunks as $index => $chunk) {
                        echo '<div class="carousel-item ' . ($index === 0 ? 'active' : '') . '">
                    <div class="row">';

                        // Display up to 3 items in each carousel item
                        foreach ($chunk as $review) {
                            echo '<div class="col-md-4 mb-3">
                        <div class="card mx-2">
                            <div class="card-body">
                                <h5 class="card-title"><small>' . htmlspecialchars($review['username']) . ' says:</small></h5>
                                <p class="card-text">' . htmlspecialchars($review['review']) . '</p>
                            </div>
                        </div>
                    </div>';
                        }

                        echo '</div></div>';
                    }
                    ?>
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#carousel" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#carousel" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>

        </div>
    </div>
    </div>

    <script>
        var radioButtons = document.querySelectorAll('input[name="articleLike1"]');

        radioButtons.forEach(function (radioButton) {
            radioButton.addEventListener('change', function () {
                var selectedValue = document.querySelector('input[name="articleLike1"]:checked').value;
                var isCorrect = document.querySelector('input[name="articleLike1"]:checked').parentElement.getAttribute('data-correct');
                var user_id = <?php echo $user_id; ?>; 
                var article_id = <?php echo $article_id; ?>; 

                var xhr = new XMLHttpRequest();
                xhr.open("POST", "add-rating.php", true);
                xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
                xhr.onreadystatechange = function () {
                    if (xhr.readyState == 4 && xhr.status == 200) {
                        console.log(xhr.responseText);
                    }
                };
                xhr.send("feedback=" + selectedValue + "&isCorrect=" + isCorrect + "&user_id=" + user_id + "&article_id=" + article_id);
            });
        });

        var reviewTextarea = document.getElementById("reviewText");
        var submitButton = document.getElementById("submitButton");

        submitButton.addEventListener('click', function () {
            var reviewText = reviewTextarea.value;
            var user_id = <?php echo $user_id; ?>; 
            var article_id = <?php echo $article_id; ?>; 

            var xhr = new XMLHttpRequest();
            xhr.open("POST", "add-review.php", true);
            xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
            xhr.onreadystatechange = function () {
                if (xhr.readyState == 4 && xhr.status == 200) {
                    console.log(xhr.responseText);
                }
            };
            xhr.send("reviewText=" + reviewText + "&user_id=" + user_id + "&article_id=" + article_id);
        });

    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>