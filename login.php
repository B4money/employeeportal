<?php
    error_reporting(E_ALL ^ E_NOTICE);
    require_once('connect.php');
    unset($_SESSION['username']);
    require 'master.php';
	
	$emailErr = $passwordErr = "";

    if (isset($_POST['login_user'])) {
        $email = test_input($_POST["email"]);
        $password = test_input($_POST["password"]);

        if (empty($email)) {
            $emailErr = "Email is required";
        } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $emailErr = "Invalid email format";
        }

        if (empty($password)) {
            $passwordErr = "Password is required";
        }

        if (empty($emailErr) && empty($passwordErr)) {
            $loginQuery = "SELECT * FROM tbluser WHERE email= '$email' AND password='$password'";
            $results = mysqli_query($newConnection->connection, $loginQuery); 

            if (mysqli_num_rows($results) == 1) { 
                while($row = mysqli_fetch_assoc($results)) {
                    $_SESSION['username'] = $row['firstName'];
                    $_SESSION['email'] = $row['email'];
                    $_SESSION['password'] = $row['password'];
                    $_SESSION['firstName'] = $row['firstName'];
                    $_SESSION['lastName'] = $row['lastName'];
                    $_SESSION['address'] = $row['address'];
                    $_SESSION['phone'] = $row['phone'];
                    $_SESSION['salary'] = $row['salary'];
                    $_SESSION['SSN'] = $row['SSN'];
                }
                header('location: index.php'); 
            } else {
                $passwordErr = "Invalid email or password";
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
    <title> Login Page </title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-sacle=1">
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
    <script src="https://ajax.googleleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
</head>
<body>

    <div class="container text-center">
        <h1>Welcome to the Login Page</h1>
		<a href="index.php">Click here to go back</a><br/><br/>
		<form class="padding-top" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
			<label for="inputEmail">Email:</label>
			<input type="email" id="inputEmail" placeholder="Enter your Email" autocomplete="off" name="email" required>
			<br>
			<label for="password">Password:</label>
			<input type="password" id="inputPassword" placeholder="Enter your Password" autocomplete="off" name="password" required>
			<br>
			<span class="error"><?php echo $emailErr;?></span>
			<br>
			<span class="error"><?php echo $passwordErr;?></span>
			<br>
            <button type="submit" class="btn btn-primary" name="login_user">Submit</button>
            
        </form>
    </div>
<?php require_once 'footer.php';?>
</body>
</html>
