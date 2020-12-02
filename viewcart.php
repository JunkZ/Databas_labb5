<?php
session_start();
?>
<html>
<body>
<head>
    <link rel="stylesheet" href="css/index.css" />
</head>
<form action="index.php" method="post" >
<input type="submit" value="Back to home" class="button"> 
</form>

<?php
$servername = "localhost";
$username = "root";
$password = "123";
$dbname = "mydb";
$uName = $_SESSION['username'];

$conn = new mysqli($servername, $username, $password,$dbname);


if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
$sql = "SELECT * FROM varukorg WHERE Customer_Användarnamn = '$uName';";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
      while ($row = $result->fetch_assoc()) {
		$prodid = $row["produkt_ProductID"];
		$sql = "SELECT * FROM produkt WHERE ProductID = '$prodid';";
		$resultProdukt = $conn->query($sql);
		$produktArray = mysqli_fetch_array($resultProdukt); 
        echo "<span id=\"lst\"><strong>ProductID: </strong>" . $produktArray["ProductID"]
          . " | <strong>Product Name: </strong>" . $produktArray["ProductName"]
          . " | <strong>Price: </strong>" . $produktArray["Pris"]
          . " | <strong>Kvantitet: </strong>" . $row["Kvantitet"]
          . "</span>";
		  echo "<br>";
		  
      }
    } else {
      echo "Inga resultat!";
    }
?>
</body>
</html>
