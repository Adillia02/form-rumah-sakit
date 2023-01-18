<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css">
    <style>
        .table td,
        .table tr {
            border-top: none;
        }
    </style>
</head>

<body>
    <div class="container mt-5 mb-5 d-flex justify-content-center">
        <div class="col-md-9">
            <div class="card">
                <h5 class="card-header bg-info text-white">Data Dokter</h5>
                <form id="form-data" action="" method="post">
                    <div class="card-body">

                        <table class="table">
                            <?php
                            include 'config/koneksi.php';
                            $kode = '';

                            if (isset($_POST['id'])) {
                                $kode = $_POST['id'];
                            } elseif (isset($_GET['id'])) {
                                $kode = $_GET['id'];
                            }

                            $query_result = "SELECT * from m_dokter where id_dokter = '$kode'";
                            $result = mysqli_query($conn, $query_result);
                            while ($data = mysqli_fetch_assoc($result)) {
                            ?>

                                <tr>
                                    <td>Nama Dokter</td>
                                    <td class="d-flex justify-content-center">:</td>
                                    <td><?php echo $data['nama_dokter']; ?></td>
                                </tr>
                                <tr>
                                    <td>Profil Singkat</td>
                                    <td class="d-flex justify-content-center">:</td>
                                    <td><?php echo $data['profil_singkat']; ?></td>
                                </tr>
                            <?php
                            }
                            ?>
                            <!-- Detail-Riwayat Pendidikan -->
                            <tr>
                                <td>Riwayat Pendidikan</td>
                                <td class="d-flex justify-content-center">:</td>
                                <td>
                                    <ul>
                                        <?php

                                        $dokter = '';

                                        if (isset($_POST['id'])) {
                                            $dokter = $_POST['id'];
                                        } elseif (isset($_GET['id'])) {
                                            $dokter = $_GET['id'];
                                        }


                                        $query_result = "SELECT * from riwayat_pendidikan where id_dokter = '$dokter'";
                                        $result = mysqli_query($conn, $query_result);
                                        while ($data = mysqli_fetch_assoc($result)) {
                                        ?>
                                            <li style="margin-left: -25px;">
                                                <div class="row">
                                                    <div class="col-md-9">
                                                        <p class="mb-0"><?php echo $data['instansi'] ?></p>
                                                        <p><?php echo $data['tahun_masuk'] ?>-<?php echo $data['tahun_keluar'] ?></p>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <a title="Edit" class="btn text-info btn-sm edit-poly" data-id-pendidikan="<?php echo $data['id_pendidikan'] ?>" data-id-dokter="<?php echo $data['id_dokter'] ?>" data-instansi="<?php echo $data['instansi'] ?>" data-bidang="<?php echo $data['bidang_studi'] ?>" data-masuk="<?php echo $data['tahun_masuk'] ?>" data-keluar="<?php echo $data['tahun_keluar'] ?>" data-toggle="modal" data-target="#modal-ubah-pendidikan" id="btnUbah">
                                                            <i class="fa fa-edit"></i>
                                                        </a>
                                                        <form action="" method="post">
                                                            <input type="text" name="id" id="" value="<?php echo $data['id_pendidikan'] ?>" readonly hidden>
                                                            <button type="submit" name="hapus_pendidikan" title="Delete" class="btn text-danger btn-sm delete-poly">
                                                                <i class="fa fa-trash"></i>
                                                            </button>
                                                        </form>
                                                    </div>
                                                <?php
                                            }
                                                ?>
                                                </div>
                                            </li>
                                    </ul>
                                    <?php
                                    if (isset($_POST['hapus_pendidikan'])) {
                                        $id_pendidikan = $_POST['id'];

                                        $queryDeletePendidikan = "delete from riwayat_pendidikan where id_pendidikan=" . $id_pendidikan;
                                        $execDeletePendidikan = mysqli_query($conn, $queryDeletePendidikan);
                                        if ($execDeletePendidikan == 1) {
                                            echo "
                                                    <script>
                                                        alert('Data Berhasil Dihapus'); 
                                                        window.location.href = 'detail-dokter.php?act=view&id=$_GET[id]';
                                                    </script>
                                                ";
                                        } else {
                                            echo "
                                                    <script>
                                                        alert('Data Gagal Dihapus'); 
                                                        window.location.href = 'detail-dokter.php?act=view&id=$_GET[id]';
                                                    </script>
                                                ";
                                        }
                                    }

                                    ?>
                                    <a title="Tambah" class="btn btn-info text-white btn-sm delete-poly" data-toggle="modal" data-target="#modal-pendidikan">
                                        Tambah Pendidikan
                                        <i class="fa fa-plus"></i>
                                    </a>
                                </td>

                            </tr>

                            <!-- Detail-Riwayat Pekerjaan -->
                            <tr>
                                <td>Riwayat Pekerjaan</td>
                                <td class="d-flex justify-content-center">:</td>
                                <td>
                                    <ul>
                                        <?php
                                        $dokter1 = '';

                                        if (isset($_POST['id'])) {
                                            $dokter1 = $_POST['id'];
                                        } elseif (isset($_GET['id'])) {
                                            $dokter1 = $_GET['id'];
                                        }


                                        $query_result_pekerjaan = "SELECT * from riwayat_pekerjaan where id_dokter = '$dokter1'";
                                        $result_pekerjaan = mysqli_query($conn, $query_result_pekerjaan);
                                        while ($data1 = mysqli_fetch_assoc($result_pekerjaan)) {
                                        ?>
                                            <li style="margin-left: -25px;">
                                                <div class="row">
                                                    <div class="col-md-9">
                                                        <p class="mb-0"><?php echo $data1['posisi']; ?> - <?php echo $data1['nama_perusahaan'] ?></p>
                                                        <p><?php echo $data1['tahun_masuk'] ?> - <?php echo $data1['tahun_keluar'] ?></p>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <a title="Edit" class="btn text-info btn-sm edit-poly" data-id-pekerjaan="<?php echo $data1['id_pekerjaan'] ?>" data-id-dokter="<?php echo $data1['id_dokter'] ?>" data-posisi="<?php echo $data1['posisi'] ?>" data-perusahaan="<?php echo $data1['nama_perusahaan'] ?>" data-thn-masuk="<?php echo $data1['tahun_masuk'] ?>" data-thn-keluar="<?php echo $data1['tahun_keluar'] ?>" data-toggle="modal" data-target="#modal-ubah-pekerjaan" id="btnUbahPekerjaan">
                                                            <i class="fa fa-edit"></i>
                                                        </a>
                                                        <form action="" method="post">
                                                            <input type="text" name="id" id="" value="<?php echo $data1['id_pekerjaan'] ?>" readonly hidden>
                                                            <button type="submit" name="hapus_pekerjaan" title="Delete" class="btn text-danger btn-sm delete-poly">
                                                                <i class="fa fa-trash"></i>
                                                            </button>
                                                        </form>
                                                    </div>
                                                <?php
                                            }
                                                ?>
                                                </div>
                                            </li>
                                    </ul>
                                    <?php
                                    if (isset($_POST['hapus_pekerjaan'])) {
                                        $id_pekerjaan = $_POST['id'];

                                        $queryDeletePekerjaan = "delete from riwayat_pekerjaan where id_pekerjaan=" . $id_pekerjaan;
                                        $execDeletePekerjaan = mysqli_query($conn, $queryDeletePekerjaan);
                                        if ($execDeletePekerjaan == 1) {
                                            echo "
                                                    <script>
                                                        alert('Data Berhasil Dihapus'); 
                                                        window.location.href = 'detail-dokter.php?act=view&id=$_GET[id]';
                                                    </script>
                                                ";
                                        } else {
                                            echo "
                                                    <script>
                                                        alert('Data Gagal Dihapus'); 
                                                        window.location.href = 'detail-dokter.php?act=view&id=$_GET[id]';
                                                    </script>
                                                ";
                                        }
                                    }

                                    ?>

                                    <a title="Tambah" class="btn btn-info text-white btn-sm delete-poly" data-toggle="modal" data-target="#modal-pekerjaan">
                                        Tambah Pekerjaan
                                        <i class="fa fa-plus"></i>
                                    </a>
                                </td>

                            </tr>

                            <!-- Detail-Pelatihan -->
                            <tr>
                                <td>Pelatihan</td>
                                <td class="d-flex justify-content-center">:</td>
                                <td>
                                    <ul>
                                        <?php
                                        $dokter_pelatihan = '';

                                        if (isset($_POST['id'])) {
                                            $dokter_pelatihan = $_POST['id'];
                                        } elseif (isset($_GET['id'])) {
                                            $dokter_pelatihan = $_GET['id'];
                                        }

                                        $query_result_pelatihan = "SELECT * from pelatihan where id_dokter = '$dokter_pelatihan'";
                                        $result_pelatihan = mysqli_query($conn, $query_result_pelatihan);
                                        while ($data2 = mysqli_fetch_assoc($result_pelatihan)) {
                                        ?>
                                            <li style="margin-left: -25px;">
                                                <div class="row">
                                                    <div class="col-md-9">
                                                        <p class="mb-0"> <?php echo $data2['nama_pelatihan'] ?></p>
                                                        <p><?php echo $data2['tahun']; ?></p>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <a href="dokter.php?act=ubah&id=<?php echo $data['id_dokter'] ?>" title="Edit" class="btn text-info btn-sm edit-poly">
                                                            <i class="fa fa-edit"></i>
                                                        </a>
                                                        <a href="dokter.php?act=hapus&id=<?php echo $data['id_dokter'] ?>" title="Delete" class="btn text-danger btn-sm delete-poly">
                                                            <i class="fa fa-trash"></i>
                                                        </a>
                                                    </div>
                                                <?php
                                            }
                                                ?>
                                                </div>
                                            </li>
                                    </ul>
                                    <a title="Tambah" class="btn btn-info text-white btn-sm delete-poly" data-toggle="modal" data-target="#modal-pelatihan">
                                        Tambah Pelatihan
                                        <i class="fa fa-plus"></i>
                                    </a>
                                </td>

                            </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="card-footer text-muted">
                        <a href="dokter.php" type="submit" id="submit" name="submit" class="btn btn-info">Kembali</a>
                        <!-- <button type="reset" class="btn btn-warning">Reset</button> -->

                    </div>
                </form>
            </div>

            <!-- modal-tambah-riwayat-pendidikan_ -->
            <div class="modal fade" id="modal-pendidikan" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Riwayat Pendidikan</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form method="post">
                                <div class="mb-3">
                                    <label for="instansi" class="form-label">Sekolah/Instansi</label>
                                    <input type="text" name="instansi" id="instansi" class="form-control form-control-lg" id="pendidikan" placeholder="Universitas Dinamika" required>
                                </div>
                                <div class="mb-3">
                                    <label for="bidang" class="form-label">bidang Studi</label>
                                    <input type="text" name="bidang" id="bidang" class="form-control form-control-lg" id="pendidikan" placeholder="Sistem Informasi">
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <div class="mb-3">
                                            <label for="thn_masuk" class="form-label">Tahun Masuk</label>
                                            <input type="number" name="thn_masuk" id="thn_masuk" class="form-control form-control-lg" id="pendidikan" placeholder="2011" required>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="mb-3">
                                            <label for="thn_keluar" class="form-label">Tahun Keluar</label>
                                            <input type="number" name="thn_keluar" id="thn_keluar" class="form-control form-control-lg" id="pendidikan" placeholder="2012" required>
                                        </div>
                                    </div>
                                </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                            <button type="sumbit" name="simpan" class="btn btn-primary">Simpan</button>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
            <!-- code php pendidikan -->
            <?php
            $dokter = '';

            if (isset($_POST['id'])) {
                $dokter = $_POST['id'];
            } elseif (isset($_GET['id'])) {
                $dokter = $_GET['id'];
            }

            $instansi = "";
            $bidang = "";
            $tahun_msk = "";
            $tahun_klr = "";


            if (isset($_POST['simpan'])) {
                $dokter = $_GET['id'];
                $instansi = $_POST['instansi'];
                $bidang = $_POST['bidang'];
                $tahun_msk = $_POST['thn_masuk'];
                $tahun_klr = $_POST['thn_keluar'];

                $query_add_pendidikan = "insert into riwayat_pendidikan (id_pendidikan, id_dokter, instansi, bidang_studi, tahun_masuk, tahun_keluar)
                                                            values('','$dokter', '$instansi', '$bidang', '$tahun_msk', $tahun_klr)";
                $result_add_pendidikan = mysqli_query($conn, $query_add_pendidikan) or die(mysqli_error($conn));
                if ($result_add_pendidikan == 1) {
                    echo "
                            <script>
                                alert('Data Berhasil Ditambahkan'); 
                                window.location.href = 'detail-dokter.php?act=view&id=$dokter';
                            </script>
                        ";
                }
            }

            ?>

            <!-- modal-ubah-riwayat-pendidikan_ -->
            <?php
            if (isset($_POST['update_pendidikan'])) {
                $id_pendidikan = $_POST['id'];
                $instansi = $_POST['instansi'];
                $bidang = $_POST['bidang'];
                $tahun_msk = $_POST['thn_masuk'];
                $tahun_klr = $_POST['thn_keluar'];


                $queryUpdatePendidikan = "update riwayat_pendidikan 
                                            set instansi='" . $instansi . "', 
                                            bidang_studi='" . $bidang . "', 
                                            tahun_masuk=" . $tahun_msk . ", 
                                            tahun_keluar=" . $tahun_klr . "
                                            where id_pendidikan=" . $id_pendidikan;
                $execUpdatePendidikan = mysqli_query($conn, $queryUpdatePendidikan);
                if ($execUpdatePendidikan == 1) {
                    echo "
                            <script>
                                alert('Data Berhasil Diperbarui'); 
                                window.location.href = 'detail-dokter.php?act=view&id=$_GET[id]';
                            </script>
                        ";
                } else {
                    echo "
                            <script>
                                alert('Data Gagal Diperbarui'); 
                                window.location.href = 'detail-dokter.php?act=view&id=$_GET[id]';
                            </script>
                        ";
                }
            }

            ?>
            <div class="modal fade" id="modal-ubah-pendidikan" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Riwayat Pendidikan</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form method="post">
                                <div class="mb-3">
                                    <label for="instansi" class="form-label">Sekolah/Instansi</label>
                                    <input type="text" name="instansi" id="instansi" class="form-control form-control-lg" id="pendidikan" placeholder="Universitas Dinamika" required>
                                    <input type="text" name="id" id="id" readonly hidden>
                                </div>
                                <div class="mb-3">
                                    <label for="bidang" class="form-label">bidang Studi</label>
                                    <input type="text" name="bidang" id="bidang" class="form-control form-control-lg" id="pendidikan" placeholder="Sistem Informasi">
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <div class="mb-3">
                                            <label for="thn_masuk" class="form-label">Tahun Masuk</label>
                                            <input type="number" name="thn_masuk" id="thn_masuk" class="form-control form-control-lg" id="pendidikan" placeholder="2011" required>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="mb-3">
                                            <label for="thn_keluar" class="form-label">Tahun Keluar</label>
                                            <input type="number" name="thn_keluar" id="thn_keluar" class="form-control form-control-lg" id="pendidikan" placeholder="2012" required>
                                        </div>
                                    </div>
                                </div>
                        </div>
                        <div class="modal-footer">
                            <button class="btn btn-secondary" data-dismiss="modal">Batal</button>
                            <button type="sumbit" name="update_pendidikan" class="btn btn-primary">Perbarui</button>
                        </div>
                        </form>
                    </div>
                </div>
            </div>

            <!-- modal-tambah-pekerjaan -->
            <div class="modal fade" id="modal-pekerjaan" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Riwayat Pekerjaan</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form method="post">
                                <div class="mb-3">
                                    <label for="posisi" class="form-label">Posisi</label>
                                    <input type="text" name="posisi" id="posisi" class="form-control form-control-lg" id="pendidikan" placeholder="Senin" required>
                                </div>
                                <div class="mb-3">
                                    <label for="perusahaan" class="form-label">Nama Perusahaan</label>
                                    <input type="text" name="perusahaan" id="perusahaan" class="form-control form-control-lg" placeholder="Senin" required>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <div class="mb-3">
                                            <label for="tahun_msk" class="form-label">Tahun Masuk</label>
                                            <input type="number" name="tahun_msk" id="tahun_msk" class="form-control form-control-lg" id="pendidikan" placeholder="2011" required>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="mb-3">
                                            <label for="tahun_klr" class="form-label">Tahun Keluar</label>
                                            <input type="number" name="tahun_klr" id="tahun_klr" class="form-control form-control-lg" id="pendidikan" placeholder="2011" required>
                                        </div>
                                    </div>
                                </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                            <button type="submit" name="simpan1" class="btn btn-primary">Simpan</button>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
            <!-- code php tambah-pekerjaan -->
            <?php
            $dokter1 = '';

            if (isset($_POST['id'])) {
                $dokter1 = $_POST['id'];
            } elseif (isset($_GET['id'])) {
                $dokter1 = $_GET['id'];
            }

            $posisi = "";
            $perusahaan = "";
            $thn_masuk = "";
            $thn_keluar = "";

            if (isset($_POST['simpan1'])) {
                $dokter1 = $_GET['id'];
                $posisi = $_POST['posisi'];
                $perusahaan = $_POST['perusahaan'];
                $thn_masuk = $_POST['tahun_msk'];
                $thn_keluar = $_POST['tahun_klr'];
                $query_add_pekerjaan = "insert into riwayat_pekerjaan (
                                                        id_pekerjaan, id_dokter, posisi, nama_perusahaan, tahun_masuk, tahun_keluar)
                                                        values ('','$dokter1','$posisi', '$perusahaan', '$thn_masuk', '$thn_keluar')";

                $result_add_pekerjaan = mysqli_query($conn, $query_add_pekerjaan) or die(mysqli_error($conn));
                if ($result_add_pekerjaan == 1) {
                    echo "
                                <script>
                                    alert('Data Berhasil Ditambahkan'); 
                                    window.location.href = 'detail-dokter.php?act=view&id=$dokter';
                                </script>
                            ";
                }
            }
            ?>

            <!-- modal-ubah-riwayat-pekerjaan -->
            <?php
            if (isset($_POST['update_pekerjaan'])) {
                $id_pekerjaan = $_POST['id'];
                $posisi = $_POST['posisi'];
                $perusahaan = $_POST['perusahaan'];
                $thn_masuk = $_POST['tahun_msk'];
                $thn_keluar = $_POST['tahun_klr'];


                $queryUpdatePekerjaan = "update riwayat_pekerjaan
                                            set posisi='" . $posisi . "', 
                                            nama_perusahaan='" . $perusahaan . "', 
                                            tahun_masuk=" . $thn_masuk . ", 
                                            tahun_keluar=" . $thn_keluar . "
                                            where id_pekerjaan=" . $id_pekerjaan;
                $execUpdatePekerjaan = mysqli_query($conn, $queryUpdatePekerjaan);
                if ($execUpdatePekerjaan == 1) {
                    echo "
                            <script>
                                alert('Data Berhasil Diperbarui'); 
                                window.location.href = 'detail-dokter.php?act=view&id=$_GET[id]';
                            </script>
                        ";
                } else {
                    echo "
                            <script>
                                alert('" . $queryUpdatePekerjaan . "); 
                                window.location.href = 'detail-dokter.php?act=view&id=$_GET[id]';
                            </script>
                        ";
                }
            }

            ?>
            <div class="modal fade" id="modal-ubah-pekerjaan" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Riwayat Pekerjaan</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form method="post" id="form-edit-pekerjaan">
                                <div class="mb-3">
                                    <label for="posisi" class="form-label">Posisi</label>
                                    <input type="text" name="posisi" id="posisi" class="form-control form-control-lg" placeholder="Dokter bedah" required>
                                </div>
                                <div class="mb-3">
                                    <label for="perusahaan" class="form-label">Nama Perusahaan</label>
                                    <input type="text" name="perusahaan" id="perusahaan" class="form-control form-control-lg" placeholder="Rumah Sakit..." required>
                                    <input type="text" name="id" id="id" readonly hidden>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <div class="mb-3">
                                            <label for="tahun_msk" class="form-label">Tahun Masuk</label>
                                            <input type="number" name="tahun_msk" id="tahun_msk" class="form-control form-control-lg" placeholder="2011" required>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="mb-3">
                                            <label for="tahun_klr" class="form-label">Tahun Keluar</label>
                                            <input type="number" name="tahun_klr" id="tahun_klr" class="form-control form-control-lg" placeholder="2011" required>
                                        </div>
                                    </div>
                                </div>
                        </div>
                        <div class="modal-footer">
                            <button class="btn btn-secondary" data-dismiss="modal">Batal</button>
                            <button type="submit" name="update_pekerjaan" class="btn btn-primary">Simpan</button>
                        </div>
                        </form>
                    </div>
                </div>
            </div>


            <!-- modal-tambah-pelatihan -->
            <div class="modal fade" id="modal-pelatihan" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Pelatihan</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form method="post">
                                <div class="mb-3">
                                    <label for="pelatihan" class="form-label">Nama Pelatihan</label>
                                    <input type="text" name="pelatihan" id="pelatihan" class="form-control form-control-lg" id="pendidikan" placeholder="Senin" required>
                                </div>
                                <div class="mb-3">
                                    <label for="thn" class="form-label">Tahun</label>
                                    <input type="number" name="thn" id="thn" class="form-control form-control-lg" id="pendidikan" placeholder="2011" required>
                                </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                            <button type="submit" name="simpan_pelatihan" class="btn btn-primary">Simpan</button>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
            <!-- Code php tambah_pelatihan -->
            <?php
            $dokter_pelatihan = '';

            if (isset($_POST['id'])) {
                $dokter_pelatihan = $_POST['id'];
            } elseif (isset($_POST['id'])) {
                $dokter_pelatihan = $_GET['id'];
            }

            $pelatihan = "";
            $tahun = "";

            if (isset($_POST['simpan_pelatihan'])) {
                $dokter_pelatihan = $_GET['id'];
                $pelatihan = $_POST['pelatihan'];
                $tahun = $_POST['thn'];

                $query_add_pelatihan = "insert into pelatihan (id_pelatihan, id_dokter, nama_pelatihan, tahun)
                                                values ('', '$dokter_pelatihan', '$pelatihan', '$tahun')";

                $result_add_pelatihan = mysqli_query($conn, $query_add_pelatihan);
                if ($result_add_pelatihan == 1) {
                    echo "
                            <script>
                                alert('Data Berhasil Ditambahkan'); 
                                window.location.href = 'detail-dokter.php?act=view&id=$dokter';
                            </script>
                            ";
                }
            }

            ?>


        </div>
    </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/b060a488c4.js" crossorigin="anonymous"></script>
    <script>
        $(document).on("click", "#btnUbah", function() {


            let pendidikan = $(this).data('id-pendidikan');
            // let dokter = $(this).data('id_dokter');
            let instansi = $(this).data('instansi');
            let bidang = $(this).data('bidang');
            let masuk = $(this).data('masuk');
            let keluar = $(this).data('keluar');

            $(".modal-body #id").val(pendidikan);
            $(".modal-body #instansi").val(instansi);
            $(".modal-body #bidang").val(bidang);
            $(".modal-body #thn_masuk").val(masuk);
            $(".modal-body #thn_keluar").val(keluar);
        });

        $(document).on("click", "#btnUbahPekerjaan", function() {
            let pekerjaan = $(this).data('id-pekerjaan');
            // let dokter = $(this).data('id_dokter');
            let posisi = $(this).data('posisi');
            let perusahaan = $(this).data('perusahaan');
            let thn_masuk = $(this).data('thn-masuk');
            let thn_keluar = $(this).data('thn-keluar');

            console.log("Tes");
            $(".modal-body #id").val(pekerjaan);
            $(".modal-body #posisi").val(posisi);
            $(".modal-body #perusahaan").val(perusahaan);
            $(".modal-body #tahun_msk").val(thn_masuk);
            $(".modal-body #tahun_klr").val(thn_keluar);
        });
    </script>
</body>

</html>