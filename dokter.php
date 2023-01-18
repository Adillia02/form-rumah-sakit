<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css">
</head>

<body>
    <div class="container mt-5">
        <div class="d-flex justify-content-center mb-5">

            <?php include 'menu.php'; ?>
        </div>
        <div class="tab-content" id="pills-tabContent">
            <div class="tab-pane fade show active" id="tab-dokter" role="tabpanel" aria-labelledby="tab-dokter-tab">

                <!--Kode PHP -->
                <?php
                include 'config/koneksi.php';

                $kode = "";
                $nama = "";
                $profil = "";

                $act = "";

                if (isset($_GET['act'])) {
                    $act = $_GET['act'];
                }

                // hapus data
                if ($act == 'hapus') {
                    // echo "<script>alert('hapus');</script>";
                    $kode = $_GET['id'];
                    $query_hps_dokter = "delete from m_dokter where id_dokter = '$kode'";
                    $result_hapus = mysqli_query($conn, $query_hps_dokter);

                    if ($result_hapus > 0) {
                        echo "
                        <script>
                        alert('Data Berhasil Dihapus'); 
                        window.location.href = 'dokter.php';
                        </script>
                        ";
                    } else {
                        echo "<script>
                        alert('Data Gagal Dihapus'); 
                        window.location.href = 'dokter.php';
                        </script>";
                    }
                }

                //ubah data
                if ($act == 'ubah') {
                    $kode = $_GET['id'];
                    $query_ubah_dokter = "select * from m_dokter where id_dokter = '$kode'";
                    $result = mysqli_query($conn, $query_ubah_dokter);
                    $data1 = mysqli_fetch_assoc($result);

                    $kode = $data1['id_dokter'];
                    $nama = $data1['nama_dokter'];
                    $profil = $data1['profil_singkat'];
                }

                //tambah data
                if (isset($_POST['submit'])) {
                    $kode = '';

                    if (isset($_POST['id'])) {
                        $kode = $_POST['id'];
                    } elseif (isset($_GET['id'])) {
                        $kode = $_GET['id'];
                    }


                    $nama = $_POST['nama'];
                    $profil = $_POST['profil'];


                    if ($act == 'ubah') {
                        //ubah dokter
                        $query_upd_dokter = "update m_dokter set
                                                nama_dokter ='$nama',
                                                profil_singkat = '$profil'
                                                where id_dokter = '$kode'";

                        $result_upd = mysqli_query($conn, $query_upd_dokter) or die(mysqli_error($conn));
                        if ($result_upd == 1) {
                            echo "
                            <script>
                            alert('Data Berhasil Diperbarui'); 
                            window.location.href = 'dokter.php';
                            </script>";
                        }
                    } else {
                        //tambah dokter
                        $query_ins_dokter = "insert into m_dokter (
                                                id_dokter, 
                                                nama_dokter, 
                                                profil_singkat)
                                            values ('', '$nama', '$profil')";

                        $result_add = mysqli_query($conn, $query_ins_dokter) or die(mysqli_error($conn));
                        if ($result_add == 1) {
                            echo "
                                <script>
                                    alert('Data Berhasil Ditambahkan'); 
                                    window.location.href = 'dokter.php';
                                </script>
                            ";
                        }
                    }
                }

                ?>
                <div class="container mt-5 d-flex justify-content-center">
                    <div class="col-md-11">
                        <div class="card">
                            <h5 class="card-header bg-info text-white">Data Dokter</h5>
                            <form id="form-data" action="" method="post">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col">
                                            <div class="mb-3">
                                                <label for="nama" class="form-label">Nama Dokter</label>
                                                <input type="text" name="nama" id="nama" class="form-control form-control-lg" id="poli" placeholder="dr. Donald HDP Marpaung, Sp.THT" required value="<?php echo $nama ?>">
                                            </div>
                                            <div class="mb-3">
                                                <label for="profil" class="form-label">Profil Singkat</label>
                                                <textarea class="form-control form-control-lg" name="profil" id="profil"><?php echo $profil ?></textarea>
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
                </div>

                <table class="table table-hover mt-5">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Nama Dokter</th>
                            <th>Profil Singkat</th>
                            <th>Opsi</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>#</th>
                            <th>Nama Dokter</th>
                            <th>Profil Singkat</th>
                            <th>Opsi</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        <?php

                        $no = 1;
                        $query_result = "SELECT * from m_dokter order by id_dokter";
                        $result = mysqli_query($conn, $query_result);
                        while ($data = mysqli_fetch_assoc($result)) {
                        ?>
                            <tr>
                                <td><?php echo $no++; ?></td>
                                <td><?php echo $data['nama_dokter']; ?></td>
                                <td><?php echo $data['profil_singkat']; ?></td>
                                <td>
                                    <div class="form-button-action">
                                        <a href="detail-dokter.php?act=view&id=<?php echo $data['id_dokter'] ?>" title="View" class="btn text-info btn-sm lihat-poly">
                                            <i class="fa fa-eye"></i>
                                        </a>
                                        <a href="dokter.php?act=ubah&id=<?php echo $data['id_dokter'] ?>" title="Edit" class="btn text-info btn-sm edit-poly">
                                            <i class="fa fa-edit"></i>
                                        </a>
                                        <a href="dokter.php?act=hapus&id=<?php echo $data['id_dokter'] ?>" title="Delete" class="btn text-info btn-sm delete-poly">
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

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/b060a488c4.js" crossorigin="anonymous"></script>
</body>

</html>