<?php
session_start();
?>
<html>
<body>

<head>
    <link rel="stylesheet" href="css/index.css" />
</head>
<form action="index.php" method="post">
<input type="submit" value="Back to home" class="button">
</form>

<?php
session_destroy();
echo "successfully logged out";
?>

</body>
</html>
