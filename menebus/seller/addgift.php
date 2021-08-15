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
  <title>Add gift </title>
  <link rel="stylesheet" type="text/css" href="../style.css">
</head>

<body>
  <div class="header">
    <?php include 'header.php'; ?>
    <?php include 'header3.php'; ?>

  </div>

  <div class="bg">

    <br>

    <?php
    $thumbnailErr  = $gifttitleErr    = $giftpriceErr = "";

    $thumbnail = "";
    $gifttitle = "";
    $giftprice = "";
    $sUname = $_SESSION['userNameV'];


    if ($_SERVER["REQUEST_METHOD"] == "POST") {

      if (empty($_POST['thumbnail'])) {
        $thumbnailErr = "Please fill up gift thumbnail properly";
      } else {
        $thumbnail = $_POST['thumbnail'];
      }

      if (empty($_POST['gifttitle'])) {
        $gifttitleErr = "Please fill up gift title properly";
      } else {
        $gifttitle = $_POST['gifttitle'];
      }


      if (empty($_POST['giftprice'])) {
        $giftpriceErr = "Please fill up the gift price properly";
      } else {
        $giftprice = $_POST['giftprice'];
      }
    }

    ?>
    <div class="form" style="margin: 5vh auto;">

      <h1>Add gift</h1>

      <form name="jsForm" onsubmit="submitForm(event)">

        <label for="thumbnail">gift Thumbnail:</label>
        <input type="text" name="thumbnail" id="thumbnail" value="<?php echo $thumbnail; ?>">

        <p style="color:red"><?php echo $thumbnailErr; ?></p>

        <label for="gifttitle">gift Title:</label>
        <input type="text" name="gifttitle" id="gifttitle" value="<?php echo $gifttitle; ?>">

        <p style="color:red"><?php echo $gifttitleErr; ?></p>


        <label for="giftprice">gift Price:</label>
        <input type="text" name="giftprice" id="giftprice" value="<?php echo $giftprice ?>">

        <p style="color:red"><?php echo $giftpriceErr; ?></p>

        <br>

        <input type="submit" value="Add" class="addgiftBtn" id="submit">

      </form>
      <p id="errorMsg"></p>
    </div>

    <br>

    <?php

    if ($thumbnail != "" && $gifttitle  != "" && $giftprice != "") {
      $host = "localhost";
      $user = "project";
      $pass = "1234";
      $db = "menebus";

      $conn = new mysqli($host, $user, $pass, $db);

      if ($conn->connect_error) {
        echo "Database Connection Failed!";
        echo "<br>";
        echo $conn->connect_error;
      } else {
        echo "Database Connection Successful!";

        $stmt = $conn->prepare("insert into giftdata (thumbnail, gifttitle, giftprice, sUname) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssss", $p1, $p2, $p6, $p7);
        $p1 = $thumbnail;
        $p2 = $gifttitle;
        $p6 = $giftprice;
        $p7 = $sUname;

        $status = $stmt->execute();

        if ($status) {
          echo "Data Insertion Successful.";
        } else {
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
    <?php include 'footer.php'; ?>
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
    function submitForm(e) {
      console.log(e);
      e.preventDefault();

      var thumbnail = document.forms["jsForm"]["thumbnail"].value;
      var gifttitle = document.forms["jsForm"]["gifttitle"].value;
      var giftprice = document.forms["jsForm"]["giftprice"].value;

      if (thumbnail == "" || gifttitle == "" || giftprice == "")

      {
        document.getElementById("errorMsg").innerHTML = "<b>Please fill up the form properly.</b>";
        document.getElementById("errorMsg").style.color = "red";


        if (thumbnail == "")
          document.getElementById("thumbnail").style.border = "2px solid red";
        else
          document.getElementById("thumbnail").style.border = "1px solid black";


        if (gifttitle == "")
          document.getElementById("gifttitle").style.border = "2px solid red";
        else
          document.getElementById("gifttitle").style.border = "1px solid black";






        if (giftprice == "")
          document.getElementById("giftprice").style.border = "2px solid red";
        else
          document.getElementById("giftprice").style.border = "1px solid black";

      } else {

        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
          if (this.readyState == 4 && this.status == 200) {
            document.getElementById("errorMsg").innerHTML = "<b>gift Added Successfully</b>";
            document.getElementById("errorMsg").style.color = "green";

            document.getElementById("thumbnail").style.border = "1px solid black";
            document.getElementById("gifttitle").style.border = "1px solid black";
            document.getElementById("giftprice").style.border = "1px solid black";

          }
        }

        xhttp.open("POST", "<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>", true);
        xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xhttp.send("thumbnail=" + thumbnail + "&gifttitle=" + gifttitle + "&giftprice=" + giftprice);

      }
    }
  </script>

</body>

</html>