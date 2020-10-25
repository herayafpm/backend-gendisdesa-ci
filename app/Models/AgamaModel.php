<?php namespace App\Models;

use CodeIgniter\Model;

class AgamaModel extends Model
{
    protected $table      = 'agama';
    protected $primaryKey = 'agama_id';
    protected $returnType     = 'array';
    protected $allowedFields = ['agama_nama'];
    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
}