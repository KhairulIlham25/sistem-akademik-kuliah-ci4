<?php

namespace App\Controllers;

use App\Models\MahasiswaModel;
use App\Models\DosenModel;
use App\Models\RuanganModel;
use App\Models\JadwalModel;
use App\Models\MataKuliahModel;

use CodeIgniter\Controller;

class AdminController extends BaseController
{
    protected $mahasiswaModel;
    protected $dosenModel;
    protected $ruanganModel;
    protected $jadwalModel;

    public function __construct()
    {
        $this->mahasiswaModel = new MahasiswaModel();
        $this->dosenModel = new DosenModel();
        $this->ruanganModel = new RuanganModel();
        $this->jadwalModel = new JadwalModel();
    }

public function dashboard()
{
    $mahasiswaModel = new \App\Models\MahasiswaModel();
    $dosenModel     = new \App\Models\DosenModel();
    $ruanganModel   = new \App\Models\RuanganModel();
    $jadwalModel    = new \App\Models\JadwalModel();

    $data = [
        'jml_mahasiswa' => $mahasiswaModel->countAll(),
        'jml_dosen'     => $dosenModel->countAll(),
        'jml_ruangan'   => $ruanganModel->countAll(),
        'jml_jadwal'    => $jadwalModel->countAll(),
    ];

    return view('admin/dashboard', $data);
}

    // === CRUD Mahasiswa ===
public function mahasiswa()
{
    $model = new \App\Models\MahasiswaModel();
    $data['mahasiswa'] = $model->findAll();
    return view('admin/mahasiswa/index', $data);
}

public function tambahMahasiswa()
{
    return view('admin/mahasiswa/tambah');
}

public function simpanMahasiswa()
{
    $mahasiswaModel = new \App\Models\MahasiswaModel();
    $userModel = new \App\Models\UserModel();

    $dataMahasiswa = [
        'nim'      => $this->request->getPost('nim'),
        'nama'     => $this->request->getPost('nama'),
        'email'    => $this->request->getPost('email'),
        'prodi'    => $this->request->getPost('prodi'),
        'angkatan' => $this->request->getPost('angkatan'),
        'password' => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT)
    ];

    $mahasiswaModel->insert($dataMahasiswa);

    // Tambah user untuk login mahasiswa (username = NIM)
$userModel->insert([
    'nama_user'  => $this->request->getPost('nama'),
    'username'   => $this->request->getPost('nim'),
    'password'   => $this->request->getPost('password'), // tidak hash dulu
    'role'       => 'mahasiswa',
    'related_id' => $this->request->getPost('nim')
]);


    return redirect()->to('/admin/mahasiswa')->with('success', 'Mahasiswa & akun login berhasil ditambahkan');
}

public function editMahasiswa($nim)
{
    $model = new \App\Models\MahasiswaModel();
    $data['mhs'] = $model->find($nim);
    return view('admin/mahasiswa/edit', $data);
}

public function updateMahasiswa($nim)
{
    $model = new \App\Models\MahasiswaModel();

    $data = [
        'nim' => $this->request->getPost('nim'),
        'nama' => $this->request->getPost('nama'),
        'email' => $this->request->getPost('email'),
        'prodi' => $this->request->getPost('prodi'),
        'angkatan' => $this->request->getPost('angkatan')
    ];

    $model->update($nim, $data);
    return redirect()->to('/admin/mahasiswa')->with('success', 'Data berhasil diperbarui');
}

public function hapusMahasiswa($nim)
{
    $model = new \App\Models\MahasiswaModel();
    $model->delete($nim);
    return redirect()->to('/admin/mahasiswa')->with('success', 'Data berhasil dihapus');
}
// =======================================================
// CRUD Dosen
// =======================================================
public function dosen()
{
    $model = new \App\Models\DosenModel();
    $data['dosen'] = $model->findAll();
    return view('admin/dosen/index', $data);
}

public function tambahDosen()
{
    return view('admin/dosen/tambah');
}

public function simpanDosen()
{
    $dosenModel = new \App\Models\DosenModel();
    $userModel = new \App\Models\UserModel();

    $dataDosen = [
        'nidn'    => $this->request->getPost('nidn'),
        'nama'    => $this->request->getPost('nama'),
        'email'   => $this->request->getPost('email'),
        'prodi'   => $this->request->getPost('prodi'),
        'password'=> password_hash($this->request->getPost('password'), PASSWORD_DEFAULT)
    ];

    $dosenModel->insert($dataDosen);

    // Tambah user login dosen (username = NIDN)
$userModel->insert([
    'nama_user'  => $this->request->getPost('nama'),
    'username'   => $this->request->getPost('nidn'),
    'password'   => $this->request->getPost('password'),
    'role'       => 'dosen',
    'related_id' => $this->request->getPost('nidn')
]);


    return redirect()->to('/admin/dosen')->with('success', 'Dosen & akun login berhasil ditambahkan');
}

public function editDosen($id)
{
    $model = new \App\Models\DosenModel();
    $data['dsn'] = $model->find($id);
    return view('admin/dosen/edit', $data);
}

public function updateDosen($id)
{
    $model = new \App\Models\DosenModel();

    $data = [
        'nidn' => $this->request->getPost('nidn'),
        'nama' => $this->request->getPost('nama'),
        'email' => $this->request->getPost('email'),
        'prodi' => $this->request->getPost('prodi')
    ];

    $model->update($id, $data);
    return redirect()->to('/admin/dosen')->with('success', 'Data dosen berhasil diperbarui');
}

public function hapusDosen($id)
{
    $model = new \App\Models\DosenModel();
    $model->delete($id);
    return redirect()->to('/admin/dosen')->with('success', 'Data dosen berhasil dihapus');
}

// =======================================================
// CRUD Ruangan
// =======================================================
public function ruangan()
{
    $model = new \App\Models\RuanganModel();
    $data['ruangan'] = $model->findAll();
    return view('admin/ruangan/index', $data);
}

public function tambahRuangan()
{
    return view('admin/ruangan/tambah');
}

public function simpanRuangan()
{
    $validationRule = [
        'nama_ruangan' => 'required|is_unique[ruangan.nama_ruangan]',
        'kapasitas'    => 'required|numeric',
    ];

    if (!$this->validate($validationRule)) {
        return redirect()->back()->with('error', 'Nama ruangan sudah ada atau data tidak valid')->withInput();
    }

    $ruanganModel = new \App\Models\RuanganModel();
    $ruanganModel->insert($this->request->getPost());

    return redirect()->to('/admin/ruangan')->with('success', 'Data ruangan berhasil ditambahkan');
}

public function editRuangan($id)
{
    $model = new \App\Models\RuanganModel();
    $data['ruang'] = $model->find($id);
    return view('admin/ruangan/edit', $data);
}

public function updateRuangan($id)
{
    $model = new \App\Models\RuanganModel();

    $data = [
        'nama_ruangan' => $this->request->getPost('nama_ruangan'),
        'kapasitas' => $this->request->getPost('kapasitas')
    ];

    $model->update($id, $data);
    return redirect()->to('/admin/ruangan')->with('success', 'Data ruangan berhasil diperbarui');
}

public function hapusRuangan($id)
{
    $model = new \App\Models\RuanganModel();
    $model->delete($id);
    return redirect()->to('/admin/ruangan')->with('success', 'Data ruangan berhasil dihapus');
}

public function users()
{
   $data['users'] = (new \App\Models\UserModel())->findAll();
   return view('admin/user/index', $data);
}

public function tambahUser()
{
   // ambil daftar mahasiswa/dosen untuk pilihan relasi
   $data['mahasiswa'] = (new \App\Models\MahasiswaModel())->findAll();
   $data['dosen'] = (new \App\Models\DosenModel())->findAll();
   return view('admin/user/tambah', $data);
}

public function simpanUser()
{
    $userModel = new \App\Models\UserModel();
    $userModel->insert([
        'username'   => $this->request->getPost('username'),
        'password'   => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT),
        'role'       => $this->request->getPost('role'),
        'related_id' => $this->request->getPost('related_id')
    ]);

    return redirect()->to('/admin/user')->with('success', 'User berhasil ditambahkan.');
}

/// ========================
// CRUD Jadwal
// ========================

public function jadwal()
{
    $jadwalModel = new \App\Models\JadwalModel();

    $data['jadwal'] = $jadwalModel
        ->select('jadwal.id, jadwal.nama_kelas, jadwal.hari, jadwal.jam_mulai, jadwal.jam_selesai,
                mata_kuliah.nama_mata_kuliah, ruangan.nama_ruangan, dosen.nama as nama_dosen')
        ->join('mata_kuliah', 'mata_kuliah.id_mata_kuliah = jadwal.id_mata_kuliah')
        ->join('ruangan', 'ruangan.id_ruangan = jadwal.id_ruangan')
        ->join('dosen', 'dosen.nidn = jadwal.nidn')
        ->findAll();


    return view('admin/jadwal/index', $data);
}

public function tambahJadwal()
{
    $dosenModel = new \App\Models\DosenModel();
    $ruanganModel = new \App\Models\RuanganModel();
    $mataKuliahModel = new \App\Models\MataKuliahModel();

    $data = [
        'dosen'      => $dosenModel->findAll(),
        'ruangan'    => $ruanganModel->findAll(),
        'mataKuliah' => $mataKuliahModel->findAll()
    ];

    return view('admin/jadwal/tambah', $data);
}

public function simpanJadwal()
{
    $jadwalModel = new \App\Models\JadwalModel();
    $mataKuliahModel = new \App\Models\MataKuliahModel();

    $nama_kelas  = $this->request->getPost('nama_kelas');
    $id_mk       = $this->request->getPost('id_mata_kuliah');
    $id_ruangan  = $this->request->getPost('id_ruangan');
    $nidn        = $this->request->getPost('nidn');
    $hari        = $this->request->getPost('hari');
    $jam_mulai   = $this->request->getPost('jam_mulai');
    $jam_selesai = $this->request->getPost('jam_selesai');

    // Hitung jam selesai berdasar SKS (50 menit per SKS)
    $mk = $mataKuliahModel->find($id_mk);
    $durasiMenit = $mk['sks'] * 50;
    $jam_selesai = date("H:i", strtotime($jam_mulai . " +{$durasiMenit} minutes"));

    // Cek bentrok jadwal
    $bentrok = $jadwalModel->cekBentrok($hari, $id_ruangan, $nidn, $jam_mulai, $jam_selesai);
    if ($bentrok) {
        return redirect()->back()->with('error', '❌ Jadwal bentrok dengan jadwal lain! Silakan pilih ruangan/jam lain.');
    }

    // Simpan
    $jadwalModel->insert([
        'nama_kelas'     => $nama_kelas,
        'id_mata_kuliah' => $id_mk,
        'id_ruangan'     => $id_ruangan,
        'nidn'           => $nidn,
        'hari'           => $hari,
        'jam_mulai'      => $jam_mulai,
        'jam_selesai'    => $jam_selesai,
    ]);

    return redirect()->to('/admin/jadwal')->with('success', '✅ Jadwal berhasil ditambahkan');
}

public function editJadwal($id)
{
    $jadwalModel = new \App\Models\JadwalModel();
    $dosenModel = new \App\Models\DosenModel();
    $mataKuliahModel = new \App\Models\MataKuliahModel();
    $ruanganModel = new \App\Models\RuanganModel();

    $data['jadwal'] = $jadwalModel->find($id);
    $data['dosen'] = $dosenModel->findAll();
    $data['mataKuliah'] = $mataKuliahModel->findAll();
    $data['ruangan'] = $ruanganModel->findAll();

    return view('admin/jadwal/edit', $data);
}

public function updateJadwal($id)
{
    $jadwalModel = new \App\Models\JadwalModel();
    $mataKuliahModel = new \App\Models\MataKuliahModel();

    $nama_kelas = $this->request->getPost('nama_kelas');
    $id_mk = $this->request->getPost('id_mata_kuliah');
    $id_ruangan = $this->request->getPost('id_ruangan');
    $nidn = $this->request->getPost('nidn');
    $hari = $this->request->getPost('hari');
    $jam_mulai = $this->request->getPost('jam_mulai');

    // Hitung jam selesai berdasar SKS
    $mk = $mataKuliahModel->find($id_mk);
    $durasiMenit = $mk['sks'] * 50;
    $jam_selesai = date("H:i", strtotime($jam_mulai . " +{$durasiMenit} minutes"));

    // Cek bentrok
    $bentrok = $jadwalModel->cekBentrokUpdate($hari, $id_ruangan, $nidn, $jam_mulai, $jam_selesai, $id);
    if ($bentrok) {
        return redirect()->back()->with('error', '❌ Jadwal bentrok! Silakan ubah jadwal.');
    }

    $jadwalModel->update($id, [
        'nama_kelas'     => $nama_kelas,
        'id_mata_kuliah' => $id_mk,
        'id_ruangan'     => $id_ruangan,
        'nidn'           => $nidn,
        'hari'           => $hari,
        'jam_mulai'      => $jam_mulai,
        'jam_selesai'    => $jam_selesai,
    ]);

    return redirect()->to('/admin/jadwal')->with('success', '✅ Jadwal berhasil diperbarui');
}

public function hapusJadwal($id)
{
    $model = new \App\Models\JadwalModel();
    $model->delete($id);
    return redirect()->to('admin/jadwal')->with('success', 'Jadwal berhasil dihapus');
}


public function mataKuliah()
{
    $model = new MataKuliahModel();
    $data['mk'] = $model->findAll();
    return view('admin/mata_kuliah/index', $data);
}

public function tambahMataKuliah()
{
    return view('admin/mata_kuliah/tambah');
}

public function simpanMataKuliah()
{
    $rules = [
        'kode_mata_kuliah' => 'required|is_unique[mata_kuliah.kode_mata_kuliah]',
        'nama_mata_kuliah' => 'required|is_unique[mata_kuliah.nama_mata_kuliah]',
        'sks'              => 'required|numeric'
    ];

    if (!$this->validate($rules)) {
        return redirect()->back()->with('error', 'Kode atau nama mata kuliah sudah ada')->withInput();
    }

    $mkModel = new \App\Models\MataKuliahModel();
    $mkModel->insert($this->request->getPost());

    return redirect()->to('/admin/mata-kuliah')->with('success', 'Mata kuliah berhasil ditambahkan');
}

public function editMataKuliah($id)
{
    $model = new MataKuliahModel();
    $data['mk'] = $model->find($id);
    return view('admin/mata_kuliah/edit', $data);
}

public function updateMataKuliah($id)
{
    $model = new MataKuliahModel();
    $model->update($id, [
        'kode_mata_kuliah' => $this->request->getPost('kode_mata_kuliah'),
        'nama_mata_kuliah' => $this->request->getPost('nama_mata_kuliah'),
        'sks'              => $this->request->getPost('sks'),
    ]);
    return redirect()->to('/admin/mata-kuliah')->with('success', 'Mata kuliah berhasil diperbarui');
}

public function hapusMataKuliah($id)
{
    $model = new MataKuliahModel();
    $model->delete($id);
    return redirect()->to('/admin/mata-kuliah')->with('success', 'Mata kuliah berhasil dihapus');
}


}

