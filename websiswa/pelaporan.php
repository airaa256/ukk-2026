<?php
session_start();
include 'db.php';

if ($_SESSION['status_login'] != true) {
    echo '<script>window.location="login.php"</script>';
}

// --- FILTER LOGIC ---
// We start with a condition to show only reports that HAVEN'T been processed yet
// (Those that don't exist in the 'aspirasi' table)
$where = " WHERE aspirasi.id_pelaporan IS NULL ";

if (!empty($_GET['search_nis'])) {
    $nis = mysqli_real_escape_string($conn, $_GET['search_nis']);
    $where .= " AND input_aspirasi.nis = '$nis' ";
}

if (!empty($_GET['filter_kat'])) {
    $kat = mysqli_real_escape_string($conn, $_GET['filter_kat']);
    $where .= " AND input_aspirasi.id_kategori = '$kat' ";
}

if (!empty($_GET['filter_month'])) {
    $month = mysqli_real_escape_string($conn, $_GET['filter_month']);
    $where .= " AND MONTH(input_aspirasi.tanggal_input) = '$month' ";
}

if (!empty($_GET['date_from']) && !empty($_GET['date_to'])) {
    $from = mysqli_real_escape_string($conn, $_GET['date_from']);
    $to = mysqli_real_escape_string($conn, $_GET['date_to']);
    $where .= " AND input_aspirasi.tanggal_input BETWEEN '$from' AND '$to' ";
}

// Combine all logic into one final query
$query_str = "SELECT * FROM input_aspirasi 
              LEFT JOIN kategori USING (id_kategori) 
              LEFT JOIN aspirasi USING (id_pelaporan) 
              $where 
              ORDER BY id_pelaporan DESC";

$pelaporan = mysqli_query($conn, $query_str);
$total_count = mysqli_num_rows($pelaporan); // Count based on filtered results
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Aspirasi | Pelaporan</title>
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <link href="https://fonts.googleapis.com/css2?family=Quicksand&display=swap" rel="stylesheet">
</head>

<body>
    <header>
        <div class="container">
            <h1><a href="dashboard.php">aspirasi</a></h1>
            <ul>
                <li><a href="dashboard.php">dashboard</a></li>
                <li><a href="profil.php">profil</a></li>
                <li><a href="pelaporan.php" class="active">pelaporan</a></li>
                <li><a href="aspirasi.php">aspirasi</a></li>
                <li><a href="siswa.php">siswa</a></li>
                <li><a href="kategori.php">kategori</a></li>
                <li><a href="keluar.php">keluar</a></li>
            </ul>
        </div>
    </header>

    <div class="section">
        <div class="container">
            <h3>Pelaporan Masuk (<?php echo $total_count ?>)</h3>
            <div class="box">
                <form action="" method="GET" class="filter-form">
                    <div class="filter-inputs-wrapper">
                        <div class="filter-group">
                            <label>NIS Siswa</label>
                            <input type="number" name="search_nis" placeholder="Cari NIS..."
                                value="<?php echo @$_GET['search_nis'] ?>">
                        </div>
                        <div class="filter-group">
                            <label>Kategori</label>
                            <select name="filter_kat">
                                <option value="">- Semua Kategori -</option>
                                <?php
                                $kategori = mysqli_query($conn, "SELECT * FROM kategori ORDER BY ket_kategori ASC");
                                while ($k = mysqli_fetch_array($kategori)) {
                                    ?>
                                    <option value="<?php echo $k['id_kategori'] ?>" <?php echo (@$_GET['filter_kat'] == $k['id_kategori']) ? 'selected' : '' ?>>
                                        <?php echo $k['ket_kategori'] ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="filter-group">
                            <label>Bulan</label>
                            <select name="filter_month">
                                <option value="">- Semua Bulan -</option>
                                <?php
                                for ($m = 1; $m <= 12; $m++) {
                                    $mVal = str_pad($m, 2, "0", STR_PAD_LEFT);
                                    $mName = date('F', mktime(0, 0, 0, $m, 1));
                                    echo "<option value='$mVal' " . ((@$_GET['filter_month'] == $mVal) ? 'selected' : '') . ">$mName</option>";
                                }
                                ?>
                            </select>
                        </div>
                        <div class="filter-group">
                            <label>Dari Tanggal</label>
                            <input type="date" name="date_from" value="<?php echo @$_GET['date_from'] ?>">
                        </div>
                        <div class="filter-group">
                            <label>Sampai Tanggal</label>
                            <input type="date" name="date_to" value="<?php echo @$_GET['date_to'] ?>">
                        </div>
                    </div>
                    <div class="filter-actions-wrapper">
                        <button type="submit" class="btn-filter">Cari</button>
                        <a href="pelaporan.php" class="btn-reset">Reset</a>
                    </div>
                </form>
            </div>

            <div class="box">
                <table border="0" cellspacing="0" class="table">
                    <thead>
                        <tr>
                            <th width="60px">ID</th>
                            <th width="130px">Tanggal</th>
                            <th>NIS</th>
                            <th>Kategori</th>
                            <th>Lokasi</th>
                            <th>Keterangan</th>
                            <th width="180px">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if (mysqli_num_rows($pelaporan) > 0) {
                            while ($row = mysqli_fetch_array($pelaporan)) {
                                ?>
                                <tr>
                                    <td><?php echo $row['id_pelaporan'] ?></td>
                                    <td><?php echo date('d/m/Y', ($row['tanggal_input'])) ?></td>
                                    <td><?php echo $row['nis'] ?></td>
                                    <td><?php echo $row['ket_kategori'] ?></td>
                                    <td><?php echo $row['lokasi'] ?></td>
                                    <td><?php echo $row['ket'] ?></td>
                                    <td>
                                        <div class="btn-container">
                                            <a href="tambah-aspirasi-kelola.php?id=<?php echo $row['id_pelaporan'] ?>"
                                                class="kelola">Kelola</a>
                                            <a href="proses-hapus.php?pelaporan=<?php echo $row['id_pelaporan'] ?>"
                                                class="hapus" onclick="return confirm('Hapus data ini?')">Hapus</a>
                                        </div>
                                    </td>
                                </tr>
                            <?php }
                        } else { ?>
                            <tr>
                                <td colspan="7" align="center">Tidak ada laporan baru yang sesuai filter.</td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <footer>
        <div class="container">
            <small>Copyright &copy; 2026 - adelia samaira.</small>
        </div>
    </footer>
</body>

</html>