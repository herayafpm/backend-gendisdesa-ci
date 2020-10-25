<?php namespace App\Database\Seeds;

class OrganisasiSeeder extends \CodeIgniter\Database\Seeder
{
  public function run()
  {
   $initOrganisasi = [
      ["organisasi_nama" => "Pertuni"],
      ["organisasi_nama" => "Itmi"],
      ["organisasi_nama" => "Gergatin"],
      ["organisasi_nama" => "PPDI"],
      ["organisasi_nama" => "Bina Akses"],
      ["organisasi_nama" => "Tidak Ikut Sama Sekali"],
    ];
    $this->db->table('organisasi')->insertBatch($initOrganisasi);
  }
}