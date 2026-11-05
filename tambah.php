<?php
require 'sambungkan.php';

// Inisialisasi variabel untuk menyimpan pesan
$message = "";

// Cek apakah form telah disubmit
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $hewan = $_POST['hewan'];
    $transfer = $_POST['transfer'];
    $image = $_FILES['image']['name'];
    $target_dir = "images/";
    $target_file = $target_dir . basename($image);
    
    // Upload gambar
    if (move_uploaded_file($_FILES['image']['tmp_name'], $target_file)) {
        // Menyimpan data ke database
        $query = "INSERT INTO product (hewan, transfer, image) VALUES ('$hewan', '$transfer', '$image')";
        // $query = "INSERT INTO 2230511037_t_product (hewan, transfer, image) VALUES ('$hewan', '$transfer', '$image')";
        if (mysqli_query($conn, $query)) {
            echo "<script>alert('Data berhasil ditambahkan'); 
            window.location = 'hewan.php';</script>";
        } else {
            $message = "Error: " . $query . "<br>" . mysqli_error($conn);
        }
    } else {
        $message = "Maaf, terjadi kesalahan saat mengupload file.";
    }
}

mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="en">

<head>
<meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <!-- Mobile Metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <!-- Site Metas -->
    <meta name="keywords" content="" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Hewan Qurban</title>
    <!-- Tambahkan link stylesheet Bootstrap di sini -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- Tambahkan link stylesheet Font Awesome di sini -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <!-- slider stylesheet -->
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.1.3/assets/owl.carousel.min.css" />
    <!-- bootstrap core css -->
    <link rel="stylesheet" type="text/css" href="css/bootstrap.css" />

    <!-- fonts style -->
    <link href="https://fonts.googleapis.com/css?family=Poppins:400,600,700&display=swap" rel="stylesheet">
    <!-- Custom styles for this template -->
    <link href="css/style.css" rel="stylesheet" />
    <!-- responsive style -->
    <link href="css/responsive.css" rel="stylesheet" />
</head>

<body class="sub_page">
        <div class="hero_area">
            <header class="header_section">
                <div class="container">
                    <nav class="navbar navbar-expand-lg custom_nav-container">
                    <a class="navbar-brand" href="tambah.php">
                        <span>
                            Pilih Hewan Qurban
                        </span>
                    </a>
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav">
                            <li class="nav-item"><a class="nav-link" href="hewan.php">Dasboard</a></li>
                        </ul>
                    </div>
                </div>
            </header>
        </div>
    </nav>

    <div class="container">
        <!-- Menampilkan pesan -->
        <?php if ($message): ?>
            <div class="alert alert-info">
                <?= $message; ?>
            </div>
        <?php endif; ?>

        <form action="tambah.php" method="post" enctype="multipart/form-data">
            <div class="form-group">
                <label for="hewan">Pilih Hewan:</label>
                <input type="text" class="form-control" id="hewan" name="hewan" required>
            </div>
            <div class="form-group">
                <label for="transfer">Transfer:</label>
                <input type="number" class="form-control" id="transfer" name="transfer" required>
            </div>
            <div class="form-group">
                <label for="image">Upload Bukti Transfer:</label>
                <input type="file" class="form-control-file" id="image" name="image" required>
            </div>
            <button type="submit" class="btn btn-primary">Tambah</button>
        </form>
    </div>

    <!-- Tambahkan script Bootstrap di sini -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>
