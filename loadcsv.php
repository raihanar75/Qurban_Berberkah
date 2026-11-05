<?php 
    require "sambungkan.php"; 
	if(isset($_POST['submit']))
    {
         $file = $_FILES['userfile']['tmp_name']; 
         
			// Mendapatkan ekstensi file csv yang akan diimport.
			$ekstensi  = explode('.', $_FILES['userfile']['name']);

			// Tampilkan peringatan jika submit tanpa memilih menambahkan file.
			if (empty($file)) {
		        	echo 'Data tidak berhasil disimpan. File tidak boleh kosong!';   
			} else {
				// Validasi apakah file yang diupload benar-benar file csv.
				if (strtolower(end($ekstensi)) === 'csv' && $_FILES["userfile"]["size"] > 0) {

					$i = 0;
					$handle = fopen($file, "r");
					while (($row = fgetcsv($handle, 2048)) ) {
						$i++;
						if ($i == 1) continue;
 
						// Data yang akan disimpan ke dalam database
                   $sql = "INSERT INTO kustomer (nama_lengkap, jenis_hewan, alamat, total_bayar, tgl_bayar) VALUES
                             ('". $row[0] ."', '". $row[1] ."', '". $row[2] ."', '".$row[3]."', '". $row[4] ."')";
                         //echo $sql;  
                        if (mysqli_query($conn, $sql)) {
                            echo "Data berhasil disimpan";
                        } else {
                            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
                        }
						 	}
				  	fclose($handle); 
				} else {
					echo 'Data tidak berhasil disimpan. Format file tidak valid!'; 
				}
			}
    }
?>
<!doctype html>
<html lang="en">
 
	<body class="wide hero">
        <form class="form form-horizontal" method="post" enctype="multipart/form-data">
            <span>Upload File</span><input name="userfile" type="file"> 
            <input type="submit" value="Ajukan"  name="submit"><br/><br/>
        </form>

        <table id="example" class="display" style="width:100%">
            <thead>
                <tr> 
                    <th>No</th>
                    <th>Nama Lengkap</th>
                    <th>Jenis Hewan</th>
                    <th>Alamat</th>
                    <th>Total Bayar</th>
                    <th>Tanggal Bayar</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                $sqlproduct = "SELECT * FROM kustomer";
                $result = mysqli_query($conn, $sqlproduct);
                $no = 1;
                while ($row = mysqli_fetch_array($result)) { 
                ?>
                <tr>
                    <td><?php echo $no; ?></td>
                    <td><?php echo $row["nama_lengkap"]; ?></td>
                    <td><?php echo $row["jenis_hewan"]; ?></td>
                    <td><?php echo $row["alamat"]; ?></td>
                    <td><?php echo $row["total_bayar"]; ?></td>
                    <td><?php echo $row["tgl_bayar"]; ?></td>
                </tr>
                <?php $no++; } ?>
            </tbody>
        </table>
	</body>
</html>
