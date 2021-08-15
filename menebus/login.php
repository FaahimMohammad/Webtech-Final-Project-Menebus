<?php
session_start();


?>

<!DOCTYPE html>
<html>

<head>
	<title>Login</title>
	<link rel="stylesheet" href="css/font-awesome.min.css">
</head>

<body>

	<div class="header">
		<?php include 'header2.php'; ?>
	</div>

	<div class="bg">

		<br>

		<?php
		$userNameErr = $passwordErr = "";

		$userName = "";
		$password = "";
		$msg = "";
		$flag = 0;

		if ($_SERVER["REQUEST_METHOD"] == "POST") {

			if (empty($_POST['uname'])) {
				$userNameErr = "Please fill up the username properly";
			} else {
				$userName = $_POST['uname'];
			}

			if (empty($_POST['password'])) {
				$passwordErr = "Please fill up the password properly";
			} else {
				$password = $_POST['password'];
			}

			$host = "localhost";
			$user = "project";
			$pass = "1234";
			$db = "menebus";

			$conn1 = new mysqli($host, $user, $pass, $db);

			if ($conn1->connect_error) {
				echo "Database Connection Failed!";
				echo "<br>";
				echo $conn1->connect_error;
			} else {

				$stmt3 = $conn1->prepare("select userName, password from sellerdata where userName = ? and password = ?");
				$stmt3->bind_param("ss", $p5, $p6);
				$p5 = $userName;
				$p6 = $password;
				$stmt3->execute();
				$res = $stmt3->get_result();
				$num_row3 = mysqli_num_rows($res);


				if ($num_row3 == 1) {
					$_SESSION['userNameV'] = $userName;
					$_SESSION['passwordV'] = $password;
					header("Location: seller/giftCardList.php");
					$flag = 1;
					exit;
				}

			}


			if ($flag == 0) {
				$msg = "Login Denied!!!! Try again...";
				echo $msg;
			}
		}


		?>

		<div class="form">

			<h1 style="font-size: 40px;">Login</h1>

			<!-- <form name="jsForm" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>" onsubmit="return validate()" method="POST"> -->
			<form method="POST" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>">


				<i class="fa fa-user icon"></i>
				<input type="text" name="uname" id="uname" value="<?php echo $userName; ?>" placeholder="Username">
				<br>
				<p style="color:red"><?php echo $userNameErr; ?></p>

				<br>

				<i class="fa fa-unlock-alt icon"></i>
				<input type="password" name="password" id="password" value="<?php echo $password; ?>" placeholder="Password">
				<br>
				<p style="color:red"><?php echo $passwordErr; ?></p>

				<br>

				<input type="submit" value="Login" id="submit">

				<a href="userSignup.php" title="" class="anchor">Not yet registered?</a>

			</form>
			<p id="errorMsg"></p>
		</div>
	</div>

	<div class="footer">
		<?php include 'footer.php'; ?>
	</div>



	<style>
		body,
		html {
			height: 90%;
			margin: 0;
			color: white;
			font-family: candara;
		}

		.bg {
			background-image: url('images/bg.jpg');
			min-height: 100%;
			background-position: center;
			background-repeat: no-repeat;
			background-size: cover;
		}

		.footer {
			color: white;
			height: 7%;
			background-color: #83888A;
		}

		legend {
			text-align: center;
			font-weight: bold;
			font-size: 20px;
		}

		h1 {
			text-align: center;
			color: dodgerblue;
		}


		.form {
			width: 400px;
			margin: 12vh auto;
			padding: 30px;
			box-shadow: 0px 0px 200px black;
			background-color: #cdcfd0;
			color: #34495e;
		}

		i {
			display: block;
			float: left;
		}

		.form label {
			display: block;
			font-weight: bold;
		}

		.form input {
			display: block;
			float: right;
			width: 90%;
			border: 1px solid #000;
			padding: 5px;
			box-sizing: border-box;
			height: 35px;
		}

		.form textarea {
			width: 100%;
			border: 1px solid #000;
			padding: 5px;
			box-sizing: border-box;
			margin-bottom: 10px;
		}

		#submit {
			width: 100%;
			padding: 5px 80px;
			background-color: #34495e;
			color: #FFF;
			text-transform: uppercase;
			font-weight: 900;
			box-shadow: 0px 0px 10px black;
			cursor: pointer;
			margin-bottom: 5px;
		}

		.form a {
			color: blue !important;
		}

		.icon {
			padding: 10px;
			background: dodgerblue;
			color: white;
			text-align: center;
			width: 15px;
			height: 15px;
		}
	</style>

	<script>
		function validate() {
			var isValid = false;
			var username = document.forms["jsForm"]["uname"].value;
			var password = document.forms["jsForm"]["password"].value;

			if (username == "" || password == "") {
				document.getElementById("errorMsg").innerHTML = "<b>Please fill up the form properly.</b>";
				document.getElementById("errorMsg").style.color = "red";

				if (username == "")
					document.getElementById("uname").style.border = "2px solid red";
				else
					document.getElementById("uname").style.border = "1px solid black";

				if (password == "")
					document.getElementById("password").style.border = "2px solid red";
				else
					document.getElementById("password").style.border = "1px solid black";


			} else {
				isValid = true;
			}

			return isValid;
		}
	</script>

</body>

</html>