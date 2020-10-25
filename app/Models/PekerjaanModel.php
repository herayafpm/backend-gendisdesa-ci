<?php namespace App\Models;

use CodeIgniter\Model;

class PekerjaanModel extends Model
{
    protected $table      = 'pekerjaan';
    protected $primaryKey = 'pekerjaan_id';
    protected $returnType     = 'array';
    protected $allowedFields = ['pekerjaan_nama'];
    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
}