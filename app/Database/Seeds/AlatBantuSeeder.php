<?php namespace App\Database\Seeds;

class AlatBantuSeeder extends \CodeIgniter\Database\Seeder
{
  public function run()
  {
    $initAlatBantu = [
            ["alat_bantu_nama" => "Kursi Roda"],
            ["alat_bantu_nama" => "Kruk"],
            ["alat_bantu_nama" => "Walker"],
            ["alat_bantu_nama" => "Kursi Roda Adaftive"],
            ["alat_bantu_nama" => "Tongkat"],
            ["alat_bantu_nama" => "Kaki Palsu"],
            ["alat_bantu_nama" => "Tangan Palsu"],
            ["alat_bantu_nama" => "Tidak Menggunakan Alat Bantu"],
    ];
    $this->db->table('alat_bantu')->insertBatch($initAlatBantu);
  }
}