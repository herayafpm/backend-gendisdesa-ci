<?php namespace App\Models;

use CodeIgniter\Model;

class OrangTuaModel extends Model
{
    protected $table      = 'orang_tua';
    protected $primaryKey = 'orang_tua_id';

    protected $returnType     = 'array';

    protected $allowedFields = ['difabel_no_urut','ayah_nama','ayah_nik','ayah_no_kk','ayah_tempat_lahir','ayah_tanggal_lahir','ayah_jk','ayah_agama_id','ayah_alamat_jalan_perumahan','ayah_alamat_rt','ayah_alamat_rw','ayah_alamat_desa','ayah_alamat_kecamatan','ayah_alamat_kabupaten','ayah_alamat_telepon','ibu_nama','ibu_nik','ibu_no_kk','ibu_tempat_lahir','ibu_tanggal_lahir','ibu_jk','ibu_agama_id','ibu_alamat_jalan_perumahan','ibu_alamat_rt','ibu_alamat_rw','ibu_alamat_desa','ibu_alamat_kecamatan','ibu_alamat_kabupaten','ibu_alamat_telepon'];
    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    
}