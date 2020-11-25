<html>
<body>
<head>
    <link rel="stylesheet" href="css/search.css" />
</head>
<form action="index.php" method="post">
<input type="submit" value="Back to home" class="button"> 
</form>
<form action="search.php" method="get">
<input type="text" name="searched" placeholder="Product to lookup..">
<input type="submit" class="button1" value="Search"> 
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
	echo "Produktnamn: ";
    echo $row['ProductName'];
	echo ", ProduktID:   ";
	echo $row['ProductID'];
	echo ", Pris:   ";
	echo $row['Pris'];
	echo ", Saldo:   ";
	echo $row['Lagersaldo'];
	echo "<br>";// Print a single column data
}


?>

</body>
</html>
