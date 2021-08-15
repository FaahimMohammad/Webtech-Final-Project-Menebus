<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<title></title>
</head>

<body>
	<div class="menu">
		<div class="nav">
			<ul>
				<li><a href="addgift.php">Add Gift</a></li>
				<li><a href="updatedeletegift.php">Update/Delete Gift</a></li>
				<li><a href="giftCardListself.php">My Gift List</a></li>
			</ul>
		</div>
	</div>
	<style>
		.nav {
			text-align: center;
			position: relative;
			width: 70%;
			margin: auto;
		}

		.menu {
			background-color: #34495e;
		}

		.menue ul {
			margin-left: auto;
			margin-right: auto;
		}

		.menu ul li {

			list-style: none;
			display: inline-block;
			position: relative;
		}

		.menu ul li a {
			text-align: center;
			text-decoration: none;
			color: #FFF;
			padding: 20px 28px;
			display: block;
			border-bottom: 3px solid red;
		}

		.menu ul li a:hover {
			background-color: #2c3e50;
			border-bottom: 3px solid red;
		}

		.menu ul li ul li {
			display: block;
			background-color: #34495e;
			margin-top: 3px;
			transition: .4s;
		}

		.menu ul li ul {
			position: absolute;
			top: 100%;
			left: 0px;
			width: 200px;
			display: none;
		}

		.menu ul li:hover ul {
			display: block;
		}

		.menu ul li ul li:hover {
			transform: scale(1.5);
			z-index: 999;
		}

		.logo {
			margin-left: 50px;
			float: left;
		}

		.logo img {
			height: 4rem;
			width: 4rem;

		}
	</style>
</body>

</html>