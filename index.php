<?php
include 'config/koneksi.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=in, initial-scale=1.0">
    <title>Rumah Sakit</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>

<body>
    <div class="container mt-5">
        <div class="d-flex justify-content-center mb-5">
           
            <?php include 'menu.php'; ?>
        </div>

        <div class="tab-content" id="pills-tabContent">
            <div class="tab-pane fade show active" id="tab-beranda" role="tabpanel" aria-labelledby="tab-beranda-tab">
            
            </div>
            <div class="tab-pane fade" id="tab-hari" role="tabpanel" aria-labelledby="tab-hari-tab">
                <?php include 'hari.php'; ?>
            </div>

            <div class="tab-pane fade" id="tab-poli" role="tabpanel" aria-labelledby="tab-poli-tab">
                <?php include 'poli.php'; ?>
            </div>
            
            <div class="tab-pane fade" id="tab-dokter" role="tabpanel" aria-labelledby="tab-dokter-tab">
                <?php include 'dokter.php'; ?>
            </div>

            <div class="tab-pane fade" id="tab-transaksi" role="tabpanel" aria-labelledby="tab-transaksi-tab">
                <?php include 'transaksi.php'; ?>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

</body>

</html>