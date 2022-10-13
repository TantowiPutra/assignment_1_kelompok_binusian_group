<?php
$host = "localhost";
$user = "root";
$password = "";
$database = "daftar_pelanggan";

$connect = mysqli_connect($host, $user, $password, $database);
if ($connect) {
    //echo "Succesfully Connected to Database";
} else {
    throw new exception("Failed to Connect Database: " . mysqli_connect_error());
}

$nama = "";
$alamat = "";
$transaksi = "";
$status = "";
$gender = "";
$success = "";
$error = "";
$total = "";
$counter = 0;
$ids = "";

if (isset($_GET['op'])) {
    $op = $_GET['op'];
} else {
    $op = "";
}

if($op == 'delete'){
    $save       = $_GET['id'];
    $query      = "DELETE FROM pelanggan WHERE idPelanggan = '$save'";
    $execute    = mysqli_query($connect, $query);
    if($execute){
        $sukses = "Data Succesfully Deleted";
    } else{
        $error = "Failed to Delete Data";
    }
}

if ($op == 'edit') {
    $ids = $_GET['id'];
    $query_2  = "SELECT * FROM `pelanggan` WHERE idPelanggan ='$ids'";
    $execute_query_2 = mysqli_query($connect, $query_2);
    $save = mysqli_fetch_array($execute_query_2);
 
    $id         = $save['idPelanggan'];
    $nama       = $save['namaPelanggan'];
    $alamat     = $save['alamatPelanggan'];
    $transaksi  = $save['jumlahTransaksi'];
    $status     = $save['statusPelanggan'];
    $gender     = $save['genderPelanggan'];

    if ($id = "") {
        $error = "Data unavailable";
    }
}

if (isset($_POST['save'])) {
    $nama = $_POST['nama'];
    $alamat = $_POST['alamat'];
    $transaksi = $_POST['transaksi'];
    $status = $_POST['status'];
    $gender = $_POST['gender'];

    $select_all = "SELECT * FROM pelanggan";
    $result = mysqli_query($connect, $select_all);
    while (mysqli_fetch_array($result)) {
        $counter += 1;
    }

    if ($nama != NULL && $alamat != NULL && $transaksi != NULL && $status != NULL && $gender != NULL) {
        if($op == "edit"){
            $query = "UPDATE pelanggan SET namaPelanggan = '$nama', alamatPelanggan = '$alamat', jumlahTransaksi = '$transaksi', statusPelanggan = '$status', genderPelanggan = '$gender' WHERE idPelanggan = '$ids'";
            $q = mysqli_query($connect, $query);
            if($q){
                $success = "Successfully Updated Customer Data";
            }else{
                $error = "Failed to Update Customer Data";
            }
        } else {
            $query = "INSERT INTO pelanggan(idPelanggan, namaPelanggan, alamatPelanggan, jumlahTransaksi, statusPelanggan, genderPelanggan) VALUES('PE$counter', '$nama', '$alamat', $transaksi, '$status', '$gender');";
            $execute_query = mysqli_query($connect, $query);

            if ($execute_query) {
                //echo "Succesfully Insert Data";
                $success = "Data Submited";
                $nama = "";
                $alamat = "";
                $transaksi = "";
                $status = "";
                $gender = "";
            } else {
                throw new exception("Failed to Insert Data: " . mysqli_connect_error());
                $error = "Failed to Insert Data";
            }
        }
    } else {
        $error = "All fields must be filled!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Pelanggan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <style>
        .card-header {
            font-weight: bolder;
            font-family: Arial, Helvetica, sans-serif;
            font-size: large;
        }

        .card-body {
            background-color: rgb(255, 221, 204);
        }

        .card {
            margin: 20px;
        }

        .form-label {
            font-weight: bold;
        }

        .first {
            background-color: wheat;
        }

        .second {
            background-color: lightsteelblue;
        }

        .col-11 {
            margin-left: 40%;
        }
    </style>
</head>

<body>
    <!-- Input data into DB -->
    <div class="mx-auto " style="width: 600px">
        <div class="card">
            <div class="card-header text-warning bg-warning bg-gradient bg-opacity-10">
                CRUDE (Create/Update/Delete) Data Pelanggan
            </div>
            <div class="card-body first">
                <?php
                if ($error) {
                ?>
                    <div class="alert alert-danger" role="alert">
                        <?php echo $error ?>
                    </div>
                <?php
                    header("refresh: 5; url = home.php");
                }
                ?>

                <?php
                if ($success) {
                ?>
                    <div class="alert alert-success" role="alert">
                        <?php echo $success ?>
                    </div>
                <?php
                     header("refresh: 5; url = home.php");
                }
                ?>

                <!-- Kirim data input -->
                <form action="" method="POST">
                    <div class="mb-3 row col-sm-11">
                        <label for="nama" class="form-label">Nama Pelanggan</label>
                        <input type="text" class="form-control" id="nama" name="nama" placeholder="cth: John Doe" value="<?php echo $nama ?>">
                    </div>

                    <div class="mb-3 row col-sm-11">
                        <label for="alamat" class="form-label">Alamat Pelanggan</label>
                        <input type="text" class="form-control" id="alamat" name="alamat" placeholder="cth: jln merpati no.3" value="<?php echo $alamat ?>">
                    </div>

                    <div class="mb-3 row col-sm-11">
                        <label for="transaksi" class="form-label">Jumlah Transaksi</label>
                        <input type="text" class="form-control" id="transaksi" name="transaksi" placeholder="cth: 50000" value="<?php echo $transaksi ?>">
                    </div>

                    <div class="mb-3 row col-sm-11">
                        <label for="status" class="form-label">Status Pelanggan</label>
                        <input type="text" class="form-control" id="status" name="status" placeholder="Bronze/Silver/Gold" value="<?php echo $status ?>">
                    </div>

                    <div class="mb-3 row">
                        <label for="gender" class="form-label">Gender Pelanggan</label>
                        <div class="col-sm-11 mb-3 row">
                            <select class=" form-control" id="gender" name="gender" value="<?php echo $gender ?>">
                                <option value="<?php echo $gender ?>">~ Pilih Gender ~</option>
                                <option value="Laki-Laki" <?php if ($gender == "Laki-Laki") echo "selected" ?>>Laki-Laki</option>
                                <option value="Perempuan" <?php if ($gender == "Perempuan") echo "selected" ?>>Perempuan</option>
                            </select>
                        </div>
                    </div>

                    <div class="col-11 position-relative">
                        <input type="submit" id="save" name="save" value="Simpan Data" class="btn btn-primary"></input>
                    </div>

                </form>
            </div>
        </div>
    </div>

    <div class="mx-max" style="width: 1500px;">
        <div class="card">
            <div class="card-header text-primary bg-info bg-gradient bg-opacity-10">
                Daftar Pelanggan
            </div>
            <div class="card-body second">
                <table class="table table-dark table-hover table-striped-columns">
                    <thead>
                        <tr>
                            <td scope="col">No.</td>
                            <td scope="col">ID Pelanggan</td>
                            <td scope="col">Nama Pelanggan</td>
                            <td scope="col">Alamat Pelanggan</td>
                            <td scope="col">Jumlah Transaksi</td>
                            <td scope="col">Status Pelanggan</td>
                            <td scope="col">Gender Pelanggan</td>
                            <td scope="col">Update/Delete Data</td>
                        </tr>
                    </thead>

                    <tbody>
                      <?php
                        $query2 = "SELECT * FROM pelanggan";
                        $execute = mysqli_query($connect, $query2);
                        $urut = 0;
                        while ($data = mysqli_fetch_array($execute)) {
                            $id         = $data['idPelanggan'];
                            $nama       = $data['namaPelanggan'];
                            $alamat     = $data['alamatPelanggan'];
                            $transaksi  = $data['jumlahTransaksi'];
                            $status     = $data['statusPelanggan'];
                            $gender     = $data['genderPelanggan'];
                            $urut++;
                        ?>
                            <tr>
                                <td scope="row"><?php echo $urut ?></td>
                                <td scope="row"><?php echo $id ?></td>
                                <td scope="row"><?php echo $nama ?></td>
                                <td scope="row"><?php echo $alamat ?></td>
                                <td scope="row"><?php echo $transaksi ?></td>
                                <td scope="row"><?php echo $status ?></td>
                                <td scope="row"><?php echo $gender ?></td>
                                <td scope="row">
                                    <a href="home.php?op=edit&id=<?php echo $id ?>" onclick="return confirm('Update Data?')"><button type="button" class="btn btn-warning">Update</button></a>
                                    <a href="home.php?op=delete&id=<?php echo $id?>" onclick = "return confirm('Apakah Anda yakin Untuk Menghapus Data?')"><button type="button" class="btn btn-danger">Delete</button></a>
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