<html>
<body>
<head>
    <link rel="stylesheet" href="css/products.css" />
</head>
<p class=serif> List of products </p>
<?php
$servername = "localhost";
$username = "root";
$password = "123";
$dbname = "myDB";

// Create connection
$conn = new mysqli($servername, $username, $password,$dbname);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
$sql = "SELECT * FROM produkt";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
  // output data of each row
  while($row = $result->fetch_assoc()) {
    echo "id: " . $row["ProductID"]. " - Name: " . $row["ProductName"]. " 
    - Pris: " . $row["Pris"]. " - Saldo: " . $row["Lagersaldo"]. "<br>";
  }
} else {
  echo "0 results";
}
$conn->close();

?>

</body>
</html>
