<?php
    require "session.php";
    require "koneksi.php";
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <title>Barang Masuk - Toko Dhaqilqin</title>
        <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
        <link href="css/styles.css" rel="stylesheet" />
        <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="js/scripts.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js" crossorigin="anonymous"></script>
        <script src="js/datatables-simple-demo.js"></script>
    </head>
    <body class="sb-nav-fixed">
        <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
            <!-- Navbar Brand-->
            <a class="navbar-brand ps-3" href="index.php">Toko Dhaqilqin</a>
            <!-- Sidebar Toggle-->
            <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i class="fas fa-bars"></i></button>
        </nav>
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
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid px-4">
                        <h1 class="mt-4">Barang Masuk</h1>

                        <div class="card mb-4">
                            <div class="card-header">
                                <!-- Button trigger modal -->
                                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                                    Tambah Barang Masuk
                                </button>

                                <!-- Modal -->
                                <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" 
                                    data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" 
                                    aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h1 class="modal-title fs-5" id="staticBackdropLabel">Tambah Barang Masuk</h1>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                    <div class="modal-body">
                                        <form method="post">
                                            <select name="barangterdaftar" class="form-control">
                                                <!--Aliran Kontrol dan fungsi untuk menampilkan opsi barang-->
                                                <?php
                                                    $ambildatabarang = mysqli_query($connect, "SELECT * FROM barang");
                                                    while ($fetcharray = mysqli_fetch_array($ambildatabarang)){
                                                        $namabarangmasuk = $fetcharray['nama_barang'];
                                                        $idbarangmasuk = $fetcharray['id_barang'];
                                                ?>
                                                <option value="<?=$idbarangmasuk;?>">
                                                    <?=$namabarangmasuk;?>
                                                </option>
                                                <?php
                                                    }
                                                ?>
                                            </select><br>
                                            <!--Form untuk mengisi data-->
                                            <input type="number" name="qty" placeholder="Jumlah" class="form-control" required><br>
                                            <input type="text" name="penjual" placeholder="Penjual" class="form-control" required><br>
                                            <div class="modal-footer">
                                                <button type="submit" class="btn btn-primary" name="tambahbarangmasuk">Simpan</button>
                                            </div>
                                        </form>
                                        <!--Aliran kontrol dan fungsi untuk menambah form yang telah diisi ke tabel dan update isi barang-->
                                        <?php
                                            if(isset($_POST['tambahbarangmasuk'])){
                                                $barangterdaftar = $_POST['barangterdaftar'];
                                                $qty = $_POST['qty'];
                                                $penjual = $_POST['penjual'];
                                            
                                                $cekjumlahbarang = mysqli_query($connect, "SELECT * FROM barang WHERE id_barang='$barangterdaftar'");
                                                $ambildata = mysqli_fetch_array($cekjumlahbarang);

                                                $jumlahsekarang = $ambildata['jumlah'];
                                                $jumlahbarangsekarangdanmasuk = $jumlahsekarang+$qty;

                                                $isitabelmasuk = mysqli_query($connect, "INSERT INTO barang_masuk (id_barang, qty, keterangan) VALUES ('$barangterdaftar','$qty','$penjual')");
                                                $updatejumlahmasuk = mysqli_query($connect, "UPDATE barang SET jumlah='$jumlahbarangsekarangdanmasuk' WHERE id_barang='$barangterdaftar'");

                                                if ($isitabelmasuk && $updatejumlahmasuk){
                                                    
                                                }
                                                else {
                                                    echo "Gagal memasukkan barang";
                                                    header ('location: barangmasuk.php');
                                                }
                                            }
                                        ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <table id="datatablesSimple">
                                <thead>
                                    <tr>
                                        <th>Tanggal</th>
                                        <th>Nama Barang</th>
                                        <th>Jumlah</th>
                                        <th>Penjual</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <!--Aliran Kontrol dan Fungsi untuk menampilkan isi tabel yang masuk dari database-->
                                    <?php
                                        $databarang = mysqli_query($connect, "SELECT * FROM barang_masuk m, barang s WHERE s.id_barang = m.id_barang");
                                        while ($data=mysqli_fetch_array($databarang)){
                                            $tanggal = $data['tanggal_masuk'];
                                            $namabarang = $data['nama_barang'];
                                            $qty = $data['qty'];
                                            $keterangan = $data['keterangan'];
                                            
                                    ?>
                                    <tr>
                                        <td><?=$tanggal;?></td>
                                        <td><?=$namabarang;?></td>
                                        <td><?=$qty;?></td>
                                        <td><?=$keterangan;?></td>
                                    </tr>
                                    <?php
                                        };
                                    ?>                                    
                                </tbody>
                            </table>
                        </div>
                    </div>
                </main>
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