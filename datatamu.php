<?php
$host           = "localhost";
$user           = "root";
$pass           = "";
$db             = "hotel_database";

$koneksi        = mysqli_connect($host, $user, $pass, $db);
if (!$koneksi) { // Check connection
    die("Tidak bisa terkoneksi ke database");
}

$kode_temu     = "";
$nama_tamu      = "";
$alamat         = "";
$jenis_kelamin  = "";
$sukses         = "";
$error          = "";

if (isset($_GET['op'])) {
    $op = $_GET['op'];
} else {
    $op = "";
}

if ($op == 'delete') {
    $id         = $_GET['id'];
    $sql1       = "DELETE FROM hotel_tamu WHERE id = '$id'";
    $q1         = mysqli_query($koneksi, $sql1);
    if ($q1) {
        $sukses = "Berhasil hapus data";
    } else {
        $error  = "Gagal melakukan delete data";
    }
}

if ($op == 'edit') {
    $id         = $_GET['id'];
    $sql1       = "SELECT * FROM hotel_tamu WHERE id = '$id'";
    $q1         = mysqli_query($koneksi, $sql1);
    $r1         = mysqli_fetch_array($q1);
    $kode_temu = $r1['kode_temu'];
    $nama_tamu  = $r1['nama_tamu'];
    $alamat     = $r1['alamat'];
    $jenis_kelamin = $r1['jenis_kelamin'];

    if ($kode_temu == '') {
        $error = "Data tidak ditemukan";
    }
}

if (isset($_POST['simpan'])) { // untuk create atau update
    $kode_temu      = $_POST['kode_temu'];
    $nama_tamu      = $_POST['nama_tamu'];
    $alamat         = $_POST['alamat'];
    $jenis_kelamin  = $_POST['jenis_kelamin'];

    if ($kode_temu && $nama_tamu && $alamat && $jenis_kelamin) {
        if ($op == 'edit') {
            $sql1   = "UPDATE hotel_tamu SET kode_temu = '$kode_temu', nama_tamu = '$nama_tamu', alamat = '$alamat', jenis_kelamin = '$jenis_kelamin' WHERE id = '$id'";
        } else {
            $sql1   = "INSERT INTO hotel_tamu (kode_temu, nama_tamu, alamat, jenis_kelamin) VALUES ('$kode_temu','$nama_tamu','$alamat','$jenis_kelamin')";
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
    <title>KAMAR KHASBULLA</title>
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
        <div class="p-3 mb-2 bg-light text-dark">DATA TAMU</div>
            <div class="card-body">
                <?php
                if ($error) {
                ?>
                    <div class="alert alert-danger" role="alert">
                        <?php echo $error ?>
                    </div>
                <?php
                    header("refresh:5;url=datatamu.php");//5 : detik
                }
                ?>
                <?php
                if ($sukses) {
                ?>
                    <div class="alert alert-success" role="alert">
                        <?php echo $sukses ?>
                        </div>
                <?php
                    header("refresh:5;url=datatamu.php");
                }
                ?>
<form action="" method="POST">
    <div class="mb-3 row">
        <label for="kode_temu" class="col-sm-2 col-form-label">KODE TAMU</label>
        <div class="col-sm-2">
            <input type="text" class="form-control" id="kode_temu" name="kode_temu" value="<?php echo $kode_temu ?>">
        </div>
    </div>
    <div class="mb-3 row">
        <label for="nama_tamu" class="col-sm-2 col-form-label">NAMA TAMU</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" id="nama_tamu" name="nama_tamu" value="<?php echo $nama_tamu ?>">
        </div>
    </div>
    <div class="mb-3 row">
        <label for="alamat" class="col-sm-2 col-form-label">ALAMAT TAMU</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" id="alamat" name="alamat" value="<?php echo $alamat ?>">
        </div>
    </div>
    <div class="mb-3 row">
        <label for="jenis_kelamin" class="col-sm-2 col-form-label">JENIS KELAMIN</label>
        <div class="col-sm-10">
            <input type="radio" class="form-check-input" id="jenis_kelamin_laki" name="jenis_kelamin" value="laki-laki" <?php if ($jenis_kelamin == "laki-laki") echo "checked" ?>> Laki-laki
            <input type="radio" class="form-check-input" id="jenis_kelamin_perempuan" name="jenis_kelamin" value="perempuan" <?php if ($jenis_kelamin == "perempuan") echo "checked" ?>> Perempuan
        </div>
    </div>
    <div class="col-12">
        <input type="submit" name="simpan" value="PROSES" class="btn btn-primary"/>
    </div>
</form>
</body>
</html>

<div class="card">
<div class="p-3 mb-2 bg-info text-dark">DATA TAMU</div>
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">NO</th>
                    <th scope="col">KODE TAMU</th>
                    <th scope="col">NAMA TAMU</th>
                    <th scope="col">ALAMAT TAMU</th>
                    <th scope="col">JENIS KELAMIN</th>
                    <th scope="col"></th>
                </tr>
            </thead>
            <tbody>
                <?php
                $sql2   = "SELECT * FROM hotel_tamu ORDER BY id DESC";
                $q2     = mysqli_query($koneksi, $sql2);
                $urut   = 1;
                while ($r2 = mysqli_fetch_array($q2)) {
                    $id             = $r2['id'];
                    $kode_temu      = $r2['kode_temu'];
                    $nama_tamu      = $r2['nama_tamu'];
                    $alamat         = $r2['alamat'];
                    $jenis_kelamin  = $r2['jenis_kelamin'];

                ?>
                    <tr>
                        <th scope="row"><?php echo $urut++ ?></th>
                        <td scope="row"><?php echo $kode_temu ?></td>
                        <td scope="row"><?php echo $nama_tamu ?></td>
                        <td scope="row"><?php echo $alamat ?></td>
                        <td scope="row"><?php echo $jenis_kelamin ?></td>
                        <td scope="row">
                            <a href="datatamu.php?op=edit&id=<?php echo $id ?>"><button type="button" class="black">Edit</button></a>
                            <a href="datatamu.php?op=delete&id=<?php echo $id ?>" onclick="return confirm('Yakin mau delete data?')"><button type="button" class="black">Delete</button></a>
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