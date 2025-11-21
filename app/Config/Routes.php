<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

// === DEFAULT PAGE ===
$routes->get('/', 'Auth::index');

// === AUTH ===
$routes->get('/login', 'Auth::index');
$routes->post('/auth/login', 'Auth::login');
$routes->get('/logout', 'Auth::logout');

// === TEST DB (opsional) ===
$routes->get('dbtest', 'DatabaseTest::index');

// =======================
// ADMIN ROUTES
// =======================
$routes->group('admin', ['filter' => 'role:admin'], function($routes){

        $routes->get('/', 'AdminController::dashboard');
    $routes->get('dashboard', 'AdminController::dashboard');

    // CRUD Mahasiswa
// CRUD Mahasiswa
    $routes->get('mahasiswa', 'AdminController::mahasiswa');
    $routes->get('mahasiswa/tambah', 'AdminController::tambahMahasiswa');
    $routes->post('mahasiswa/simpan', 'AdminController::simpanMahasiswa');
    $routes->get('mahasiswa/edit/(:segment)', 'AdminController::editMahasiswa/$1');
    $routes->post('mahasiswa/update/(:segment)', 'AdminController::updateMahasiswa/$1');
    $routes->get('mahasiswa/hapus/(:segment)', 'AdminController::hapusMahasiswa/$1');

    // CRUD Dosen
$routes->get('dosen', 'AdminController::dosen');
$routes->get('dosen/tambah', 'AdminController::tambahDosen');
$routes->post('dosen/simpan', 'AdminController::simpanDosen');
$routes->get('dosen/edit/(:any)', 'AdminController::editDosen/$1');
$routes->post('dosen/update/(:any)', 'AdminController::updateDosen/$1');
$routes->get('dosen/hapus/(:any)', 'AdminController::hapusDosen/$1');


    // CRUD Ruangan
$routes->get('ruangan','AdminController::ruangan');
$routes->get('ruangan/tambah','AdminController::tambahRuangan');
$routes->post('ruangan/simpan', 'AdminController::simpanRuangan');
$routes->get('ruangan/edit/(:num)','AdminController::editRuangan/$1');
$routes->post('ruangan/update/(:num)','AdminController::updateRuangan/$1');
$routes->get('ruangan/hapus/(:num)','AdminController::hapusRuangan/$1');


    // CRUD Jadwal
// --- Routing untuk Jadwal ---
$routes->get('jadwal', 'AdminController::jadwal');
$routes->get('jadwal/tambah', 'AdminController::tambahJadwal');
$routes->post('jadwal/simpan', 'AdminController::simpanJadwal');
$routes->get('jadwal/edit/(:num)', 'AdminController::editJadwal/$1');
$routes->post('jadwal/update/(:num)', 'AdminController::updateJadwal/$1');
$routes->get('jadwal/hapus/(:num)', 'AdminController::hapusJadwal/$1');

$routes->get('mata-kuliah', 'AdminController::mataKuliah');
$routes->get('mata-kuliah/tambah', 'AdminController::tambahMataKuliah');
$routes->post('mata-kuliah/simpan', 'AdminController::simpanMataKuliah');
$routes->get('mata-kuliah/edit/(:num)', 'AdminController::editMataKuliah/$1');
$routes->post('mata-kuliah/update/(:num)', 'AdminController::updateMataKuliah/$1');
$routes->get('mata-kuliah/hapus/(:num)', 'AdminController::hapusMataKuliah/$1');

});

// =======================
// MAHASISWA ROUTES
// =======================
$routes->group('mahasiswa', ['filter' => 'role:mahasiswa'], function($routes){
    $routes->get('dashboard', 'MahasiswaController::dashboard');
    $routes->get('rencana-studi', 'MahasiswaController::rencanaStudi');
    $routes->post('rencana-studi/simpan', 'MahasiswaController::simpanRencanaStudi');
    $routes->get('hasil-studi', 'MahasiswaController::hasilStudi');
});

// =======================
// DOSEN ROUTES
// =======================
$routes->group('dosen', ['filter' => 'role:dosen'], function($routes){
    $routes->get('dashboard', 'DosenController::dashboard');
    $routes->get('jadwal', 'DosenController::jadwalSaya');
    $routes->get('input-nilai/(:num)', 'DosenController::inputNilai/$1');
    $routes->post('simpan-nilai', 'DosenController::simpanNilai');
});
