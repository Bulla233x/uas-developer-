<?php
$host           = "localhost";
$user           = "root";
$pass           = "";
$db             = "hotel_database";

$koneksi        = mysqli_connect($host, $user, $pass, $db);
if (!$koneksi) {
    die("Tidak bisa terkoneksi ke database");
}

$kode_temu      = "";
$kode_kamar     = "";
$tgl_checkin    = "";
$lama_inap      = "";
$sukses         = "";
$error          = "";

if (isset($_GET['op'])) {
    $op = $_GET['op'];
} else {
    $op = "";
}

if ($op == 'delete') {
    $id         = $_GET['id'];
    $sql1       = "DELETE FROM hotel_inap WHERE id = '$id'";
    $q1         = mysqli_query($koneksi, $sql1);
    if ($q1) {
        $sukses = "Berhasil hapus data";
    } else {
        $error  = "Gagal melakukan delete data";
    }
}

if ($op == 'edit') {
    $id             = $_GET['id'];
    $sql1           = "SELECT * FROM hotel_inap WHERE id = '$id'";
    $q1             = mysqli_query($koneksi, $sql1);
    $r1             = mysqli_fetch_array($q1);
    $kode_temu      = $r1['kode_temu'];
    $kode_kamar     = $r1['kode_kamar'];
    $tgl_checkin    = $r1['tgl_checkin'];
    $lama_inap      = $r1['lama_inap'];

    if ($kode_temu == '') {
        $error = "Data tidak ditemukan";
    }
}

if (isset($_POST['simpan'])) { // untuk create atau update
    $kode_temu      = $_POST['kode_temu'];
    $kode_kamar     = $_POST['kode_kamar'];
    $tgl_checkin    = $_POST['tgl_checkin'];
    $lama_inap  = $_POST['lama_inap'];

    if ($kode_temu && $kode_kamar && $tgl_checkin && $lama_inap) {
        
        $tarif = 0; 

        $kode_kamar = $_POST['kode_kamar'];

        if ($kode_kamar == 'A-100') {
            $tarif = 3000000;
        } elseif ($kode_kamar == 'B-100') {
            $tarif = 4000000;
        } elseif ($kode_kamar == 'C-100') {
            $tarif = 5000000;
        }

        $lama_inap = $_POST['lama_inap'];
        $total_tarif = $tarif * $lama_inap;

        
        if (($kode_kamar == 'A-100' || $kode_kamar == 'B-100') && $lama_inap > 5) {
            $diskon = 10 * $total_tarif; 
        } elseif ($kode_kamar == 'C-100' && $lama_inap > 5) {
            $diskon = 0.07 * $total_tarif;
        } else {
            $diskon = 0;
        }

        if ($op == 'edit') {
            $sql1   = "UPDATE hotel_inap SET kode_temu = '$kode_temu', kode_kamar = '$kode_kamar', tgl_checkin = '$tgl_checkin', lama_inap = '$lama_inap', total_tarif = '$total_tarif', diskon = '$diskon' WHERE id = '$id'";
        } else {
            $sql1   = "INSERT INTO hotel_inap (kode_temu, kode_kamar, tgl_checkin, lama_inap, total_tarif, diskon) VALUES ('$kode_temu','$kode_kamar','$tgl_checkin','$lama_inap','$total_tarif','$diskon')";
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
            width: 860px
        }

        .card {
            margin-top: 20px;
        }
    </style>
</head>

<body>
    <div class="mx-auto">
        <div class="card">
        <div class="p-3 mb-2 bg-light text-dark">DATA INAP</div>
            <div class="card-body">
                <?php
                if ($error) {
                ?>
                    <div class="alert alert-danger" role="alert">
                        <?php echo $error ?>
                    </div>
                <?php
                    header("refresh:5;url=datainap.php");//5 : detik
                }
                ?>
                <?php
                if ($sukses) {
                ?>
                    <div class="alert alert-success" role="alert">
                        <?php echo $sukses ?>
                        </div>
                <?php
                    header("refresh:5;url=datainap.php");
                }
                ?>
<form action="" method="POST">
    <!-- Other form fields -->
    <div class="mb-3 row">
        <label for="kode_temu" class="col-sm-2 col-form-label">KODE TEMU</label>
        <div class="col-sm-3">
            <select class="form-select" id="kode_temu" name="kode_temu">
                <option selected>Menu</option>
                <option value="A-100" <?php echo ($kode_temu == 'A-100') ? 'selected' : ''; ?>>A-100</option>
                <option value="B=100" <?php echo ($kode_temu == 'B-100') ? 'selected' : ''; ?>>B-100</option>
                <option value="C-100" <?php echo ($kode_temu == 'C-100') ? 'selected' : ''; ?>>C-100</option>
            </select>
        </div>
    </div>
    <div class="mb-3 row">
        <label for="kode_kamar" class="col-sm-2 col-form-label">KODE KAMAR</label>
        <div class="col-sm-3">
            <select class="form-select" id="kode_kamar" name="kode_kamar">
                <option selected>Menu</option>
                <option value="A-100" <?php echo ($kode_kamar == 'A-100') ? 'selected' : ''; ?>>A-100</option>
                <option value="B-100" <?php echo ($kode_kamar == 'B-100') ? 'selected' : ''; ?>>B-100</option>
                <option value="C-100" <?php echo ($kode_kamar == 'C-100') ? 'selected' : ''; ?>>C-100</option>
            </select>
        </div>
    </div>
    <div class="mb-3 row">
        <label for="tgl_checkin" class="col-sm-2 col-form-label">TGL CHECK IN</label>
        <div class="col-sm-5">
            <input type="date" class="form-control" id="tgl_checkin" name="tgl_checkin" value="<?php echo $tgl_checkin ?>">
        </div>
    </div>
    <div class="mb-3 row">
        <label for="lama_inap" class="col-sm-2 col-form-label">LAMA INAP</label>
        <div class="col-sm-5">
            <input type="text" class="form-control" id="lama_inap" name="lama_inap" value="<?php echo $lama_inap ?>">
        </div>
    </div>
    <div class="col-12">
        <input type="submit" name="simpan" value="PROSES" class="btn btn-primary" />
    </div>
</form>
</body>
</html>

<div class="card">
<div class="p-3 mb-2 bg-info text-dark">INFO TRANSAKSI</div>
    <div class="card-body">
        <table class="table">
        <thead>
    <tr>
        <th scope="col">NO</th>
        <th scope="col">KODE TAMU</th>
        <th scope="col">KODE KAMAR</th>
        <th scope="col">TARIF</th>
        <th scope="col">LAMA INAP</th>
        <th scope="col">TOTAL TARIF</th>
        <th scope="col">DISKON</th>
        <th scope="col"></th>
    </tr>
</thead>
<tbody>
    <?php
    $sql2   = "SELECT * FROM hotel_inap ORDER BY id DESC";
    $q2     = mysqli_query($koneksi, $sql2);
    $urut   = 1;
    while ($r2 = mysqli_fetch_array($q2)) {
        $id             = $r2['id'];
        $kode_temu      = $r2['kode_temu'];
        $kode_kamar     = $r2['kode_kamar'];
        $tgl_checkin    = $r2['tgl_checkin'];
        $lama_inap      = $r2['lama_inap'];
        $total_tarif    = $r2['total_tarif'];
        $diskon         = $r2['diskon'];
    ?>
        <tr>
            <th scope="row"><?php echo $urut++ ?></th>
            <td scope="row"><?php echo $kode_temu ?></td>
            <td scope="row"><?php echo $kode_kamar ?></td>
            <td scope="row"><?php echo $tgl_checkin ?></td>
            <td scope="row"><?php echo $lama_inap ?></td>
            <td scope="row"><?php echo $total_tarif ?></td>
            <td scope="row"><?php echo $diskon ?></td>
            <td scope="row">
                <a href="datainap.php?op=edit&id=<?php echo $id ?>"><button type="button" class="black">Edit</button></a>
                <a href="datainap.php?op=delete&id=<?php echo $id ?>" onclick="return confirm('Yakin mau delete data?')"><button type="button" class="black">Delete</button></a>
            </td>
        </tr>
    <?php
    }
    ?>
</tbody>
