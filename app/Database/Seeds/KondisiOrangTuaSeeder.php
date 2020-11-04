<?php namespace App\Database\Seeds;

class KondisiOrangTuaSeeder extends \CodeIgniter\Database\Seeder
{
  public function run()
  {
    $initKondisiOrangTua = [
      ["kondisi_orang_tua_nama" => "Mampu"],
      ["kondisi_orang_tua_nama" => "Tidak Mampu"],
      ["kondisi_orang_tua_nama" => "NO DTKS/BDT"],
      ["kondisi_orang_tua_nama" => "NON DTKS/BDT"],
      ["kondisi_orang_tua_nama" => "Tidak Ada Identitas"],
    ];
    $this->db->table('kondisi_orang_tua')->insertBatch($initKondisiOrangTua);
  }
}