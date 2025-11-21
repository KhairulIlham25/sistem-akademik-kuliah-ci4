<?php

namespace App\Controllers;

use App\Models\JadwalModel;
use App\Models\RencanaStudiModel;
use App\Models\MataKuliahModel;
use App\Models\NilaiMutuModel;

class MahasiswaController extends BaseController
{
    protected $rencanaModel;
    protected $jadwalModel;
    protected $nilaiModel;

    public function __construct()
    {
        $this->rencanaModel = new RencanaStudiModel();
        $this->jadwalModel = new JadwalModel();
        $this->nilaiModel = new NilaiMutuModel();
    }

    public function dashboard()
    {
        return view('mahasiswa/dashboard');
    }

public function rencanaStudi()
{
    $nim = session()->get('related_id');

    $jadwalModel = new \App\Models\JadwalModel();
    $rencanaModel = new \App\Models\RencanaStudiModel();

    // Ambil seluruh jadwal
    $data['jadwal'] = $jadwalModel
        ->select('jadwal.*, mata_kuliah.nama_mata_kuliah, mata_kuliah.sks, dosen.nama as nama_dosen')
        ->join('mata_kuliah', 'mata_kuliah.id_mata_kuliah = jadwal.id_mata_kuliah')
        ->join('dosen', 'dosen.nidn = jadwal.nidn')
        ->findAll();

    // Ambil jadwal yang sudah dipilih mahasiswa
    $data['dipilih'] = array_column(
        $rencanaModel->where('nim', $nim)->findAll(),
        'id_jadwal'
    );

    return view('mahasiswa/rencana_studi', $data);
}

public function simpanRencanaStudi()
{
    $nim = session()->get('related_id');
    $selected = $this->request->getPost('jadwal_id');

    $rencanaModel = new \App\Models\RencanaStudiModel();

    // Hapus semua data lama
    $rencanaModel->where('nim', $nim)->delete();

    // Simpan rencana baru
    if ($selected) {
        foreach ($selected as $idJadwal) {
            $rencanaModel->insert([
                'nim' => $nim,
                'id_jadwal' => $idJadwal,
                'nilai_huruf' => null,
            ]);
        }
    }

    return redirect()->to('/mahasiswa/rencana-studi')
        ->with('success', 'Rencana studi berhasil disimpan.');
}

    // === Menu Hasil Studi (KHS) ===
    public function hasilStudi()
    {
        $nim = session()->get('related_id');
        $rencanaModel = new RencanaStudiModel();
        $nilaiMutuModel = new NilaiMutuModel();

        $rencana = $rencanaModel->getByNimWithDetail($nim);
        $totalMutu = 0; $totalSks = 0;

        foreach ($rencana as &$r) {
            if ($r['nilai_huruf']) {
                $mutu = $nilaiMutuModel->getNilaiMutu($r['nilai_huruf']);
                $r['nilai_mutu'] = $mutu['nilai_mutu'];
                $totalMutu += $mutu['nilai_mutu'] * $r['sks'];
                $totalSks += $r['sks'];
            }
        }

        $data['ipk'] = $totalSks ? round($totalMutu / $totalSks, 2) : 0;
        $data['hasil'] = $rencana;

        return view('mahasiswa/hasil_studi', $data);
    }
}
