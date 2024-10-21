<?php
session_start();
require '../../include/config.php'; 

if (isset($_GET['id'])) {
    $id_anggota = $_GET['id'];

    
    if (is_numeric($id_anggota)) {

        $stmt = $pdo->prepare("DELETE FROM db_anggota WHERE id_anggota = :id_anggota");

        $stmt->bindParam(':id_anggota', $id_anggota, PDO::PARAM_INT);

        if ($stmt->execute()) {
           
            header('Location: anggota.php');
            exit;
        } else {
            echo "Gagal menghapus data.";
        }
    } else {
        echo "ID anggota tidak valid.";
    }
} else {
    echo "ID anggota tidak ditemukan.";
}

