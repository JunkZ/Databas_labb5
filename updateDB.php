<html>
<body>

<form action="admin.php" method="post">
<input type="submit" value="Back to adminpage"> 
</form>

<?php
$servername = "localhost";
$username = "root";
$password = "123";
$dbname = "mydb";
$PID = $_POST["PID"];
$PNAME = $_POST["PName"];
$PPRICE = $_POST["PPrice"];
$PSALDO = $_POST["PSaldo"];

// Create connection
$conn = new mysqli($servername, $username, $password,$dbname);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
$sql = "INSERT INTO produkt VALUES ('$PID', '$PNAME',CURRENT_TIMESTAMP(),'$PPRICE','$PSALDO');";
$result = $conn->query($sql);



?>

</body>
</html>
