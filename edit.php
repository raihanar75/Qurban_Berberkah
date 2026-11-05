<?php
require 'sambungkan.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $query = "SELECT * FROM product WHERE id = $id";
    // $query = "SELECT * FROM 2230511037_t_product WHERE id = $id";
    $result = mysqli_query($conn, $query);
    $product = mysqli_fetch_assoc($result);
}

if (isset($_POST['update'])) {
    $hewan = $_POST['hewan'];
    $transfer = $_POST['transfer'];
    $image = $_POST['image'];

    $query = "UPDATE product SET hewan = '$hewan', transfer = '$transfer', image = '$image' WHERE id = $id";
    // $query = "UPDATE 2230511037_t_product SET hewan = '$hewan', transfer = '$transfer', image = '$image' WHERE id = $id";

    if (mysqli_query($conn, $query)) {
        echo "<script>alert('Data berhasil diperbarui'); window.location = 'hewan.php';</script>";
    } else {
        echo "Error: " . mysqli_error($conn);
    }

    mysqli_close($conn);
}
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
    <title>Edit Produk</title>
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
            <div class="container mt-5">
                <h2 class="text-center">Edit Produk</h2>
                <form method="post">
                    <div class="form-group">
                        <label for="hewan">Hewan</label>
                        <input type="text" class="form-control" id="hewan" name="hewan" value="<?= $product['hewan']; ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="transfer">Harga Transfer</label>
                        <input type="number" class="form-control" id="transfer" name="transfer" value="<?= $product['transfer']; ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="image">Upload Bukti Transfer</label>
                        <input type="file" class="form-control-file" id="image" name="image" value="<?= $product['image']; ?>" required>
                    </div>
                    <button type="submit" class="btn btn-primary" name="update">Update</button>
                </form>
            </div>
    </header>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
