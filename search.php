<html>
<body>
<form action="index.php" method="post">
<input type="submit" value="Back to home"> 
</form>
<form action="search.php" method="get">
Product: <input type="text" name="searched">
<input type="submit"> 
</form>

<?php
$servername = "localhost";
$username = "root";
$password = "123";
$dbname = "myDB";
$searched = $_GET["searched"];

// Create connection
$conn = new mysqli($servername, $username, $password,$dbname);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
$sql = "SELECT * FROM products WHERE ProductName LIKE '%$searched%';";
$result = $conn->query($sql);
while($row = mysqli_fetch_array($result)) {
	echo "Produktnamn: ";
    echo $row['ProductName'];
	echo ", ProduktID:   ";
	echo $row['ProductID'];
	echo "<br>";// Print a single column data
}


?>

</body>
</html>
