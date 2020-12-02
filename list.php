<?php
session_start();
?>
<html>

<body>
  <p>

    <head>
      <link rel="stylesheet" href="css/products.css" />
    </head>
	<form action="index.php" method="post">
	<input type="submit" value="Back to home" class="button"> 
	</form>
	<form action="viewcart.php" method="post" class=poslogout <?php if($_SESSION["loggedIN"] == "false") echo 'style="display:none"';?>>
	<input type="submit" value="View cart" class="buttonlogout">
	</form>
    <h1 class=serif> Product list: </h1>
    <?php
    $servername = "localhost";
    $username = "root";
    $password = "123";
    $dbname = "mydb";

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
    }
    $sql = "SELECT * FROM produkt";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
      while ($row = $result->fetch_assoc()) {
		$id = $row["ProductID"];
		//echo $id;
        echo "<span id=\"lst\"><strong>ProductID: </strong>" . $row["ProductID"]
          . " | <strong>Product Name: </strong>" . $row["ProductName"]
          . " |<strong> Date: </strong>" . $row["Tillagt datum"]
          . " | <strong>Price: </strong>" . $row["Pris"]
          . " | <strong>Stock: </strong>" . $row["Lagersaldo"]
          . "</span>";
		  ?>
		  <form action="tocart.php" method="post" <?php if($_SESSION["loggedIN"] == "false") echo 'style="display:none"';?>>
		  <input type="hidden" name="prodid" value="<?php echo $row["ProductID"]; ?>">  
		  <input type="submit" value="Add to cart" ></form>
		  <?php
		  echo "<br>";
		  
      }
    } else {
      echo "Inga resultat!";
    }
    $sql = "SELECT * FROM kategorier";
    $result = $conn->query($sql);
    echo "<br><h1 class=serif>Category list: </h1>";
    if ($result->num_rows > 0) {
      while ($row = $result->fetch_assoc()) {
        echo "<span id=\"lst\"><strong>ProductID FK: </strong>" . $row["ProductID"]
          . " | <strong>Kategori Namn: </strong>" . $row["ProductName"]
          . "</span><br>";
      }
    } else {
      echo "No results!";
    }
    $conn->close();

    ?>
    </div>
</body>

</html>