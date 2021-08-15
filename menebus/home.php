<!DOCTYPE html>
<html>

<head>
	<title>Home</title>
</head>

<body>

	<div class="header">
		<?php include 'header2.php'; ?>
	</div>

	<div class="bg">
		<br>
		<br>
		<br>
		<P class="home"><b>Welcome to Seller</b></P>
		<br>
		<P class="home2"><b>Sell your best Gift</b></P>
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
		}

		.header {
			font-family: candara;
		}

		.bg {
			background-image: url('images/home.jpg');
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

		h1 {
			text-align: center;
		}

		.home {
			text-align: center;
			font-size: 50px;
		}

		.home2 {
			text-align: center;
			font-size: 80px;
			color: #fff;
		}
	</style>


</body>

</html>