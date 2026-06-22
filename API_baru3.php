<?php

$jeneng_file = "DATA_jatim_baru.JSON";

$data_json = file_get_contents($jeneng_file);

if ($data_json === false) {
    die("Error: File JSON tidak dapat dibaca.");
}

$daftar_data = json_decode($data_json, true);

if ($daftar_data === null) {
    die("Error: Format JSON tidak valid.");
}

$cari = $_GET['cari'] ?? '';

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Pencarian Data Jawa Timur</title>
</head>
<body>

<h2>DATA JAWA TIMUR 2025</h2>

<form method="GET">
    <label>Cari Desa/Kelurahan :</label>
    <input type="text" name="cari" value="<?php echo htmlspecialchars($cari); ?>">
    <button type="submit">Cari</button>
</form>

<hr>

<?php

$jumlah_hasil = 0;

foreach ($daftar_data["data"] as $baris) {

    if ($baris["jenis"] == "Desa/Kelurahan") {

        if ($cari == '' || stripos($baris["nama_wilayah"], $cari) !== false) {

            echo "<b>Desa/Kelurahan :</b> " . $baris["nama_wilayah"] . "<br>";
            echo "<b>Kode BPS :</b> " . $baris["kode_bps"] . "<br>";
            echo "<b>Kode Kemendagri :</b> " . $baris["kode_kemendagri"] . "<br>";
            echo "<hr>";

            $jumlah_hasil++;
        }
    }
}

if ($jumlah_hasil == 0) {
    echo "Data tidak ditemukan.";
}

?>

</body>
</html>