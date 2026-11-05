<?php
include 'sambungkan.php';

if (isset($_POST['submit'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $aktif = $_POST['aktif'];
    $role = $_POST['role'];

    // Periksa apakah file foto diunggah
    if (isset($_FILES['foto']) && $_FILES['foto']['error'] == 0) {
        $foto = $_FILES['foto']['name'];
        $target_dir = "images/";
        $target_file = $target_dir . basename($foto);
        
        // Cek apakah file tersebut adalah gambar
        $check = getimagesize($_FILES["foto"]["tmp_name"]);
        if ($check !== false) {
            // Pindahkan file yang diunggah ke direktori target
            if (move_uploaded_file($_FILES["foto"]["tmp_name"], $target_file)) {
                // Koneksi ke database
                $conn = new mysqli('localhost', 'root', '', '2230511037');
                
                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                }
                
                // Masukkan data pengguna ke database
                // $sql = "INSERT INTO 2230511037_t_user (username, password, aktif, role, foto) VALUES ('$username', '$password', '$aktif', '$role', '$foto')";
                $sql = "INSERT INTO user (username, password, aktif, role, foto) VALUES ('$username', '$password', '$aktif', '$role', '$foto')";
                
                if ($conn->query($sql) === TRUE) {
                    echo "
                    <script>
                    alert('Akun berhasil ditambahkan!');
                    document.location.href = 'hewan.php';
                    </script>
                    ";
                } else {
                    echo "Error: " . $sql . "<br>" . $conn->error;
                }
                
                $conn->close();
            } else {
                echo "<script>
                alert ('Akun gagal ditambahkan!');
                document.location.href = 'register.html';
                </script>";
            }
        } else {
            echo "<script>
                alert ('gambar gagal ditambahkan!');
                document.location.href = 'register.html';
                </script>";
        }
    } else {
        echo "<script>
                alert ('gambar eror');
                document.location.href = 'register.html';
                </script>";
    }
}
?>
