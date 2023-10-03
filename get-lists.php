<?php
// Establish a database connection (modify these with your actual database credentials)
$mysqli = mysqli_connect("localhost:3306", "u21513768", "yobsxklz", "u21513768");

// Check connection
if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}

// SQL query to fetch existing lists
$query = "SELECT list_id, name FROM tblist";
$result = $mysqli->query($query);

if ($result->num_rows > 0) {
    // Output data of each row
    while ($row = $result->fetch_assoc()) {
        echo "<option value='" . $row["list_id"] . "'>" . $row["name"] . "</option>";
    }
} else {
    echo "<option value=''>No existing lists found</option>";
}

// Close the database connection
$mysqli->close();
?>
