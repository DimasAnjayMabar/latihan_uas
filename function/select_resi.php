<?php
    require('../includes/connection.php');

    $query = "select * from transaksi";
    $stmt = $conn -> prepare($query);
    $stmt -> execute();
    $resi = $stmt -> fetchAll(PDO::FETCH_ASSOC);

    if ($conn) {
        echo "Connection successful";  // Debugging message
    } else {
        echo "Connection failed";      // Debugging message
    }
?>