<?php
session_start();

if ($_SESSION['userNameV'] == '') {
  header("location:../login.php");
}
?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>seller Profile</title>
    <link rel="stylesheet" type="text/css" href="../style.css">
  </head>
  <body>

 <div class="header">
      <?php include 'header.php';?>
  </div>

    <div class="bg">
      <br>
 
    <?php

      $srcAErr = $sellerNameErr = $sellerAddressErr = $idErr = $userNameErr=  $emailErr = $passwordErr= $confirmpassErr="";


		    $srcA = "";
        $sellerName = ""; 
        $sellerAddress = "";
        $id = "";
        $userName= "";
        $email = "";
        $password= "";
        $confirmpass= "";
        $flag = 0;
	      $searchKey = $_SESSION['userNameV'];


      $host = "localhost";
      $user = "project";
      $pass = "1234";
      $db = "menebus";

      $conn1 = new mysqli($host, $user, $pass, $db);

      if($conn1->connect_error) {
        echo "Database Connection Failed!";
        echo "<br>";
        echo $conn1->connect_error;
      }
      else {

        $stmt1 = $conn1->prepare("select sellerName, sellerAddress, id, userName, email, password, confirmpass from sellerdata where userName = ?");
        $stmt1->bind_param("s", $p1);
        $p1 = $searchKey;
        $stmt1->execute();
        $res2 = $stmt1->get_result();
        $sellerdata = $res2->fetch_assoc();

        $sellerName = $sellerdata['sellerName'];
        $sellerAddress = $sellerdata['sellerAddress'];
        $id = $sellerdata['id'];
        $email = $sellerdata['email'];
        $userName = $sellerdata['userName'];
        $password = $sellerdata['password'];
        $confirmpass = $sellerdata['confirmpass'];
        
      }

      mysqli_close($conn1);
      



		if((isset($_POST['update']))||(isset($_POST['delete'])))
	      {

      	 if($_SERVER["REQUEST_METHOD"] == "POST") 
      	 {
      	
      		if(empty($_POST['sellerName'])) 
      		{
        $sellerNameErr = "Please fill up the seller name properly";
      }
      else {
        $sellerName = $_POST['sellerName'];
      }

      if(empty($_POST['sellerAddress'])) {
        $sellerAddressErr = "Please fill up the seller address properly";
      }
      else {
        $sellerAddress = $_POST['sellerAddress'];
      } 

       if(empty($_POST['email'])) {
        $emailErr = "Email is required";
      }
      else {
        $email = $_POST['email'];
      
      if (!filter_var($email, FILTER_VALIDATE_EMAIL)) 
        { $emailErr = "Invalid email format"; }
             }
 
           if(empty($_POST['password'])) {
        $passwordErr = "Please fill up the password properly";
      }
      else {
        $password = $_POST['password'];
      }
           if(empty($_POST['confirmpass'])) {
        $confirmpassErr = "Please fill up the password properly";
      }
      else {
        $confirmpass = $_POST['confirmpass'];
      }
      if($password!==$confirmpass)
      {
        $confirmpassErr="Password don't match";
      }

    }

	  if(isset($_POST['update']) && $password==$confirmpass)
        {

          $host = "localhost";
          $user = "project";
          $pass = "1234";
          $db = "menebus";

          $conn2 = new mysqli($host, $user, $pass, $db);

          if($conn2->connect_error) {
            echo "Database Connection Failed!";
            echo "<br>";
            echo $conn2->connect_error;
          }

          else{
            $stmt2 = mysqli_prepare($conn2, 'update sellerdata set sellerName = ?, sellerAddress = ?, email = ?, password = ?, confirmpass = ? where userName=?');

            mysqli_stmt_bind_param($stmt2, 'ssssss', $p2, $p3, $p4, $p5, $p6, $p7);

            $p2 = $sellerName;
            $p3 = $sellerAddress;
            $p4 = $email;
            $p5 = $password;
            $p6 = $confirmpass;
            $p7 = $searchKey;

            mysqli_stmt_execute($stmt2);
          }

          mysqli_close($conn2);

        }

        if(isset($_POST['delete']))
        {
          $host = "localhost";
          $user = "project";
          $pass = "1234";
          $db = "menebus";

          $conn3 = mysqli_connect($host, $user, $pass, $db);
          if(mysqli_connect_error()) {
            echo "Database Connection Failed!";
            echo "<br>";
            echo $conn3 -> connect_error;
          }
          else {
            echo "Database Connection Successful!";
            $stmt3 = mysqli_prepare($conn3, 'delete from sellerdata where userName=?');
            mysqli_stmt_bind_param($stmt3, 's', $p10);
            $p10 = $searchKey;
            mysqli_stmt_execute($stmt3);
          }
          mysqli_close($conn3);

          header("location:../logout.php");

        }

        }
        
      ?>

      <div class="form" style="margin: 5vh auto;">
        <h1>seller Profile </h1>

  <form name="jsForm" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>"onsubmit="return validate()" method="POST">

    <fieldset>
      <legend> Basic Information :</legend>

       <label for="sellerName">seller Name :</label>
       <input type="text" name="sellerName" id="sellerName" value="<?php echo $sellerName; ?>"> 
       <p style="color:red"><?php echo $sellerNameErr; ?></p>

       <label for="sellerAddress">seller Address :</label>
       <input type="text" name="sellerAddress" id="sellerAddress" value="<?php echo $sellerAddress ?>">
       <p style="color:red"><?php echo $sellerAddressErr; ?></p>

       <label for="email">Email :</label>
       <input type="email" name="email" id="email" value="<?php echo $email ?>">
       <p style="color:red"><?php echo $emailErr; ?></p>

    </fieldset>

    <fieldset>
      <legend> User Account Information :</legend>

       <label for="id">Id :</label>
       <input type="text" name="id" id="id" value="<?php echo $id; ?>" disabled> 
       <p style="color:red"><?php echo $idErr; ?></p>
    
       <label for="userName">Username :</label>
       <input type="text" name="userName" id="userName" value="<?php echo $userName; ?>" disabled> 
       <p style="color:red"><?php echo $userNameErr; ?></p>
    
       <label for="password">Password :</label>
       <input type="password" name="password" id="password" value="<?php echo $password; ?>"> 
       <p style="color:red"><?php echo $passwordErr; ?></p>

        <label for="confirmpass">Re-Type Password :</label>
       <input type="password" name="confirmpass" id="confirmpass" value="<?php echo $confirmpass; ?>"> 
       <p style="color:red"><?php echo $confirmpassErr; ?></p>

    </fieldset>
      <br>

      <input type="submit" name="update" value="Update" id="updateBtn">

      <input type="submit" name="delete" value="Delete" id="deleteBtn">

    </form>
    <p id="errorMsg"></p>
    </div>
      <br>

      <div class="footer">
        <?php include 'footer.php';?>
      </div>
      
    <style>
      
        .bg {
          background-image: url('../images/bg.jpg');
          min-height: 100%; 
          background-position: center;
          background-repeat: no-repeat;
          background-size: cover;
        }
      </style>

        <script>
          function validate() {
          var isValid = false;

          var sellerName = document.forms["jsForm"]["sellerName"].value;
          var sellerAddress = document.forms["jsForm"]["sellerAddress"].value;
          var email = document.forms["jsForm"]["email"].value;
          var id = document.forms["jsForm"]["id"].value;
          var userName = document.forms["jsForm"]["userName"].value;
          var password = document.forms["jsForm"]["password"].value;
          var confirmpass = document.forms["jsForm"]["confirmpass"].value;

      if(sellerName == "" || sellerAddress == "" || email== ""|| id== "" || userName== ""|| password== "" || confirmpass== "") 

      {
        document.getElementById("errorMsg").innerHTML = "<b>Please fill up the form properly.</b>";
        document.getElementById("errorMsg").style.color = "red";


        if(sellerName == "")
          document.getElementById("sellerName").style.border = "2px solid red";
        else
          document.getElementById("sellerName").style.border = "1px solid black";


        if(sellerAddress == "")
        document.getElementById("sellerAddress").style.border = "2px solid red";
        else
          document.getElementById("sellerAddress").style.border = "1px solid black";


         if(email == "")
        document.getElementById("email").style.border = "2px solid red";
        else
          document.getElementById("email").style.border = "1px solid black";


         if(id == "")
        document.getElementById("id").style.border = "2px solid red";
        else
          document.getElementById("id").style.border = "1px solid black";


         if(userName == "")
        document.getElementById("userName").style.border = "2px solid red";
        else
          document.getElementById("userName").style.border = "1px solid black";


         if(password == "")
        document.getElementById("password").style.border = "2px solid red";
        else
          document.getElementById("password").style.border = "1px solid black";

        if(confirmpass == "")
        document.getElementById("confirmpass").style.border = "2px solid red";
        else
          document.getElementById("confirmpass").style.border = "1px solid black";
               
      }
      else {
        isValid = true;
      }

      return isValid;
    }
    </script>
    </body>
</html>