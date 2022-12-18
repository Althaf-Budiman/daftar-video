<?php
$con = mysqli_connect("localhost", "root", "", "daftar-video");

function query($query)
{
    global $con;
    $result = mysqli_query($con, $query);

    $rows = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
    }
    return $rows;
}

$videos = query("SELECT * FROM video");
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Daftar Video</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
</head>

<body>
    <h1>Daftar Video Anda</h1>
    <div class="container">

        <!-- Button trigger modal create -->
        <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#exampleModal">
            Tambah Video
        </button>
        <!-- Akhir button trigger modal create -->

        <!-- Modal tambah data -->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah Data Video</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="" method="post" enctype="multipart/form-data">
                        <div class="modal-body">
                            <div class="mb-3">
                                <label for="nama" class="form-label">Nama Video :</label>
                                <input type="text" class="form-control" id="nama" name="nama">
                            </div>
                            <div class="mb-3">
                                <label for="durasi" class="form-label">Durasi Video :</label>
                                <input type="text" class="form-control" id="durasi" name="durasi">
                            </div>
                            <div class="mb-3">
                                <label for="tanggal" class="form-label">Tanggal Upload Video :</label>
                                <input type="date" class="form-control" id="tanggal" name="tanggal">
                            </div>
                            <div class="mb-3">
                                <label for="thumbnail" class="form-label">Thumbnail Video :</label>
                                <input type="file" class="form-control" id="thumbnail" name="thumbnail">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-success" name="btnTambahVideo">Tambah Video</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- Akhir Modal Tambah Data -->

        <table class="table table-striped">
            <thead>
                <tr>
                    <th class="col">Id</th>
                    <th class="col">Nama</th>
                    <th class="col">Durasi</th>
                    <th class="col">Tanggal</th>
                    <th class="col">Thumbnail</th>
                    <th class="col">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($videos as $video) { ?>
                    <tr>
                        <td><?= $video['id'] ?></td>
                        <td><?= $video['nama'] ?></td>
                        <td><?= $video['durasi'] ?></td>
                        <td><?= $video['tanggal'] ?></td>
                        <td><img src="img/<?= $video['thumbnail'] ?>" width="50"></td>
                        <td>
                            <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#btnUbahVideo<?= $video['id'] ?>">
                                Ubah Video
                            </button>
                            <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#btnHapusVideo<?= $video['id'] ?>">
                                Hapus Video
                            </button>
                        </td>
                    </tr>

                    <!-- Modal hapus data -->
                    <div class="modal fade" id="btnHapusVideo<?= $video['id'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Hapus Data Video <?= $video['nama'] ?> dengan id <?= $video['id'] ?></h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    Apakah yakin ada akan menghapus video bernama <?= $video['nama'] ?> ? dengan id <?= $video['id'] ?>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    <form action="" method="post">
                                        <input type="hidden" value="<?= $video['id'] ?>" name="id">
                                        <button type="submit" class="btn btn-danger" name="btnHapusVideo">Hapus Video</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Akhir Modal hapus Data -->

                    <!-- Modal ubah data -->
                    <div class="modal fade" id="btnUbahVideo<?= $video['id'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Ubah Data Video <?= $video['nama'] ?> dengan id <?= $video['id'] ?></h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <form action="" method="post" enctype="multipart/form-data">
                                    <div class="modal-body">
                                        <input type="hidden" value="<?= $video['id'] ?>" name="id">
                                        <div class="mb-3">
                                            <label for="nama" class="form-label">Nama Video :</label>
                                            <input type="text" value="<?= $video['nama'] ?>" class="form-control" id="nama" name="nama">
                                        </div>
                                        <div class="mb-3">
                                            <label for="durasi" class="form-label">Durasi Video :</label>
                                            <input type="text" value="<?= $video['durasi'] ?>" class="form-control" id="durasi" name="durasi">
                                        </div>
                                        <div class="mb-3">
                                            <label for="tanggal" class="form-label">Tanggal Upload Video :</label>
                                            <input type="date" value="<?= $video['tanggal'] ?>" class="form-control" id="tanggal" name="tanggal">
                                        </div>
                                        <div class="mb-3">
                                            <input type="hidden" name="thumbnailLama" value="<?= $video['thumbnail'] ?>">
                                            Thumbnail Video Lama : <img src="img/<?= $video['thumbnail'] ?>" width="50">
                                        </div>
                                        <div class="mb-3">
                                            <label for="thumbnail" class="form-label">Thumbnail Video :</label>
                                            <input type="file" value="<?= $video['thumbnail'] ?>" class="form-control" id="thumbnail" name="thumbnail">
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                        <form action="" method="post">
                                            <button type="submit" class="btn btn-success" name="btnUbahVideo">Ubah Video</button>
                                        </form>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <!-- Akhir Modal ubah Data -->
                <?php } ?>
            </tbody>
        </table>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
    </div>
</body>

</html>

<?php
if (isset($_POST['btnTambahVideo'])) {
    $nama = $_POST['nama'];
    $durasi = $_POST['durasi'];
    $tanggal = $_POST['tanggal'];
    $thumbnail = upload();

    mysqli_query($con, "INSERT INTO `video` (`id`, `nama`, `durasi`, `tanggal`, `thumbnail`) VALUES (NULL, '$nama', '$durasi', '$tanggal', '$thumbnail');");
    echo "<script>document.location.href = 'index.php'</script>";
}

if (isset($_POST['btnUbahVideo'])) {
    $id = $_POST['id'];
    $nama = $_POST['nama'];
    $durasi = $_POST['durasi'];
    $tanggal = $_POST['tanggal'];
    $thumbnailLama = $_POST['thumbnailLama'];

    if ($_FILES['thumbnail']['error'] === 4) {
        $thumbnail = $thumbnailLama;
    } else {
        $thumbnail = upload();
    }

    mysqli_query($con, "UPDATE `video` SET `nama` = '$nama', `durasi` = '$durasi',`tanggal` = '$tanggal', `thumbnail` = '$thumbnail' WHERE `video`.`id` = $id;");
    echo
    "<script>document.location.href = 'index.php'</script>";
}

if (isset($_POST['btnHapusVideo'])) {
    $id = $_POST['id'];

    mysqli_query($con, "DELETE FROM video WHERE id = $id");
    echo "<script>document.location.href = 'index.php'</script>";
}

function upload()
{
    $namaFile = $_FILES['thumbnail']['name'];
    $ukuranFile = $_FILES['thumbnail']['size'];
    $error = $_FILES['thumbnail']['error'];
    $tmpName = $_FILES['thumbnail']['tmp_name'];

    if ($error === 4) {
        echo "<script>alert('Masukkan Gambar Dulu!')</script>";
        return false;
    }

    // cek apakah yang diupload adalah gambar
    $extensiValid = ['jpg', 'jpeg', 'png'];
    $extensi = explode('.', $namaFile);
    $extensi = strtolower(end($extensi));

    // cek apakah isinya ada atau tidak
    if (!in_array($extensi, $extensiValid)) {
        echo "<script>alert('Yang anda masukkan bukan gambar')</script>";
        return false;
    }

    // cek ukuran file
    if ($ukuranFile > 1000000) {
        echo "<script>alert('Ukuran file gambar terlalu besar!')</script>";
        return false;
    }

    $namaFileBaru = uniqid() . "." . $extensi;

    move_uploaded_file($tmpName, "img/" . $namaFileBaru);

    $namaGambar = $namaFileBaru;
    return $namaGambar;
}
?>