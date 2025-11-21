<?php

namespace App\Controllers;

class HomeController extends BaseController
{
    public function index()
    {
        $session = session();

        if (!$session->get('isLoggedIn')) {
            return redirect()->to('/login');
        }

        $role = $session->get('role');

        // Arahkan sesuai role
        switch ($role) {
            case 'admin':
                return redirect()->to('/admin/dashboard');
            case 'mahasiswa':
                return redirect()->to('/mahasiswa/dashboard');
            case 'dosen':
                return redirect()->to('/dosen/dashboard');
            default:
                return redirect()->to('/login')->with('error', 'Role tidak dikenali');
        }
    }
}
