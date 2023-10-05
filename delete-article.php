<?php
$mysqli = mysqli_connect("localhost:3306", "u21513768", "yobsxklz", "u21513768");

if (isset($_POST['article_id'])) {
    $articleId = $_POST['article_id'];
    $deleteQuery = "DELETE FROM tbarticles WHERE article_id = '$articleId'";
    $result = mysqli_query($mysqli, $deleteQuery);

    if ($result) {
        echo "Article deleted successfully";
    } else {
        echo "Error deleting article: " . mysqli_error($mysqli);
    }
} else {
    echo "Invalid request";
}
?>
