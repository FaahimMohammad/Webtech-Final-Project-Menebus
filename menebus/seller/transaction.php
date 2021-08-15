<?php
session_start();

if ($_SESSION['userNameV'] == '') {
  header("location:../login.php");
}
?>


<!DOCTYPE html>
<html>

<head>
	<meta charset="UTF-8" />
	<title>Customer Order Information</title>
	<link rel="stylesheet" type="text/css" href="../style.css" />
</head>

<body>
	<div class="header">
		<?php include 'header.php'; ?>
	</div>

	<div class="bg">
		<br />
		<h1>Customer Transaction Information</h1>

		<?php

		$sid = $_SESSION['userNameV'];


		$host = "localhost";
		$user = "project";
		$pass = "1234";
		$db = "menebus";

		$conn1 = new mysqli($host, $user, $pass, $db);

		if ($conn1->connect_error) {
			echo "Database Connection Failed!";
			echo "<br />";
			echo $conn1->connect_error;
		} else {
			echo '
      <table id="table">
        <tr>
          <th>Id</th>
          <th>Seller Username</th>

          <th>Buyer Username</th>

          <th>Amount</th>
        </tr>
        ';
			$stmt1 = "SELECT * FROM `transaction` where seller_Username='$sid'";
			$result = $conn1->query($stmt1);

			if ($result->num_rows > 0) {
				while ($row = $result->fetch_assoc()) {

					echo "<tr>";
					
					echo "<td>" . $row['id'] . "</td>";

					echo "<td>" . $row['seller_Username'] . "</td>";


					echo "<td>" . $row['buyer_Username'] . "</td>";

					echo "<td>" . $row['amount'] . "</td>";

					echo "</tr>";
				}
			}
			echo "
      </table>
      ";
		} ?>
	</div>

	<div class="footer">
		<?php include 'footer.php'; ?>
	</div>

	<style>
		.bg {
			background-image: url("../images/bg.jpg");
			min-height: 100%;
			background-position: center;
			background-repeat: no-repeat;
			background-size: cover;
		}
	</style>
</body>

</html>