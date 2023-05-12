<!-- Add this HTML element to display the message -->
<div id="message"></div>
<?php 
	error_reporting(E_ALL ^ E_NOTICE);
	require_once('Connect.php');
	$message = "";
	if ($_SERVER['REQUEST_METHOD'] === 'POST') {
	// Retrieve form data using POST method
		$email = test_input($_POST["email"]);
		$password = test_input($_POST["password"]);
		$firstName = test_input($_POST["firstName"]);
		$lastName = test_input($_POST["lastName"]);
		$address = test_input($_POST["address"]);
		$phone = test_input($_POST["phone"]);
		$salary = test_input($_POST["salary"]);
		$SSN = test_input($_POST["SSN"]);
		
		// Validate form data
		if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
			$message = "Invalid email format.";
		} elseif (strlen($password) < 6) {
			$message = "Password must be at least 6 characters long.";
		} elseif (!preg_match('/^[a-zA-Z]+$/', $firstName)) {
			$message = "First name can only contain alphabets.";
		} elseif (!preg_match('/^[a-zA-Z]+$/', $lastName)) {
			$message = "Last name can only contain alphabets.";
		} elseif (!preg_match('/^[0-9]+$/', $phone)) {
			$message = "Phone number can only contain digits.";
		} elseif (!preg_match('/^[0-9]+$/', $salary)) {
			$message = "Salary can only contain digits.";
		} elseif (!preg_match('/^[0-9]+$/', $SSN)) {
			$message = "SSN can only contain digits.";
		} else {

			// Insert data into database
			$checkUserQuery = "SELECT * FROM tbluser WHERE email= '$email'";
			$checkUserExists = mysqli_query($newConnection->connection,$checkUserQuery);
			if(mysqli_num_rows($checkUserExists) == 0) {
				$submitDataQuery = "INSERT INTO `tblUser` (email, password, firstName, lastName, address, phone, salary, SSN) 
				VALUES ('$email', '$password', '$firstName', '$lastName', '$address', '$phone', '$salary', '$SSN')";
				$newConnection->executeQuery($newConnection->connection,$submitDataQuery);
				
				// Set the message content
				$message = "Successfully Registered! You will be redirected to Login Screen.......";
				// Redirect after 3 seconds
				header("refresh:3;url=login.php");
			}else{
				$message = "User already exists with the given email";
			}
		}
	}
	
	function test_input($data) {
		$data = trim($data);
		$data = stripslashes($data);
		$data = htmlspecialchars($data);
		return $data;
		
	}
?>




<!DOCTYPE html>
<html lang="en">
<head>
	<title> Registration Page </title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
</head>
<body>

	<?php include 'master.php';?>

	<div class="container text-center">
		<h1>Welcome to the Registration page</h1>
		<a href="index.php">Click here to go back</a>
		<h2>User Registration Form</h2>
		<form action="registration.php" method="POST">
			<label for="email">Email:</label>
			<input type="email" name="email" id="email" placeholder="Enter your email" required>
			<br>
			<label for="password">Password:</label>
			<input type="password" name="password" id="password" placeholder="Enter your password" required>
			<br>
			<label for="firstName">First Name:</label>
			<input type="text" name="firstName" id="firstName" placeholder="Enter your first name" required>
			<br>
			<label for="lastName">Last Name:</label>
			<input type="text" name="lastName" id="lastName" placeholder="Enter your last name" required>
			<br>
			<label for="address">Address:</label>
			<input type="text" name="address" id="address" placeholder="Enter your address" required>
			<br>
			<label for="phone">Phone:</label>
			<input type="text" name="phone" id="phone" placeholder="Enter your phone number" required>
			<br>
			<label for="salary">Salary:</label>
			<input type="text" name="salary" id="salary" placeholder="Enter your salary" required>
			<br>
			<label for="SSN">SSN:</label>
			<input type="text" name="SSN" id="SSN" placeholder="Enter your SSN" required>
			<br>
			<br>
			<span class="message"><?php echo $message; ?></span>
			<br>
			<input type="submit" class="btn btn-primary" value="Register"/>
		</form>
	</div>
	
	<?php include 'footer.php';?>
</body>
</html>