<?php

namespace App\Controllers;

use App\Models\JadwalModel;
use App\Models\DosenModel;
use App\Models\RuanganModel;
use App\Models\MataKuliahModel;


class JadwalController extends BaseController
{
    protected $jadwalModel;
    protected $dosenModel;
    protected $ruanganModel;
    

    public function __construct()
    {
        $this->jadwalModel = new JadwalModel();
        $this->dosenModel = new DosenModel();
        $this->ruanganModel = new RuanganModel();
    }

        public function index()
    {
        $jadwalModel = new JadwalModel();
        $data['jadwal'] = $jadwalModel->findAll();
        return view('admin/jadwal/index', $data);
    }

public function jadwal()
{
    $data['jadwal'] = $this->jadwalModel->getAllJadwal();
    return view('admin/jadwal/index', $data);
}

    public function tambahJadwal()
    {
        $data['dosen'] = $this->dosenModel->findAll();
        $data['ruangan'] = $this->ruanganModel->findAll();
        return view('admin/jadwal/tambah', $data);
    }

    public function simpanJadwal()
    {
        $this->jadwalModel->insert([
            'mata_kuliah' => $this->request->getPost('mata_kuliah'),
            'nidn' => $this->request->getPost('nidn'),
            'id_ruangan' => $this->request->getPost('id_ruangan'),
            'hari' => $this->request->getPost('hari'),
            'jam_mulai' => $this->request->getPost('jam_mulai'),
            'jam_selesai' => $this->request->getPost('jam_selesai'),
        ]);
        return redirect()->to('/admin/jadwal');
    }

    public function editJadwal($id)
    {
        $data['jadwal'] = $this->jadwalModel->getJadwalById($id);
        $data['dosen'] = $this->dosenModel->findAll();
        $data['ruangan'] = $this->ruanganModel->findAll();
        return view('admin/jadwal/edit', $data);
    }

    public function updateJadwal($id)
    {
        $this->jadwalModel->update($id, [
            'mata_kuliah' => $this->request->getPost('mata_kuliah'),
            'nidn' => $this->request->getPost('nidn'),
            'id_ruangan' => $this->request->getPost('id_ruangan'),
            'hari' => $this->request->getPost('hari'),
            'jam_mulai' => $this->request->getPost('jam_mulai'),
            'jam_selesai' => $this->request->getPost('jam_selesai'),
        ]);
        return redirect()->to('/admin/jadwal');
    }

    public function hapusJadwal($id)
    {
        $this->jadwalModel->delete($id);
        return redirect()->to('/admin/jadwal');
    }
}
