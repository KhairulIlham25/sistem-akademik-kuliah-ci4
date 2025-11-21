<?php
$koneksi = new mysqli("localhost", "root", "", "kuliah");

if ($koneksi->connect_error) {
    die("Koneksi gagal: " . $koneksi->connect_error);
}
echo "Koneksi ke database berhasil!";
