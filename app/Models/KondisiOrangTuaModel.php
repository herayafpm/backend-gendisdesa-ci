<?php namespace App\Models;

use CodeIgniter\Model;

class KondisiOrangTuaModel extends Model
{
    protected $table      = 'kondisi_orang_tua';
    protected $primaryKey = 'kondisi_orang_tua_id';
    protected $returnType     = 'array';
    protected $allowedFields = ['kondisi_orang_tua_nama'];
    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
}