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
$ANAMN = $_POST["ANAMN"];
$PASS = $_POST["PASS"];

$sql = "SELECT * FROM customer WHERE Användarnamn ='$ANAMN'AND Lösenord = '$PASS';";
$resultANAMN = $conn->query($sql);
$sqlADMIN = "SELECT * FROM adminstrator WHERE Customer_Användarnamn ='$ANAMN';";
$resultADMIN = $conn->query($sqlADMIN);
$row = $resultANAMN->fetch_assoc();
$row2 = $resultADMIN->fetch_assoc();

if ($row['Användarnamn'] == $ANAMN && $row['Lösenord'] == $PASS) {
    $_SESSION["loggedIN"] = "true";
    $_SESSION["username"] = $row['Användarnamn'];
    echo "You have successfully logged in as ", $row['Användarnamn'], "<br>And you are ";
    if ($row2['Admin Flagga'] == 1) {
        echo "an Admin!";
        $_SESSION["Admin"] = "true";
    } else {
        echo "not an Admin!";
        $_SESSION["Admin"] = "false";
    }
} else {
    $_SESSION["loggedIN"] = "false";
    $_SESSION["Admin"] = "false";
    echo "User or password incorrect, please return to the home page";
}

?>
<br>
<form action="admin.php" method="post">
<input type="submit" value="Admin page" class="button">
</form>

<p> This button should only redirect you into admin.php if youre an admin, otherwise back to index <p>

</body>
</html>
