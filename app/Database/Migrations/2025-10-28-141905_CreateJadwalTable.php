<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateJadwalTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => ['type' => 'INT', 'auto_increment' => true],
            'nama_kelas' => ['type' => 'VARCHAR', 'constraint' => 50],
            'id_mata_kuliah' => ['type' => 'INT'],
            'id_ruangan' => ['type' => 'INT'],
            'nidn' => ['type' => 'VARCHAR', 'constraint' => 20],
            'hari' => ['type' => 'VARCHAR', 'constraint' => 10],
            'jam' => ['type' => 'VARCHAR', 'constraint' => 10],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('id_mata_kuliah', 'mata_kuliah', 'id_mata_kuliah', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('id_ruangan', 'ruangan', 'id_ruangan', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('nidn', 'dosen', 'nidn', 'CASCADE', 'CASCADE');
        $this->forge->createTable('jadwal');
    }

    public function down()
    {
        $this->forge->dropTable('jadwal');
    }
}
