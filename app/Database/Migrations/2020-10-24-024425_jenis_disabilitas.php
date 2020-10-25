<?php namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class JenisDisabilitas extends Migration
{
	public function up()
	{
			$this->forge->addField([
					'jenis_disabilitas_id'          => [
							'type'           => 'INT',
							'constraint'     => 11,
							'unsigned'       => true,
							'auto_increment' => true,
					],
					'jenis_disabilitas_nama'       => [
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
			$this->forge->addKey('jenis_disabilitas_id', true);
			$this->forge->createTable('jenis_disabilitas');
	}

	public function down()
	{
			$this->forge->dropTable('jenis_disabilitas');
	}
}
