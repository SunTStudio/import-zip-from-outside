<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Folder tujuan di server (misalnya di `htdocs/uploads`)
    $targetDir = __DIR__ . '/uploads/';
    if (!is_dir($targetDir)) {
        mkdir($targetDir, 0777, true);
    }

    // Periksa apakah ada file yang diunggah
    if (isset($_FILES['file'])) {
        $file = $_FILES['file'];
        
        // Periksa apakah file adalah ZIP
        $fileType = pathinfo($file['name'], PATHINFO_EXTENSION);
        if ($fileType !== 'zip') {
            echo "Hanya file ZIP yang diizinkan.";
            exit;
        }

        // Nama file tujuan
        $targetFile = $targetDir . basename($file['name']);

        // Pindahkan file ke folder tujuan
        if (move_uploaded_file($file['tmp_name'], $targetFile)) {
            echo "File berhasil diunggah: " . htmlspecialchars($file['name']);
        } else {
            echo "Terjadi kesalahan saat mengunggah file.";
        }
    } else {
        echo "Tidak ada file yang diunggah.";
    }
} else {
    echo "Metode tidak didukung.";
}
?>
