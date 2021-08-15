<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title>seller Sign Up</title>
  <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
  <div class="header">
      <?php include 'header2.php';?>
  </div>

  <div class="bg">
    <br>
  
  <?php
    $sellerNameErr = $sellerAddressErr = $userNameErr=  $emailErr = $passwordErr= $confirmpassErr="";

    $sellerName = ""; 
    $sellerAddress = ""; 
    $userName= "";
    $email = "";
    $password= "";
    $confirmpass= "";

    if($_SERVER["REQUEST_METHOD"] == "POST") {
      if(empty($_POST['sellerName'])) {
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

          
       if(empty($_POST['userName'])) {
        $userNameErr = "Please fill up the username properly";
      }
      else {
        $userName = $_POST['userName'];
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
      if($confirmpass!==$password)
      {
        $confirmpassErr="Password don't match";
      }
    }
  ?>

  <div class="form">

    <h1>seller Sign Up</h1>

  <form name="jsForm" onsubmit="submitForm(event)">
    
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


       <label for="userName">Username :</label>
       <input type="text" name="userName" id="userName" value="<?php echo $userName; ?>"> 
       <p style="color:red"><?php echo $userNameErr; ?></p>
    

           <label for="password">Password :</label>
       <input type="password" minlength='4' name="password" id="password" value="<?php echo $password; ?>"> 
       <p style="color:red"><?php echo $passwordErr; ?></p>
    

            <label for="confirmpass">Re-Type Password :</label>
            <input type="password" minlength='4' name="confirmpass" id="confirmpass" value="<?php echo $confirmpass; ?>"> 
            <p style="color:red"><?php echo $confirmpassErr; ?></p>
    
    </fieldset>

        <br>

        <center>

          <input type="submit" value="Submit" id = "submit">
          
        </center>
        

        </form>

        <p id="errorMsg"></p>

      </div>
        <br>
 <?php

        if($sellerName != "" && $sellerAddress != "" && $userName != "" && $email != "" && $password != "" && $confirmpass != "" && $password == $confirmpass)
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
            
            $stmt = $conn->prepare("insert into sellerdata (sellerName, sellerAddress, userName, email, password, confirmpass) VALUES (?, ?, ?, ?, ?, ?)");
            $stmt->bind_param("ssssss", $p1, $p2, $p3, $p4, $p5, $p6);
            $p1 = $sellerName;
            $p2 = $sellerAddress;
            $p3 = $userName;
            $p4 = $email;
            $p5 = $password;
            $p6 = $confirmpass;

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
        function submitForm(e) 
        {

          console.log(e);
          e.preventDefault();
          console.log("form submitted");

          var sellerName = document.forms["jsForm"]["sellerName"].value;
          var sellerAddress = document.forms["jsForm"]["sellerAddress"].value;
          var email = document.forms["jsForm"]["email"].value;
          var userName = document.forms["jsForm"]["userName"].value;
          var password = document.forms["jsForm"]["password"].value;
          var confirmpass = document.forms["jsForm"]["confirmpass"].value;


          if(sellerName == "" || sellerAddress == "" || email == "" || userName == ""
            || password == "" || confirmpass == "") 
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


            var xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function() {
              if(this.readyState == 4 && this.status == 200) {
                document.getElementById("errorMsg").innerHTML = "<b>seller Added Successfully</b>";
                document.getElementById("errorMsg").style.color = "green";
                if(password!=confirmpass)
                {
                  document.getElementById("errorMsg").innerHTML = "<b>Password not matched</b>";
                  document.getElementById("errorMsg").style.color = "red";

                }
                if(password.length<4)
                {
                  document.getElementById("errorMsg").innerHTML = "";
                }

                document.getElementById("sellerName").style.border = "1px solid black";
                document.getElementById("sellerAddress").style.border = "1px solid black";
                document.getElementById("email").style.border = "1px solid black";
                document.getElementById("userName").style.border = "1px solid black";
                document.getElementById("password").style.border = "1px solid black";
                document.getElementById("confirmpass").style.border = "1px solid black";
              }
            }

            xhttp.open("POST", "<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>", true);
            xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            xhttp.send("sellerName="+sellerName+"&sellerAddress="+sellerAddress+"&email="+email+"&userName="+userName+"&password="+password+"&confirmpass="+confirmpass);

          }

        }
      </script>


    </body>
</html>