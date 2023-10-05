<?php
header("Content-type: application/json");

if (isset($_POST['messageContent']) && isset($_POST['recipient_id'])) {
    $messageContent = $_POST['messageContent'];
    $recipient_id = $_POST['recipient_id'];

    $response = array("success" => true, "message" => "Message sent successfully!");
} else {
    $response = array("success" => false, "error" => "Invalid parameters");
}

echo json_encode($response);
?>
