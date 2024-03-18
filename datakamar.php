<?php
$host           = "localhost";
$user           = "root";
$pass           = "";
$db             = "hotel_database";

$koneksi        = mysqli_connect($host, $user, $pass, $db);
if (!$koneksi) { // Check connection
    die("Tidak bisa terkoneksi ke database");
}

$kode_kamar     = "";
$tipe_kamar     = "";
$jumlah_kamar   = "";
$sukses         = "";
$error          = "";

if (isset($_GET['op'])) {
    $op = $_GET['op'];
} else {
    $op = "";
}

if ($op == 'delete') {
    $id         = $_GET['id'];
    $sql1       = "DELETE FROM hotel_rooms WHERE id = '$id'";
    $q1         = mysqli_query($koneksi, $sql1);
    if ($q1) {
        $sukses = "Berhasil hapus data";
    } else {
        $error  = "Gagal melakukan delete data";
    }
}

if ($op == 'edit') {
    $id         = $_GET['id'];
    $sql1       = "SELECT * FROM hotel_rooms WHERE id = '$id'";
    $q1         = mysqli_query($koneksi, $sql1);
    $r1         = mysqli_fetch_array($q1);
    $kode_kamar = $r1['kode_kamar'];
    $tipe_kamar = $r1['tipe_kamar'];
    $jumlah_kamar = $r1['jumlah_kamar'];

    if ($kode_kamar == '') {
        $error = "Data tidak ditemukan";
    }
}

if (isset($_POST['simpan'])) { // untuk create atau update
    $kode_kamar     = $_POST['kode_kamar'];
    $tipe_kamar     = $_POST['tipe_kamar'];
    $jumlah_kamar   = $_POST['jumlah_kamar'];

    if ($kode_kamar && $tipe_kamar && $jumlah_kamar) {
        if ($op == 'edit') {
            $sql1   = "UPDATE hotel_rooms SET kode_kamar = '$kode_kamar', tipe_kamar = '$tipe_kamar', jumlah_kamar = '$jumlah_kamar' WHERE id = '$id'";
        } else {
            $sql1   = "INSERT INTO hotel_rooms (kode_kamar, tipe_kamar, jumlah_kamar) VALUES ('$kode_kamar','$tipe_kamar','$jumlah_kamar')";
        }

        $q1     = mysqli_query($koneksi, $sql1);

        if ($q1) {
            $sukses = ($op == 'edit') ? "Data berhasil diupdate" : "Berhasil memasukkan data baru";
        } else {
            $error  = "Gagal memasukkan data";
        }
    } else {
        $error = "Silakan masukkan semua data";
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>KAMAR KHASBULA</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
    <style>
        body {
            background-color: slategray;
        }

        .mx-auto {
            width: 850px
        }

        .card {
            margin-top: 20px;
        }
    </style>
</head>

<body>
    <div class="mx-auto">
        <div class="card">
        <div class="p-3 mb-2 bg-light text-dark">DATA KAMAR</div>
            <div class="card-body">
                <?php
                if ($error) {
                ?>
                    <div class="alert alert-danger" role="alert">
                        <?php echo $error ?>
                    </div>
                <?php
                    header("refresh:5;url=datakamar.php");//5 : detik
                }
                ?>
                <?php
                if ($sukses) {
                ?>
                    <div class="alert alert-success" role="alert">
                        <?php echo $sukses ?>
                        </div>
                <?php
                    header("refresh:5;url=datakamar.php");
                }
                ?>
<form action="" method="POST">
    <div class="mb-3 row">
        <label for="kode_kamar" class="col-sm-2 col-form-label">KODE KAMAR</label>
        <div class="col-sm-2">
            <input type="text" class="form-control" id="kode_kamar" name="kode_kamar" value="<?php echo $kode_kamar ?>">
        </div>
    </div>
    <div class="mb-3 row">
        <label for="tipe_kamar" class="col-sm-2 col-form-label">TIPE KAMAR</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" id="tipe_kamar" name="tipe_kamar" value="<?php echo $tipe_kamar ?>">
        </div>
    </div>
    <div class="mb-3 row">
        <label for="jumlah_kamar" class="col-sm-2 col-form-label">JUMLAH KAMAR</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" id="jumlah_kamar" name="jumlah_kamar" value="<?php echo $jumlah_kamar ?>">
        </div>
    </div>
    <div class="col-12">
        <input type="submit" name="simpan" value="PROSES" class="btn btn-primary" />
    </div>
</form>
</body>
</html>

<div class="card">
<div class="p-3 mb-2 bg-info text-dark">DATA KAMAR</div>
    <div class="card-body">
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">NO</th>
                    <th scope="col">KODE KAMAR</th>
                    <th scope="col">TIPE KAMAR</th>
                    <th scope="col">JUMLAH KAMAR</th>
                    <th scope="col"></th>
                </tr>
            </thead>
            <tbody>
                <?php
                $sqlKamar = "SELECT * FROM hotel_rooms ORDER BY id DESC";
                $queryKamar = mysqli_query($koneksi, $sqlKamar);
                $urutKamar = 1;
                while ($rowKamar = mysqli_fetch_array($queryKamar)) {
                    $idKamar = $rowKamar['id'];
                    $kodeKamar = $rowKamar['kode_kamar'];
                    $tipeKamar = $rowKamar['tipe_kamar'];
                    $jumlahKamar = $rowKamar['jumlah_kamar'];
                ?>
                    <tr>
                        <th scope="row"><?php echo $urutKamar++ ?></th>
                        <td scope="row"><?php echo $kodeKamar ?></td>
                        <td scope="row"><?php echo $tipeKamar ?></td>
                        <td scope="row"><?php echo $jumlahKamar ?></td>
                        <td scope="row">
                            <a href="datakamar.php?op=edit&id=<?php echo $idKamar ?>"><button type="button" class="black">Edit</button></a>
                            <a href="datakamar.php?op=delete&id=<?php echo $idKamar ?>" onclick="return confirm('Yakin mau delete data?')"><button type="button" class="black">Delete</button></a>
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
</body>

</html>

