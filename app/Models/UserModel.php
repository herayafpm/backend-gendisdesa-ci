<?php namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table      = 'user';
    protected $primaryKey = 'id';

    protected $returnType     = 'array';

    protected $allowedFields = ['user_nik','user_nama','user_tempat_lahir','user_tanggal_lahir','user_jk','desa','rt','rw','kecamatan','kabupaten','provinsi','user_telepon','user_status','user_password','last_login','status_verif'];

    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $beforeInsert = ['hashPassword'];
    protected $beforeUpdate = ['hashPassword','setLogin'];
    protected function hashPassword(array $data)
    {
        if (!isset($data['data']['user_password'])) return $data;
        $data['data']['user_password'] = password_hash($data['data']['user_password'], PASSWORD_DEFAULT);
        return $data;
    }
    protected function setLogin(array $data)
    {
        if (!isset($data['data']['last_login'])) return $data;
        unset($data['data']['updated_at']);
        return $data;
    }
    public function insertUser($data)
    {
        return $this->save($data);
    }
    public function getUser($user_nik)
    {
        return $this->where('user_nik',$user_nik)->first();
    }
    public function change_pass($user_id,$user_password)
    {
        return $this->where('user_id',$user_id)->set(['user_password' => $user_password])->update();
    }
    public function setLastLogin($user_nik)
    {
        $loginUserModel =  new \App\Models\LoginUserModel();
        $loginUserModel->save(['login_user_nik' => $user_nik]);
        return $this->where('user_nik',$user_nik)->set(['last_login' => date('Y-m-d H:i:s')])->update();
    }
    public function authenticate($user_nik,$user_password)
    {
        $auth = $this->where('user_nik',$user_nik)->first();
        if($auth){
            if(password_verify($user_password,$auth['user_password'])){
                return $auth;
            }else{
                return false;
            }
        }else{
            return false;
        }
    }
}