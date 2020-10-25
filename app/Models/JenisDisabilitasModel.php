<?php namespace App\Models;

use CodeIgniter\Model;

class JenisDisabilitasModel extends Model
{
    protected $table      = 'jenis_disabilitas';
    protected $primaryKey = 'jenis_disabilitas_id';
    protected $returnType     = 'array';
    protected $allowedFields = ['jenis_disabilitas_nama'];
    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
}