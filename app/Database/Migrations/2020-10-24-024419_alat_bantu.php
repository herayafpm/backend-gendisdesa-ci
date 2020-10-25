<?php namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AlatBantu extends Migration
{
	public function up()
	{
			$this->forge->addField([
					'alat_bantu_id'          => [
							'type'           => 'INT',
							'constraint'     => 11,
							'unsigned'       => true,
							'auto_increment' => true,
					],
					'alat_bantu_nama'       => [
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
			$this->forge->addKey('alat_bantu_id', true);
			$this->forge->createTable('alat_bantu');
	}

	public function down()
	{
			$this->forge->dropTable('alat_bantu');
	}
}
