<?php namespace App\Database\Seeds;

class FasilitasKesehatanSeeder extends \CodeIgniter\Database\Seeder
{
  public function run()
  {
    $initFasilitasKesehatan = [
      ["fasilitas_kesehatan_nama" => "BPJS PBI/KIS PEMERINTAH"],
      ["fasilitas_kesehatan_nama" => "BPJS MANDIRI"],
      ["fasilitas_kesehatan_nama" => "TIDAK PUNYA"],
      ["fasilitas_kesehatan_nama" => "ASURANSI"],
    ];
    $this->db->table('fasilitas_kesehatan')->insertBatch($initFasilitasKesehatan);
  }
}