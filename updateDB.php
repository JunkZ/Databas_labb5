<html>
<body>

<form action="admin.php" method="post">
<input type="submit" value="Back to adminpage"> 
</form>

<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "mydb";
$PID = $_POST["PID"];
$PNAME = $_POST["PName"];

// Create connection
$conn = new mysqli($servername, $username, $password,$dbname);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
$sql = "INSERT INTO products VALUES ('$PID', '$PNAME');";
$result = $conn->query($sql);



?>

</body>
</html>