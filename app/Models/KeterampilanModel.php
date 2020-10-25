<?php namespace App\Models;

use CodeIgniter\Model;

class KeterampilanModel extends Model
{
    protected $table      = 'keterampilan';
    protected $primaryKey = 'keterampilan_id';
    protected $returnType     = 'array';
    protected $allowedFields = ['keterampilan_nama'];
    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
}