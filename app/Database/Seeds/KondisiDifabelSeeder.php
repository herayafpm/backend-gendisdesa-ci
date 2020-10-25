<?php namespace App\Database\Seeds;

class KondisiDifabelSeeder extends \CodeIgniter\Database\Seeder
{
  public function run()
  {
    $initKondisiDifabel = [
          ["kondisi_difabel_nama" => "Bisa Mandiri"],
          ["kondisi_difabel_nama" => "Tidak Bisa Mandiri"],
          ["kondisi_difabel_nama" => "Bed Ridden"],
  ];
  $this->db->table('kondisi_difabel')->insertBatch($initKondisiDifabel);
  }
}