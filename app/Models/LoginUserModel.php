<?php namespace App\Models;

use CodeIgniter\Model;

class LoginUserModel extends Model
{
    protected $table      = 'login_user';
    protected $primaryKey = 'login_user_id';
    protected $returnType     = 'array';
    protected $allowedFields = ['login_user_nik','login_user_waktu'];
    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $beforeInsert = ['setWaktu'];
    protected $beforeUpdate = ['setWaktu'];
    protected function setWaktu(array $data)
    {
        $data['data']['login_user_waktu'] = date('Y-m-d H:i:s');
        return $data;
    }
}