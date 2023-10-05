<?php

$mysqli = mysqli_connect("localhost:3306", "u21513768", "yobsxklz", "u21513768");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $newEmail = $_POST['editEmail'];
    $newUsername = $_POST['editUsername'];
    $user_id = $_POST['userId'];

    $updateQuery = "UPDATE tbusers SET email='$newEmail', username='$newUsername' WHERE user_id='$user_id'";

    if (mysqli_query($mysqli, $updateQuery)) {
        echo "User info updated successfully";
    } else {
        echo "Error updating user info: " . mysqli_error($mysqli);
    }

    mysqli_close($mysqli);
}
?>
