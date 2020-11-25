
<html>
<body>

<form action="index.php" method="post">
<input type="submit" value="Back to home"> 
</form>

<?php
$servername = "localhost";
$username = "root";
$password = "123";
$dbname = "mydb";
$ANAMN = $_POST["ANAMN"];
$PASS = $_POST["PASS"];

// Create connection
$conn = new mysqli($servername, $username, $password,$dbname);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
$sql = "INSERT INTO customer (Användarnamn,Lösenord) VALUES ('$ANAMN', '$PASS');";
$result = $conn->query($sql);
echo "Registering komplett";



?>

</body>
</html>
