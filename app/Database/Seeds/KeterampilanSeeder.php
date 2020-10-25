<?php namespace App\Database\Seeds;

class KeterampilanSeeder extends \CodeIgniter\Database\Seeder
{
  public function run()
  {
    $initKeterampilan = [
            ["keterampilan_nama" => "Pijat"],
            ["keterampilan_nama" => "Bermain Musik"],
            ["keterampilan_nama" => "Memasak"],
            ["keterampilan_nama" => "Menjahit"],
            ["keterampilan_nama" => "Membuat Keset"],
    ];
    $this->db->table('keterampilan')->insertBatch($initKeterampilan);
  }
}