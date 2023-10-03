<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $mysqli = mysqli_connect("localhost:3306", "u21513768", "yobsxklz", "u21513768");

    // Validate and sanitize input data
    $article_id = mysqli_real_escape_string($mysqli, $_POST['articleId']);
    $user_id = mysqli_real_escape_string($mysqli, $_POST['userId']);
    
    // Check if the user selected an existing list from the dropdown
    if(isset($_POST['existingList']) && !empty($_POST['existingList']) && (!isset($_POST['newListName']) || empty($_POST['newListName']))) {
        // User picked an existing list
        $list_id = mysqli_real_escape_string($mysqli, $_POST['existingList']);
        echo $list_id;
    } else {
        // User entered a new list name into the text box
        $name = mysqli_real_escape_string($mysqli, $_POST['newListName']);
        echo $name;

        // Check if the list entry with the given name and user_id exists
        $checkQuery = "SELECT * FROM tblist WHERE user_id = '$user_id' AND name = '$name'";
        $checkResult = mysqli_query($mysqli, $checkQuery);

        if ($checkResult && mysqli_num_rows($checkResult) > 0) {
            // If the list entry exists, get the list_id
            $row = mysqli_fetch_assoc($checkResult);
            $list_id = $row['list_id'];
        } else {
            // If the list entry does not exist, create a new entry and get the list_id
            $insertQuery = "INSERT INTO tblist (user_id, name) VALUES ('$user_id', '$name')";
            mysqli_query($mysqli, $insertQuery);

            // Get the newly created list_id
            $list_id = mysqli_insert_id($mysqli);
        }
    }

    // Check if the article_id already exists in the list
    $checkArticleQuery = "SELECT * FROM tblisttable WHERE article_id = '$article_id' AND list_id = '$list_id'";
    $checkArticleResult = mysqli_query($mysqli, $checkArticleQuery);

    if ($checkArticleResult && mysqli_num_rows($checkArticleResult) > 0) {
        // If the article_id exists in the list, return an error message
        echo "Article already exists in the list!";
    } else {
        // If the article_id does not exist, add it to tblisttable
        $insertArticleQuery = "INSERT INTO tblisttable (article_id, list_id) VALUES ('$article_id', '$list_id')";
        if(mysqli_query($mysqli, $insertArticleQuery)) {
            // Return a success message
            echo "Article added to the list successfully!";
        } else {
            // Handle the insert error
            echo "Error: " . mysqli_error($mysqli);
        }
    }

    // Close the database connection
    mysqli_close($mysqli);
} else {
    // Handle non-POST requests (if necessary)
    echo "Invalid request method!";
}
?>