<?php
require 'sambungkan.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // $query = "DELETE FROM 2230511037_t_product WHERE id = $id";
    // Query untuk menghapus data berdasarkan id
    $query = "DELETE FROM product WHERE id = $id";
    // $delete = "select * from product where id = $id";
    // mysqli_query($conn, $query)
    // $image = $delete['image'];
    // var_dump($image);
    // die; 
 
    if (mysqli_query($conn, $query)) {
        // if(is_file())
        echo "<script>alert('Data berhasil dihapus'); window.location = 'hewan.php';</script>";
    } else {
        echo "Error: " . mysqli_error($conn);
    }

    mysqli_close($conn);
}
?>
