<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard | BPUPEMDA</title>
    <link rel="icon" href="img/logo.png" type="image/x-icon" />
    <link rel="stylesheet" href="css/style.css" />

    <!-- Font -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Lugrasimo&family=Poppins:wght@100;300;400;700&display=swap" rel="stylesheet" />
</head>

<body>
    <div class="container">
        <div class="sidebar">
            <div class="logo">
                <img src="img/logo.png" alt="Penduduk Bukan Penerimah Upah">
                <h2>Penduduk Bukan Penerimah Upah</h2>
            </div>
            <ul class="menu">
                <li class="active"><a href="index.php">Dashboard</a></li>
                <li><a href="data-training.php">Data Training</a></li>
                <li><a href="data-mahasiswa.php">Data Mahasiswa</a></li>
                <li><a href="data-testing.php">Data Testing</a></li>
                <li><a href="hasil-prediksi.php">Hasil Prediksi</a></li>
                <li><a href="ubah-password.php">Ubah Password</a></li>
                <li><a href="logout.php" onclick="return confirm('Apakah Anda yakin ingin logout?')">Logout</a></li>
            </ul>
        </div>
        <div class="content">
            <div class="navbar">
                <p>ADMIN | DASHBOARD</p>
            </div>
            <div class="informasi">
                <h2>Informasi</h2>
                <p>Untuk Admin, jika ingin memulai proses prediksi berdasarkan data yang diinput Calon Mahasiswa silakan klik menu <a href="data-mahasiswa.php">Data Mahasiswa</a>. Jika ingin memulai prediksi berdasarkan data yang diinput sendiri silakan klik menu <a href="data-testing.php">Data Testing.</a></p>
                <p style="margin-top: 30px; margin-bottom: 20px;">Untuk melihat hasil, silakan pergi ke menu <a href="hasil-prediksi.php">Hasil Prediksi</a>.</p>
            </div>
        </div>
    </div>
</body>

</html>
