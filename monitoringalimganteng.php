<?php

echo "<!DOCTYPE html>";
echo "<html>";
echo "<body>";

include "koneksi.php";

$sql = "SELECT waktu, nama, alamat FROM tb_skripsi";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    $count = 1;
    while($row = $result->fetch_assoc()) {
        echo "<br>" . $count . ". waktu: ". $row["waktu"]. " - nama: ". $row["nama"]. " - alamat: " . $row["alamat"] . "<br>";
        $count += 1;
    }
} else {
    echo "0 results";
}

$conn->close();

echo "</body>";
echo "</html>";
?>

