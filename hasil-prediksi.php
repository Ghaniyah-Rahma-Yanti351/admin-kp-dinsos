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

// Pencarian data
$search = "";
if (isset($_POST['search'])) {
    $search = $_POST['search'];
}

// Ambil data hasil prediksi dari tabel data_hasil berdasarkan pencarian
$query_hasil = "SELECT id_data_hasil, nama, nik, asal_sekolah, skor_akhir, prodi, keterangan FROM data_hasil 
                WHERE nama LIKE '%$search%' OR nik LIKE '%$search%'";
$result_hasil = mysqli_query($koneksi, $query_hasil);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hasil Prediksi | PrediMaba</title>
    <link rel="icon" href="img/logo.png" type="image/x-icon" />
    <link rel="stylesheet" href="css/style.css" />

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

    <!-- Font -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lugrasimo&family=Poppins:wght@100;300;400;700&display=swap" rel="stylesheet">

    <style>
        table {
            width: 100%;
            border-collapse: collapse;
            font-family: 'Poppins', sans-serif;
            background-color: #f9f9f9;
            margin-top: -15px;
        }

        table,
        th,
        td {
            border: 1px solid #ddd;
        }

        th,
        td {
            padding: 12px;
            text-align: center;
        }

        th {
            background-color: #4CAF50;
            color: white;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        tr:hover {
            background-color: #ddd;
        }

        .table-container {
            overflow-y: auto;
            max-height: 385px;
            padding: 20px;
        }

        .table-container table {
            min-width: 600px;
        }

        .text-center {
            text-align: center;
        }

        .search-container {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 20px 20px 10px;
        }

        .search-container form {
            display: flex;
            align-items: center;
        }

        .search-container input[type="text"] {
            padding: 8px;
            margin-right: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            width: 250px;
        }

        .search-container input[type="text"]:focus {
            outline: none;
            border-color: blue;
        }

        .search-container button {
            padding: 8px 12px;
            border: none;
            background-color: #4CAF50;
            color: white;
            border-radius: 4px;
            cursor: pointer;
        }

        .search-container button:hover {
            background-color: #45a049;
        }
        
        .tbl-hapus {
            background-color: red;
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
                <li class="active"><a href="hasil-prediksi.php">Hasil Prediksi</a></li>
                <li><a href="ubah-password.php">Ubah Password</a></li>
                <li><a href="logout.php" onclick="return confirm('Apakah Anda yakin ingin logout?')">Logout</a></li>
            </ul>
        </div>
        <div class="content">
            <div class="navbar">
                <p>ADMIN | HASIL PREDIKSI</p>
            </div>
            <div class="search-container">
                <form method="post" action="">
                    <input type="text" name="search" placeholder="Cari berdasarkan Nama atau NIK" value="<?php echo htmlspecialchars($search); ?>">
                    <button type="submit">Cari</button>
                </form>
                <a href="hapus-semua-data-hasil.php" onclick="return confirm('Apakah Anda yakin ingin menghapus semua data?')"><button style="background-color: red; margin-left: 300px;">Hapus semua data</button></a>
                <a href="download_excel1.php"><button style=" background-color: #000;">Download</button></a>
            </div>
            <div class="table-container">
                <table>
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>NIK</th>
                            <th>Asal Sekolah</th>
                            <th>Skor Akhir</th>
                            <th>Program Studi</th>
                            <th>Keterangan</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if (mysqli_num_rows($result_hasil) > 0) {
                            $nomor = 1;
                            while ($row = mysqli_fetch_assoc($result_hasil)) {
                                echo "<tr>";
                                echo "<td>" . $nomor++ . "</td>";
                                echo "<td class='text-center'>" . htmlspecialchars($row['nama']) . "</td>";
                                echo "<td>" . htmlspecialchars($row['nik']) . "</td>";
                                echo "<td>" . htmlspecialchars($row['asal_sekolah']) . "</td>";
                                echo "<td>" . htmlspecialchars($row['skor_akhir']) . "</td>";
                                echo "<td class='text-center'>" . htmlspecialchars($row['prodi']) . "</td>";
                                echo "<td>" . htmlspecialchars($row['keterangan']) . "</td>";
                                echo "<td><a href='hapus_hasil.php?id=" . $row['id_data_hasil'] . "' onclick='return confirm(\"Apakah Anda yakin ingin menghapus data ini?\")' ><button style='background-color: red; cursor:pointer; border-radius:5px;'>Hapus</button></a></td>";
                                // echo "<td><a href='hapus_mahasiswa.php?nik=" . htmlspecialchars($row['nik']) . "' onclick=\"return confirm('Apakah Anda yakin ingin menghapus data ini?')\"><button style='background-color: red; cursor:pointer; border-radius:5px;'>Hapus</button></a></td>";
                                echo "</tr>";
                            }
                        } else {
                            echo "<tr><td colspan='8'>Tidak ada data hasil prediksi, karena Anda belum memulai proses prediksi!</td></tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>

</html>
