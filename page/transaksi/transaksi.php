<?php
session_start();
require '../../include/config.php';

$limit = 5;

$page = isset($_GET['page']) ? (int) $_GET['page'] : 1;

$start = ($page > 1) ? ($page * $limit) - $limit : 0;

$sql = "SELECT transaksi_peminjaman.id_transaksi, db_anggota.nama_anggota, db_buku.judul_buku, 
               transaksi_peminjaman.tanggal_pinjam, transaksi_peminjaman.tanggal_kembali,
               transaksi_peminjaman.status
        FROM transaksi_peminjaman 
        INNER JOIN db_anggota ON transaksi_peminjaman.id_anggota = db_anggota.id_anggota
        INNER JOIN db_buku ON transaksi_peminjaman.id_buku = db_buku.id_buku
        LIMIT :start, :limit";

$stmt = $pdo->prepare($sql);
$stmt->bindValue(':start', $start, PDO::PARAM_INT);
$stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
$stmt->execute();

$transaksi = $stmt->fetchAll(PDO::FETCH_ASSOC);

$total_sql = "SELECT COUNT(*) FROM transaksi_peminjaman";
$total_stmt = $pdo->query($total_sql);
$total = $total_stmt->fetchColumn();

$total_pages = ceil($total / $limit);
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
                <div class="table-container">
                    <a href="tambah_transaksi.php" class="btn-add">Tambah Transaksi</a>
                    <table class="table">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Anggota</th>
                                <th>Judul Buku</th>
                                <th>Tanggal Pinjam</th>
                                <th>Tanggal Kembali</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($transaksi)): ?>
                                <?php foreach ($transaksi as $item): ?>
                                    <tr>
                                        <td><?php echo htmlspecialchars($item['id_transaksi']); ?></td>
                                        <td><?php echo htmlspecialchars($item['nama_anggota']); ?></td>
                                        <td><?php echo htmlspecialchars($item['judul_buku']); ?></td>
                                        <td><?php echo htmlspecialchars($item['tanggal_pinjam']); ?></td>
                                        <td><?php echo htmlspecialchars($item['tanggal_kembali']); ?></td>
                                        <td><?php echo htmlspecialchars($item['status']); ?></td>
                                        <td>
                                            <a href="hapus.php?id=<?php echo $item['id_transaksi']; ?>"
                                                class="btn btn-delete">Hapus</a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="6">Tidak ada data transaksi</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>

                    <!-- Pagination -->
                    <nav aria-label="Page navigation example">
                        <ul class="pagination justify-content-center">
                            <li class="page-item">
                                <a class="page-link" href="?page=1" aria-label="Previous">
                                    <span aria-hidden="true">&laquo;</span>
                                </a>
                            </li>
                            <?php for ($i = 1; $i <= $total_pages; $i++): ?>
                                <li class="page-item"><a class="page-link"
                                        href="?page=<?php echo $i; ?>"><?php echo $i; ?></a></li>
                            <?php endfor; ?>
                            <li class="page-item">
                                <a class="page-link" href="?page=<?php echo $total_pages; ?>" aria-label="Next">
                                    <span aria-hidden="true">&raquo;</span>
                                </a>
                            </li>
                        </ul>
                    </nav>

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