<?php namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class KebutuhanPelatihan extends Migration
{
	public function up()
	{
			$this->forge->addField([
					'kebutuhan_pelatihan_id'          => [
							'type'           => 'INT',
							'constraint'     => 11,
							'unsigned'       => true,
							'auto_increment' => true,
					],
					'kebutuhan_pelatihan_nama'       => [
							'type'           => 'VARCHAR',
							'constraint'     => '255',
					],
					'created_at'       => [
							'type'           => 'DATETIME',
							'default' => date('Y-m-d H:i:s')
					],
					'updated_at'       => [
							'type'           => 'DATETIME',
							'default' => date('Y-m-d H:i:s')
					],
					'admin_tambah'       => [
							'type'           => 'VARCHAR',
							'constraint'     => '50',
							'default' 			 => '24680',
					],
					'admin_ubah'       => [
							'type'           => 'VARCHAR',
							'constraint'     => '50',
							'default' 			 => '24680',
					],
			]);
			$this->forge->addKey('kebutuhan_pelatihan_id', true);
			$this->forge->createTable('kebutuhan_pelatihan');
	}

	public function down()
	{
			$this->forge->dropTable('kebutuhan_pelatihan');
	}
}
