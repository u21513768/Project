<?php
if (isset($_POST['reviewText']) && isset($_POST['user_id']) && isset($_POST['article_id'])) {
    $reviewText = $_POST['reviewText'];
    $user_id = $_POST['user_id'];
    $article_id = $_POST['article_id'];

    $mysqli = mysqli_connect("localhost:3306", "u21513768", "yobsxklz", "u21513768");

    if ($mysqli->connect_error) {
        die("Connection failed: " . $mysqli->connect_error);
    }

    $existingReviewQuery = "SELECT * FROM tbreviews WHERE user_id = '$user_id' AND article_id = '$article_id'";
    $existingReviewResult = $mysqli->query($existingReviewQuery);

    if ($existingReviewResult->num_rows > 0) {
        $updateReviewQuery = "UPDATE tbreviews SET review = '$reviewText' WHERE user_id = '$user_id' AND article_id = '$article_id'";
        if ($mysqli->query($updateReviewQuery) === TRUE) {
            echo "Review updated successfully";
        } else {
            echo "Error updating review: " . $mysqli->error;
        }
    } else {
        $insertReviewQuery = "INSERT INTO tbreviews (user_id, article_id, review) VALUES ('$user_id', '$article_id', '$reviewText')";
        if ($mysqli->query($insertReviewQuery) === TRUE) {
            echo "Review inserted successfully";
        } else {
            echo "Error inserting review: " . $mysqli->error;
        }
    }

    $mysqli->close();

} else {
    echo "One or more values are not received.";
}
?>
