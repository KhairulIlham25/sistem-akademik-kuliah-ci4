<?php

namespace App\Models;
use CodeIgniter\Model;

class RencanaStudiModel extends Model
{
    protected $table = 'rencana_studi';
    protected $primaryKey = 'id_rencana_studi';
    protected $allowedFields = ['nim', 'id_jadwal', 'nilai_angka', 'nilai_huruf'];

    public function getByMahasiswa($nim)
    {
        return $this->select('rencana_studi.*, mata_kuliah.nama_mata_kuliah, mata_kuliah.sks, dosen.nama as nama_dosen')
            ->join('jadwal', 'jadwal.id = rencana_studi.id_jadwal')
            ->join('mata_kuliah', 'mata_kuliah.id_mata_kuliah = jadwal.id_mata_kuliah')
            ->join('dosen', 'dosen.nidn = jadwal.nidn')
            ->where('rencana_studi.nim', $nim)
            ->findAll();

    }

    public function getStudentsByJadwal($id_jadwal)
    {
        return $this->select('rencana_studi.*, mahasiswa.nama')
                    ->join('mahasiswa', 'mahasiswa.nim = rencana_studi.nim')
                    ->where('rencana_studi.id_jadwal', $id_jadwal)
                    ->findAll();
    }
        public function getByNim($nim)
    {
        return $this->where('nim', $nim)->findAll();
    }

    public function getByNimWithDetail($nim)
    {
        return $this->select('rencana_studi.*, mata_kuliah.nama_mata_kuliah, mata_kuliah.sks, dosen.nama as nama_dosen')
                    ->join('jadwal', 'jadwal.id = rencana_studi.id_jadwal')
                    ->join('mata_kuliah', 'mata_kuliah.id_mata_kuliah = jadwal.id_mata_kuliah')
                    ->join('dosen', 'dosen.nidn = jadwal.nidn')
                    ->where('rencana_studi.nim', $nim)
                    ->findAll();
    }
}
