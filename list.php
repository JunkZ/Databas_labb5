<html>
<body>
<p> Produktlista: </p>
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
  while($row = $result->fetch_assoc()) {
    echo "ProductID: " . $row["ProductID"]. " - Produkt Namn: " . $row["ProductName"]. " - Tillagt datum: " . $row["Tillagt datum"]. " - Pris: " . $row["Pris"]. " - Lagersaldo: " . $row["Lagersaldo"]. "<br>";
  }
} else {
  echo "Inga resultat!";
}
$sql = "SELECT * FROM kategorier";
$result = $conn->query($sql);
echo "<br>Kategorilista: <br>";
if ($result->num_rows > 0) {
  while($row = $result->fetch_assoc()) {
    echo "ProductID: " . $row["ProductID"]. " - Kategori Namn: " . $row["Kategori Namn"]."<br>";
  }
} else {
  echo "Inga resultat!";
}
$conn->close();

?>

</body>
</html>
