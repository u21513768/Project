<?php
// follow.php

header("Content-type: application/json");

if (isset($_POST['user_id']) && isset($_POST['friend_id'])) {
    $user_id = $_POST['user_id'];
    $friend_id = $_POST['friend_id'];

    $mysqli = mysqli_connect("localhost:3306", "u21513768", "yobsxklz", "u21513768");

    // Check if the friendship already exists
    $checkQuery = "SELECT * FROM tbfriends WHERE user_id = '$user_id' AND follow_id = '$friend_id'";
    $checkResult = mysqli_query($mysqli, $checkQuery);

    if (mysqli_num_rows($checkResult) > 0) {
        // Friendship exists, delete the row from tbfriends table
        $deleteQuery = "DELETE FROM tbfriends WHERE user_id = '$user_id' AND follow_id = '$friend_id'";
        $deleteResult = mysqli_query($mysqli, $deleteQuery);

        if ($deleteResult) {
            $response = array("success" => true, "message" => "Friendship removed successfully!");
        } else {
            $response = array("success" => false, "message" => "Failed to remove friendship.");
        }
    } else {
        // Friendship does not exist, insert into the tbfriends table
        $insertQuery = "INSERT INTO tbfriends (user_id, follow_id) VALUES ('$user_id', '$friend_id')";
        $insertResult = mysqli_query($mysqli, $insertQuery);

        if ($insertResult) {
            $response = array("success" => true, "message" => "Friendship added successfully!");
        } else {
            $response = array("success" => false, "message" => "Failed to add friendship.");
        }
    }
} else {
    $response = array("success" => false, "message" => "Invalid parameters.");
}

// Send JSON response
echo json_encode($response);
?>
