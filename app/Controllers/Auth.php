<?php

namespace App\Controllers;

use App\Models\UserModel;

class Auth extends BaseController
{
    public function index()
    {
        return view('login');
    }

public function login()
{
    $username = $this->request->getPost('username');
    $password = $this->request->getPost('password');

    $userModel = new UserModel();
    $user = $userModel->where('username', $username)->first();

    if (!$user) {
        return redirect()->back()->with('error', 'Username tidak ditemukan');
    }

    $stored = $user['password'];

    // Cek hash atau plain
    if ((str_starts_with($stored, '$2y$') && !password_verify($password, $stored)) ||
        (!str_starts_with($stored, '$2y$') && $password !== $stored)) {

        return redirect()->back()->with('error', 'Password salah');
    }

// Simpan Session
session()->set([
    'logged_in' => true,
    'id_user' => $user['id_user'],
    'nama_user' => $user['nama_user'],
    'username' => $user['username'],
    'role' => strtolower($user['role']),
    'related_id' => $user['related_id'],
]);



    return redirect()->to('/'.$user['role'].'/dashboard');
}

    public function logout()
    {
        session()->destroy();
        return redirect()->to('/login');
    }
}