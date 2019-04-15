<?php
$servername = "localhost";
$database = "wonogiri_db_skripsi";
$username = "wonogiri_user";
$password = "user1234USER";

// untuk tulisan bercetak tebal silakan sesuaikan dengan detail database Anda
// membuat koneksi
$conn = mysqli_connect($servername, $username, $password, $database);
$sql ="CREATE TABLE IF NOT EXISTS tb_skripsi (waktu TEXT, ip TEXT, browser TEXT, device TEXT, nama TEXT, alamat TEXT, koordinat TEXT, verifikasi TEXT) ENGINE=INNODB";
// mengecek koneksi
if (!$conn) {
    die("Server Error" . mysqli_connect_error());
} else {
	$conn->query($sql);
	echo "Thanks!";
}

?>