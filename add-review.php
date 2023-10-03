<?php
// Check if the necessary values are set in the POST request
if (isset($_POST['reviewText']) && isset($_POST['user_id']) && isset($_POST['article_id'])) {
    // Retrieve reviewText, user_id, and article_id from the POST request
    $reviewText = $_POST['reviewText'];
    $user_id = $_POST['user_id'];
    $article_id = $_POST['article_id'];

    // Connect to the database
    $mysqli = mysqli_connect("localhost:3306", "u21513768", "yobsxklz", "u21513768");

    // Check the database connection
    if ($mysqli->connect_error) {
        die("Connection failed: " . $mysqli->connect_error);
    }

    // Check if a review already exists for the user and article
    $existingReviewQuery = "SELECT * FROM tbreviews WHERE user_id = '$user_id' AND article_id = '$article_id'";
    $existingReviewResult = $mysqli->query($existingReviewQuery);

    if ($existingReviewResult->num_rows > 0) {
        // Update the existing review
        $updateReviewQuery = "UPDATE tbreviews SET review = '$reviewText' WHERE user_id = '$user_id' AND article_id = '$article_id'";
        if ($mysqli->query($updateReviewQuery) === TRUE) {
            echo "Review updated successfully";
        } else {
            echo "Error updating review: " . $mysqli->error;
        }
    } else {
        // Insert a new review
        $insertReviewQuery = "INSERT INTO tbreviews (user_id, article_id, review) VALUES ('$user_id', '$article_id', '$reviewText')";
        if ($mysqli->query($insertReviewQuery) === TRUE) {
            echo "Review inserted successfully";
        } else {
            echo "Error inserting review: " . $mysqli->error;
        }
    }

    // Close the database connection
    $mysqli->close();

} else {
    // Handle the case where one or more values are not received
    echo "One or more values are not received.";
}
?>
