<?php namespace App\Controllers;
use CodeIgniter\RESTful\ResourceController;
class DashboardController extends ResourceController
{   
    
	protected $format       = 'json';
    protected $modelName    = 'App\Models\IdentitasDifabelModel';

    public function banners()
    {
        $client = new \GuzzleHttp\Client();
        $request = $client->get('http://gendisdesa.banyumaskab.go.id/api');
        if($request->getStatusCode() == 200){
            $response = json_decode($request->getBody(),true);
            $no = 0;
            $urlUpload = config('App')->baseURL."uploads";
            foreach ($response['data'] as $image) {
                [$url,$file] = explode("images/",$image);
                if(!file_exists("uploads/$file")){
                    $client->request('GET', $image, ['sink' => "uploads/$file"]);
                }
                $response['data'][$no] = $urlUpload."/$file";
                $no++;
            }
            return $this->respond($response, 200);
        }else{
            return $this->respond(["status" => 0,"message" => "Data banner tidak ditemukkan","data" => []], 400);
        }
    }
    public function static()
	{
        $agamaModel =  new \App\Models\AgamaModel();
        $agama = $agamaModel->get()->getResultArray();

        $alatBantuModel =  new \App\Models\AlatBantuModel();
        $alat_bantu = $alatBantuModel->get()->getResultArray();

        $fasilitasKesehatanModel =  new \App\Models\FasilitasKesehatanModel();
        $fasilitas_kesehatan = $fasilitasKesehatanModel->get()->getResultArray();

        $jenisDisabilitasModel =  new \App\Models\JenisDisabilitasModel();
        $jenis_disabilitas = $jenisDisabilitasModel->get()->getResultArray();

        $kebutuhanPelatihanModel =  new \App\Models\KebutuhanPelatihanModel();
        $kebutuhan_pelatihan = $kebutuhanPelatihanModel->get()->getResultArray();

        $kebutuhanPerawatanModel =  new \App\Models\KebutuhanPerawatanModel();
        $kebutuhan_perawatan = $kebutuhanPerawatanModel->get()->getResultArray();

        $keterampilanModel =  new \App\Models\KeterampilanModel();
        $keterampilan = $keterampilanModel->get()->getResultArray();

        $kondisiDifabelModel =  new \App\Models\KondisiDifabelModel();
        $kondisi_difabel = $kondisiDifabelModel->get()->getResultArray();

        $kondisiOrangTuaModel =  new \App\Models\KondisiOrangTuaModel();
        $kondisi_orang_tua = $kondisiOrangTuaModel->get()->getResultArray();

        $organisasiModel =  new \App\Models\OrganisasiModel();
        $organisasi = $organisasiModel->get()->getResultArray();

        $pekerjaanModel =  new \App\Models\PekerjaanModel();
        $pekerjaan = $pekerjaanModel->get()->getResultArray();

		return $this->respond(["status" => 1,"message" => "Data berhasil diambil","data" => compact('agama','alat_bantu','fasilitas_kesehatan','jenis_disabilitas','kebutuhan_perawatan','keterampilan','kondisi_difabel','kondisi_orang_tua','organisasi','pekerjaan','kebutuhan_pelatihan')], 200); 
	}

    public function index()
    {
        $user = $this->request->user;
        $dataGet = $this->request->getGet();
        $limit = $dataGet["limit"] ?? 10;
        $offset = $dataGet["offset"] ?? 0;
        try {
            $difabels = $this->model->getDifabels($user['user_nik'],$limit,$offset);
            $current_page = ($offset == 0)?1:($offset/$limit) * $limit;
            $total = $this->model->countDifabels();
            $total_page = ceil($total/$limit);
            if($difabels){
                return $this->respond([
                    "status" => 1,
                    "message"=>"Berhasil mengambil data",
                    "data"=>compact('current_page','total','total_page','difabels')], 200); 
            }else{
                return $this->respond([
                    "status" => 0,
                    "message"=>'Anda belum pernah mendaftarkan difabel',
                    "data"=>[]], 200); 
            }
        } catch (\Throwable $th) {
            return $this->respond(["status" => 0,"message"=>$th->getMessage(),'data' => []], 400); 
        } 
    }
    
    public function show($difabel_id = NULL)
    {
        $user = $this->request->user;
        try {
            $difabel = $this->model->getDifabel(['difabel_id' => $difabel_id]);
            if($difabel){
                $orangTuaModel = new \App\Models\OrangTuaModel();
                $difabel['orang_tua'] = $orangTuaModel->where('difabel_no_urut',$difabel['difabel_no_urut'])->get()->getRow();
                return $this->respond(["status" => 1,"message" => "Data difabel ditemukkan","data" => $difabel],200);
            }else{
                return $this->respond(["status" => 0,"message" => "Data difabel tidak ditemukkan",'data' => []], 400);
            }
        } catch (\Exception $th) {
            return $this->respond(["status" => 0,"message" => $th->getMessage(),'data' => []], 400);
        }
    }
    public function cek_status()
    {
        try {
            $dataJson = $this->request->getJson();
            $difabel = $this->model->getDifabel(['difabel_nik' => $dataJson->difabel_nik]);
            if($difabel){
                $message = "";
                if((bool)$difabel['sudah_verif']){
                    $message = "sudah terverivikasi";
                }else{
                    $message = "belum diverivikasi, masih dalam proses 2 x 24Jam";
                }
                return $this->respond(["status" => 1,"message" => $message,"data" => []], 200);
            }else{
                return $this->respond(["status" => 0,"message" => "Data difabel tidak ditemukkan"], 400);
            }
        } catch (\Throwable $th) {
           return $this->respond(["status" => 0,"message"=>$th->getMessage(),'data' => []], 400); 
        }
    }
    function register()
    {
        $user = $this->request->user;
        $dataJson = $this->request->getJson();
        $dataJson->user_daftar = $user['user_nik'];
        // upload file
        try {
            $noUrut = $this->model->getNoUrut();
            if(isset($dataJson->difabel_image) && !empty($dataJson->difabel_image)){
                helper('upload_file');
                $dataJson->difabel_image = upload_file($dataJson->difabel_image);
            }
            if(empty($dataJson->difabel_image)){
                $dataJson->difabel_image = 'kosong.png';
            }
            $dataDifabel = [
                "difabel_no_urut" => $noUrut,
                "user_daftar" => $dataJson->user_daftar,
                "difabel_nama" => strtoupper(htmlspecialchars($dataJson->difabel_nama ?? '0')),
                "difabel_nik" => strtoupper(htmlspecialchars($dataJson->difabel_nik ?? '0')),
                "difabel_no_kk" => strtoupper(htmlspecialchars($dataJson->difabel_no_kk ?? '0')),
                "difabel_no_dtks" => htmlspecialchars($dataJson->difabel_no_dtks ?? ''),
                "difabel_tempat_lahir" => strtoupper(htmlspecialchars($dataJson->difabel_tempat_lahir ?? '0')),
                "difabel_tanggal_lahir" => htmlspecialchars($dataJson->difabel_tanggal_lahir ?? '1000-01-01'),
                "difabel_jk" => htmlspecialchars($dataJson->difabel_jk ?? '0'),
                "agama_id" => htmlspecialchars($dataJson->agama_id ?? 0),
                "alamat_jalan_perumahan" => strtoupper(htmlspecialchars($dataJson->alamat_jalan_perumahan ?? '')),
                "alamat_rt" => htmlspecialchars($dataJson->alamat_rt ?? '0'),
                "alamat_rw" => htmlspecialchars($dataJson->alamat_rw ?? '0'),
                "alamat_desa" => strtoupper(htmlspecialchars($dataJson->alamat_desa ?? '0')),
                "alamat_kecamatan" => strtoupper(htmlspecialchars($dataJson->alamat_kecamatan ?? '0')),
                "alamat_kabupaten" => strtoupper(htmlspecialchars($dataJson->alamat_kabupaten ?? '0')),
                "alamat_telepon" => htmlspecialchars($dataJson->alamat_telepon ?? '0'),
                "jenis_disabilitas_id" => htmlspecialchars($dataJson->jenis_disabilitas_id ?? 0),
                "alat_bantu_id" => htmlspecialchars($dataJson->alat_bantu_id ?? 0),
                "fasilitas_kesehatan_id" => htmlspecialchars($dataJson->fasilitas_kesehatan_id ?? 0),
                "keterampilan_id" => htmlspecialchars($dataJson->keterampilan_id ?? 0),
                "difabel_keterampilan_lainnya" => htmlspecialchars($dataJson->difabel_keterampilan_lainnya ?? null),
                "organisasi_id" => htmlspecialchars($dataJson->organisasi_id ?? 0),
                "difabel_organisasi_lainnya" => htmlspecialchars($dataJson->difabel_organisasi_lainnya ?? null),
                "kondisi_orang_tua_id" => htmlspecialchars($dataJson->kondisi_orang_tua_id ?? 0),
                "pekerjaan_id" => htmlspecialchars($dataJson->pekerjaan_id ?? 0),
                "difabel_pekerjaan_lainnya" => htmlspecialchars($dataJson->difabel_pekerjaan_lainnya ?? null),
                "kebutuhan_pelatihan_id" => htmlspecialchars($dataJson->kebutuhan_pelatihan_id ?? 0),
                "difabel_pelatihan_lainnya" => htmlspecialchars($dataJson->difabel_pelatihan_lainnya ?? null),
                "kebutuhan_perawatan_id" => htmlspecialchars($dataJson->kebutuhan_perawatan_id ?? 0),
                "difabel_perawatan_lainnya" => htmlspecialchars($dataJson->difabel_perawatan_lainnya ?? null),
                "kondisi_difabel_id" => htmlspecialchars($dataJson->kondisi_difabel_id ?? 0),
                "difabel_image" => htmlspecialchars($dataJson->difabel_image ?? 'kosong.png'),
            ];
            $dataAyah = [
                "difabel_no_urut" => $noUrut,
                "ayah_nama" => strtoupper(htmlspecialchars($dataJson->ayah->ayah_nama ?? '0')),
                "ayah_nik" => htmlspecialchars($dataJson->ayah->ayah_nik ?? '0'),
                "ayah_no_kk" => htmlspecialchars($dataJson->ayah->ayah_no_kk ?? '0'),
                "ayah_tempat_lahir" => strtoupper(htmlspecialchars($dataJson->ayah->ayah_tempat_lahir ?? '0')),
                "ayah_tanggal_lahir" => htmlspecialchars($dataJson->ayah->ayah_tanggal_lahir ?? '1000-01-01'),
                "ayah_agama_id" => htmlspecialchars($dataJson->ayah->ayah_agama_id ?? 0),
                "ayah_alamat_jalan_perumahan" => strtoupper(htmlspecialchars($dataJson->ayah->ayah_alamat_jalan_perumahan ?? '0')),
                "ayah_alamat_rt" => htmlspecialchars($dataJson->ayah->ayah_alamat_rt ?? '0'),
                "ayah_alamat_rw" => htmlspecialchars($dataJson->ayah->ayah_alamat_rw ?? '0'),
                "ayah_alamat_desa" => strtoupper(htmlspecialchars($dataJson->ayah->ayah_alamat_desa ?? '0')),
                "ayah_alamat_kecamatan" => strtoupper(htmlspecialchars($dataJson->ayah->ayah_alamat_kecamatan ?? '0')),
                "ayah_alamat_kabupaten" => strtoupper(htmlspecialchars($dataJson->ayah->ayah_alamat_kabupaten ?? '0')),
                "ayah_alamat_telepon" => htmlspecialchars($dataJson->ayah->ayah_alamat_telepon ?? '0')
            ];
            $dataIbu = [
                "difabel_no_urut" => $noUrut,
                "ibu_nama" => strtoupper(htmlspecialchars($dataJson->ibu->ibu_nama ?? '0')),
                "ibu_nik" => htmlspecialchars($dataJson->ibu->ibu_nik ?? '0'),
                "ibu_no_kk" => htmlspecialchars($dataJson->ibu->ibu_no_kk ?? '0'),
                "ibu_tempat_lahir" => strtoupper(htmlspecialchars($dataJson->ibu->ibu_tempat_lahir ?? '0')),
                "ibu_tanggal_lahir" => htmlspecialchars($dataJson->ibu->ibu_tanggal_lahir ?? '1000-01-01'),
                "ibu_agama_id" => htmlspecialchars($dataJson->ibu->ibu_agama_id ?? 0),
                "ibu_alamat_jalan_perumahan" => strtoupper(htmlspecialchars($dataJson->ibu->ibu_alamat_jalan_perumahan ?? '0')),
                "ibu_alamat_rt" => htmlspecialchars($dataJson->ibu->ibu_alamat_rt ?? '0'),
                "ibu_alamat_rw" => htmlspecialchars($dataJson->ibu->ibu_alamat_rw ?? '0'),
                "ibu_alamat_desa" => strtoupper(htmlspecialchars($dataJson->ibu->ibu_alamat_desa ?? '0')),
                "ibu_alamat_kecamatan" => strtoupper(htmlspecialchars($dataJson->ibu->ibu_alamat_kecamatan ?? '0')),
                "ibu_alamat_kabupaten" => strtoupper(htmlspecialchars($dataJson->ibu->ibu_alamat_kabupaten ?? '0')),
                "ibu_alamat_telepon" => htmlspecialchars($dataJson->ibu->ibu_alamat_telepon ?? '0')
            ];
            $insert = $this->model->insertData($dataDifabel);
            if($insert){
                $orangtua = $dataAyah + $dataIbu;
                $orangtuaModel =  new \App\Models\OrangTuaModel();
                $orangtuaModel->save($orangtua);
                return $this->respond(["status" => 1,"message" => 'berhasil mendaftar','data' => []], 400); 
            }else{
                return $this->respond(["status" => 0,"message" => 'gagal mendaftarkan difabel','data' => []], 400); 
            }
        } catch (\Exception $th) {
            return $this->respond(["status" => 0,"message" => $th->getMessage(),'data' => []], 400); 
        }
    }
    function edit($difabel_id = NULL)
    {
        $user = $this->request->user;
        $dataJson = $this->request->getJson();
        unset($dataJson->user_daftar);
        try {
            $difabel = $this->model->getDifabel(['difabel_id' => $difabel_id]);
            if(!$difabel){
                 return $this->respond(["status" => 0,"message" => 'Data tidak ditemukkan','data' => []], 200); 
            }
            if($difabel['sudah_verif'] == 1){
                return $this->respond(["status" => 1,"message" => 'Data sudah divalidasi admin, tidak dapat diubah','data' => []], 200); 
            }
            if($dataJson->difabel_image == $difabel['difabel_image']){
                unset($dataJson->difabel_image);
            }else{
                helper('upload_file');
                $dataJson->difabel_image = upload_file($dataJson->difabel_image);
            }
            $dataDifabel = [
                'difabel_id' => $difabel_id,
                "difabel_nama" => strtoupper(htmlspecialchars($dataJson->difabel_nama ?? '0')),
                "difabel_nik" => strtoupper(htmlspecialchars($dataJson->difabel_nik ?? '0')),
                "difabel_no_kk" => strtoupper(htmlspecialchars($dataJson->difabel_no_kk ?? '0')),
                "difabel_no_dtks" => htmlspecialchars($dataJson->difabel_no_dtks ?? ''),
                "difabel_tempat_lahir" => strtoupper(htmlspecialchars($dataJson->difabel_tempat_lahir ?? '0')),
                "difabel_tanggal_lahir" => htmlspecialchars($dataJson->difabel_tanggal_lahir ?? '1000-01-01'),
                "difabel_jk" => htmlspecialchars($dataJson->difabel_jk ?? '0'),
                "agama_id" => htmlspecialchars($dataJson->agama_id ?? 0),
                "alamat_jalan_perumahan" => strtoupper(htmlspecialchars($dataJson->alamat_jalan_perumahan ?? '')),
                "alamat_rt" => htmlspecialchars($dataJson->alamat_rt ?? '0'),
                "alamat_rw" => htmlspecialchars($dataJson->alamat_rw ?? '0'),
                "alamat_desa" => strtoupper(htmlspecialchars($dataJson->alamat_desa ?? '0')),
                "alamat_kecamatan" => strtoupper(htmlspecialchars($dataJson->alamat_kecamatan ?? '0')),
                "alamat_kabupaten" => strtoupper(htmlspecialchars($dataJson->alamat_kabupaten ?? '0')),
                "alamat_telepon" => htmlspecialchars($dataJson->alamat_telepon ?? '0'),
                "jenis_disabilitas_id" => htmlspecialchars($dataJson->jenis_disabilitas_id ?? 0),
                "alat_bantu_id" => htmlspecialchars($dataJson->alat_bantu_id ?? 0),
                "fasilitas_kesehatan_id" => htmlspecialchars($dataJson->fasilitas_kesehatan_id ?? 0),
                "keterampilan_id" => htmlspecialchars($dataJson->keterampilan_id ?? 0),
                "difabel_keterampilan_lainnya" => htmlspecialchars($dataJson->difabel_keterampilan_lainnya ?? null),
                "organisasi_id" => htmlspecialchars($dataJson->organisasi_id ?? 0),
                "difabel_organisasi_lainnya" => htmlspecialchars($dataJson->difabel_organisasi_lainnya ?? null),
                "kondisi_orang_tua_id" => htmlspecialchars($dataJson->kondisi_orang_tua_id ?? 0),
                "pekerjaan_id" => htmlspecialchars($dataJson->pekerjaan_id ?? 0),
                "difabel_pekerjaan_lainnya" => htmlspecialchars($dataJson->difabel_pekerjaan_lainnya ?? null),
                "kebutuhan_pelatihan_id" => htmlspecialchars($dataJson->kebutuhan_pelatihan_id ?? 0),
                "difabel_pelatihan_lainnya" => htmlspecialchars($dataJson->difabel_pelatihan_lainnya ?? null),
                "kebutuhan_perawatan_id" => htmlspecialchars($dataJson->kebutuhan_perawatan_id ?? 0),
                "difabel_perawatan_lainnya" => htmlspecialchars($dataJson->difabel_perawatan_lainnya ?? null),
                "kondisi_difabel_id" => htmlspecialchars($dataJson->kondisi_difabel_id ?? 0),
                "difabel_image" => htmlspecialchars($dataJson->difabel_image ?? 'kosong.png'),
            ];
            $dataAyah = [
                "ayah_nama" => strtoupper(htmlspecialchars($dataJson->ayah->ayah_nama ?? '0')),
                "ayah_nik" => htmlspecialchars($dataJson->ayah->ayah_nik ?? '0'),
                "ayah_no_kk" => htmlspecialchars($dataJson->ayah->ayah_no_kk ?? '0'),
                "ayah_tempat_lahir" => strtoupper(htmlspecialchars($dataJson->ayah->ayah_tempat_lahir ?? '0')),
                "ayah_tanggal_lahir" => htmlspecialchars($dataJson->ayah->ayah_tanggal_lahir ?? '1000-01-01'),
                "ayah_agama_id" => htmlspecialchars($dataJson->ayah->ayah_agama_id ?? 0),
                "ayah_alamat_jalan_perumahan" => strtoupper(htmlspecialchars($dataJson->ayah->ayah_alamat_jalan_perumahan ?? '0')),
                "ayah_alamat_rt" => htmlspecialchars($dataJson->ayah->ayah_alamat_rt ?? '0'),
                "ayah_alamat_rw" => htmlspecialchars($dataJson->ayah->ayah_alamat_rw ?? '0'),
                "ayah_alamat_desa" => strtoupper(htmlspecialchars($dataJson->ayah->ayah_alamat_desa ?? '0')),
                "ayah_alamat_kecamatan" => strtoupper(htmlspecialchars($dataJson->ayah->ayah_alamat_kecamatan ?? '0')),
                "ayah_alamat_kabupaten" => strtoupper(htmlspecialchars($dataJson->ayah->ayah_alamat_kabupaten ?? '0')),
                "ayah_alamat_telepon" => htmlspecialchars($dataJson->ayah->ayah_alamat_telepon ?? '0')
            ];
            $dataIbu = [
                "ibu_nama" => strtoupper(htmlspecialchars($dataJson->ibu->ibu_nama ?? '0')),
                "ibu_nik" => htmlspecialchars($dataJson->ibu->ibu_nik ?? '0'),
                "ibu_no_kk" => htmlspecialchars($dataJson->ibu->ibu_no_kk ?? '0'),
                "ibu_tempat_lahir" => strtoupper(htmlspecialchars($dataJson->ibu->ibu_tempat_lahir ?? '0')),
                "ibu_tanggal_lahir" => htmlspecialchars($dataJson->ibu->ibu_tanggal_lahir ?? '1000-01-01'),
                "ibu_agama_id" => htmlspecialchars($dataJson->ibu->ibu_agama_id ?? 0),
                "ibu_alamat_jalan_perumahan" => strtoupper(htmlspecialchars($dataJson->ibu->ibu_alamat_jalan_perumahan ?? '0')),
                "ibu_alamat_rt" => htmlspecialchars($dataJson->ibu->ibu_alamat_rt ?? '0'),
                "ibu_alamat_rw" => htmlspecialchars($dataJson->ibu->ibu_alamat_rw ?? '0'),
                "ibu_alamat_desa" => strtoupper(htmlspecialchars($dataJson->ibu->ibu_alamat_desa ?? '0')),
                "ibu_alamat_kecamatan" => strtoupper(htmlspecialchars($dataJson->ibu->ibu_alamat_kecamatan ?? '0')),
                "ibu_alamat_kabupaten" => strtoupper(htmlspecialchars($dataJson->ibu->ibu_alamat_kabupaten ?? '0')),
                "ibu_alamat_telepon" => htmlspecialchars($dataJson->ibu->ibu_alamat_telepon ?? '0')
            ];
            if(isset($dataJson->difabel_image)){
                $dataDifabel['difabel_image'] = $dataJson->difabel_image;
            }
            $dif = $this->model->insertData($dataDifabel);
            if($dif){
                if(isset($dataJson->difabel_image)){
                    if($difabel['difabel_image'] != 'kosong.png'){
                        if(file_exists(FCPATH.'uploads/'.$difabel['difabel_image'])){
                            unlink(FCPATH.'uploads/'.$difabel['difabel_image']);
                        }
                    }
                }
                $orangtua = $dataAyah + $dataIbu;
                $orangtuaModel =  new \App\Models\OrangTuaModel();
                $orangtuaModel->where('difabel_no_urut',$difabel['difabel_no_urut'])->set($orangtua)->update();
                return $this->respond(["status" => 1,"message"=>"Berhasil mengupdate data, silahkan tunggu untuk admin memvalidasi data",'data' => []], 200);  
            }else{
                if($difabel['difabel_image'] != 'kosong.png'){
                   if(file_exists(FCPATH.'uploads/'.$difabel['difabel_image'])){
                        unlink(FCPATH.'uploads/'.$difabel['difabel_image']);
                    }
                }
                return $this->respond(["status" => 0,"message" => 'Data tidak bisa diproses silahkan periksa kembali data anda','data' => []], 400); 
            }
        } catch (\Throwable $th) {
            return $this->respond(["status" => 0,"message" => $th->getMessage(),'data' => []], 400); 
        }
       
    }
    public function delete($difabel_id = NULL)
    {
        $user = $this->request->user;
        try {
            $difabel = $this->model->getDifabel(['difabel_id' => $difabel_id,'user_daftar' => $user['user_nik']]);
            if($difabel){
                if((bool)$difabel['sudah_verif']){
                    return $this->respond(["status" => 0,"message" => "Data tidak bisa dihapus, karena sudah terverifikasi",'data' => []], 400); 
                }else{
                    $delete = $this->model->delete($difabel_id);
                    if($delete){
                        if($difabel['difabel_image'] != 'kosong.png'){
                            $difabel_image = FCPATH.'uploads/'.$difabel['difabel_image'];
                            if(file_exists($difabel_image)){
                                unlink($difabel_image);
                            }
                        }
                        $orangtuaModel =  new \App\Models\OrangTuaModel();
                        $orangtuaModel->where('difabel_no_urut',$difabel['difabel_no_urut'])->delete();
                        return $this->respond(["status" => 1,"message" => "Data berhasil dihapus",'data' => []], 200); 
                    }else{
                        return $this->respond(["status" => 0,"message" => "Data gagal dihapus",'data' => []], 400); 
                    }
                }
            }else{
                return $this->respond(["status" => 0,"message" => "Data tidak ditemukkan",'data' => []], 400); 
            }
        } catch (\Exception $th) {
            return $this->respond(["status" => 0,"message" => $th->getMessage(),'data' => []], 400); 
        }
    }
    
}
