<?php
include 'koneksi.php';

$no_hp        = "";
$nama       = "";
$alamat     = "";
$pilihan      = "";
$sukses     = "";
$error      = "";

if (isset($_GET['op'])) {
    $op = $_GET['op'];
} else {
    $op = "";
}

if($op == 'delete'){
    $id         = $_GET['id'];
    $sql1       = "delete from tbl_daftar where id = '$id'";
    $q1         = mysqli_query($koneksi,$sql1);
    if($q1){
        $sukses = "Berhasil hapus data";
    }else{
        $error  = "Gagal melakukan delete data";
    }
}
if ($op == 'edit') {
    $id         = $_GET['id'];
    $sql1       = "select * from tbl_daftar where id = '$id'";
    $q1         = mysqli_query($koneksi, $sql1);
    $r1         = mysqli_fetch_array($q1);
    $no_hp      = $r1['no_hp'];
    $nama       = $r1['nama'];
    $alamat     = $r1['alamat'];
    $pilihan   = $r1['pilihan'];

    if ($no_hp == '') {
        $error = "Data tidak ditemukan";
    }
}
if (isset($_POST['simpan'])) { //untuk create
    $no_hp        = $_POST['no_hp'];
    $nama       = $_POST['nama'];
    $alamat     = $_POST['alamat'];
    $pilihan   = $_POST['pilihan'];

    if ($no_hp && $nama && $alamat && $pilihan) {
        if ($op == 'edit') { //untuk update
            $sql1       = "update tbl_daftar set no_hp = '$no_hp',nama='$nama',alamat = '$alamat', pilihan='$pilihan' where id = '$id'";
            $q1         = mysqli_query($koneksi, $sql1);
            if ($q1) {
                $sukses = "Data berhasil diupdate";
            } else {
                $error  = "Data gagal diupdate";
            }
        } else { //untuk insert
            $sql1   = "insert into tbl_daftar(no_hp,nama,alamat,pilihan) values ('$no_hp','$nama','$alamat','$pilihan')";
            $q1     = mysqli_query($koneksi, $sql1);
            if ($q1) {
                $sukses     = "Berhasil memasukkan data baru";
            } else {
                $error      = "Gagal memasukkan data";
            }
        }
    } else {
        $error = "Silakan masukkan semua data";
    }
}
?>
<!DOCTYPE html>


<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Pendaftar</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="ano_hpnymous">
    <style>
        .mx-auto {
            width: 800px
        }

        .card {
            margin-top: 10px;
        }
        header {
            height:70px;
            background-color: #556B2F;
        }
        header h1 {
            display: inline-block;
            padding: 15px 24px;
            text-transform: uppercase;
        }
        .home {
            background-color: #EEE8AA;
            padding-left: 35px;
            padding: 100px;
        }
        
    </style>
</head>


<body>
    <!--- header --->
        <header>
            <div class="container"></div>
                <h1><a href=""></a></h1>
            </div>
        </header>

    <div class="mx-auto">
        <!-- untuk memasukkan data -->
        <div class="card">
            <div class="card-header">
                Silahkan Daftar
            </div>
            <div class="card-body">
                <?php
                if ($error) {
                ?>
                    <div class="alert alert-danger" role="alert">
                        <?php echo $error ?>
                    </div>
                <?php
                    header("refresh:5;url=index.php");//5 : detik
                }
                ?>
                <?php
                if ($sukses) {
                ?>
                    <div class="alert alert-success" role="alert">
                        <?php echo $sukses ?>
                    </div>
                <?php
                    header("refresh:5;url= daftar.php");
                }
                 
                ?>
                <form action="" method="POST">
                    <div class="mb-3 row">
                        <label for="no_hp" class="col-sm-2 col-form-label">NoHP</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="no_hp" name="no_hp" value="<?php echo $no_hp ?>">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="nama" class="col-sm-2 col-form-label">Nama</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="nama" name="nama" value="<?php echo $nama ?>">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="alamat" class="col-sm-2 col-form-label">Alamat</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="alamat" name="alamat" value="<?php echo $alamat ?>">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="kelas" class="col-sm-2 col-form-label">Pilihan</label>
                        <div class="col-sm-10">
                            <select class="form-control" name="pilihan" id="pilihan">
                                <option value="">- Pilih Webinar -</option>
                                <option value="Membongkar Rahasia Copywriting" <?php if ($pilihan == "MRC") echo "selected" ?>>Membongkar Rahasia Copywriting</option>
                                <option value="30 Days Reseller Academy" <?php if ($pilihan == "DRA") echo "selected" ?>>30 Days Reseller Academy</option>
                                <option value="Bedah trik banjir order dengan Omnichannel dan Fulfillment" <?php if ($pilihan == "OF") echo "selected" ?>>Bedah trik banjir order dengan Omnichannel dan Fulfillment</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-12">
                        <input type="submit" name="simpan" value="Simpan Data" class="btn btn-primary" />
                    </div>
                </form>
            </div>
        </div>

        <!-- untuk mengeluarkan data -->
        <div class="card">
            <div class="card-header text-white bg-secondary">
                Data Pendaftar
            </div>
            <div class="card-body">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">No Hp</th>
                            <th scope="col">Nama</th>
                            <th scope="col">Alamat</th>
                            <th scope="col">Pilihan</th>
                            <th scope="col">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $sql2   = "select * from tbl_daftar order by id desc";
                        $q2     = mysqli_query($koneksi, $sql2);
                        $urut   = 1;
                        while ($r2 = mysqli_fetch_array($q2)) {
                            $id         = $r2['id'];
                            $no_hp        = $r2['no_hp'];
                            $nama       = $r2['nama'];
                            $alamat     = $r2['alamat'];
                            $pilihan   = $r2['pilihan'];

                        ?>
                            <tr>
                                <th scope="row"><?php echo $urut++ ?></th>
                                <td scope="row"><?php echo $no_hp ?></td>
                                <td scope="row"><?php echo $nama ?></td>
                                <td scope="row"><?php echo $alamat ?></td>
                                <td scope="row"><?php echo $pilihan ?></td>
                                <td scope="row">
                                    <a href="daftar.php?op=edit&id=<?php echo $id ?>"><button type="button" class="btn btn-warning">Edit</button></a>
                                    <a href="daftar.php?op=delete&id=<?php echo $id?>" onclick="return confirm('Yakin mau delete data?')"><button type="button" class="btn btn-danger">Delete</button></a>            
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