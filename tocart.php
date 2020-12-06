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
include_once 'dbini/db_handler.php';
$conn;
$prodid = $_POST["prodid"];
$uName = $_SESSION['username'];

$sql = "SELECT * FROM varukorg WHERE Customer_Användarnamn = '$uName' AND produkt_ProductID = '$prodid';";
$result = $conn->query($sql);

if (mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_array($result);
    $newValue = $row["Kvantitet"] + 1;
    $sql = "UPDATE varukorg SET Kvantitet = $newValue WHERE Customer_Användarnamn = '$uName' AND produkt_ProductID = '$prodid';";
    $conn->query($sql);
} else {
    $sql = "INSERT INTO varukorg VALUES (1,'$uName', '$prodid',NULL,4);";
    $conn->query($sql);

}
?>
</body>
</html>


