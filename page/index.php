<?php include '../include/config.php'; ?>
<?php include '../include/auth_check.php'; ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perpustakaan Ku</title>
    <link href="https://cdn.lineicons.com/4.0/lineicons.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLR9IcS0VygCj5P3CZXJ8Ez+XHjq9QJmK2s7WFu8Zt" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/style.css">
</head>

<body>
    <div class="wrapper">
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
                    <a href="" class="sidebar-link">
                        <span>dasboard</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a href="#" class="sidebar-link collapsed has-dropdown" data-bs-toggle="collapse"
                        data-bs-target="#dataEntry" aria-expanded="false" aria-controls="dataEntry">
                        <span>Entry Data</span>
                    </a>
                    <ul id="dataEntry" class="sidebar-dropdown list-unstyled collapse" data-bs-parent="#sidebar">
                        <li class="sidebar-item">
                            <a href="anggota/anggota.php" class="sidebar-link">Data Anggota</a>
                        </li>
                        <li class="sidebar-item">
                            <a href="buku/buku.php" class="sidebar-link">Data Buku</a>
                        </li>
                        <li class="sidebar-item">
                            <a href="transaksi/transaksi.php" class="sidebar-link">Transaksi Peminjaman</a>
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
                            <a href="laporan/lap_anggota.php" class="sidebar-link">Lap. Data Anggota</a>
                        </li>
                        <li class="sidebar-item">
                            <a href="laporan/lap_buku.php" class="sidebar-link">Lap. Data Buku</a>
                        </li>
                    </ul>
                </li>
            </ul>
            <div class="sidebar-footer">
                <a href="logout.php" class="sidebar-link">
                    <span>Logout</span>
                </a>
            </div>
        </aside>

        <div class="main">
            <!-- Header -->
            <header class="d-flex justify-content-between align-items-center p-3 mb-3 border-bottom"
                style="background-color: #0e2238; color: #FFF;">
                <div class="d-flex align-items-center">
                    <h1>Perpus ku</h1>
                </div>
            </header>

            <!-- Main Content -->
            <div class="content">
                <div class="crossfade-container">
                    <img src="../img/poster2.png" class="visible">
                    <img src="../img/poster1.png" class="hidden">
                    <img src="../img/poster3.png" class="hidden">
                </div>
            </div>

            <!-- Footer -->
            <footer class="text-center mt-4 p-3 border-top">
                <p>&copy; 2024 Perpus ku. All rights reserved.</p>
            </footer>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe"
        crossorigin="anonymous"></script>
    <script src="../js/script.js"></script>
</body>

</html>