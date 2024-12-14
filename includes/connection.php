<?php
//inisialisasi koneksi ke server
$ipserver = "localhost";
$username = "postgres";//root jika pake mysql
$password = "admin";//tidak ada password jika pake mysql
$database = "latihan_uas";

//koneksi ke server
try{
    //sebener e cuman butuh ini tok buat koneksi
    $conn = new PDO("pgsql:host=$ipserver;dbname=$database", $username, $password);
    //ini opsional, kalo ga bisa baru 
    $conn -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}catch(PDOException $e){
    //catch error
    echo "connection failed : " . $e->getMessage();
    exit;
}
?>