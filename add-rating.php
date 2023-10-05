<?php
if (isset($_POST['feedback']) && isset($_POST['isCorrect']) && isset($_POST['user_id']) && isset($_POST['article_id'])) {

    $feedback = $_POST['feedback'];
    $isCorrect = ($_POST['isCorrect'] === 'true') ? 1 : 0; // Convert to 1 for true, 0 for false
    $user_id = $_POST['user_id'];
    $article_id = $_POST['article_id'];

    $mysqli = mysqli_connect("localhost:3306", "u21513768", "yobsxklz", "u21513768");

    if ($mysqli->connect_error) {
        die("Connection failed: " . $mysqli->connect_error);
    }

    $checkQuery = "SELECT * FROM tbratings WHERE user_id = '$user_id' AND article_id = '$article_id'";
    $result = $mysqli->query($checkQuery);

    if ($result->num_rows > 0) {
        $updateQuery = "UPDATE tbratings SET rating = '$isCorrect' WHERE user_id = '$user_id' AND article_id = '$article_id'";
        if ($mysqli->query($updateQuery) === TRUE) {
            echo "Review updated successfully";
        } else {
            echo "Error updating review: " . $mysqli->error;
        }
    } else {
        $insertQuery = "INSERT INTO tbratings (rating, user_id, article_id) VALUES ('$isCorrect', '$user_id', '$article_id')";
        if ($mysqli->query($insertQuery) === TRUE) {
            echo "New review inserted successfully";
        } else {
            echo "Error inserting new review: " . $mysqli->error;
        }
    }

    $mysqli->close();

} else {
    echo "One or more values are not received.";
}
?>
