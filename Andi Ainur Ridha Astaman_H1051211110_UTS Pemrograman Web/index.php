<?php
require "session.php";
require "koneksi.php";
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <title>Stock Barang - Toko Dhaqilqin</title>
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
    <link href="css/styles.css" rel="stylesheet" />
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
        crossorigin="anonymous"></script>
    <script src="js/scripts.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js"
        crossorigin="anonymous"></script>
    <script src="js/datatables-simple-demo.js"></script>
</head>

<!--Navbar Atas-->
<body class="sb-nav-fixed">
    <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
        <!-- Navbar Brand-->
        <a class="navbar-brand ps-3" href="index.php">Toko Dhaqilqin</a>
        <!-- Sidebar Toggle-->
        <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i
                class="fas fa-bars"></i></button>
    </nav>

<!--Navbar Samping-->
    <div id="layoutSidenav">
        <div id="layoutSidenav_nav">
            <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                <div class="sb-sidenav-menu">
                    <div class="nav">
                        <div class="sb-sidenav-menu-heading">Menu</div>
                        <a class="nav-link" href="index.php">
                            <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                            Stock Barang
                        </a>
                        <a class="nav-link" href="barangmasuk.php">
                            <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                            Barang Masuk
                        </a>
                        <a class="nav-link" href="barangkeluar.php">
                            <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                            Barang Keluar
                        </a>
                        <a class="nav-link" href="logout.php">
                            Logout
                        </a>
                    </div>
                </div>
            </nav>
        </div>

        <!--Isi Index-->
        <div id="layoutSidenav_content">
            <main>
                <div class="container-fluid px-4">
                    <h1 class="mt-4">Stock Barang</h1>

                    <div class="card mb-4">
                        <div class="card-header">
                            <!-- Button trigger modal -->
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                data-bs-target="#staticBackdrop">
                                Tambah Barang
                            </button>

                            <!-- Modal -->
                            <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static"
                                data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel"
                                aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h1 class="modal-title fs-5" id="staticBackdropLabel">Tambah Barang</h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <!--Form untuk mengisi data yang akan masuk ke database-->
                                            <form method="post">
                                                <input type="text" name="namabarang" placeholder="Nama Barang"
                                                    class="form-control" required><br>
                                                <input type="text" name="deskripsi" placeholder="Deskripsi Barang"
                                                    class="form-control" required><br>
                                                <input type="number" name="jumlah" placeholder="Jumlah"
                                                    class="form-control" required><br>
                                                <div class="modal-footer">
                                                    <button type="submit" class="btn btn-primary"
                                                        name="tambahbarang">Simpan</button>
                                                </div>
                                            </form>

                                            <!--Aliran Kontrol dan fungsi php untuk menambah dan menampilkan data yang telah diisi ke database-->
                                            <?php
                                            if (isset($_POST['tambahbarang'])) {
                                                $namabarang = $_POST['namabarang'];
                                                $deskripsi = $_POST['deskripsi'];
                                                $jumlah = $_POST['jumlah'];

                                                $isitabel = mysqli_query($connect, "INSERT INTO barang (nama_barang, deskripsi, jumlah) VALUES ('$namabarang','$deskripsi','$jumlah')");

                                                if ($isitabel) {
                                                    
                                                } else {
                                                    echo "Gagal memasukkan barang";
                                                    header('location: index.php');
                                                }
                                            }
                                            ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!--Isi dalam tabel-->
                        <div class="card-body">
                            <table id="datatablesSimple">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama Barang</th>
                                        <th>Deskripsi</th>
                                        <th>Jumlah</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <!--Aliran Kontrol dan Fungsi untuk menampilkan data pada database-->
                                    <?php
                                    $databarang = mysqli_query($connect, "SELECT * FROM barang");
                                    $i= 1;
                                    while ($data = mysqli_fetch_array($databarang)) {
                                        $namabarang = $data['nama_barang'];
                                        $deskripsi = $data['deskripsi'];
                                        $jumlah = $data['jumlah'];
                                        $idb = $data['id_barang'];
                                    ?>
                                        <tr>
                                            <td>
                                                <?= $i++; ?>
                                            </td>
                                            <td>
                                                <?= $namabarang; ?>
                                            </td>
                                            <td>
                                                <?= $deskripsi; ?>
                                            </td>
                                            <td>
                                                <?= $jumlah; ?>
                                            </td>
                                            <td>
                                                <!--Codingan tombol hapus pada html-->
                                                <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#delete<?= $idb;?>">
                                                    Hapus
                                                </button>
                                                <div class="modal fade" id="delete<?= $idb;?>">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h1 class="modal-title fs-5">Hapus Barang</h1>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <form method="post">
                                                                    <p>Apakah anda yakin ingin menghapus <?= $namabarang;?>?
                                                                    <input type="hidden" name="idb" value="<?= $idb;?>"></p>
                                                                    <div class="modal-footer">
                                                                        <button type="submit" class="btn btn-danger" name="hapusbarang">Hapus</button>
                                                                    </div>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    <?php
                                    }   
                                    ;

                                    //Aliran kontrol untuk menghapus barang
                                    if (isset($_POST['hapusbarang'])){
                                        $idyangdihapus = $_POST['idb'];

                                        $hapus = mysqli_query($connect, "DELETE FROM barang WHERE id_barang='$idyangdihapus'");
                                        if ($hapus) {

                                        } else {
                                            echo "Gagal menghapus barang";
                                            header('location: index.php');
                                        }
                                    }

                                    ?>         
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </main>

            <!--Menampilkan Footer-->
            <footer class="py-4 bg-light mt-auto">
                <div class="container-fluid px-4">
                    <div class="d-flex align-items-center justify-content-between small">
                        <div class="text-muted">Copyright &copy; Toko Dhaqilqin 2023</div>
                    </div>
                </div>
            </footer>
        </div>
    </div>
</body>

</html>