<?php
namespace App\Validations;

class MyRule{
    public function cek_pass(string $user_password,$user_id)
    {
        $userModel = new \App\Models\UserModel();
        $user = $userModel->where('user_id',$user_id)->first();
        if(md5($user_password) == $user['user_password']){
            return true;
        }
        return false;
    }
    public function cek_nik(string $user_nik)
    {
        $userModel = new \App\Models\UserModel();
        $user = $userModel->getUser($user_nik);
        if($user){
            return true;
        }
        return false;
    }
}