<?php

namespace App\Models;
use CodeIgniter\Model;

class NilaiMutuModel extends Model
{
    protected $table = 'nilai_mutu';
    protected $primaryKey = 'nilai_huruf';
    protected $allowedFields = ['nilai_huruf', 'nilai_mutu'];

        public function getNilaiMutu($huruf)
    {
        return $this->where('nilai_huruf', $huruf)->first();
    }
}
