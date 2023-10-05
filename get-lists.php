<?php
$mysqli = mysqli_connect("localhost:3306", "u21513768", "yobsxklz", "u21513768");

if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}

$query = "SELECT list_id, name FROM tblist";
$result = $mysqli->query($query);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "<option value='" . $row["list_id"] . "'>" . $row["name"] . "</option>";
    }
} else {
    echo "<option value=''>No existing lists found</option>";
}

$mysqli->close();
?>
