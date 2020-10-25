<?php namespace App\Models;

use CodeIgniter\Model;

class IdentitasDifabelModel extends Model
{
    protected $table      = 'identitas_difabel';
    protected $primaryKey = 'difabel_id';

    protected $returnType     = 'array';

    protected $allowedFields = ['difabel_no_urut','difabel_nama','difabel_nik','difabel_no_kk','difabel_no_dtks','difabel_tempat_lahir','difabel_tanggal_lahir','difabel_jk','agama_id','alamat_jalan_perumahan','alamat_rt','alamat_rw','alamat_desa','alamat_kecamatan','alamat_kabupaten','alamat_telepon','jenis_disabilitas_id','alat_bantu_id','fasilitas_kesehatan_id','keterampilan_id','organisasi_id','difabel_organisasis_lainnya','kondisi_orang_tua_id','pekerjaan_id','difabel_pekerjaan_lainnya','kebutuhan_pelatihan_id','difabel_pelatihan_lainnya','kebutuhan_perawatan_id','difabel_perawatan_lainnya','kondisi_difabel_id','difabel_permasalahan','sudah_verif','foto','user_daftar','difabel_image'];

    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    public function insertData($data)
    {
        return $this->save($data);
    }
    public function getDif($nik)
    {
        return $this->where('nik',$nik)->first();
    }
    public function getDifabel($where)
    {
        return $this->where($where)->first();
    }
    public function getParent($nik)
    {
        return $this->where('nik',$nik)->first();
    }
    public function getDifabels($user_nik,$limit,$offset)
    {
        $difabels = $this->where('user_daftar',$user_nik)->orderBy('difabel_id','desc')->get($limit,$offset)->getResultArray();
        $orangTuaModel = new \App\Models\OrangTuaModel();
        $no = 0;
        foreach ($difabels as $difabel) {
            $difabels[$no]['orang_tua'] = $orangTuaModel->where(['difabel_no_urut'=>$difabel['difabel_no_urut']])->first();
            $no++;
        }
        return $difabels;
    }
    public function countDifabels()
    {
        return $this->countAll();
    }

    public function getNoUrut()
    {
        $difabelNoUrut = "NO-".date('Y-m-d');
        $db = $this->db->table($this->table);
        $noUrut = $db->select('difabel_no_urut')->like('difabel_no_urut',$difabelNoUrut)->orderBy('difabel_id','DESC')->get()->getRow();
        if($noUrut){
            $noUrut = $noUrut->difabel_no_urut;
            [$str,$year,$month,$day,$no] = explode('-',$noUrut);
            $date = $year."-".$month."-".$day;
            $no = (int) $no + 1;
            return $str."-".$date."-".$no;
        }else{
            return $difabelNoUrut."-1";
        }
    }
}