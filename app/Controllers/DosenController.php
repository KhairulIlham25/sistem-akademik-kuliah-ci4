<?php

namespace App\Controllers;

use App\Models\JadwalModel;
use App\Models\RencanaStudiModel;
use App\Models\NilaiMutuModel;

class DosenController extends BaseController
{
    protected $jadwalModel;
    protected $rencanaModel;
    protected $nilaiModel;

    public function __construct()
    {
        $this->jadwalModel = new JadwalModel();
        $this->rencanaModel = new RencanaStudiModel();
        $this->nilaiModel = new NilaiMutuModel();
    }

    public function dashboard()
    {
        return view('dosen/dashboard');
    }

    public function jadwalSaya()
    {
        $nidn = session()->get('related_id');

        $data['jadwal'] = $this->jadwalModel
            ->select('jadwal.*, mata_kuliah.nama_mata_kuliah, ruangan.nama_ruangan')
            ->join('mata_kuliah', 'mata_kuliah.id_mata_kuliah = jadwal.id_mata_kuliah')
            ->join('ruangan', 'ruangan.id_ruangan = jadwal.id_ruangan')
            ->where('jadwal.nidn', $nidn)
            ->findAll();

        return view('dosen/jadwal', $data);
    }

    public function inputNilai($id_jadwal)
    {
        $jadwalModel   = new \App\Models\JadwalModel();
        $rencanaModel  = new \App\Models\RencanaStudiModel();

        // Ambil info jadwal
        $jadwal = $jadwalModel
            ->select('jadwal.*, mata_kuliah.nama_mata_kuliah')
            ->join('mata_kuliah', 'mata_kuliah.id_mata_kuliah = jadwal.id_mata_kuliah')
            ->where('jadwal.id', $id_jadwal)
            ->first();

        // ✅ Hanya mahasiswa yang KRS-nya sudah disetujui
        $mahasiswa = $rencanaModel
              ->select('rencana_studi.id_rencana_studi, mahasiswa.nim, mahasiswa.nama, rencana_studi.nilai_huruf, rencana_studi.nilai_angka')
            ->join('mahasiswa', 'mahasiswa.nim = rencana_studi.nim')
            ->where('rencana_studi.id_jadwal', $id_jadwal)
            ->findAll();


        return view('dosen/input_nilai', [
            'jadwal' => $jadwal,
            'mahasiswa' => $mahasiswa
        ]);
    }

public function simpanNilai()
{
    $rencanaModel = new \App\Models\RencanaStudiModel();

    $id_jadwal  = $this->request->getPost('id_jadwal');
    $nilaiAngka = $this->request->getPost('nilai_angka');

    if (!$nilaiAngka || !is_array($nilaiAngka)) {
        return redirect()->back()->with('error', 'Tidak ada nilai yang diinput!');
    }

    foreach ($nilaiAngka as $id_rencana => $angka) {
        if ($angka === "" || $angka === null) continue;

        $huruf = $this->konversiNilai($angka);

        $rencanaModel->update($id_rencana, [
            'nilai_angka' => $angka,
            'nilai_huruf' => $huruf
        ]);
    }

    return redirect()->to('/dosen/input-nilai/'.$id_jadwal)
                     ->with('success', 'Nilai berhasil disimpan!');
}

    public function nilai($id_jadwal)
    {
        $rencanaModel = new \App\Models\RencanaStudiModel();
        $data['rencana'] = $rencanaModel
            ->select('rencana_studi.*, mahasiswa.nama')
            ->join('mahasiswa', 'mahasiswa.nim = rencana_studi.nim')
            ->where('rencana_studi.id_jadwal', $id_jadwal)
            ->findAll();

        $data['id_jadwal'] = $id_jadwal;
        return view('dosen/nilai', $data);
    }

    public function setujuiKRS()
    {
        $nim = $this->request->getPost('nim');

        if (!$nim) {
            return redirect()->back()->with('error', 'NIM tidak ditemukan.');
        }

        $rencanaModel = new \App\Models\RencanaStudiModel();

        // Update seluruh KRS mahasiswa menjadi approved
        $rencanaModel->where('nim', $nim)->update(null, [
            'status' => 'approved'
        ]);

        return redirect()->to('/dosen/persetujuan-krs')->with('success', '✅ KRS mahasiswa telah disetujui.');
    }

    private function konversiNilai($angka)
{
    if ($angka >= 85) return 'A';
    if ($angka >= 70) return 'B';
    if ($angka >= 55) return 'C';
    if ($angka >= 40) return 'D';
    return 'E';
}

}
