<?php

namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;

class RoleFilter implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        $session = session();

        // Pastikan user sudah login
if (!$session->get('logged_in')) {

            return redirect()->to('/login');
        }

        // Cek role yang dibutuhkan
        if ($arguments) {
            $allowedRoles = $arguments; // misalnya ['admin'] atau ['mahasiswa', 'dosen']
            $userRole = $session->get('role');

            if (!in_array($userRole, $allowedRoles)) {
                // Jika role tidak sesuai
                return redirect()->to('/login')->with('error', 'Akses ditolak!');
            }
        }

        // Jika lolos, lanjutkan ke controller
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
    }
}
