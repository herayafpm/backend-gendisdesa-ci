<?php namespace App\Controllers;
use CodeIgniter\RESTful\ResourceController;
use \Firebase\JWT\JWT;

class AuthController extends ResourceController
{   
    
    protected $format       = 'json';
    protected $modelName    = 'App\Models\UserModel';
 
    public function login()
    {
        $validation =  \Config\Services::validation();
        $loginRule = [
            'user_nik' => [
                'label'  => 'NIK',
                'rules'  => 'required',
                'errors' => [
                    'required' => '{field} tidak boleh kosong',
                ]
            ],
            'user_password' => [
                'label'  => 'Password',
                'rules'  => 'required|min_length[6]',
                'errors' => [
                    'required' => '{field} tidak boleh kosong',
                    'min_length' => '{field} harus lebih dari 6 karakter'
                ]
            ],
        ];
        $dataJson = $this->request->getJson();
        $data = [
            'user_nik' => htmlspecialchars($dataJson->user_nik ?? ''),
            'user_password' => htmlspecialchars($dataJson->user_password ?? ''),
        ];
        $validation->setRules($loginRule);
        if(!$validation->run($data)){
            return $this->respond(["status" => 0,"message"=>"validation error",'data' => $validation->getErrors()], 400); 
        }
        try {
            $user = $this->model->authenticate($data['user_nik'],$data['user_password']);
            if($user){
                if((bool) $user['user_status'] && (bool) $user['status_verif']){
                    $config = config('App');
                    $jwt = JWT::encode($user,$config->JWTKey);
                    $user['token'] = $jwt;
                    $this->model->setLastLogin($user['user_nik']);
                    return $this->respond(["status" => 1,"message" => 'Berhasil Login',"data"=>$user], 200);  
                }else{
                    return $this->respond(["status" => 0,"message"=>"Akun anda belum aktif, akan diproses 1 * 24jam",'data' => []], 500); 
                }
            }else{
                return $this->respond(["status" => 0,"message"=>"nik atau password salah",'data' => []], 400); 
            }
        } catch (\Exception $th) {
            return $this->respond(["status" => 0,"message"=>$th->getMessage(),'data'=>[]], 400); 
        }
    }
    public function profile()
    {
        return $this->respond(['status' => 1,'message'=>"berhasil mengambil data",'data' => $this->request->user], 200);  
    }

    public function register()
    {
        $validation =  \Config\Services::validation();
        $registerRule = [
            'user_nik' => [
                'label'  => 'NIK',
                'rules'  => 'required|is_unique[user.user_nik]',
                'errors' => [
                    'required' => '{field} tidak boleh kosong',
                    'is_unique' => '{field} sudah digunakan akun lain',
                ]
            ],
            'user_nama' => [
                'label'  => 'Nama',
                'rules'  => 'required',
                'errors' => [
                    'required' => '{field} tidak boleh kosong'
                ]
            ],
            'user_tempat_lahir' => [
                'label'  => 'Tempat Lahir',
                'rules'  => 'required',
                'errors' => [
                    'required' => '{field} tidak boleh kosong'
                ]
            ],
            'user_tanggal_lahir' => [
                'label'  => 'Tanggal Lahir',
                'rules'  => 'required',
                'errors' => [
                    'required' => '{field} tidak boleh kosong'
                ]
            ],
            'user_jk' => [
                'label'  => 'Jenis Kelamin',
                'rules'  => 'required',
                'errors' => [
                    'required' => '{field} tidak boleh kosong'
                ]
            ],
            'user_telepon' => [
                'label'  => 'No Telepon (WA)',
                'rules'  => 'required',
                'errors' => [
                    'required' => '{field} tidak boleh kosong'
                ]
            ],
            'desa' => [
                'label'  => 'Desa',
                'rules'  => 'required',
                'errors' => [
                    'required' => '{field} tidak boleh kosong'
                ]
            ],
            'rt' => [
                'label'  => 'RT',
                'rules'  => 'required',
                'errors' => [
                    'required' => '{field} tidak boleh kosong'
                ]
            ],
            'rw' => [
                'label'  => 'RW',
                'rules'  => 'required',
                'errors' => [
                    'required' => '{field} tidak boleh kosong'
                ]
            ],
            'kecamatan' => [
                'label'  => 'Kecamatan',
                'rules'  => 'required',
                'errors' => [
                    'required' => '{field} tidak boleh kosong'
                ]
            ],
            'kabupaten' => [
                'label'  => 'Kabupaten',
                'rules'  => 'required',
                'errors' => [
                    'required' => '{field} tidak boleh kosong'
                ]
            ],
            'provinsi' => [
                'label'  => 'Provinsi',
                'rules'  => 'required',
                'errors' => [
                    'required' => '{field} tidak boleh kosong'
                ]
            ],
            'user_password' => [
                'label'  => 'Password',
                'rules'  => 'required|min_length[6]',
                'errors' => [
                    'required' => '{field} tidak boleh kosong',
                    'min_length' => '{field} harus lebih dari 6 karakter'
                ]
            ],
        ];
        $dataJson = $this->request->getJson();
        $data = [
            'user_nik' => htmlspecialchars($dataJson->user_nik ?? ''),
            'user_nama' => strtoupper(htmlspecialchars($dataJson->user_nama ?? '')),
            'user_tempat_lahir' => htmlspecialchars($dataJson->user_tempat_lahir ?? ''),
            'user_tanggal_lahir' => strtoupper(htmlspecialchars($dataJson->user_tanggal_lahir ?? '')),
            'user_jk' => htmlspecialchars($dataJson->user_jk ?? ''),
            'user_telepon' => strtoupper(htmlspecialchars($dataJson->user_telepon ?? '')),
            'desa' => strtoupper(htmlspecialchars($dataJson->desa ?? '')),
            'rt' => strtoupper(htmlspecialchars($dataJson->rt ?? '')),
            'rw' => strtoupper(htmlspecialchars($dataJson->rw ?? '')),
            'kecamatan' => strtoupper(htmlspecialchars($dataJson->kecamatan ?? '')),
            'kabupaten' => strtoupper(htmlspecialchars($dataJson->kabupaten ?? '')),
            'provinsi' => strtoupper(htmlspecialchars($dataJson->provinsi ?? '')),
            'user_password' => htmlspecialchars($dataJson->user_password ?? ''),
        ];
        $validation->setRules($registerRule);
        if(!$validation->run($data)){
            return $this->respond(["status" => 0,"message"=>"validation error",'data' => $validation->getErrors()], 400); 
        }
        try {
            $data['user_status'] = 1;
            $data['status_verif'] = 1;
            $save = $this->model->insertUser($data);
            if($save){
                return $this->respond(["status" => 1,"message"=>"Berhasil mendaftar, silahkan login",'data' => []], 200);  
            }else{
                return $this->respond(["status" => 0,"message"=>"Gagal mendaftar",'data'=> []], 400); 
            } 
        } catch (\Exception $th) {
            return $this->respond(["status" => 0,"message"=>$th->getMessage(),'data' => []], 400); 
        }
        
    }
    public function change_pass()
    {
        $validation =  \Config\Services::validation();
        $user_id = $this->request->user['user_id'];
        $changePassRule = [
            'old_password' => [
                'label'  => 'Password Lama',
                'rules'  => 'required|cek_pass['.$user_id.']',
                'errors' => [
                    'required' => '{field} tidak boleh kosong',
                    'cek_pass' => '{field} salah',
                ]
            ],
            'new_password' => [
                'label'  => 'Password Baru',
                'rules'  => 'required|min_length[6]',
                'errors' => [
                    'required' => '{field} tidak boleh kosong',
                    'min_length' => '{field} harus lebih dari 6 karakter'
                ]
            ],
        ];
        $dataJson = $this->request->getJson();
        $data = [
            'old_password' => htmlspecialchars($dataJson->old_password ?? ''),
            'new_password' => htmlspecialchars($dataJson->new_password ?? ''),
        ];
        $validation->setRules($changePassRule);
        if(!$validation->run($data)){
            return $this->respond(["status" => 0,"message"=>"validation error",'data' => $validation->getErrors()], 400); 
        }
        try {
            $res = $this->model->change_pass($user_id,$data['new_password']);
            if($res){
                return $this->respond(["status" => 1,"message"=> "Berhasil mengubah password",'data' => []], 200);
            }else{
                return $this->respond(["status" => 0,"message"=>"Gagal mengubah password",'data' => []], 400); 
            }
        } catch (\Exception $th) {
            return $this->respond(["status" => 0,"message"=>$th->getMessage(),'data' => []], 500); 
        }
    }
    public function forgot_pass()
    {
        $validation =  \Config\Services::validation();
        $dataJson = $this->request->getJson();
        $data = [
            'user_nik' => htmlspecialchars($dataJson->user_nik ?? ''),
            'user_password' => htmlspecialchars($dataJson->user_password ?? ''),
        ];
        $forgotPassRule = [
            'user_nik' => [
                'label'  => 'NIK',
                'rules'  => 'required|cek_nik',
                'errors' => [
                    'required' => '{field} tidak boleh kosong',
                    'cek_nik' => '{field} tidak ditemukkan',
                ]
            ],
            'user_password' => [
                'label'  => 'Password',
                'rules'  => 'required|min_length[6]',
                'errors' => [
                    'required' => '{field} tidak boleh kosong',
                    'min_length' => '{field} harus lebih dari 6 karakter'
                ]
            ],
        ];
        
        $validation->setRules($forgotPassRule);
        if(!$validation->run($data)){
            return $this->respond($validation->getErrors(), 400);
        }
        try {
            $user = $this->model->getUser($data['user_nik']);
            $res = $this->model->change_pass($user['user_id'],$data['user_password']);
            if($res){
                return $this->respond(["status" => 1,"message"=> "Berhasil mengubah password",'data'=> []], 200);
            }else{
                return $this->respond(["status" => 0,"message"=>"Gagal mengubah password",'data' => []], 400); 
            }
        } catch (\Throwable $th) {
            return $this->respond(["status" => 0,"message"=>$th->getMessage(),'data' => []], 500); 
        }
    }
    
}
