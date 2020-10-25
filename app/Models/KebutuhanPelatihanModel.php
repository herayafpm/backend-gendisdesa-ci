<?php namespace App\Models;

use CodeIgniter\Model;

class KebutuhanPelatihanModel extends Model
{
    protected $table      = 'kebutuhan_pelatihan';
    protected $primaryKey = 'kebutuhan_pelatihan_id';
    protected $returnType     = 'array';
    protected $allowedFields = ['kebutuhan_pelatihan_nama'];
    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
}