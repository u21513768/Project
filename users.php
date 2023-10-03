<?php
/*Quintin d'Hotman de Villiers u21513768*/
// See all errors and warnings
error_reporting(E_ALL);
ini_set('error_reporting', E_ALL);

$mysqli = mysqli_connect("localhost:3306", "u21513768", "yobsxklz", "u21513768");

if (isset($_GET['user_id'])) {
    $user_id = $_GET['user_id'];

    $query = "SELECT * FROM tbusers WHERE user_id = '$user_id'";

    $res = mysqli_query($mysqli, $query);

    $row = mysqli_fetch_array($res);

    if ($row == null) {
        header("Location: index.php");
        exit;
    }

    $email = $row["email"];
    $pass = $row["password"];

    $query = "SELECT * FROM tbusers WHERE user_id != '$user_id'";
    $res = mysqli_query($mysqli, $query);


} else {
    // Handle the case where article_id or user_id is not set in the URL
    echo "User ID is not set.";
}

$submit = isset($_POST['return']);
if ($submit) {
    session_start();

    $_SESSION["email"] = $_POST['email'];
    $_SESSION["pass"] = $_POST['pass'];
    header("Location: articles.php");
    exit; // Make sure to exit after redirecting
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>IMY 220 - Assignment 2</title>
    <meta charset="utf-8" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css"
        integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous">
    <!--<link rel="stylesheet" type="text/css" href="style.css" />-->
    <link rel="stylesheet" href="articles.css">
    <link rel="stylesheet" href="https://cdn.lineicons.com/4.0/lineicons.css" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway:700,900|Open+Sans">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <meta charset="utf-8" />
    <meta name="author" content="Name Surname">
    <!-- Quintin d'Hotman de Villiers u21513768 -->

</head>

<body>
    <div class='container'>
        <div class='sideSection'>

            <form id="redirectForm" action="article-details.php" method="POST">
                <input type="hidden" class="form-control" name="email" value="<?php echo $email; ?>" />
                <input type="hidden" class="form-control" name="pass" value="<?php echo $pass; ?>" />
                <input type="submit" class="btn btn-primary" value="Return" name="return">
            </form>

            <div>
                <?php
                if ($res) {
                    while ($row = mysqli_fetch_array($res)) {
                        $username = $row["username"];
                        $friend_id = $row["user_id"];
                        // Create a link with user_id as a query parameter
                        echo "<a href='friend.php?user_id=$user_id&&friend_id=$friend_id'>$username</a><br>";
                    }
                } else {
                    echo "Error: " . mysqli_error($mysqli);
                }
                ?>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>