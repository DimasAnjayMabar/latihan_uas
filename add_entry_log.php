<?php
    require('includes/connection.php');

    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id-resi'])) {
        $idResi = filter_input(INPUT_POST, 'id-resi', FILTER_SANITIZE_NUMBER_INT);
        if($idResi){
            $query = "select * from transaksi where id_transaksi = ?";
            $stmt = $conn -> prepare($query);
            $stmt -> execute([$idResi]);
            $resi = $stmt -> fetch(PDO::FETCH_ASSOC);
        }
    }
?>

<?php
// require('includes/connection.php');

// if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id-resi'])) {
//     // Sanitize input
//     $idResi = filter_input(INPUT_POST, 'id-resi', FILTER_SANITIZE_NUMBER_INT);

//     if ($idResi) {
//         $query = "SELECT * FROM transaksi WHERE id_transaksi = ?";
//         $stmt = $conn->prepare($query);
//         $stmt->execute([$idResi]);
//         $resi = $stmt->fetch(PDO::FETCH_ASSOC);
//     }
// }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <?php
        require('includes/head.php');
        session_start();
    ?>
</head>
<body>
    <nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container-fluid">
            <a class="navbar-brand" href="#" style="font-weight: bold;">Halo, <?php echo isset($_SESSION['nama_admin']) ? htmlspecialchars($_SESSION['nama_admin']) : 'Guest'; ?></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="#">Data Resi Pengiriman</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#" data-bs-toggle="modal" data-bs-target="#logoutModal">Logout</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <nav class="container" style="margin-top: 15%;">
        <nav class="container-fluid" style="background-color: black; text-align: center;">
            <h1 style="color: white; margin-top: 2%;" class="">RESI : <?php echo $resi['nomor_resi']?></h1>
            <form id="submit-resi" method="POST" action="function/add_resi.php" enctype="multipart/form-data">
                <!-- <div class="mb-3">
                    <label for="username" class="form-label" style="color: white; margin-top: 2%;">Tanggal</label>
                    <input type="date" class="form-control" id="tanggal" name="tanggal">
                </div> -->
                <div class="mb-3">
                    <div class="mb-3">
                        <label for="username" class="form-label" style="color: white;">Nomor Resi</label>
                        <input type="resi" class="form-control" id="resi" name="resi">
                        <div class="error" id="resiError"></div>
                    </div>
                </div>
                <button type="button" class="btn btn-primary" style="margin-bottom: 2%;" data-bs-target="#confirmationModal" data-bs-toggle="modal">Tambah</button>
            </form>
        </nav>
    </nav>

    <div class="container" style="text-align: center">
        <table class="table" style="margin-top: 5%;">
            <thead>
                <tr>
                    <th scope="col">Tanggal</th>
                    <th scope="col">Nomor Resi</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    if($resi){
                        foreach($resi as $row){
                            $noResi = $row['nomor_resi'];
                            $tanggal = $row['tanggal_resi'];

                            echo '
                                <tr>
                                    <td>' . $tanggal . '</td>
                                    <td>' . $noResi . '</td>
                                    <td>
                                        <button type="button" class="btn btn-primary" style="margin-bottom: 2%;" data-bs-target="#confirmationModal" data-bs-toggle="modal">Entry Log</button>
                                        <button type="button" class="btn btn-danger" style="margin-bottom: 2%;" data-bs-target="#confirmationModal" data-bs-toggle="modal">Hapus</button>
                                    </td>
                                </tr>
                            ';
                        }
                    }
                ?>
                <!-- <tr>
                    <th scope="row">1</th>
                    <td>Mark</td>
                    <td>Otto</td>
                    <td>@mdo</td>
                </tr>
                <tr>
                    <th scope="row">2</th>
                    <td>Jacob</td>
                    <td>Thornton</td>
                    <td>@fat</td>
                </tr>
                <tr>
                    <th scope="row">3</th>
                    <td colspan="2">Larry the Bird</td>
                    <td>@twitter</td>
                </tr> -->
            </tbody>
        </table>
    </div>

    <!-- Modal Start -->
    <div class="modal fade" id="confirmationModal" tabindex="-1" aria-labelledby="confirmationModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="confirmationModalLabel" style="color: #522e38 !important;">Konfirmasi Tambah Artikel</h5>
        </div>
        <div class="modal-body">
            Apakah Anda yakin ingin menyimpan resi baru?
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-lg btn-primary rounded-pill custom-button" data-bs-dismiss="modal">Batal</button>
            <button type="button" class="btn btn-lg btn-primary rounded-pill custom-button" data-bs-dismiss="modal" onclick="handleSave()">Simpan</button>
        </div>
        </div>
    </div>
    </div>
    <!-- Modal End -->

    <!-- Modal Start -->
    <div class="modal fade" id="logoutModal" tabindex="-1" aria-labelledby="logoutModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="logoutModalLabel" style="color: #522e38 !important;">Konfirmasi Keluar</h5>
                </div>
                <div class="modal-body">
                    Apakah Anda yakin ingin keluar?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-lg btn-primary rounded-pill custom-button" data-bs-dismiss="modal">Batal</button>
                    <button type="button" class="btn btn-lg btn-primary rounded-pill custom-button" onclick="handleLogout()">Keluar</button>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal End -->

    <?php
        require('includes/foot.php');
        require('script/add_resi.php');
    ?>
</body>
</html>