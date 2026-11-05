<?php
require 'sambungkan.php';

// Query untuk mengambil data dari database
$query = "SELECT * FROM product";
// $query = "SELECT * FROM 2230511037_t_product";
$result = mysqli_query($conn, $query);

if (!$result) {
    die("Query gagal dijalankan: " . mysqli_error($conn));
}

mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Basic -->
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <!-- Mobile Metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <!-- Site Metas -->
    <meta name="keywords" content="" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Qurban Berberkah</title>
    
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

    <style>
        .custom-img-size {
            width: 75px;
            height: 50px;
            object-fit: cover;
            object-position: center;
        }
    </style>
</head>

<body class="sub_page">
    <div class="hero_area">
        <header class="header_section">
        <div class="container">
            <nav class="navbar navbar-expand-lg custom_nav-container ">
            <a class="navbar-brand" href="hewan.php">
                <span>
                Hewan Qurban
                </span>
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="s-1"> </span>
                <span class="s-2"> </span>
                <span class="s-3"> </span>
            </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav">
                        <li class="nav-item"><a class="nav-link" href="index.html">Home</a></li>
                        <li class="nav-item"><a class="nav-link" href="tambah.php">Pesan</a></li>
                        <li class="nav-item"><a class="nav-link" href="loadcsv.php">Upload CSV</a></li>
                    </ul>
                </div>
            </nav>
        </div>
        </header>
    </div>
    <section class="service_section layout_service">
        <div class="container">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Gambar</th>
                        <th>Nama Hewan</th>
                        <th>Harga</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (mysqli_num_rows($result) > 0): ?>
                        <?php while($row = mysqli_fetch_assoc($result)): ?>
                            <tr>
                                <td><img src="images/<?= $row['image']; ?>" class="img-fluid custom-img-size" alt="<?= $row['hewan']; ?>"></td>
                                <td><?= $row['hewan']; ?></td>
                                <td>Rp. <?= number_format($row['transfer'], 0, ',', '.'); ?></td>
                                <td>
                                    <a class="btn btn-success" href="signatur.php?jenis_hewan=<?= urlencode($row['hewan']); ?>&total_bayar=<?= urlencode($row['transfer']); ?>">Buat Laporan</a>
                                    <a class="btn btn-primary" href="edit.php?id=<?= $row['id']; ?>">Edit</a>
                                    <a class="btn btn-danger" href="hapus.php?id=<?= $row['id']; ?>" onclick="return confirm('Anda yakin ingin menghapus data ini?');">Hapus</a>
                                </td>
                            </tr>
                        <?php endwhile; ?>  
                    <?php else: ?>
                        <tr>
                            <td colspan="4" class="text-center">Tidak ada barang yang ditemukan.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </section>
    <!-- Tambahkan script Bootstrap di sini -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>
