<?php
session_start();
require '../../include/config.php';

// Ambil data buku dan anggota dari database untuk dropdown
$bukuQuery = $pdo->query("SELECT id_buku, judul_buku FROM db_buku");
$bukuOptions = $bukuQuery->fetchAll(PDO::FETCH_ASSOC);

$anggotaQuery = $pdo->query("SELECT id_anggota, nama_anggota FROM db_anggota");
$anggotaOptions = $anggotaQuery->fetchAll(PDO::FETCH_ASSOC);

// Periksa apakah form telah disubmit
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Ambil data dari form
    $id_buku = $_POST['id_buku'] ?? [];
    $id_anggota = $_POST['id_anggota'] ?? '';
    $tanggal_pinjam = $_POST['tanggal_pinjam'] ?? '';
    $tanggal_kembali = $_POST['tanggal_kembali'] ?? '';
    $status = $_POST['status'] ?? '';

    // Validasi jika ada data yang kosong
    if (empty($id_buku) || empty($id_anggota) || empty($tanggal_pinjam) || empty($tanggal_kembali) || empty($status)) {
        die("Semua field harus diisi.");
    }

    // Pastikan $id_buku adalah array
    if (!is_array($id_buku)) {
        $id_buku = [$id_buku];
    }

    // Loop untuk menyimpan setiap transaksi peminjaman
    foreach ($id_buku as $buku) {
        // Persiapkan statement SQL
        $stmt = $pdo->prepare("INSERT INTO transaksi_peminjaman (id_buku, id_anggota, tanggal_pinjam, tanggal_kembali, status) VALUES (:id_buku, :id_anggota, :tanggal_pinjam, :tanggal_kembali, :status)");

        if ($stmt === false) {
            die("Error preparing statement: " . htmlspecialchars($pdo->errorInfo()[2]));
        }

        // Bind parameter
        $stmt->bindParam(':id_buku', $buku);
        $stmt->bindParam(':id_anggota', $id_anggota);
        $stmt->bindParam(':tanggal_pinjam', $tanggal_pinjam);
        $stmt->bindParam(':tanggal_kembali', $tanggal_kembali);
        $stmt->bindParam(':status', $status);

        // Execute statement
        $executeResult = $stmt->execute();

        if ($executeResult === false) {
            die("Error executing statement: " . htmlspecialchars($stmt->errorInfo()[2]));
        }
    }

    // Redirect ke halaman transaksi
    header('Location: transaksi.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perpustakaan Ku - Data Transaksi Peminjaman</title>
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
                            <a href="../buku/buku.php" class="sidebar-link">Data Buku</a>
                        </li>
                        <li class="sidebar-item">
                            <a href="transaksi.php" class="sidebar-link">Transaksi Peminjaman</a>
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
                    <form action="tambah_transaksi.php" method="POST" class="form-book">
                        <h2>Tambah Transaksi Peminjaman</h2>
                        <div class="form-group">
                            <label for="id_buku">ID Buku:</label>
                            <select id="id_buku" name="id_buku" required>
                                <option value="5">Pilih Buku</option>
                                <?php foreach ($bukuOptions as $buku): ?>
                                    <option value="<?php echo htmlspecialchars($buku['id_buku']); ?>">
                                        <?php echo htmlspecialchars($buku['judul_buku']); ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="id_anggota">ID Anggota:</label>
                            <select id="id_anggota" name="id_anggota" required>
                                <option value="">Pilih Anggota</option>
                                <?php foreach ($anggotaOptions as $anggota): ?>
                                    <option value="<?php echo htmlspecialchars($anggota['id_anggota']); ?>">
                                        <?php echo htmlspecialchars($anggota['nama_anggota']); ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="tanggal_pinjam">Tanggal Pinjam:</label>
                            <input type="date" id="tanggal_pinjam" name="tanggal_pinjam" required>
                        </div>
                        <div class="form-group">
                            <label for="tanggal_kembali">Tanggal Kembali:</label>
                            <input type="date" id="tanggal_kembali" name="tanggal_kembali" required>
                        </div>
                        <div class="form-group">
                            <label>Status:</label>
                            <div>
                                <label><input type="radio" name="status" value="dipinjam" required />
                                    Dipinjam</label>
                                <label><input type="radio" name="status" value="dikembalikan" required />
                                    Dikembalikan</label>
                                <label><input type="radio" name="status" value="terlambat" required />
                                    Terlambat</label>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </form>
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