
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

$check = "SELECT * FROM customer WHERE Användarnamn = '$ANAMN';";
$resultcheck = $conn->query($check);


if (mysqli_num_rows($resultcheck) > 0) {
    echo "User already exists";
}
else{
    $sql = "INSERT INTO customer (Användarnamn,Lösenord) VALUES ('$ANAMN', '$PASS');";
    $result = $conn->query($sql);
    echo "Registering komplett";
}

?>

</body>
</html>
