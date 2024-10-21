<?php
require '../../include/config.php';

// Periksa apakah form telah disubmit
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Ambil data dari form
    $judul_buku = $_POST['judul_buku'] ?? '';
    $penulis_buku = $_POST['penulis_buku'] ?? '';
    $penerbit = $_POST['penerbit'] ?? '';
    $tahun_terbit = $_POST['tahun_terbit'] ?? '';

    // Validasi jika ada data yang kosong
    if (empty($judul_buku) || empty($penulis_buku) || empty($penerbit) || empty($tahun_terbit)) {
        die("Semua field harus diisi.");
    }

    // Persiapkan statement SQL
    $stmt = $pdo->prepare("INSERT INTO db_buku (judul_buku, penulis_buku, penerbit, tahun_terbit) VALUES (:judul_buku, :penulis_buku, :penerbit, :tahun_terbit)");

    if ($stmt === false) {
        die("Error preparing statement: " . htmlspecialchars($pdo->errorInfo()[2]));
    }

    // Bind parameter
    $stmt->bindParam(':judul_buku', $judul_buku);
    $stmt->bindParam(':penulis_buku', $penulis_buku);
    $stmt->bindParam(':penerbit', $penerbit);
    $stmt->bindParam(':tahun_terbit', $tahun_terbit);

    // Execute statement
    $executeResult = $stmt->execute();

    if ($executeResult === false) {
        die("Error executing statement: " . htmlspecialchars($stmt->errorInfo()[2]));
    }

    // Redirect ke halaman buku
    header('Location: buku.php');
    exit;
}
?>



<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perpustakaan Ku - Tambah Buku</title>
    <link href="https://cdn.lineicons.com/4.0/lineicons.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLR9IcS0VygCj5P3CZXJ8Ez+XHjq9QJmK2s7WFu8Zt" crossorigin="anonymous">
    <link rel="stylesheet" href="../../css/style.css">
</head>

<body>
    <div class="wrapper">
        <!-- Sidebar -->
        <aside id="sidebar">
            <div class="d-flex">
                <button class="toggle-btn" type="button">
                    <i class="lni lni-grid-alt"></i>
                </button>
                <div class="sidebar-logo">
                    <a href="#">Menu</a>
                </div>
            </div>
            <ul class="sidebar-nav">
                <li class="sidebar-item">
                    <a href="../index.php" class="sidebar-link">
                        <span>Dashboard</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a href="#" class="sidebar-link collapsed has-dropdown" data-bs-toggle="collapse"
                        data-bs-target="#dataEntry" aria-expanded="false" aria-controls="dataEntry">
                        <span>Entry Data</span>
                    </a>
                    <ul id="dataEntry" class="sidebar-dropdown list-unstyled collapse" data-bs-parent="#sidebar">
                        <li class="sidebar-item">
                            <a href="../anggota/anggota.php" class="sidebar-link">Data Anggota</a>
                        </li>
                        <li class="sidebar-item">
                            <a href="buku.php" class="sidebar-link">Data Buku</a>
                        </li>
                        <li class="sidebar-item">
                            <a href="../transaksi/transaksi.php" class="sidebar-link">Transaksi Peminjaman</a>
                        </li>
                    </ul>
                </li>
                <li class="sidebar-item">
                    <a href="#" class="sidebar-link collapsed has-dropdown" data-bs-toggle="collapse"
                        data-bs-target="#laporan" aria-expanded="false" aria-controls="laporan">
                        <span>Laporan</span>
                    </a>
                    <ul id="laporan" class="sidebar-dropdown list-unstyled collapse" data-bs-parent="#sidebar">
                        <li class="sidebar-item">
                            <a href="../laporan/lap_anggota.php" class="sidebar-link">Lap. Data Anggota</a>
                        </li>
                        <li class="sidebar-item">
                            <a href="../laporan/lap_buku.php" class="sidebar-link">Lap. Data Buku</a>
                        </li>
                    </ul>
                </li>
            </ul>
            <div class="sidebar-footer">
                <a href="../logout.php" class="sidebar-link">
                    <span>Logout</span>
                </a>
            </div>
        </aside>

        <!-- Main Content -->
        <div class="main">
            <!-- Header -->
            <header class="d-flex justify-content-between align-items-center p-3 mb-3 border-bottom"
                style="background-color: #0e2238; color: #FFF;">
                <div class="d-flex align-items-center">
                    <h1>Perpus Ku</h1>
                </div>
            </header>

            <!-- Main Content -->
            <div class="container">
                <div class="form-book-container">
                    <form action="tambah_buku.php" method="POST" class="form-book">
                        <h2>Tambah Buku</h2>
                        <div class="form-group">
                            <label for="judul_buku">Judul Buku:</label>
                            <input type="text" id="judul_buku" name="judul_buku" required>
                        </div>
                        <div class="form-group">
                            <label for="penulis_buku">Nama Penulis:</label>
                            <input type="text" id="penulis_buku" name="penulis_buku" required>
                        </div>
                        <div class="form-group">
                            <label for="penerbit">Penerbit:</label>
                            <input type="text" id="penerbit" name="penerbit" required>
                        </div>
                        <div class="form-group">
                            <label for="tahun_terbit">Tahun Terbit:</label>
                            <div class="year-picker">
                                <button type="button" class="year-btn" onclick="changeYear(-1)">&#9660;</button>
                                <input type="text" id="tahun_terbit" name="tahun_terbit" value="2023" readonly>
                                <button type="button" class="year-btn" onclick="changeYear(1)">&#9650;</button>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </form>

                </div>
            </div>
        </div>

        <!-- Footer -->
        <footer class="text-center mt-4 p-3 border-top">
            <p>&copy; 2024 Perpus Ku. All rights reserved.</p>
        </footer>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe"
        crossorigin="anonymous"></script>
    <script src="../../js/script.js"></script>
</body>

</html>