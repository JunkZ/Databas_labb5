<html>
<body>
<head>
    <link rel="stylesheet" href="css/updateDB.css"/>
</head>

<form action="admin.php" method="post">
<input type="submit" value="Back to adminpage" class="button">
</form>
<?php
include_once 'dbini/db_handler.php';
$conn;
$PID = $_POST["PID"];
$PNAME = $_POST["PName"];
$PPRICE = $_POST["PPrice"];
$PSALDO = $_POST["PSaldo"];

if($PPRICE>0){
$sql = "INSERT INTO produkt VALUES ('$PID', '$PNAME',CURRENT_TIMESTAMP(),'$PPRICE','$PSALDO');";
$result = $conn->query($sql);
echo "New product added!";
}
else{
    echo "Please enter a price above 0";
}

?>

</body>
</html>