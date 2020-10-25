<?php namespace App\Database\Seeds;

class AgamaSeeder extends \CodeIgniter\Database\Seeder
{
  public function run()
  {
    $initAgama = [
            ["agama_nama" => "Islam"],
            ["agama_nama" => "Protestan"],
            ["agama_nama" => "Katolik"],
            ["agama_nama" => "Hindu"],
            ["agama_nama" => "Buddha"],
            ["agama_nama" => "Konghucu"],
    ];
    $this->db->table('agama')->insertBatch($initAgama);
  }
}