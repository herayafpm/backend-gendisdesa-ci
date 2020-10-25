<?php namespace App\Database\Seeds;

class InitSeeder extends \CodeIgniter\Database\Seeder
{
  public function run()
  {
    $this->call('AgamaSeeder');
    $this->call('AlatBantuSeeder');
    $this->call('FasilitasKesehatanSeeder');
    $this->call('JenisDisabilitasSeeder');
    $this->call('KebutuhanPelatihanSeeder');
    $this->call('KebutuhanPerawatanSeeder');
    $this->call('KeterampilanSeeder');
    $this->call('KondisiDifabelSeeder');
  }
}