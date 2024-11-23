<?php
// Periksa apakah data POST telah diterima
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama = htmlspecialchars($_POST['nama']);
    $email = htmlspecialchars($_POST['email']);
    $nomor = htmlspecialchars($_POST['nomor']);
    $pesan = htmlspecialchars($_POST['pesan']);

    // Periksa apakah semua field telah diisi
    if (empty($nama) || empty($email) || empty($nomor) || empty($pesan)) {
        echo json_encode(["status" => "error", "message" => "Semua field harus diisi!"]);
        exit;
    }

    // Kirim email (gunakan fungsi mail atau simpan ke database)
    $to = "your-email@example.com"; // Ganti dengan email Anda
    $subject = "Pesan Baru dari $nama";
    $message = "Nama: $nama\nEmail: $email\nNomor: $nomor\nPesan:\n$pesan";
    $headers = "From: $email";

    if (mail($to, $subject, $message, $headers)) {
        echo json_encode(["status" => "success", "message" => "Pesan Anda berhasil dikirim!"]);
    } else {
        echo json_encode(["status" => "error", "message" => "Pesan gagal dikirim. Silakan coba lagi nanti."]);
    }
} else {
    echo json_encode(["status" => "error", "message" => "Metode pengiriman tidak valid."]);
}
?>
