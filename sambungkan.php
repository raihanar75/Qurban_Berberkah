<?php
$servername = "localhost";
$database = "2230511037";
$username = "root";
$password = "";

// $servername = "localhost";
// $database = "u341021167_kelasa";
// $username = "u341021167_kelasa";
// $password = "Kelasa_123";
 
// untuk tulisan bercetak tebal silakan sesuaikan dengan detail database Anda
// membuat koneksi
$conn = mysqli_connect($servername, $username, $password, $database);
// mengecek koneksi
if (!$conn) {
    die("Koneksi gagal: " . mysqli_connect_error());
}
//echo "Koneksi berhasil";
//mysqli_close($conn);
?>