<?php
// Mulai session
session_start();

// Periksa apakah session email sudah ada (pengguna sudah login)
if (!isset($_SESSION['email'])) {
    // Jika belum, redirect ke halaman login.php
    header("Location: login.php");
    exit;
}

// Koneksi ke database
require 'koneksi.php';

// Proses form ubah password
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Ambil data dari form
    $password_lama = $_POST['password_lama'];
    $password_baru = $_POST['password_baru'];

    // Ambil email dari session
    $email = $_SESSION['email'];

    // Query untuk mendapatkan password lama dari database
    $query = "SELECT password FROM admin WHERE email = ?";
    if ($stmt = mysqli_prepare($koneksi, $query)) {
        mysqli_stmt_bind_param($stmt, "s", $email);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_bind_result($stmt, $hashed_password);
        mysqli_stmt_fetch($stmt);
        mysqli_stmt_close($stmt);

        // Periksa apakah password lama sesuai
        if (password_verify($password_lama, $hashed_password)) {
            // Hash password baru
            $password_baru_hashed = password_hash($password_baru, PASSWORD_DEFAULT);

            // Query untuk mengubah password
            $query_update = "UPDATE admin SET password = ? WHERE email = ?";
            if ($stmt_update = mysqli_prepare($koneksi, $query_update)) {
                mysqli_stmt_bind_param($stmt_update, "ss", $password_baru_hashed, $email);
                if (mysqli_stmt_execute($stmt_update)) {
                    $_SESSION['pesan'] = "Password berhasil diubah.";
                } else {
                    $_SESSION['pesan'] = "Gagal mengubah password.";
                }
                mysqli_stmt_close($stmt_update);
            }
        } else {
            $_SESSION['pesan'] = "Password lama tidak sesuai.";
        }
    }
    
    // Redirect kembali ke halaman ini untuk menampilkan pesan
    header("Location: ubah-password.php");
    exit;
}

// Tutup koneksi
mysqli_close($koneksi);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ubah Password | PrediMaba</title>
    <link rel="icon" href="img/logo.png" type="image/x-icon" />
    <link rel="stylesheet" href="css/style.css" />

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

    <!-- Font -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lugrasimo&family=Poppins:wght@100;300;400;700&display=swap" rel="stylesheet">

    <style>
        .form-container {
            padding: 20px;
        }

        .form-container input[type="password"] {
            width: 50%;
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        .form-container button {
            /* display: flex; */
            background-color: #4CAF50;
            color: white;
            padding: 8px 20px;
            border-radius: 5px;
            border: none;
            cursor: pointer;
            width: 50%;
            /* text-align: center; */
        }

        .form-container button:hover {
            background-color: #45a049;
        }

        .form-container .message {
            margin-top: 15px;
            text-align: center;
            font-weight: bold;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="sidebar">
            <div class="logo">
                <img src="img/logo.png" alt="Universitas Singaperbangsa Karawang">
                <h2>UNIVERSITAS SINGAPERBANGSA KARAWANG</h2>
            </div>
            <ul class="menu">
                <li><a href="index.php">Dashboard</a></li>
                <li><a href="data-training.php">Data Training</a></li>
                <li><a href="data-mahasiswa.php">Data Mahasiswa</a></li>
                <li><a href="data-testing.php">Data Testing</a></li>
                <li><a href="hasil-prediksi.php">Hasil Prediksi</a></li>
                <li class="active"><a href="ubah-password.php">Ubah Password</a></li>
                <li><a href="logout.php" onclick="return confirm('Apakah Anda yakin ingin logout?')">Logout</a></li>
            </ul>
        </div>
        <div class="content">
            <div class="navbar">
                <p>ADMIN | UBAH PASSWORD</p>
            </div>
            <div class="form-container">
                <form id="form-ubah-password" method="post" action="">
                    <input type="password" name="password_lama" placeholder="Password Lama" required>
                    <input type="password" name="password_baru" placeholder="Password Baru" required>
                    <button type="submit" id="btn-ubah">Ubah</button>
                </form>
            </div>
        </div>
    </div>

    <script>
        // Ambil pesan dari session PHP dan hapus session setelahnya
        var pesan = "<?php echo isset($_SESSION['pesan']) ? $_SESSION['pesan'] : ''; ?>";
        <?php unset($_SESSION['pesan']); ?>

        // Tampilkan alert jika pesan tidak kosong
        if (pesan !== '') {
            alert(pesan);
        }
    </script>
</body>

</html>
