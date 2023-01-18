<?php
include 'config/koneksi.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css" crossorigin="anonymous">
</head>

<body>
    <div class="container mt-5">
        <div class="d-flex justify-content-center mb-5">

            <?php include 'menu.php'; ?>
        </div>
        <div class="tab-content" id="pills-tabContent">
            <div class="tab-pane fade show active" id="tab-poli" role="tabpanel" aria-labelledby="tab-poli-tab">

                <?php

                include 'config/koneksi.php';

                $kode = "";
                $poli = "";

                if (isset($_GET['act'])) {
                    $act = $_GET['act'];
                } else {
                    $act = "";
                }

                // hapus data
                if ($act == 'hapus') {
                    // echo "<script>alert('hapus');</script>";
                    $kode = $_GET['id'];
                    $query_hps_poli = "delete from m_poli where id_poli = '$kode'";
                    $result_hapus = mysqli_query($conn, $query_hps_poli);

                    if ($result_hapus > 0) {
                        echo "
                        <script>
                        alert('Data Berhasil Dihapus'); 
                        window.location.href = 'poli.php';
                        </script>
                        ";
                    } else {
                        echo "<script>
                        alert('Data Gagal Dihapus'); 
                        window.location.href = 'poli.php';
                        </script>";
                    }
                }

                //Ubah Data
                if ($act == 'ubah') {
                    $kode = $_GET['id'];
                    $ubah_poli = "SELECT * from m_poli where id_poli='$kode'";
                    $result = mysqli_query($conn, $ubah_poli);
                    $data1 = mysqli_fetch_assoc($result);

                    $kode = $data1['id_poli'];
                    $poli = $data1['poli'];
                }

                //tambah data
                if (isset($_POST['submit'])) {
                    $code = '';

                    if (isset($_POST['id'])) {
                        $code = $_POST['id'];
                    } elseif (isset($_GET['id'])) {
                        $code = $_GET['id'];
                    }

                    $poly = $_POST['poli'];

                    if ($act == 'ubah') {
                        $query_poli = "UPDATE m_poli set 
                                            poli = '$poly' 
                                            where id_poli = '$code'";

                        $result_upd = mysqli_query($conn, $query_poli);
                        if ($result_upd == 1) {
                            echo "
                                    <script>
                                        alert('Data Berhasil Diubah');
                                        document.location.href = 'poli.php';
                                    </script>
                                ";
                        }
                    } else {
                        //insert data
                        $query_ins_poly = "insert into m_poli (id_poli, poli) values ('','$poly')";
                        $result_add = mysqli_query($conn, $query_ins_poly);
                        if ($result_add == 1) {
                            echo "
                                <script>
                                    alert('Data Berhasil Ditambahkan');
                                    document.location.href = poli.php;
                                </script>
                            ";
                        }
                    }
                }



                ?>
                <div class="row justify-content-md-center">
                    <div class="col col-lg-5">
                        <div class="card">
                            <h5 class="card-header bg-info text-white">Data Poli</h5>
                            <form id="form-data" action="" method="post">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col">
                                            <div class="mb-3">
                                                <label for="poli" class="form-label">Poli</label>
                                                <input type="text" name="poli" id="poli" class="form-control form-control-lg" id="poli" placeholder="Gigi" required value="<?= $poli ?>">
                                            </div>
                                        </div>

                                    </div>
                                </div>
                                <div class="card-footer text-muted">
                                    <button type="submit" id="submit" name="submit" data- class="btn btn-info">Simpan</button>
                                    <button type="reset" class="btn btn-warning">Reset</button>

                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="col col-lg-5">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Poli</th>
                                    <th>Opsi</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th>#</th>
                                    <th>Poli</th>
                                    <th>Opsi</th>
                                </tr>
                            </tfoot>
                            <tbody>
                                <?php

                                $no = 1;
                                $query_result = "SELECT * from m_poli order by id_poli";
                                $result = mysqli_query($conn, $query_result);
                                while ($data = mysqli_fetch_assoc($result)) {
                                ?>
                                    <tr>
                                        <td><?php echo $no++; ?></td>
                                        <td><?php echo $data['poli']; ?></td>
                                        <td>
                                            <div class="form-button-action">
                                                <a href="poli.php?act=ubah&id=<?php echo $data['id_poli'] ?>" title="Edit" class="btn text-info btn-sm edit-poly">
                                                    <i class="fa fa-edit"></i>
                                                </a>
                                                <a href="poli.php?act=hapus&id=<?php echo $data['id_poli'] ?>" title="Edit" class="btn text-info btn-sm delete-poly">
                                                    <i class="fa fa-trash"></i>
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                <?php
                                }
                                ?>


                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/b060a488c4.js" crossorigin="anonymous"></script>
    <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js" crossorigin="anonymous"></script>
    <script>
        $(document).ready( function () {
            $('.table').DataTable({
                lengthMenu: [
                    [4,10, 25, 50, -1],
                    [4,10, 25, 50, 'Semua'],
                ],
            });
        } );

    </script>

</body>

</html>