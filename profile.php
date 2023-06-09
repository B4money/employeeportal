<?php
    error_reporting(E_ALL ^ E_NOTICE);
    require_once('Connect.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<title>Profile Page</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
	
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
	<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
</head>
<body>
	<?php include 'master.php'; ?>

	<div class="container text-center">
        <?php 
            if(isset($_SESSION['username'])) {
                echo "<h1>Welcome to Your Profile, ".$_SESSION['username']."</h1>";
                echo "<br>";
                echo "<h2>Your profile information is:</h2>";
                echo "<div class='row'>";
                    echo "<div class='col-md-6 text-left'>";
                        echo "<h3>Email: ".$_SESSION['email']."</h3>";
                        echo "<h3>Password: ".$_SESSION['password']."</h3>";
                        echo "<h3>First Name: ".$_SESSION['firstName']."</h3>";
                        echo "<h3>Last Name: ".$_SESSION['lastName']."</h3>";
                    echo "</div>";
                    echo "<div class='col-md-6 text-left'>";
                        echo "<h3>Address: ".$_SESSION['address']."</h3>";
                        echo "<h3>Phone Number: ".$_SESSION['phone']."</h3>";
                        echo "<h3>Salary: ".$_SESSION['salary']."</h3>";
                        echo "<h3>SSN: ".$_SESSION['SSN']."</h3>";
                    echo "</div>";
                echo "</div>";
			}
		?>

	<?php include 'footer.php'; ?>
</body>
</html>

