<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $mysqli = mysqli_connect("localhost:3306", "u21513768", "yobsxklz", "u21513768");

    $article_id = mysqli_real_escape_string($mysqli, $_POST['articleId']);
    $user_id = mysqli_real_escape_string($mysqli, $_POST['userId']);
    
    if(isset($_POST['existingList']) && !empty($_POST['existingList']) && (!isset($_POST['newListName']) || empty($_POST['newListName']))) {
       
        $list_id = mysqli_real_escape_string($mysqli, $_POST['existingList']);
        echo $list_id;
    } else {
        $name = mysqli_real_escape_string($mysqli, $_POST['newListName']);
        echo $name;

        $checkQuery = "SELECT * FROM tblist WHERE user_id = '$user_id' AND name = '$name'";
        $checkResult = mysqli_query($mysqli, $checkQuery);

        if ($checkResult && mysqli_num_rows($checkResult) > 0) {
            $row = mysqli_fetch_assoc($checkResult);
            $list_id = $row['list_id'];
        } else {
            $insertQuery = "INSERT INTO tblist (user_id, name) VALUES ('$user_id', '$name')";
            mysqli_query($mysqli, $insertQuery);

            $list_id = mysqli_insert_id($mysqli);
        }
    }

    $checkArticleQuery = "SELECT * FROM tblisttable WHERE article_id = '$article_id' AND list_id = '$list_id'";
    $checkArticleResult = mysqli_query($mysqli, $checkArticleQuery);

    if ($checkArticleResult && mysqli_num_rows($checkArticleResult) > 0) {
        echo "Article already exists in the list!";
    } else {
        $insertArticleQuery = "INSERT INTO tblisttable (article_id, list_id) VALUES ('$article_id', '$list_id')";
        if(mysqli_query($mysqli, $insertArticleQuery)) {
            echo "Article added to the list successfully!";
        } else {
            echo "Error: " . mysqli_error($mysqli);
        }
    }

    mysqli_close($mysqli);
} else {
    echo "Invalid request method!";
}
?>