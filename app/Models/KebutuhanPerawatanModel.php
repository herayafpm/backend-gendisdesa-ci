<?php namespace App\Models;

use CodeIgniter\Model;

class KebutuhanPerawatanModel extends Model
{
    protected $table      = 'kebutuhan_perawatan';
    protected $primaryKey = 'kebutuhan_perawatan_id';
    protected $returnType     = 'array';
    protected $allowedFields = ['kebutuhan_perawatan_nama'];
    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
}