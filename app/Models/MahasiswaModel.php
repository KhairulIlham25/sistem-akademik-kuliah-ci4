<?php

namespace App\Models;
use CodeIgniter\Model;

class MahasiswaModel extends Model
{
    protected $table = 'mahasiswa';
    protected $primaryKey = 'nim';
    protected $allowedFields = ['nim', 'nama', 'email', 'prodi', 'angkatan', 'password'];
    protected $useAutoIncrement = false; // ⚠️ penting karena nim bukan auto increment

    // Contoh method tambahan
    public function getByNimWithKelas($nim)
    {
        return $this->select('mahasiswa.*, jadwal.nama_kelas, mata_kuliah.nama_mata_kuliah')
                    ->join('rencana_studi', 'rencana_studi.nim = mahasiswa.nim', 'left')
                    ->join('jadwal', 'jadwal.id = rencana_studi.id_jadwal', 'left')
                    ->join('mata_kuliah', 'mata_kuliah.id_mata_kuliah = jadwal.id_mata_kuliah', 'left')
                    ->where('mahasiswa.nim', $nim)
                    ->findAll();
    }

    public function getIPK($nim)
{
    $db = \Config\Database::connect();
    $query = $db->query("
        SELECT 
            SUM(nilai_mutu.nilai_mutu * mata_kuliah.sks) / SUM(mata_kuliah.sks) AS ipk
        FROM rencana_studi
        JOIN nilai_mutu ON rencana_studi.nilai_huruf = nilai_mutu.nilai_huruf
        JOIN jadwal ON rencana_studi.id_jadwal = jadwal.id
        JOIN mata_kuliah ON jadwal.id_mata_kuliah = mata_kuliah.id_mata_kuliah
        WHERE rencana_studi.nim = ?", [$nim]
    );

    $row = $query->getRow();
    return $row ? round($row->ipk, 2) : 0;
}
}
