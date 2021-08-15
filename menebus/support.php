<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>Contact Us</title>
    <link rel="stylesheet" type="text/css" href="style.css">
  </head>
  <body>

	<div class="header">
		<?php include 'header2.php';?>
	</div>
		<div class="bg">
			

			<br>
			

			<?php
				$nameErr = $phoneErr= $emailErr= $commentErr="";

				$name = ""; 
				$phone = ""; 
				$email = "";
				$comment="";


				if($_SERVER["REQUEST_METHOD"] == "POST") {
					if(empty($_POST['name'])) {
						$nameErr = "Please fill up the name properly";
					}
					else {
						$name = $_POST['name'];
					}

					if(empty($_POST['phone'])) {
						$phoneErr = "Please fill up the mobile phone properly";
					}
					else {
						$phone = $_POST['phone'];
					}

					 if(empty($_POST['email'])) {
						$emailErr = "Email is required";
					}
					else {
						$email = $_POST['email'];
					
					if (!filter_var($email, FILTER_VALIDATE_EMAIL)) 
						{ $emailErr = "Invalid email format"; }
				         }

			        if(empty($_POST['comment'])) {
						$commentErr = "Please fill up the comments properly";
					}
					else {
						$comment = $_POST['comment'];
					}

				     }

			?>

			<div class="form" style="margin: 10vh auto;">

				<h1>Contact Us</h1>

				<!-- <form name="jsForm" onsubmit="submitForm(event)">	 -->
				<form method="POST" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>">	

					<label for="name">Name :</label>
					<input type="text" id="name" name="name" value="<?php echo $name; ?>" >
					<p style="color:red"><?php echo $nameErr; ?></p>
			

					<label for="phone">Phone phone:</label>
					<input name="phone" type="text" id="phone" value="<?php echo $phone; ?>" >
					<p style="color:red"><?php echo $phoneErr; ?></p>


					<label for="email">Email address:</label>
					<input name="email" type="text" id="email"  value="<?php echo $email; ?>" >
					<p style="color:red"><?php echo $emailErr; ?></p>
		 

					<label for="comment">Comments:</label>

					<textarea name="comment" id="comment"  rows="7" cols="20" value="<?php echo $comment; ?>" >
					</textarea>

					<p style="color:red"><?php echo $commentErr; ?></p>

					<input type="submit" value="Submit" id="submit">

				
				</form>
				<p id="errorMsg"></p>
			</div>

			<br>
			<?php

				if ($name!=""  && $phone!="" &&  $email!="" &&  $comment!="")
				{ echo "<b> The form is submitted </b> ";}
			?>
			<?php

			  if ($name!=""  && $phone!="" &&  $email!="" &&  $comment!="" && $emailErr == "")
			  {
			    $host = "localhost";
			    $user = "project";
			    $pass = "1234";
			    $db = "menebus";

			    $conn = new mysqli($host, $user, $pass, $db);

			    if($conn->connect_error) {
			      echo "Database Connection Failed!";
			      echo "<br>";
			      echo $conn->connect_error;
			    }
			    else {
			      echo "Database Connection Successful!";
			      
			      $stmt = $conn->prepare("insert into support (name, phone, email, comment) VALUES (?, ?, ?, ?)");

			      $stmt->bind_param("ssss", $p1, $p2, $p3, $p4);

			      $p1 = $name;
			      $p2 = $phone;
			      $p3 = $email;
			      $p4 = $comment;

			      $status = $stmt->execute();

			      if($status) {
			        echo "Data Insertion Successful.";
			      }
			      else {
			        echo "Failed to Insert Data.";
			        echo "<br>";
			        echo $conn->error;
			      }
			    }

			    $conn->close();
			     }
			?>

		</div>
		<div class="footer">
		  <?php include 'footer.php';?>
		</div>

		<style>

				.bg {
					background-image: url('images/bg.jpg');
					min-height: 100%; 
					background-position: center;
					background-repeat: no-repeat;
					background-size: cover;
				}


		</style>

		<script>
          function submitForm(e){
          	console.log(e);
			e.preventDefault();
			console.log("form submitted");

			var name = document.forms["jsForm"]["name"].value;
			var phone = document.forms["jsForm"]["phone"].value;
			var email = document.forms["jsForm"]["email"].value;
			var comment = document.forms["jsForm"]["comment"].value;

			if(name == "" || phone == "" || email== ""|| comment== "") 

			{
				document.getElementById("errorMsg").innerHTML = "<b>Please fill up the form properly.</b>";
				document.getElementById("errorMsg").style.color = "red";


				if(name == "")
					document.getElementById("name").style.border = "2px solid red";
				else
				    document.getElementById("name").style.border = "1px solid black";


				if(phone == "")
					document.getElementById("phone").style.border = "2px solid red";
				else
				    document.getElementById("phone").style.border = "1px solid black";


				if(email == "")
					document.getElementById("email").style.border = "2px solid red";
				else
				    document.getElementById("email").style.border = "1px solid black";


				if(comment == "")
					document.getElementById("comment").style.border = "2px solid red";
				else
				    document.getElementById("comment").style.border = "1px solid black";

			}
			else {

				var xhttp = new XMLHttpRequest();
	            xhttp.onreadystatechange = function() {
	              if(this.readyState == 4 && this.status == 200) {
	                document.getElementById("errorMsg").innerHTML = "<b>Message sent Successfully</b>";
	                document.getElementById("errorMsg").style.color = "green";

	                document.getElementById("name").style.border = "1px solid black";
	                document.getElementById("phone").style.border = "1px solid black";
	                document.getElementById("email").style.border = "1px solid black";
	                document.getElementById("comment").style.border = "1px solid black";

	              }
	            }

	            xhttp.open("POST", "<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>", true);
	            xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	            xhttp.send("name="+name+"&phone="+phone+"&email="+email+"&comment="+comment);

				
			}
		}

    </script>
	</body>

</html>