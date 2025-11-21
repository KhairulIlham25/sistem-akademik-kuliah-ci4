<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class MahasiswaSeeder extends Seeder
{
    public function run()
    {
        $data = [
            ['nim' => '2201001', 'nama' => 'Rudi Hartono'],
            ['nim' => '2201002', 'nama' => 'Dina Sari'],
            ['nim' => '2201003', 'nama' => 'Ahmad Fajar'],
        ];
        $this->db->table('mahasiswa')->insertBatch($data);
    }
}
