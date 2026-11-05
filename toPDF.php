<?php
session_start();
include "sambungkan.php";
include "qrcode/qrlib.php";

if (isset($_POST['submit'])) {
    $nama_lengkap = $_POST['nama_lengkap'];
    $jenis_hewan = $_POST['jenis_hewan'];
    $total_bayar = $_POST['total_bayar'];
    $alamat = $_POST['alamat'];
    $tanggal_pembayaran = $_POST['tanggal_pembayaran'];
    $signed = $_POST['signed'];

    if (!empty($nama_lengkap)) {
        $penyimpanan = "qrimg/";
        if (!file_exists($penyimpanan)) {
            mkdir($penyimpanan);
        }

        $isi = "https://localhost/2230511037/filepdf";
        $qrFilename = $penyimpanan.md5($nama_lengkap).".png";
        QRcode::png($isi, $qrFilename);

        $folderPath = "ttd/";
        if (!file_exists($folderPath)) {
            mkdir($folderPath);
        }

        $img = str_replace('data:image/png;base64,', '', $signed);
        $img = str_replace(' ', '+', $img);
        $data = base64_decode($img);
        $file = $folderPath.uniqid().".png";
        file_put_contents($file, $data);

        require('pdf/fpdf.php');

        class PDF extends FPDF {
            function Header() {
                // Logo
                $this->Image('logo/qurban.jpg', 10, 6, 20);
                $this->SetFont('Arial', 'B', 14);
                $this->Cell(0, 5, 'Qurban Berberkah', 0, 1, 'C');
                $this->SetFont('Arial', '', 12);
                $this->Cell(0, 5, 'Jl.Cikujang Kel.Dayeuhluhur Kec.Warudoyong', 0, 1, 'C');
                $this->Cell(0, 5, 'Provinsi Jawa Barat Indonesia', 0, 1, 'C');
                $this->Cell(0, 5, 'Tahun 2024', 0, 1, 'C');
                $this->Ln(10);
            }

            function Footer() {
                $this->SetY(-15);
                $this->SetFont('Arial', 'I', 8);
                $this->Cell(0, 10, 'Page '.$this->PageNo().'/{nb}', 0, 0, 'C');
            }

            function TableHeader() {
                $this->SetFont('Arial', 'B', 12);
                $this->SetFillColor(200, 220, 255);
                $this->Cell(50, 10, 'Keterangan', 1, 0, 'C', true);
                $this->Cell(140, 10, 'Detail', 1, 1, 'C', true);
            }

            function TableRow($label, $value) {
                $this->SetFont('Arial', '', 12);
                $this->Cell(50, 10, $label, 1);
                $this->Cell(140, 10, $value, 1, 1);
            }
        }

        $pdf = new PDF();
        $pdf->AliasNbPages();
        $pdf->AddPage();
        
        // Table Header
        $pdf->TableHeader();
        
        // Table Rows
        $pdf->TableRow('Nama Lengkap', $nama_lengkap);
        $pdf->TableRow('Jenis Hewan', $jenis_hewan);
        $pdf->TableRow('Total Bayar', 'Rp. '.number_format($total_bayar, 0, ',', '.'));
        $pdf->TableRow('Alamat', $alamat);
        $pdf->TableRow('Tanggal Pembayaran', $tanggal_pembayaran);
        
        $pdf->Ln(20);

        $pdf->Cell(0, 5, "Sukabumi, ".date('d-m-Y'), 0, 1, 'C');
        $pdf->Cell(0, 5, 'Ketua Panitia', 0, 1, 'C');
        $pdf->Ln(30);
        $pdf->SetFont('Arial', 'BU', 12);
        $pdf->Cell(0, 5, "Usep Hidayat", 0, 1, 'C');
        $pdf->SetFont('Arial', '', 12);
        $pdf->Cell(0, 5, 'ID. 20240115', 0, 1, 'C');

        // Signature and QR Code
        $pdf->Image($file, 51, 135, 100);
        $pdf->Image($qrFilename, 20, 135, 30);

        $pdf->Output("filepdf/".md5($nama_lengkap).".pdf", 'F');
        header("location:filepdf/".md5($nama_lengkap).".pdf");
        exit;
    }
}
?>
