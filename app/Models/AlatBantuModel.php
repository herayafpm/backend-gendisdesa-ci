<?php namespace App\Models;

use CodeIgniter\Model;

class AlatBantuModel extends Model
{
    protected $table      = 'alat_bantu';
    protected $primaryKey = 'alat_bantu_id';
    protected $returnType     = 'array';
    protected $allowedFields = ['alat_bantu_nama'];
    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
}