<?php namespace App\Database\Seeds;

class JenisDisabilitasSeeder extends \CodeIgniter\Database\Seeder
{
  public function run()
  {
    $initJenisDisabilitas = [
      ["jenis_disabilitas_nama" => "Wicara"],
      ["jenis_disabilitas_nama" => "Daksa"],
      ["jenis_disabilitas_nama" => "Ganda"],
      ["jenis_disabilitas_nama" => "Intelektual"],
      ["jenis_disabilitas_nama" => "Celebral Palcy"],
      ["jenis_disabilitas_nama" => "Netra"],
      ["jenis_disabilitas_nama" => "Gangguan Jiwa"],
    ];
    $this->db->table('jenis_disabilitas')->insertBatch($initJenisDisabilitas);
  }
}