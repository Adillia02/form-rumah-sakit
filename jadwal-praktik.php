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
                $hari = "";
                $dokter = "";
                $poli = "";
                $j_buka = "";
                $j_tutup = "";

                $act = "";

                if (isset($_GET['act'])) {
                    $act = $_GET['act'];
                }

                // hapus data
                if ($act == 'hapus') {
                    // echo "<script>alert('hapus');</script>";
                    $kode = $_GET['id'];
                    $query_hps_jadwal = "delete from t_jadwal_praktik where id_jadwal = '$kode'";
                    $result_hapus = mysqli_query($conn, $query_hps_jadwal);

                    if ($result_hapus > 0) {
                        echo "
                        <script>
                        alert('Data Berhasil Dihapus'); 
                        window.location.href = 'jadwal-praktik.php';
                        </script>
                        ";
                    } else {
                        echo "<script>
                        alert('Data Gagal Dihapus'); 
                        window.location.href = 'jadwal-praktik.php';
                        </script>";
                    }
                }

                //ubah data
                if ($act == 'ubah') {
                    $kode = $_GET['id'];
                    $query_ubah_jadwal = "select * from t_jadwal_praktik where id_jadwal = '$kode'";
                    $result = mysqli_query($conn, $query_ubah_jadwal);
                    $data1 = mysqli_fetch_assoc($result);

                    $kode = $data1['id_jadwal'];
                    $hari = $data1['id_hari'];
                    $dokter = $data1['id_dokter'];
                    $poli = $data1['id_poli'];
                    $j_buka = $data1['jam_buka'];
                    $j_tutup = $data1['jam_tutup'];
                }

                //tambah data
                if (isset($_POST['submit'])) {
                    $kode = '';

                    if (isset($_POST['id'])) {
                        $kode = $_POST['id'];
                    } elseif (isset($_GET['id'])) {
                        $kode = $_GET['id'];
                    }


                    $hari = $_POST['hari'];
                    $dokter = $_POST['dokter'];
                    $poli = $_POST['poli'];
                    $j_buka = $_POST['buka'];
                    $j_tutup = $_POST['tutup'];

                    if ($act == 'ubah') {
                        //ubah dokter
                        $query_upd_jadwal = "update t_jadwal_praktik set
                                                id_hari ='$hari',
                                                id_poli ='$poli',
                                                id_dokter ='$dokter',
                                                jam_buka = '$j_buka',
                                                jam_tutup = '$j_tutup',
                                                where id_jadwal = '$kode'";

                        $result_upd = mysqli_query($conn, $query_upd_jadwal) or die(mysqli_error($conn));
                        if ($result_upd == 1) {
                            echo "
                            <script>
                            alert('Data Berhasil Diperbarui'); 
                            window.location.href = 'jadwal-praktik.php';
                            </script>";
                        }
                    } else {
                        //tambah dokter
                        $query_ins_jadwal = "insert into t_jadwal_praktik (
                                                id_jadwal, 
                                                id_hari, 
                                                id_poli,
                                                id_dokter,
                                                jam_buka,
                                                jam_tutup)
                                            values ('', '$hari', '$poli', '$dokter', '$j_buka', '$j_tutup')";

                        $result_add = mysqli_query($conn, $query_ins_jadwal) or die(mysqli_error($conn));
                        if ($result_add == 1) {
                            echo "
                                <script>
                                    alert('Data Berhasil Ditambahkan'); 
                                    window.location.href = 'jadwal-praktik.php';
                                </script>
                            ";
                        }
                    }
                }

                ?>
                <div class="container mt-5 d-flex justify-content-center">
                    <div class="col-md-11">
                        <div class="card">
                            <h5 class="card-header bg-info text-white">Jadwal Praktik</h5>
                            <form id="form-data" action="" method="post">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col">
                                            <div class="mb-3">
                                                <label for="hari" class="form-label">Hari</label>
                                                <select class="custom-select" id="hari" name="hari">
                                                    <option selected style="display: none;">Pilih Hari...</option>
                                                    <?php
                                                    $query_hari = "SELECT id_hari, hari FROM m_hari";
                                                    $result_hari = mysqli_query($conn, $query_hari);
                                                    while ($data = mysqli_fetch_assoc($result_hari)) {
                                                    ?>
                                                        <option value="<?php echo $data['id_hari'] ?>"><?php echo $data['hari']; ?></option>
                                                    <?php
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                            <div class="mb-3">
                                                <label for="poli" class="form-label">Poli</label>
                                                <select class="custom-select" id="poli" name="poli">
                                                    <option selected style="display: none;">Pilih Poli...</option>
                                                    <?php
                                                    $query_poli = "SELECT id_poli, poli FROM m_poli";
                                                    $result_poli = mysqli_query($conn, $query_poli);
                                                    while ($data = mysqli_fetch_assoc($result_poli)) {
                                                        echo "<option value='$data[id_poli]'>$data[poli]</option>";
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                            <div class="mb-3">
                                                <label for="dokter" class="form-label">Dokter</label>
                                                <select class="custom-select" id="dokter" name="dokter">
                                                    <option selected style="display: none;">Pilih Dokter...</option>
                                                    <?php
                                                    $query_dokter = "SELECT id_dokter, nama_dokter FROM m_dokter";
                                                    $result_dokter = mysqli_query($conn, $query_dokter);
                                                    while ($data = mysqli_fetch_assoc($result_dokter)) {
                                                        echo "<option value='$data[id_dokter]'>$data[nama_dokter]</option>";
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                            <div class="row">
                                                <div class="col">
                                                    <div class="mb-3">
                                                        <label for="buka" class="form-label">Jam Buka</label>
                                                        <input type="time" name="buka" id="buka" class="form-control form-control-lg" required value="<?php echo $profil ?>">
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <div class="mb-3">
                                                        <label for="tutup" class="form-label">Jam tutup</label>
                                                        <input type="time" name="tutup" id="tutup" class="form-control form-control-lg" placeholder="Senin" required value="<?php echo $profil ?>">
                                                    </div>
                                                </div>
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
                            <th>Hari</th>
                            <th>Poli</th>
                            <th>Dokter</th>
                            <th>Jam</th>
                            <!-- <th>Riwayat Pekerjaan</th> -->
                            <!-- <th>Pelatihan</th> -->
                            <th>Opsi</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>#</th>
                            <th>Hari</th>
                            <th>Poli</th>
                            <th>Dokter</th>
                            <th>Jam</th>
                            <th>Opsi</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        <?php
                        $no = 1;
                        $query_result = "SELECT j.id_jadwal, h.hari, p.poli, d.nama_dokter, j.jam_buka, j.jam_tutup 
                                            from t_jadwal_praktik j
                                            join m_hari h on j.id_hari = h.id_hari
                                            join m_poli p on j.id_poli = p.id_poli
                                            join m_dokter d on j.id_dokter = d.id_dokter
                                            order by id_jadwal";
                        $result = mysqli_query($conn, $query_result);
                        while ($data = mysqli_fetch_assoc($result)) {
                        ?>
                            <tr>
                                <td><?php echo $no++; ?></td>
                                <td><?php echo $data['hari']; ?></td>
                                <td><?php echo $data['poli']; ?></td>
                                <td><?php echo $data['nama_dokter']; ?></td>
                                <td><?php echo $data['jam_buka']; ?> s/d <?php echo $data['jam_tutup']; ?></td>

                                <td>
                                    <div class="form-button-action">
                                        <a href="jadwal-praktik.php?act=view&id=<?php echo $data['id_jadwal'] ?>" title="View" class="btn text-info btn-sm lihat-poly">
                                            <i class="fa fa-eye"></i>
                                        </a>
                                        <a href="jadwal-praktik.php?act=ubah&id=<?php echo $data['id_jadwal'] ?>" title="Edit" class="btn text-info btn-sm edit-poly">
                                            <i class="fa fa-edit"></i>
                                        </a>
                                        <a href="jadwal-praktik.php?act=hapus&id=<?php echo $data['id_jadwal'] ?>" title="Delete" class="btn text-info btn-sm delete-poly">
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

                <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                ...
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="button" class="btn btn-primary">Save changes</button>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/b060a488c4.js" crossorigin="anonymous"></script>
</body>

</html>