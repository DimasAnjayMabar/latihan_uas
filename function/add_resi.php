<?php
    require('../includes/connection.php');

    if($_SERVER['REQUEST_METHOD'] === 'POST'){
        try{
            $noResi = $_POST['resi'];
            // $tanggal = $_POST['tanggal'];

            $query = "insert into transaksi (nomor_resi) values (:nomor_resi)";
            $stmt = $conn -> prepare($query);

            $stmt -> bindParam(':nomor_resi', var: $noResi);
            // $stmt -> bindParam(':tanggal_resi', var: $tanggal);

            $stmt -> execute();
            header("Location: ../home_page.php");
            exit;
        }catch(Exception $e){
            echo "error : " . $e -> getMessage();
        }
    }
?>