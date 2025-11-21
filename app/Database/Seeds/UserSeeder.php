<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'username'    => 'admin',
                'password'    => password_hash('admin123', PASSWORD_DEFAULT),
                'role'        => 'admin',
                'related_id'  => null
            ],
            [
                'username'    => 'mahasiswa1',
                'password'    => password_hash('12345', PASSWORD_DEFAULT),
                'role'        => 'mahasiswa',
                'related_id'  => '230101001' // nim mahasiswa
            ],
            [
                'username'    => 'dosen1',
                'password'    => password_hash('12345', PASSWORD_DEFAULT),
                'role'        => 'dosen',
                'related_id'  => 'D123' // nidn dosen
            ],
        ];

        $this->db->table('user')->insertBatch($data);
    }
}
