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
    <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css">
</head>

<body>
    <div class="container mt-5">
        <div class="d-flex justify-content-center mb-5">

            <?php include 'menu.php'; ?>
        </div>

        <div class="tab-content" id="pills-tabContent">
            <div class="tab-pane fade show active" id="tab-katering" role="tabpanel" aria-labelledby="tab-katering-tab">
                <!-- Kode PHP -->
                <?php
                include 'config/koneksi.php';
                $kode = "";
                $hari = "";
                $act = "";

                if (isset($_GET['act'])) {
                    $act = $_GET['act'];
                }

                // hapus data
                if ($act == 'hapus') {
                    // echo "<script>alert('hapus');</script>";
                    $kode = $_GET['id'];
                    $query_hps_hari = "delete from m_hari where id_hari = '$kode'";
                    $result_hapus = mysqli_query($conn, $query_hps_hari);

                    if ($result_hapus > 0) {
                        echo "
                        <script>
                        alert('Data Berhasil Dihapus'); 
                        window.location.href = 'hari.php';
                        </script>
                        ";
                    } else {
                        echo "<script>
                        alert('Data Gagal Dihapus'); 
                        window.location.href = 'hari.php';
                        </script>";
                    }
                }

                if ($act == 'ubah') {
                    $kode = $_GET['id'];
                    $ubah_hari = "select * from m_hari where id_hari='$kode'";
                    $result = mysqli_query($conn, $ubah_hari);
                    $data1 = mysqli_fetch_assoc($result);

                    $kode = $data1['id_hari'];
                    $hari = $data1['hari'];
                }

                //create data
                if (isset($_POST['submit'])) {
                    // $code = (isset($_POST['id'])) ? $_POST['id']: (isset($_GET['id'])) ? $_GET['id'] : '';
                    $code = '';

                    if (isset($_POST['id'])) {
                        $code = $_POST['id'];
                    } elseif (isset($_GET['id'])) {
                        $code = $_GET['id'];
                    }

                    $day = $_POST['hari'];

                    if ($act == 'ubah') {
                        //update data
                        $query_hari = "UPDATE m_hari SET 
                                        hari = '$day'
                                        WHERE id_hari='$code'";
                        $result_upd = mysqli_query($conn, $query_hari) or die(mysqli_error($conn));
                        if ($result_upd == 1) {
                            echo "
                            <script>
                            alert('Data Berhasil Diperbarui'); 
                            window.location.href = 'hari.php';
                            </script>";
                        }
                    } else {
                        //insert data
                        $query_ins_hari = "INSERT INTO m_hari (id_hari, hari) values ('','$day')";
                        $result_add = mysqli_query($conn, $query_ins_hari) or die(mysqli_error($conn));
                        if ($result_add == 1) {
                            echo "
                                <script>
                                    alert('Data Berhasil Ditambahkan'); 
                                    window.location.href = 'hari.php';
                                </script>
                            ";
                        }
                    }
                }
                ?>

                <div class="row justify-content-md-center">
                    <div class="col col-lg-5">
                        <div class="card">
                            <h5 class="card-header bg-info text-white">Data Hari</h5>
                            <form id="form-data" action="" method="post">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col">
                                            <div class="mb-3">
                                                <label for="hari" class="form-label">Nama Hari</label>
                                                <input type="text" name="hari" id="hari" class="form-control form-control-lg" id="hari" placeholder="Senin" required value="<?php echo $hari ?>">
                                            </div>
                                        </div>

                                    </div>
                                </div>
                                <div class="card-footer text-muted">
                                    <button type="submit" id="submit" name="submit" class="btn btn-info">Simpan</button>
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
                                    <th>Hari</th>
                                    <th>Opsi</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th>#</th>
                                    <th>Hari</th>
                                    <th>Opsi</th>
                                </tr>
                            </tfoot>
                            <tbody>
                                <?php

                                $no = 1;
                                $query_result = "SELECT * from m_hari order by id_hari";
                                $result = mysqli_query($conn, $query_result);
                                while ($data = mysqli_fetch_assoc($result)) {
                                ?>  
                                    <tr>
                                        <td><?php echo $no++; ?></td>
                                        <td><?php echo $data['hari']; ?></td>
                                        <td>
                                            <div class="form-button-action">
                                                <a href="hari.php?act=ubah&id=<?php echo $data['id_hari'] ?>" title="Edit" class="btn text-info btn-sm edit-day">
                                                    <i class="fa fa-edit"></i>
                                                </a>
                                                <a href="hari.php?act=hapus&id=<?php echo $data['id_hari'] ?>" title="Edit" class="btn text-info btn-sm delete-day">
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
    <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>


    <script>
        // (
        //     document.getElementById('tab-katering-tab').classList.add("active")
        // )();
        $(document).ready(function() {
            $('#tab-hari-tab').removeClass('text-info');
            $('#tab-hari-tab').addClass('active bg-info');
            
            $('.table').DataTable({
                lengthMenu: [
                    [5, 10, 25, 50, -1],
                    [5, 10, 25, 50, 'Semua'],
                ],
            });
        });
    </script>
</body>

</html>