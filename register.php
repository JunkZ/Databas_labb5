
<html>
<body>

<form action="index.php" method="post">
<input type="submit" value="Back to home">
</form>

<?php
include_once 'dbini/db_handler.php';
$conn;
$ANAMN = $_POST["ANAMN"];
$PASS = $_POST["PASS"];

$sql = "INSERT INTO customer (Användarnamn,Lösenord) VALUES ('$ANAMN', '$PASS');";
$result = $conn->query($sql);
echo "Registering komplett";

?>

</body>
</html>
