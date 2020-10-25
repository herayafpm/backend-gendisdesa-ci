<?php namespace App\Models;

use CodeIgniter\Model;

class KondisiDifabelModel extends Model
{
    protected $table      = 'kondisi_difabel';
    protected $primaryKey = 'kondisi_difabel_id';
    protected $returnType     = 'array';
    protected $allowedFields = ['kondisi_difabel_nama'];
    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
}