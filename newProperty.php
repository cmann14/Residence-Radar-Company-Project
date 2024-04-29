<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', '1');
$host = "localhost";
$user = ""; // Your database username with mines
$pass = ""; // Your database password
$dbname = "sellerDB"; // Your database name, this will be sellerDB or something
$conn = new mysqli($host, $user, $pass, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
if ($_SERVER["REQUEST_METHOD"]) {
  $sellerID=$_SESSION['userid'];
  $img=$_POST["img"];
  $price=$_POST["price"];
  $location=$_POST["location"];
  $bedrooms=$_POST["bedrooms"];

  $sql="INSERT INTO properties (sellerID, image, price, location, bedrooms) VALUES (?,?,?,?,?)";
  $stmt = $conn->prepare($sql);
  $stmt->bind_param("issii", $sellerID, $image, $prie, $location, $bedrooms);
  $stmt->execute();

  header("Location: sellerDash.php");
  exit;

}
$conn->close();
?>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Add a property</title>
    <link rel="stylesheet" href="newProperty.css">
  </head>
  <body>
    <div class="content">
      <form action="newProperty.php" method="post">
        <label for="image">Image: </label><input type="file" id="image" name="image" required><br><br>
        <label for="price">Price: </label><input type="number" id="price" name="price" required><br><br>
        <label for="location">Location: </label><input type="text" id="location" name="location" required><br><br>
        <label for="bedrooms">Number of Bedrooms: </label><input type="text" id="bedrooms" name="bedrooms" required><br><br>
      <form>
    </div>
  </body>
</html>
