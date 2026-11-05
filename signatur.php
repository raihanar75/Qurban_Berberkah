<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Pembayaran</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="signatur/jquery.signature.css">
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <link type="text/css" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/south-street/jquery-ui.css" rel="stylesheet">
    <script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
    <script src="signatur/jquery.signature.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700,900|Roboto+Slab:400,700" />
    <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
    <style>
        .kbw-signature { width: 400px; height: 200px;}
        #sig canvas{
            width: 100% !important;
            height: 200px;
        }
        canvas {
            border: 1px solid #ccc;
            border-radius: 0.5rem;
            width: 100%;
            height: 200px;
        }
    </style>
</head>
<body>
    <div class="grid-margin stretch-card">
        <div class="card">
            <div class="card-body" style="background: auto;background-color: #243049;color: white;">
                <h4 style="text-align: center;">Laporan Pembayaran</h4>
                <hr>
                <form method="post" action="toPDF.php" enctype="multipart/form-data">
                    <div class="form-group">
                        <label>Nama Lengkap :</label>
                        <input type="text" class="form-control" name="nama_lengkap" required>
                    </div>
                    <div class="form-group">
                        <label>Jenis Hewan :</label>
                        <input type="text" class="form-control" name="jenis_hewan" value="<?= htmlspecialchars($_GET['jenis_hewan'] ?? ''); ?>" required>
                    </div>
                    <div class="form-group">
                        <label>Total Bayar :</label>
                        <input type="text" class="form-control" name="total_bayar" value="<?= htmlspecialchars($_GET['total_bayar'] ?? ''); ?>" required>
                    </div>
                    <div class="form-group">
                        <label>Alamat :</label>
                        <input type="text" class="form-control" name="alamat" required>
                    </div>
                    <div class="form-group">
                        <label>Tanggal Pembayaran :</label>
                        <input type="date" class="form-control" name="tanggal_pembayaran" required>
                        <small>*Perhatikan format isian tanggal, yaitu <b>Bulan/Tanggal/Tahun</b></small>
                    </div>
                    <div class="col-12">
                        <div class="mb-1 row">
                            <div class="col-sm-3">
                                <label class="col-form-label" for="signature-pad">Tanda Tangan</label>
                            </div>
                            <div class="col-sm-9">
                                <div id="sig"></div>
                                <canvas id="signature-pad" name="signature-pad" class="signature-pad"></canvas>
                                <input id="signed" name="signed" type="hidden">
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-9 offset-sm-3">
                        <div style="float: right;">
                            <button type="button" class="btn btn-success" id="change-color">Change Color</button>
                            <button type="button" class="btn btn-dark" id="undo">
                                <span class="fas fa-undo"></span> Undo
                            </button>
                            <button type="button" class="btn btn-danger" id="clear1">
                                <span class="fas fa-eraser"></span> Clear
                            </button>
                        </div>
                    </div>
                    <div class="col-sm-9 offset-sm-3">
                        <div style="float: left;">
                            <input type="submit" value="Setujui" class="btn btn-primary me-1" name="submit" onClick="savecanvas()">
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/signature_pad@2.3.2/dist/signature_pad.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.9.2/umd/popper.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            resizeCanvas();
        });

        function resizeCanvas() {
            var ratio = Math.max(window.devicePixelRatio || 1, 1);
            canvas.width = canvas.offsetWidth * ratio;
            canvas.height = canvas.offsetHeight * ratio;
            canvas.getContext("2d").scale(ratio, ratio);
        }

        var canvas = document.getElementById('signature-pad');
        var signaturePad = new SignaturePad(canvas, {
            backgroundColor: '#fff',
            minWidth: 5,
            maxWidth: 5
        });

        document.getElementById('clear1').addEventListener('click', function () {
            signaturePad.clear();
        });

        document.getElementById('undo').addEventListener('click', function () {
            var data = signaturePad.toData();
            if (data) {
                data.pop();
                signaturePad.fromData(data);
            }
        });

        document.getElementById('change-color').addEventListener('click', function () {
            if (signaturePad.penColor == "rgba(0, 0, 255, 1)") {
                signaturePad.penColor = "rgba(0, 0, 0, 1)";
            } else {
                signaturePad.penColor = "rgba(0, 0, 255, 1)";
            }
        });

        function savecanvas() {
            var dataURL = canvas.toDataURL("image/png");
            document.getElementById('signed').value = dataURL;
        }
    </script>
</body>
</html>
