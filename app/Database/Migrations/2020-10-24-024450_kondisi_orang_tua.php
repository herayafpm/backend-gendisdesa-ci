<?php namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class KondisiOrangTua extends Migration
{
	public function up()
	{
			$this->forge->addField([
					'kondisi_orang_tua_id'          => [
							'type'           => 'INT',
							'constraint'     => 11,
							'unsigned'       => true,
							'auto_increment' => true,
					],
					'kondisi_orang_tua_nama'       => [
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
			$this->forge->addKey('kondisi_orang_tua_id', true);
			$this->forge->createTable('kondisi_orang_tua');
	}

	public function down()
	{
			$this->forge->dropTable('kondisi_orang_tua');
	}
}
