<?php namespace App\Database\Seeds;

class KebutuhanPelatihanSeeder extends \CodeIgniter\Database\Seeder
{
  public function run()
  {
    $initKebutuhanPelatihan = [
      ["kebutuhan_pelatihan_nama" => "Pijat"],
      ["kebutuhan_pelatihan_nama" => "Menjahit"],
      ["kebutuhan_pelatihan_nama" => "Bermain Musik"],
      ["kebutuhan_pelatihan_nama" => "Membuat Kerajinan"],
    ];
    $this->db->table('kebutuhan_pelatihan')->insertBatch($initKebutuhanPelatihan);
  }
}