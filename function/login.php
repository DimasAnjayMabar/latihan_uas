<?php
require('../includes/connection.php');//manggil fungsi koneksi

//cek server apakah post
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    //cek apakah username dan password kosong
    if (isset($_POST['username'], $_POST['password']) && !empty($_POST['username']) && !empty($_POST['password'])) {
        $username = $_POST['username'];
        $password = $_POST['password'];

        //coba query dalam database
        try {
            $stmt = $conn->prepare("SELECT * FROM admin WHERE username = :username");
            $stmt->bindParam(':username', $username);
            $stmt->execute();

            //traverse seluruh admin dalam database
            if ($stmt->rowCount() > 0) {
                $user = $stmt->fetch(PDO::FETCH_ASSOC);

                //validasi username lewat password
                if ($password === $user['password']) {
                    session_start();

                    //simpan data id username dan password admin
                    $_SESSION['id_admin'] = $user['id_admin'];
                    $_SESSION['username'] = $user['username'];
                    $_SESSION['nama_admin'] = $user['nama_admin'];
                    $_SESSION['status_aktif'] = $user['status_aktif'];

                    echo "success";
                } else {
                    echo "Invalid username or password.";
                }
            } else {
                echo "Invalid username or password.";
            }
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    } else {
        echo "Please fill in all fields.";
    }
} else {
    echo "Invalid request method.";
}
?>
