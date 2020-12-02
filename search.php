<?php
session_start();
?>
<html>
<body>
<head>
    <link rel="stylesheet" href="css/search.css" />
</head>
<form action="index.php" method="post">
	<input type="submit" value="Back to home" class="button"> 
	</form>
	<form action="viewcart.php" method="post" class=poslogout <?php if($_SESSION["loggedIN"] == "false") echo 'style="display:none"';?>>
	<input type="submit" value="View cart" class="buttonlogout">
	</form>

<?php
$servername = "localhost";
$username = "root";
$password = "123";
$dbname = "mydb";
$searched = $_GET["searched"];

// Create connection
$conn = new mysqli($servername, $username, $password,$dbname);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
$sql = "SELECT * FROM produkt WHERE ProductName LIKE '%$searched%';";
$result = $conn->query($sql);
while($row = mysqli_fetch_array($result)) {
	echo "<span id=\"lst\"><strong>ProductID: </strong>" . $row["ProductID"]
          . " | <strong>Product Name: </strong>" . $row["ProductName"]
          . " |<strong> Date: </strong>" . $row["Tillagt datum"]
          . " | <strong>Price: </strong>" . $row["Pris"]
          . " | <strong>Stock: </strong>" . $row["Lagersaldo"]
          . "</span>";
	?>
		  <form action="tocart.php" method="post" <?php if($_SESSION["loggedIN"] == "false") echo 'style="display:none"';?>>
		  <input type="hidden" name="prodid" value="<?php echo $row["ProductID"]; ?>">  
		  <input type="submit" value="Add to cart" ></form>
		  <?php
	echo "<br>";// Print a single column data
}


?>

</body>
</html>
