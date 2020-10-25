<?php namespace App\Models;

use CodeIgniter\Model;

class OrganisasiModel extends Model
{
    protected $table      = 'organisasi';
    protected $primaryKey = 'organisasi_id';
    protected $returnType     = 'array';
    protected $allowedFields = ['organisasi_nama'];
    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
}