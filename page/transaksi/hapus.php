<?php
session_start();
require '../../include/config.php';

// Cek apakah ada ID transaksi yang dikirim untuk dihapus
if (isset($_GET['id'])) {
    $delete_id = $_GET['id'];

    // Hapus transaksi dari database
    $stmt = $pdo->prepare("DELETE FROM transaksi_peminjaman WHERE id_transaksi = :id_transaksi");
    $stmt->bindParam(':id_transaksi', $delete_id);
    $executeResult = $stmt->execute();

    if ($executeResult === false) {
        die("Error executing statement: " . htmlspecialchars($stmt->errorInfo()[2]));
    }

    // Redirect ke halaman transaksi setelah dihapus
    header('Location: transaksi.php');
    exit;
} else {
    die("ID transaksi tidak ditemukan.");
}
