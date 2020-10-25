<?php namespace App\Database\Seeds;

class PekerjaanSeeder extends \CodeIgniter\Database\Seeder
{
  public function run()
  {
   $initPekerjaan = [
      ["pekerjaan_nama" => "Tidak Bekerja"],
      ["pekerjaan_nama" => "Sekolah"],
    ];
    $this->db->table('pekerjaan')->insertBatch($initPekerjaan);
  }
}