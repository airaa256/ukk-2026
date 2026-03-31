<?php
session_start();
include 'db.php';
if ($_SESSION['status_login'] != true) {
    echo '<script>window.location="login.php"</script>';
}

// --- 1. BUILD FILTER LOGIC ---
$where = " WHERE 1=1 "; // Base condition to allow appending 'AND'

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

// --- 2. DYNAMIC COUNTS (Based on Filters) ---
$count_all = mysqli_query($conn, "SELECT id_aspirasi FROM aspirasi LEFT JOIN input_aspirasi USING (id_pelaporan) $where");
$total_aspirasi = mysqli_num_rows($count_all);

$count_menunggu = mysqli_query($conn, "SELECT id_aspirasi FROM aspirasi LEFT JOIN input_aspirasi USING (id_pelaporan) $where AND status = 'menunggu'");
$total_menunggu = mysqli_num_rows($count_menunggu);

$count_proses = mysqli_query($conn, "SELECT id_aspirasi FROM aspirasi LEFT JOIN input_aspirasi USING (id_pelaporan) $where AND status = 'proses'");
$total_proses = mysqli_num_rows($count_proses);

$count_selesai = mysqli_query($conn, "SELECT id_aspirasi FROM aspirasi LEFT JOIN input_aspirasi USING (id_pelaporan) $where AND status = 'selesai'");
$total_selesai = mysqli_num_rows($count_selesai);

// --- 3. MAIN TABLE QUERY ---
$query_str = "SELECT * FROM aspirasi 
                  LEFT JOIN input_aspirasi USING (id_pelaporan)
                  LEFT JOIN kategori USING (id_kategori)
                  $where 
                  ORDER BY id_aspirasi DESC";
$aspirasi = mysqli_query($conn, $query_str);
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Aspirasi | Data</title>
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
                <li><a href="pelaporan.php">pelaporan</a></li>
                <li><a href="aspirasi.php" class="active">aspirasi</a></li>
                <li><a href="siswa.php">siswa</a></li>
                <li><a href="kategori.php">kategori</a></li>
                <li><a href="keluar.php">keluar</a></li>
            </ul>
        </div>
    </header>

    <div class="section">
        <div class="container">
            <h3>Monitoring Aspirasi</h3>

            <div class="card-container">
                <div class="card">
                    <h4>Total</h4>
                    <p><?php echo $total_aspirasi; ?></p>
                </div>
                <div class="card" style="border-bottom-color: #f1c40f;">
                    <h4>Menunggu</h4>
                    <p><?php echo $total_menunggu; ?></p>
                </div>
                <div class="card" style="border-bottom-color: #3498db;">
                    <h4>Proses</h4>
                    <p><?php echo $total_proses; ?></p>
                </div>
                <div class="card" style="border-bottom-color: #2ecc71;">
                    <h4>Selesai</h4>
                    <p><?php echo $total_selesai; ?></p>
                </div>
            </div>

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
                        <a href="aspirasi.php" class="btn-reset">Reset</a>
                    </div>
                </form>
            </div>

            <div class="box">
                <table border="0" cellspacing="0" class="table">
                    <thead>
                        <tr>
                            <th width="130px">Tanggal</th>
                            <th>NIS</th>
                            <th>Kategori</th>
                            <th>Status</th>
                            <th>Feedback</th>
                            <th width="180px">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if (mysqli_num_rows($aspirasi) > 0) {
                            while ($row = mysqli_fetch_array($aspirasi)) {
                                ?>
                                <tr>
                                    <td><?php echo date('d/m/Y', strtotime($row['tanggal_input'])) ?></td>

                                    <td><?php echo $row['nis'] ?></td>

                                    <td><?php echo $row['ket_kategori'] ?></td>

                                    <td>
                                        <span class="status-label <?php echo $row['status'] ?>">
                                            <?php echo $row['status'] ?>
                                        </span>
                                    </td>

                                    <td>
                                        <?php echo $row['feedback'] ?>
                                    </td>

                                    <td>
                                        <div class="btn-container">
                                            <a href="edit-aspirasi.php?id=<?php echo $row['id_aspirasi'] ?>"
                                                class="edit">Edit</a>
                                            <a href="proses-hapus.php?aspirasi=<?php echo $row['id_aspirasi'] ?>" class="hapus"
                                                onclick="return confirm('Yakin hapus aspirasi ini?')">Hapus</a>
                                        </div>
                                    </td>
                                </tr>
                            <?php }
                        } else { ?>
                            <tr>
                                <td colspan="6" align="center">Tidak ada data ditemukan.</td>
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