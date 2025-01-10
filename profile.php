<?php
session_start();
include "koneksi.php"; // File koneksi database

// Ambil data pengguna berdasarkan sesi login
$username = $_SESSION['username']; // Pastikan sudah ada sesi login
$query = "SELECT * FROM user WHERE username = '$username'";
$result = mysqli_query($conn, $query);
//$user = mysqli_fetch_assoc($result);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Proses ubah password
    if (!empty($_POST['password'])) {
        $new_password = md5($_POST['password']); // Mengamankan input
        //$hashed_password = password_hash($new_password, PASSWORD_BCRYPT); // Hash password

        // Update password di database
        $update_query = "UPDATE user SET password = '$new_password' WHERE username = 'asif'";
        if (mysqli_query($conn, $update_query)) {
            echo "<script>alert('Password berhasil diubah!');</script>";
        } else {
            echo "<script>alert('Terjadi kesalahan, coba lagi.');</script>";
        }
    } else {
        echo "<script>alert('Password baru tidak boleh kosong!');</script>";}
}

// Proses penyimpanan data
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $uploadDir = 'img/'; // Folder penyimpanan gambar
    $defaultImage = 'default.jpg'; // Gambar default jika tidak ada yang diunggah

    // Cek apakah folder "img" sudah ada, jika tidak maka dibuat
    if (!is_dir($uploadDir)) {
        mkdir($uploadDir, 0777, true);
    }

    // Cek apakah ada gambar yang diunggah
    if (isset($_FILES['profile_picture']) && $_FILES['profile_picture']['error'] === UPLOAD_ERR_OK) {
        $fileTmpPath = $_FILES['profile_picture']['tmp_name'];
        $fileName = basename($_FILES['profile_picture']['name']);
        $filePath = $uploadDir . $fileName;

        // Pindahkan file yang diunggah ke folder "img"
        if (move_uploaded_file($fileTmpPath, $filePath)) {
            $uploadedImage = $filePath;
        } else {
            $error = "Gagal mengunggah gambar.";
        }
    } else {
        // Jika tidak ada gambar yang diunggah, gunakan gambar yang sebelumnya atau default
        $uploadedImage = isset($_POST['current_image']) ? $_POST['current_image'] : $uploadDir . $defaultImage;
    }

    // Simpan path gambar ke sesi untuk keperluan tampilan ulang
    //session_start();
    $_SESSION['profile_image'] = $uploadedImage;
}

// Ambil gambar dari sesi jika tersedia
//session_start();
$currentImage = isset($_SESSION['profile_image']) ? $_SESSION['profile_image'] : 'img/default.jpg';

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile Asif</title>
    <link rel="icon" href="img/logo.png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet" >
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
</head>
<body>
<!-- nav begin -->
<nav class="navbar navbar-expand-sm bg-body-tertiary sticky-top bg-secondary-subtle">
    <div class="container">
        <a class="navbar-brand" href="">My Daily Journal</a>
        <button
        class="navbar-toggler"
        type="button"
        data-bs-toggle="collapse"
        data-bs-target="#navbarSupportedContent"
        aria-controls="navbarSupportedContent"
        aria-expanded="false"
        aria-label="Toggle navigation"
        >
        <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav ms-auto mb-2 mb-lg-0 text-dark">
            <li class="nav-item">
                <a class="nav-link" href="admin.php?page=dashboard">Dashboard</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="admin.php?page=article">Article</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="admin.php?page=gallery">Gallery</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="index.php?page=Gallery#gallery"><b>Homepage</b></a>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle text-danger fw-bold" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">Asif
                </a>
                <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="profile.php">Profile Asif</a></li> 
                    <li><a class="dropdown-item" href="login.php">Logout</a></li>
                </ul>
            </li> 
        </ul>
        </div>
    </div>
    </nav><br><br>
    <!-- nav end -->
     
    <!-- content begin -->
<div class="container"> 
            <?php
            if(isset($_GET['page'])){
            ?>
                <h4 class="lead display-6 pb-2 border-bottom border-danger-subtle"><?= ucfirst($_GET['page'])?></h4>
                <?php
            }else{
            ?>
                <h4 class="lead display-6 pb-2 border-bottom border-danger-subtle">Profil</h4>
                <?php
            }
            ?>
        </div>
        <!-- content end -->
<div class="container mt-5">
    <form method="POST" enctype="multipart/form-data">
        <div class="mb-3">
            <label for="password" class="form-label">Ganti Password</label>
            <input type="password" class="form-control" id="password" name="password" placeholder="Tuliskan Password Baru Jika Ingin Mengganti Password Saja">
        </div>
        <div class="mb-3">
            <label for="profile_picture" class="form-label">Ganti Foto Profil</label>
            <input class="form-control" type="file" id="profile_picture" name="profile_picture">
        </div>
        <div class="mb-3">
            <p>Foto Profil Saat Ini:</p>
            <img src="<?php echo htmlspecialchars($currentImage); ?>" alt="Foto Profil" class="img-thumbnail" style="max-width: 200px;">
        </div>
        <!-- Input tersembunyi untuk menyimpan gambar saat ini -->
        <input type="hidden" name="current_image" value="<?php echo htmlspecialchars($currentImage); ?>">
        <button type="submit" class="btn btn-primary">Simpan</button>
    </form>
</div>
<br><br>

<!-- footer begin -->
<footer class="text-center p-5 bg-secondary">
      <div>
        <a href="https://www.instagram.com/arkalcoaa._1836?igsh=MWdpYW9ueWp3OXRjZA=="><i class="bi bi-instagram h2 p-2 text-dark"></i></a>
        <a href="https://www.facebook.com/profile.php?id=100009594558888&mibextid=ZbWKwL"><i class="bi bi-facebook h2 p-2 text-dark"></i></a>
        <a href="https://wa.me/+6281391043725"><i class="bi bi-whatsapp h2 p-2 text-dark"></i></a>
      </div>
      <div>
        Asif Maulida Arkadia &copy; 2024
      </div>
    </footer>
    <!-- footer end -->
</body>
</html>