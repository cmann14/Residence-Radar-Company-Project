<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Seller Dashboard</title>
    <link rel="stylesheet" href="sellerDash.css">
  </head>
  <body>
    <div class="content">
      <?php
      session_start();
      error_reporting(E_ALL);
      ini_set('display_errors', '1');
      $host = "localhost";
      $user = ""; // Your database username with mines
      $pass = ""; // Your database password
      $dbname = "sellerDB";
      $conn = new mysqli($host, $user, $pass, $dbname);
      if ($conn->connect_error) {
          die("Connection failed: " . $conn->connect_error);
      }
      if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
        header("Location: login.php");
        exit;
      }
      $info = "SELECT * FROM properties WHERE sellerID = ?";
      $stmt = $conn->prepare($info);
      $stmt->bind_param("i", $_SESSION["userid"]);
      $stmt->execute();
      $result = $stmt->get_result();

      while ($property=$result->fetch_assoc()){ ?>
        <div class="card">
          <img src="<?php echo $property['img'];?>">
          <h2>$: <?php echo $property['price'];?></h2>
          <p>location: <?php echo $property['location'];?></p>
          <p>No. Bedrooms: <?php echo $property['bedrooms'];?></p>
          <p>Tax: <?php echo (0.07 * $property['price']);?></p>
      </div>
      <?php
    }
    $stmt->close();
    $conn->close();
      ?>

      <a href="newProperty.php">
        <div class="card">
          <div class="lastCardText">
            <h2>Add a property</h2>
          </div>
        </div>
      </a>
    </div>

  </body>
</html>
