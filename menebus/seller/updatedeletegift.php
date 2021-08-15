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
  <title>Update-Delete gift</title>
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
    $srcBErr = $thumbnailErr =  $idErr = $gifttitleErr = $giftpriceErr = "";

    $srcB = "";
    $thumbnail = "";
    $id = "";
    $gifttitle = "";
    $giftprice = "";
    $flag = 0;
    $searchKey = "";
    $myShop = $_SESSION['userNameV'];

    if (isset($_POST['src'])) {
      if ($_SERVER["REQUEST_METHOD"] == "POST") {

        if (empty($_POST['srcB'])) {
          $srcBErr = "Please fill up the gift userName";
        } else {
          $srcB = $_POST['srcB'];
        }
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

        $stmt1 = $conn1->prepare("select thumbnail, id, gifttitle, giftprice from giftdata where id = ? and sUname = ?");
        $stmt1->bind_param("ss", $p1, $p2);
        $p1 = $srcB;
        $p2 = $myShop;
        $stmt1->execute();
        $res2 = $stmt1->get_result();
        $DBgift = $res2->fetch_assoc();
        if (!$DBgift)
          echo '<Script>alert("No Gift Found")</Script>';
        else {
          $thumbnail = $DBgift['thumbnail'];
          $id = $DBgift['id'];
          $gifttitle = $DBgift['gifttitle'];
          $giftprice = $DBgift['giftprice'];
        }

        if ($gifttitle != "")
          $flag = 1;
      }


      if ($flag == 0)
        // echo $srcB . " not found";

        mysqli_close($conn1);
    }

    if ((isset($_POST['update'])) || (isset($_POST['delete']))) {

      if ($_SERVER["REQUEST_METHOD"] == "POST") {

        if (empty($_POST['thumbnail'])) {
          $thumbnailErr = "Please fill up gift thumbnail properly";
        } else {
          $thumbnail = $_POST['thumbnail'];
        }

        if (empty($_POST['id'])) {
          $idErr = "Please fill up id properly";
        } else {
          $id = $_POST['id'];
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

      if (isset($_POST['update'])) {
        $host = "localhost";
        $user = "project";
        $pass = "1234";
        $db = "menebus";

        $conn2 = new mysqli($host, $user, $pass, $db);

        if ($conn2->connect_error) {
          echo "Database Connection Failed!";
          echo "<br>";
          echo $conn2->connect_error;
        } else {
          $stmt2 = mysqli_prepare($conn2, 'update giftdata set thumbnail = ?, id = ?, gifttitle = ?, giftprice = ? where id = ?');
          mysqli_stmt_bind_param($stmt2, 'sissi', $p2, $p3, $p4, $p5, $p6);
          $p2 = $thumbnail;
          $p3 = $id;
          $p4 = $gifttitle;
          $p5 = $giftprice;
          $p6 = $id;

          mysqli_stmt_execute($stmt2);
        }

        mysqli_close($conn2);
      }

      if (isset($_POST['delete'])) {

        $host = "localhost";
        $user = "project";
        $pass = "1234";
        $db = "menebus";

        $conn3 = mysqli_connect($host, $user, $pass, $db);
        if (mysqli_connect_error()) {
          echo "Database Connection Failed!";
          echo "<br>";
          echo $conn3->connect_error;
        } else {
          $stmt3 = mysqli_prepare($conn3, 'delete from giftdata where id=?');
          mysqli_stmt_bind_param($stmt3, 'i', $p10);
          $p10 = $id;
          mysqli_stmt_execute($stmt3);
        }
        mysqli_close($conn3);
      }
    }

    ?>
    <div class="form">

      <h1>Update-Delete gift</h1>

      <form name="srcForm" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>" onsubmit="return srcvalidate()" method="POST">


        <label for="srcB">Search gift:</label>
        <input type="search" name="srcB" id="srcB" value="<?php echo $srcB; ?>" placeholder="search here" style="width: 75%; display: inline-block;">

        <input type="submit" name="src" value="Search" id="srcBtn">
        <p style="color:red"><?php echo $srcBErr; ?></p>


      </form>
      <p id="srcerrorMsg"></p>

      <hr>

      <form name="jsForm" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>" onsubmit="return validate()" method="POST">

        <label for="thumbnail">gift Thumbnail:</label>
        <input type="text" name="thumbnail" id="thumbnail" value="<?php echo $thumbnail; ?>">

        <p style="color:red"><?php echo $thumbnailErr; ?></p>

        <label for="id">gift Id:</label>
        <input type="text" name="id" id="id" value="<?php echo $id; ?>">

        <p style="color:red"><?php echo $idErr; ?></p>

        <label for="gifttitle">gift Title:</label>
        <input type="text" name="gifttitle" id="gifttitle" value="<?php echo $gifttitle; ?>">

        <p style="color:red"><?php echo $gifttitleErr; ?></p>

        <label for="giftprice">gift Price:</label>
        <input type="text" name="giftprice" id="giftprice" value="<?php echo $giftprice ?>">

        <p style="color:red"><?php echo $giftpriceErr; ?></p>


        <br>

        <input type="submit" name="update" value="Update" id="updateBtn">
        <input type="submit" name="delete" value="Delete" id="deleteBtn">

      </form>
      <p id="errorMsg"></p>
    </div>
    <br>

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
    function srcvalidate() {
      var isValid = false;
      var srcB = document.forms["srcForm"]["srcB"].value;

      if (srcB == "")

      {
        document.getElementById("srcerrorMsg").innerHTML = "<b>Please fill up the form properly.</b>";
        document.getElementById("srcerrorMsg").style.color = "red";

        if (srcB == "")
          document.getElementById("srcB").style.border = "2px solid red";
        else
          document.getElementById("srcB").style.border = "1px solid black";

      } else {
        isValid = true;
      }

      return isValid;
    }
  </script>

  <script>
    function validate() {
      var isValid = false;
      var thumbnail = document.forms["jsForm"]["thumbnail"].value;
      var id = document.forms["jsForm"]["id"].value;
      var gifttitle = document.forms["jsForm"]["gifttitle"].value;
      var giftprice = document.forms["jsForm"]["giftprice"].value;

      if (thumbnail == "" || id == "" || gifttitle == "" || giftprice == "")

      {
        document.getElementById("errorMsg").innerHTML = "<b>Please fill up the form properly.</b>";
        document.getElementById("errorMsg").style.color = "red";

        if (thumbnail == "")
          document.getElementById("thumbnail").style.border = "2px solid red";
        else
          document.getElementById("thumbnail").style.border = "1px solid black";

        if (id == "")
          document.getElementById("id").style.border = "2px solid red";
        else
          document.getElementById("id").style.border = "1px solid black";


        if (gifttitle == "")
          document.getElementById("gifttitle").style.border = "2px solid red";
        else
          document.getElementById("gifttitle").style.border = "1px solid black";


        if (giftprice == "")
          document.getElementById("giftprice").style.border = "2px solid red";
        else
          document.getElementById("giftprice").style.border = "1px solid black";

      } else {
        isValid = true;
      }

      return isValid;
    }
  </script>

</body>

</html>