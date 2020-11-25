<html>

<body>
  <p>

    <head>
      <link rel="stylesheet" href="css/products.css" />
    </head>
    <h1 class=serif> Produktlista: </h1>
    <?php
    $servername = "localhost";
    $username = "root";
    $password = "123";
    $dbname = "myDB";

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
        echo "<span id=\"lst\"><strong>ProductID: </strong>" . $row["ProductID"]
          . " | <strong>Produkt Namn: </strong>" . $row["ProductName"]
          . " |<strong> Datum: </strong>" . $row["Tillagt datum"]
          . " | <strong>Pris: </strong>" . $row["Pris"]
          . " | <strong>Lagersaldo: </strong>" . $row["Lagersaldo"]
          . "</span><br>";
      }
    } else {
      echo "Inga resultat!";
    }
    $sql = "SELECT * FROM kategorier";
    $result = $conn->query($sql);
    echo "<br><h1 class=serif>Kategorilista: </h1>";
    if ($result->num_rows > 0) {
      while ($row = $result->fetch_assoc()) {
        echo "<span id=\"lst\"><strong>ProductID FK: </strong>" . $row["ProductID"]
          . " | <strong>Kategori Namn: </strong>" . $row["ProductName"]
          . "</span><br>";
      }
    } else {
      echo "Inga resultat!";
    }
    $conn->close();

    ?>
    </div>
</body>

</html>