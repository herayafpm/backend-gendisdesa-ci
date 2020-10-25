<?php namespace App\Database\Seeds;

class KebutuhanPerawatanSeeder extends \CodeIgniter\Database\Seeder
{
  public function run()
  {
    $initKebutuhanPerawatan = [
            ["kebutuhan_perawatan_nama" => "Makan/Minum"],
            ["kebutuhan_perawatan_nama" => "Bimbingan Konseling"],
            ["kebutuhan_perawatan_nama" => "Obat Obatan"],
            ["kebutuhan_perawatan_nama" => "Peralatan Medis"],
            ["kebutuhan_perawatan_nama" => "Kursi Roda"],
            ["kebutuhan_perawatan_nama" => "Kruk"],
            ["kebutuhan_perawatan_nama" => "Kaki Palsu"],
            ["kebutuhan_perawatan_nama" => "Tongkat"],
    ];
    $this->db->table('kebutuhan_perawatan')->insertBatch($initKebutuhanPerawatan);
  }
}