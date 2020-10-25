<?php namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Pekerjaan extends Migration
{
	public function up()
	{
			$this->forge->addField([
					'pekerjaan_id'          => [
							'type'           => 'INT',
							'constraint'     => 11,
							'unsigned'       => true,
							'auto_increment' => true,
					],
					'pekerjaan_nama'       => [
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
			$this->forge->addKey('pekerjaan_id', true);
			$this->forge->createTable('pekerjaan');
	}

	public function down()
	{
			$this->forge->dropTable('pekerjaan');
	}
}
