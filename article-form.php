<?php
/*Quintin d'Hotman de Villiers u21513768*/
// See all errors and warnings
error_reporting(E_ALL);
ini_set('error_reporting', E_ALL);

$mysqli = mysqli_connect("localhost:3306", "u21513768", "yobsxklz", "u21513768");

session_start();
$email = isset($_POST["email"]) ? $_POST["email"] : $_SESSION["email"];
$pass = isset($_POST["pass"]) ? $_POST["pass"] : $_SESSION["pass"];
//echo "email: " . $email . "\npassword: " . $pass;
if ($email == null || $email == "" || $pass == null || $pass == "") {
	header("Location: index.php");
	exit;
}

$query = "SELECT * FROM tbusers WHERE email = '$email' AND password = '$pass'";

$res = mysqli_query($mysqli, $query);

$row = mysqli_fetch_array($res);

if ($row == null) {
	header("Location: index.php");
}

$userid = $row["user_id"];
$title = isset($_POST["articleName"]) ? $_POST["articleName"] : null;
$name = $row["name"];
$surname = $row["surname"];
$author = $name . " " . $surname; //isset($_POST["articleAuthor"]) ? $_POST["articleAuthor"] : null;
$description = isset($_POST["articleDescription"]) ? $_POST["articleDescription"] : null;
$date = date('Y-m-d H:i:s');
; //isset($_POST["articleDate"]) ? $_POST["articleDate"] : null;
$tags = isset($_POST["articleTags"]) ? $_POST["articleTags"] : null;

if ($description !== null && $tags !== null) {
	$description .= "\nHashtags: " . $tags;
}
$secondQuery = "INSERT INTO tbarticles (user_id, title, description, author, date) VALUES ('$userid', '$title', '$description', '$author', '$date');";
$submitbutton = isset($_POST['submit']);

if ($submitbutton) {
	if (isset($_FILES['picToUpload'])) {
		if ($_FILES['picToUpload']['error'] === 0 || $_FILES['picToUpload']['error'] != 0) { //should eventually be ===
			// compute the total size of the uploaded files
			$totalFileSize = $_FILES['picToUpload']['size'];
			$maxFileSize = 10 * 1024 * 1024;
			// check if the upload size is less than the max allowed
			if ($totalFileSize > $maxFileSize) {
				/*echo '<div class="alert alert-danger mt-3" role="alert">
							Your files exceed the limit of 2MB capacity
							</div>';*/
			} else {
				if (!empty($title) && !empty($description) && !empty($author) && !empty($date) && !empty($userid) || !($_FILES['picToUpload']['error'] == 4 || ($_FILES['picToUpload']['size'] == 0 && $_FILES['picToUpload']['error'] == 0))) {
					$secondRes = mysqli_query($mysqli, $secondQuery);
					if ($secondRes) {
						$articleid = mysqli_insert_id($mysqli);
						$fileName = $_FILES['picToUpload']['name'];
						$thirdQuery = "INSERT INTO tbgallery (article_id, image_name) VALUES ('$articleid', '$fileName');";
						/*echo '<div class="alert alert-primary mt-3" role="alert">
										  </div>';*/

						$thirdRes = mysqli_query($mysqli, $thirdQuery);
						$uploadedFile = $_FILES['picToUpload']['tmp_name'];
						$galleryFolder = './gallery';
						if (!is_dir($galleryFolder)) {
							mkdir($galleryFolder);
						}

						$destination = $galleryFolder . '/' . $fileName;
						if (move_uploaded_file($uploadedFile, $destination)) {
							/*echo "File has been moved to the gallery folder.";*/
						} else {
							/*echo '<div class="alert alert-danger mt-3" role="alert">
												 Error moving the file.
												 </div>';*/
						}

						$_SESSION["email"] = $email;
						$_SESSION["pass"] = $pass;
						header("Location: article-form.php");
						exit; // Make sure to exit after redirecting

					} else {
						echo "Query failed: " . mysqli_error($mysqli);
					}
				} else {
					/*echo '<div class="alert alert-danger mt-3" role="alert">
								   Empty or blank */
				}
			}
		}
	} else {
		/*echo '<div class="alert alert-danger mt-3" role="alert">
			  The article co*/
	}
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
	<link rel="stylesheet" href="article-form.css">
	<link rel="stylesheet" href="https://cdn.lineicons.com/4.0/lineicons.css" />
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway:700,900|Open+Sans|Titillium+Web">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
	<meta charset="utf-8" />
	<meta name="author" content="Name Surname">
	<!-- Quintin d'Hotman de Villiers u21513768 -->

</head>

<body>
	<div class='container'>
		<div class='sideSection'>

			<?php
			$query = "SELECT * FROM tbusers WHERE email = '$email' AND password = '$pass' ";
			$res = $mysqli->query($query);
			if ($row = mysqli_fetch_array($res)) {
				$username = $row["username"];
				$userid = $row["user_id"];
				echo "<div class='header-info'>
					<nav class='navbar fixed-top navbar-expand-lg navbar-dark px-3'>
						<a class='navbar-brand' id='modal-click' href='profile.php?user_id=" . $userid . "'><i class='lni lni-user'></i></a>
						<a class='navbar-brand h1 active' href='profile.php?user_id=" . $userid . "'>" . $username . "</a>
						<div class='collapse navbar-collapse' id='navbarNavAltMarkup'>
							<div class='navbar-nav px-2'>
								<a class='nav-item nav-link' href='index.php'>Log Out</a>
							</div>
						</div>
					</nav>
				</div>";

				echo "<div class='article-info'>
						<form action='article-form.php' method='POST' enctype='multipart/form-data'>
							<div class='form-group'>
								
								<input type='hidden' class='form-control' name='email' value='" . $email . "' />
								<input type='hidden' class='form-control' name='pass' value='" . $pass . "' />
								<label for='articleName'>Article Name:</label><br>
								<input type='text' class='form-control' name='articleName' /><br>							
								<label for='articleDescription'>Article Description:</label><br>
								<textarea class='form-control' id='description' name='articleDescription' rows='10'></textarea><br/>
								<label for='articleTags'>Hashtags:</label><br>
								<input type='text' class='form-control' name='articleTags' /><br>
								<label for='picToUpload'>Choose image for the article:</label>
								<input type='file' class='form-control' name='picToUpload' id='picToUpload' accept='image/*'  /><br/>	<!--multiple='multiple'-->							
								<input type='submit' class='btn btn-primary' value='Upload article' name='submit' />
							</div>
							<br/>
						</form>
						<form action='go-to-articles.php' method='POST'>
							<input type='hidden' class='form-control' name='email' value='" . $email . "' />
							<input type='hidden' class='form-control' name='pass' value='" . $pass . "' />
							<input type='submit' class='btn btn-primary' value='Return' name='return'>
						</form>
					</div>";
			}
			?>
			

		</div>

		<div class="row articleGalleryContainer">
			<h1>Latest Articles</h1>
			<hr />
			<div class="articleGallery">
				<?php
				$query2 = "SELECT * FROM tbarticles WHERE user_id = '$userid' ORDER BY date DESC"; //WHERE user_id = '$userid'";
				$res2 = $mysqli->query($query2);

				if ($res2 && mysqli_num_rows($res2) > 0) {
					while ($row2 = mysqli_fetch_array($res2)) {
						$article_id = $row2['article_id'];
						$image_query = "SELECT * FROM tbgallery WHERE article_id = '$article_id'";
						$image_res = mysqli_query($mysqli, $image_query);
						$image_row = mysqli_fetch_array($image_res);
						$image_src = isset($image_row['image_name']) ? $image_row['image_name'] : 'default.jpg';
						//$image_src = $image_src == ("" || null) ? "default.jpg" : $image_src;
				
						echo '
					<div class="col-md-12 mb-12">
						<div class="card">
						<div id="logo"  class="card-img-top"><img src="./gallery/' . ($image_src ?? 'default.jpg') . '"  class="card-img-top" alt="Article Image"></div>
							<div class="card-body">
								<h5 class="card-title">' . $row2['title'] . '</h5>
								<p class="card-text">' . $row2['description'] . '</p>
								<p class="card-text"><small class="text-muted">' . $row2['author'] . ' - ' . $row2['date'] . '</small></p>
							</div>
						</div>
					</div><hr/>';
					}
				} else {
					// If no rows are returned, display a custom message
					echo '<div class="col-md-12 mb-12"><p>No articles found.</p></div>';
				}
				?>
			</div>
		</div>

		<?php
		if (isset($alertMessage)) {
			// Output JavaScript to display an alert
			echo "<script>showAlert('$alertMessage');</script>";
		}
		?>



</body>

</html>