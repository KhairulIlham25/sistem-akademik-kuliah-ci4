<?php

namespace App\Models;
use CodeIgniter\Model;

class JadwalModel extends Model
{
    protected $table = 'jadwal';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'nama_kelas',
        'id_mata_kuliah',
        'id_ruangan',
        'nidn',
        'hari',
        'jam_mulai',
        'jam_selesai'
    ];

    public function getDetailJadwal($id)
    {
        return $this->select('jadwal.*, mata_kuliah.nama_mata_kuliah, dosen.nama as nama_dosen, ruangan.nama_ruangan')
                    ->join('mata_kuliah', 'mata_kuliah.id_mata_kuliah = jadwal.id_mata_kuliah')
                    ->join('dosen', 'dosen.nidn = jadwal.nidn')
                    ->join('ruangan', 'ruangan.id_ruangan = jadwal.id_ruangan')
                    ->where('jadwal.id', $id)
                    ->first();
    }

    public function getAllWithRelations()
    {
        return $this->select('jadwal.*, mata_kuliah.nama_mata_kuliah, dosen.nama as nama_dosen, ruangan.nama_ruangan')
                    ->join('mata_kuliah', 'mata_kuliah.id_mata_kuliah = jadwal.id_mata_kuliah')
                    ->join('dosen', 'dosen.nidn = jadwal.nidn')
                    ->join('ruangan', 'ruangan.id_ruangan = jadwal.id_ruangan')
                    ->findAll();
    }

    public function getAllWithMKDosen()
    {
        return $this->select('
                jadwal.*,
                mata_kuliah.nama_mata_kuliah,
                mata_kuliah.sks,
                dosen.nama as nama_dosen,
                ruangan.nama_ruangan
            ')
            ->join('mata_kuliah', 'mata_kuliah.id_mata_kuliah = jadwal.id_mata_kuliah')
            ->join('dosen', 'dosen.nidn = jadwal.nidn')
            ->join('ruangan', 'ruangan.id_ruangan = jadwal.id_ruangan')
            ->findAll();
    }

        public function getAllJadwal()
    {
        return $this->select('jadwal.*, dosen.nama_dosen, ruangan.nama_ruangan')
                    ->join('dosen', 'dosen.nidn = jadwal.nidn')
                    ->join('ruangan', 'ruangan.id_ruangan = jadwal.id_ruangan')
                    ->findAll();
    }

    public function getJadwalById($id)
    {
        return $this->find($id);
    }

public function cekBentrok($hari, $id_ruangan, $nidn, $mulaiBaru, $selesaiBaru)
{
    return $this->where('hari', $hari)
        ->groupStart()
            ->where('id_ruangan', $id_ruangan)
            ->orWhere('nidn', $nidn)
        ->groupEnd()
        ->where("NOT (jam_selesai <= '$mulaiBaru' OR jam_mulai >= '$selesaiBaru')")
        ->first();
}

public function cekBentrokUpdate($hari, $id_ruangan, $nidn, $mulaiBaru, $selesaiBaru, $excludeId)
{
    return $this->where('hari', $hari)
        ->where('id !=', $excludeId)
        ->groupStart()
            ->where('id_ruangan', $id_ruangan)
            ->orWhere('nidn', $nidn)
        ->groupEnd()
        ->where("NOT (jam_selesai <= '$mulaiBaru' OR jam_mulai >= '$selesaiBaru')")
        ->first();
}

}
