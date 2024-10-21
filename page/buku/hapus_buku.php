<?php
session_start();
require '../../include/config.php'; 

if (isset($_GET['id'])) {
    $id_buku = $_GET['id'];

    
    if (is_numeric($id_buku)) {

        $stmt = $pdo->prepare("DELETE FROM db_buku WHERE id_buku = :id_buku");

        $stmt->bindParam(':id_buku', $id_buku, PDO::PARAM_INT);

        if ($stmt->execute()) {
           
            header('Location: buku.php');
            exit;
        } else {
            echo "Gagal menghapus data.";
        }
    } else {
        echo "ID buku tidak valid.";
    }
} else {
    echo "ID buku tidak ditemukan.";
}

