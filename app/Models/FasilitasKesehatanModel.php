<?php namespace App\Models;

use CodeIgniter\Model;

class FasilitasKesehatanModel extends Model
{
    protected $table      = 'fasilitas_kesehatan';
    protected $primaryKey = 'fasilitas_kesehatan_id';
    protected $returnType     = 'array';
    protected $allowedFields = ['fasilitas_kesehatan_nama'];
    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
}